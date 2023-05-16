<?php

namespace Variux\Warranty\Controller\Sro\Labor;

use Magento\Company\Model\CompanyContext;
use Magento\Customer\Model\Session;
use Magento\Framework\Controller\ResultFactory;
use Variux\Warranty\Helper\SuggestHelper;
use Variux\Warranty\Model\SroLaborFactory;
use Variux\Warranty\Model\SroLaborRepository;
use Variux\Warranty\Model\SroFactory;
use Variux\Warranty\Model\ResourceModel\Sro as SroResourceModel;
use Variux\Warranty\Model\ResourceModel\Workcode as WorkcodeResourceModel;
use Variux\Warranty\Model\WorkcodeFactory;
use Variux\Warranty\Model\WarrantyFactory;
use Variux\Warranty\Model\ResourceModel\Warranty as WarrantyResourceModel;
use Magento\Framework\Pricing\Helper\Data as PriceHelper;
use Variux\Warranty\Helper\CompanyDetails as CompanyDetailsHelper;
use Magento\Customer\Model\ResourceModel\CustomerRepository;
use NumberFormatter;

class Save extends \Variux\Warranty\Controller\AbstractAction
{
    /**
     * @var SroLaborFactory
     */
    protected $sroLaborFactory;
    /**
     * @var SroLaborRepository
     */
    protected $sroLaborRepository;
    /**
     * @var SroFactory
     */
    protected $sroFactory;
    /**
     * @var SroResourceModel
     */
    protected $sroResourceModel;
    /**
     * @var WorkcodeResourceModel
     */
    protected $workcodeResourceModel;
    /**
     * @var WorkcodeFactory
     */
    protected $workcodeFactory;
    /**
     * @var WarrantyFactory
     */
    protected $warrantyFactory;
    /**
     * @var WarrantyResourceModel
     */
    protected $warrantyResourceModel;
    /**
     * @var PriceHelper
     */
    protected $priceHelper;
    /**
     * @var CompanyDetailsHelper
     */
    protected $companyDetailsHelper;
    /**
     * @var CustomerRepository
     */
    protected $customerRepository;

    /**
     * @param \Magento\Framework\App\Action\Context $context
     * @param CompanyContext $companyContext
     * @param \Psr\Log\LoggerInterface $logger
     * @param Session $_customerSession
     * @param \Variux\Warranty\Helper\Data $helperData
     * @param SuggestHelper $suggestHelper
     * @param SroLaborFactory $sroLaborFactory
     * @param SroLaborRepository $sroLaborRepository
     * @param SroFactory $sroFactory
     * @param SroResourceModel $sroResourceModel
     * @param WorkcodeResourceModel $workcodeResourceModel
     * @param WorkcodeFactory $workcodeFactory
     * @param WarrantyFactory $warrantyFactory
     * @param WarrantyResourceModel $warrantyResourceModel
     * @param PriceHelper $priceHelper
     * @param CompanyDetailsHelper $companyDetailsHelper
     * @param CustomerRepository $customerRepository
     */
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        CompanyContext $companyContext,
        \Psr\Log\LoggerInterface $logger,
        Session $_customerSession,
        \Variux\Warranty\Helper\Data $helperData,
        SuggestHelper $suggestHelper,
        SroLaborFactory $sroLaborFactory,
        SroLaborRepository $sroLaborRepository,
        SroFactory $sroFactory,
        SroResourceModel $sroResourceModel,
        WorkcodeResourceModel $workcodeResourceModel,
        WorkcodeFactory $workcodeFactory,
        WarrantyFactory $warrantyFactory,
        WarrantyResourceModel $warrantyResourceModel,
        PriceHelper $priceHelper,
        CompanyDetailsHelper $companyDetailsHelper,
        CustomerRepository $customerRepository
    ) {
        parent::__construct(
            $context,
            $companyContext,
            $logger,
            $_customerSession,
            $helperData,
            $suggestHelper
        );
        $this->sroLaborFactory = $sroLaborFactory;
        $this->sroLaborRepository = $sroLaborRepository;
        $this->sroFactory = $sroFactory;
        $this->sroResourceModel = $sroResourceModel;
        $this->workcodeResourceModel = $workcodeResourceModel;
        $this->workcodeFactory = $workcodeFactory;
        $this->warrantyFactory = $warrantyFactory;
        $this->warrantyResourceModel = $warrantyResourceModel;
        $this->priceHelper = $priceHelper;
        $this->companyDetailsHelper = $companyDetailsHelper;
        $this->customerRepository = $customerRepository;
    }

    public function execute()
    {
        $acceptedValue = [
            "item_id" => "",
            "sro_id" => "",
            "hour_worked" => "",
            "work_code" => "",
            "labor_hourly_rate" => "",
            "note" => "",
            "description" => "",
            "total" => ""
        ];
        try {
            $data = $this->getRequest()->getParams();
            $data = array_intersect_key($data, $acceptedValue);
            if (!$data["item_id"]) {
                unset($data["item_id"]);
            }
            $customerId = $this->_customerSession->getCustomerId();
            $customer = $this->_customerSession->getCustomer();
            $companyId = $this->companyDetailsHelper->getInfo($customerId)->getId();
            $laborRate = $this->helperData->getPartner()->getLaborRate();
            $labor = $this->sroLaborFactory->create();
            $labor->setData($data);
            $sro = $this->sroFactory->create();
            $this->sroResourceModel->load($sro, $labor->getSroId());
            if ($sro->hasData() && $sro->getId() && $sro->getCustomerId() == $customerId) {
                $warranty = $this->warrantyFactory->create();
                $this->warrantyResourceModel->load($warranty, $sro->getWarrantyId());
                if ($warranty->getStatus() == \Variux\Warranty\Model\Warranty::STATUS_ARRAY["INCOMP"]["key"]) {
                    $workCode = $this->workcodeFactory->create();
                    $this->workcodeResourceModel->loadByCode($workCode, $labor->getWorkCode());
                    if ($workCode->hasData() && $workCode->getId()) {
                        $labor->setSroLine(1);
                        if ($workCode->getWorkCode() != "MC") {
                            $labor->setHourWorked($workCode->getDuration());
                        } else {
                            $fmt = new NumberFormatter('en_US', NumberFormatter::DECIMAL);
                            $tmp = $fmt->parse($labor->getHourWorked());
                            $labor->setHourWorked($tmp);
                        }
                        if ($labor->getHourWorked() > 0) {
                            $labor->setCompanyId($companyId);
                            $labor->setLaborHourlyRate($laborRate);
                            $labor->setTransDate($warranty->getDateOfRepair());
                            $labor->setDescription($workCode->getDescription());
                            $labor->setCustomerId($customerId);
                            $labor->setPartnerId($this->helperData->getPartner()->getId());
                            $labor->setCostConv(null);
                            $labor->setSroOper(10);
                            $this->sroLaborRepository->save($labor);
                            $responseData = $labor->getData();
                            $responseData["total"] = $this->priceHelper->currency($responseData["labor_hourly_rate"] * $responseData["hour_worked"], true, false);
                            $responseData["labor_hourly_rate"] = $this->priceHelper->currency($responseData["labor_hourly_rate"], true, false);
                            $responseData = array_intersect_key($responseData, $acceptedValue);
                            $response = [
                                'data' => $responseData,
                                'msg' => __('Update labor success')
                            ];
                        } else {
                            $response = [
                                'error' => true,
                                'msg' => "Invalid Hour Worked"
                            ];
                        }
                    } else {
                        $response = [
                            'error' => true,
                            'msg' => "Invalid Work Code"
                        ];
                    }
                } else {
                    $response = [
                        'error' => true,
                        'msg' => "Warranty is submitted"
                    ];
                }
            } else {
                $response = [
                    'error' => true,
                    'msg' => "Invalid SRO id"
                ];
            }

        } catch (\Exception $e) {
            $response = [
                'error' => true,
                'msg' => $e->getMessage()
            ];
        }

        $resultJson = $this->resultFactory->create(ResultFactory::TYPE_JSON);
        $resultJson->setData(json_encode($response));
        return $resultJson;
    }
}
