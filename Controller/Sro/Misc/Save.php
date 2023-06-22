<?php

namespace Variux\Warranty\Controller\Sro\Misc;

use Magento\Framework\App\Action\Context;
use Magento\Company\Model\CompanyContext;
use Magento\Customer\Model\Session;
use Variux\Warranty\Helper\SuggestHelper;
use Variux\Warranty\Model\SroMiscFactory;
use Variux\Warranty\Model\SroMiscRepository;
use Variux\Warranty\Model\WarrantyFactory;
use Variux\Warranty\Model\ResourceModel\Warranty as WarrantyResourceModel;
use Variux\Warranty\Model\ResourceModel\Sro as SroResourceModel;
use Variux\Warranty\Model\SroFactory;
use Variux\Warranty\Helper\CompanyDetails;
use Magento\Framework\Controller\ResultFactory;
use NumberFormatter;

class Save extends \Variux\Warranty\Controller\AbstractAction
{

    /**
     * @var SroMiscFactory
     */
    protected $sroMiscFactory;
    /**
     * @var SroMiscRepository
     */
    protected $sroMiscRepository;
    /**
     * @var WarrantyFactory
     */
    protected $warrantyFactory;
    /**
     * @var WarrantyResourceModel
     */
    protected $warrantyResourceModel;
    /**
     * @var SroResourceModel
     */
    protected $sroResourceModel;
    /**
     * @var SroFactory
     */
    protected $sroFactory;
    /**
     * @var CompanyDetails
     */
    protected $companyDetails;

    /**
     * @param Context $context
     * @param CompanyContext $companyContext
     * @param \Psr\Log\LoggerInterface $logger
     * @param Session $_customerSession
     * @param \Variux\Warranty\Helper\Data $helperData
     * @param SuggestHelper $suggestHelper
     * @param SroMiscFactory $sroMiscFactory
     * @param SroMiscRepository $sroMiscRepository
     * @param WarrantyFactory $warrantyFactory
     * @param WarrantyResourceModel $warrantyResourceModel
     * @param SroResourceModel $sroResourceModel
     * @param SroFactory $sroFactory
     * @param CompanyDetails $companyDetails
     */
    public function __construct(
        Context $context,
        CompanyContext $companyContext,
        \Psr\Log\LoggerInterface  $logger,
        Session $_customerSession,
        \Variux\Warranty\Helper\Data $helperData,
        SuggestHelper $suggestHelper,
        SroMiscFactory $sroMiscFactory,
        SroMiscRepository $sroMiscRepository,
        WarrantyFactory $warrantyFactory,
        WarrantyResourceModel $warrantyResourceModel,
        SroResourceModel $sroResourceModel,
        SroFactory $sroFactory,
        CompanyDetails $companyDetails
    ) {
        parent::__construct(
            $context,
            $companyContext,
            $logger,
            $_customerSession,
            $helperData,
            $suggestHelper
        );
        $this->sroMiscFactory = $sroMiscFactory;
        $this->sroMiscRepository = $sroMiscRepository;
        $this->warrantyFactory = $warrantyFactory;
        $this->warrantyResourceModel = $warrantyResourceModel;
        $this->sroResourceModel = $sroResourceModel;
        $this->sroFactory = $sroFactory;
        $this->companyDetails = $companyDetails;
    }

    /**
     * Execute
     *
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\Result\Json|(\Magento\Framework\Controller\Result\Json&\Magento\Framework\Controller\ResultInterface)|\Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $acceptedValue = [
            "item_id" => "",
            "sro_id" => "",
            "amount" => "",
            "misc_code" => "",
            "note" => "",
            "description" => "",
            "type" => ""
        ];

        $resultJson = $this->resultFactory->create(ResultFactory::TYPE_JSON);
        try {
            $data = $this->getRequest()->getParams();
            $data = array_intersect_key($data, $acceptedValue);
            if (!$data["item_id"]) {
                unset($data["item_id"]);
            }
            $sroMisc = $this->sroMiscFactory->create();
            $sroMisc->setData($data);
            $customerId = $this->_customerSession->getCustomerId();
            $companyId = $this->companyDetails->getInfo($customerId)->getId();
            $sro = $this->sroFactory->create();
            $this->sroResourceModel->load($sro, $sroMisc->getSroId());
            if ($sro->hasData() && $sro->getId() && $sro->getCustomerId() == $customerId) {
                if ($sroMisc->getMiscCode() == "FRT" || $sroMisc->getMiscCode() == "IMP") {
                    $warranty = $this->warrantyFactory->create();
                    $this->warrantyResourceModel->load($warranty, $sro->getWarrantyId());
                    if ($warranty->getStatus() == \Variux\Warranty\Model\Warranty::STATUS_ARRAY["INCOMP"]["key"]) {
                        $sroMisc->setTransDate($warranty->getDateOfRepair());
                        $this->checkMiscCode($sroMisc, $warranty, $resultJson);
                        $sroMisc->setCustomerId($customerId);
                        $sroMisc->setCompanyId($companyId);
                        $sroMisc->setPartnerId($this->helperData->getPartner()->getId());
                        $sroMisc->setPartnerNum($this->helperData->getPartner()->getPartnerNum());
                        $sroMisc->setQtyConv(1);
                        $sroMisc->setSroLine(1);
                        $sroMisc->setSroOper(10);
                        $fmt = new NumberFormatter('en_US', NumberFormatter::DECIMAL);
                        $tmp = $fmt->parse($sroMisc->getAmount());
                        $sroMisc->setAmount($tmp);
                        if ($sroMisc->getAmount() > 0) {
                            $this->sroMiscRepository->save($sroMisc);
                            $responseData = $sroMisc->getData();
                            $responseData = array_intersect_key($responseData, $acceptedValue);
                            $response = [
                                'data' =>  $responseData,
                                'msg' => __('Update misc success')
                            ];
                        } else {
                            $response = [
                                'error' => true,
                                'msg' => 'Invalid amount value'
                            ];
                        }
                    } else {
                        $response = [
                            'error' => true,
                            'msg' => 'Warranty is submitted'
                        ];
                    }
                } else {
                    $response = [
                        'error' => true,
                        'msg' => 'Invalid misc code'
                    ];
                }
            } else {
                $response = [
                    'error' => true,
                    'msg' => 'Invalid SRO Id'
                ];
            }

        } catch (\Exception $e) {
            $response = [
                'error' => true,
                'msg' => $e->getMessage()
            ];
        }

        $resultJson->setData(json_encode($response));
        return $resultJson;
    }

    /**
     * Check Misc Code
     *
     * @param object $sroMisc
     * @param object $warranty
     * @param object $resultJson
     * @return void
     */
    protected function checkMiscCode($sroMisc, $warranty, $resultJson)
    {
        if ($sroMisc->getMiscCode() == "FRT") {
            $sroMisc->setDescription("Freight");
            $sroMisc->setType("freight");
            if (!$warranty->getInvoiceNumber() && !$warranty->getOrderNumber()) {
                $response = [
                    'error' => true,
                    'msg' => __('Invoice and Order Number is required for freight')
                ];
                $resultJson->setData(json_encode($response));
                return $resultJson;
            }
        } else {
            $sroMisc->setDescription("Import");
            $sroMisc->setType("import_fee");
        }
    }
}
