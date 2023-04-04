<?php

namespace Variux\Warranty\Controller\Index;

use Magento\Framework\App\Action\Context;
use Variux\Warranty\Model\WarrantyFactory;
use NumberFormatter;
use Variux\Warranty\Helper\CompanyDetails;

class Save extends \Variux\Warranty\Controller\AbstractAction
{
    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $resultPageFactory;

    /**
     * @var \Variux\Warranty\Model\WarrantyFactory
     */
    protected $warrantyFactory;

    /**
     * @var \Variux\Warranty\Model\WarrantyRepository
     */
    protected $warrantyRepository;

    /**
     * @var \Magento\Framework\Data\Form\FormKey\Validator
     */
    protected $formKeyValidator;

    /**
     * @var \Variux\Warranty\Model\SroFactory
     */
    protected $sroFactory;

    /**
     * @var \Variux\Warranty\Model\SroRepository
     */
    protected $sroRepository;

    /**
     * @var CompanyDetails
     */
    protected $companyDetails;




    /**
     * @param Context $context
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     * @param \Magento\Framework\Data\Form\FormKey\Validator $formKeyValidator
     * @param WarrantyFactory $warrantyFactory
     * @param \Variux\Warranty\Model\WarrantyRepository $warrantyRepository
     * @param \Variux\Warranty\Model\SroFactory $sroFactory
     * @param \Variux\Warranty\Model\SroRepository $sroRepository
     * @param CompanyDetails $companyDetails
     */
    public function __construct(
        Context $context,
        \Magento\Company\Model\CompanyContext $companyContext,
        \Psr\Log\LoggerInterface $logger,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Magento\Framework\Data\Form\FormKey\Validator $formKeyValidator,
        \Variux\Warranty\Model\WarrantyFactory $warrantyFactory,
        \Variux\Warranty\Model\WarrantyRepository $warrantyRepository,
        \Variux\Warranty\Model\SroFactory $sroFactory,
        \Variux\Warranty\Model\SroRepository $sroRepository,
        CompanyDetails $companyDetails
    )
    {
        parent::__construct($context, $companyContext, $logger);

        $this->resultPageFactory = $resultPageFactory;
        $this->formKeyValidator = $formKeyValidator;
        $this->warrantyFactory = $warrantyFactory;
        $this->warrantyRepository = $warrantyRepository;
        $this->sroFactory = $sroFactory;
        $this->sroRepository = $sroRepository;
        $this->companyDetails = $companyDetails;
    }

    /**
     * @return array
     */
    private function validatedParams()
    {
        $data = $this->getRequest()->getPostValue();
        $acceptedValue = [
            "warranty_id" => [],
            "engine" => ["required" => true, "max-length" => 30],
            "description" => ["required" => true],
            "item_sku" => ["required" => true, "max-length" => 30],
            "boat_owner_name" => ["required" => true, "max-length" => 60],
            "reference_number" => ["required" => true, "max-length" => 25],
            "date_of_failure" => ["required" => true, "mysql-date" => true],
            "date_of_repair" => ["required" => true, "mysql-date" => true],
            "engine_hour" => ["required" => true, "decimal" => true],
            "invoice_number" => ["max-length" => 10],
            "order_number" => ["max-length" => 10],
            "dealer_name" => ["required" => true, "max-length" => 30],
            "dealer_phone_number" => ["required" => true, "max-length" => 25],
            "claim_processor_email" => ["required" => true, "max-length" => 60],
            "brief_description" => ["required" => true, "max-length" => 40],
            "reason_note" => ["required" => true],
            "resolution_note" => ["required" => true]
        ];
        $result = [];
        $fmt = new NumberFormatter('en_US', NumberFormatter::DECIMAL);
        foreach ($acceptedValue as $key => $value) {
            if (isset($acceptedValue[$key])) {
                $result[$key] = $data[$key];
            } else {
                $result[$key] = null;
            }
            if (isset($value["required"]) && $value["required"]) {
                if ($result[$key] == null && strlen($result[$key]) > 0) {
                    return ["error" => true, "msg" => $key . "is required"];
                }
            }
            if (isset($value["max-length"])) {
                if (strlen($result[$key]) > $value["max-length"]) {
                    return ["error" => true, "msg" => $key . " max length is " . $value["max-length"]];
                }
            }
            if (isset($value["decimal"]) && $value["decimal"]) {
                $result[$key] = $fmt->parse($result[$key]);
            }
            if (isset($value["mysql-date"]) && $value["mysql-date"]) {
                if (date("Y-m-d", strtotime($result[$key])) != $result[$key]) {
                    return ["error" => true, "msg" => $key . " is date time and must have format 'YYYY-MM-DD'"];
                }
            }
        }
        return ["error" => false, "data" => $result];
    }


    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\Result\Redirect|\Magento\Framework\Controller\ResultInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function execute()
    {
        $validFormKey = $this->formKeyValidator->validate($this->getRequest());

        $resultRedirect = $this->resultRedirectFactory->create();
        $sroId = null;
        if ($validFormKey && $this->getRequest()->isPost()) {
            $validate = $this->validatedParams();
            if (!$validate["error"]) {
                $data = $validate["data"];
                $warranty = $this->warrantyFactory->create();
                $isNewWarranty = false;
                if (!$data["warranty_id"]) {
                    unset($data["warranty_id"]);
                    $isNewWarranty = true;
                } else {
                    $warranty = $this->warrantyRepository->getById($data["warranty_id"]);
                    $sroId=$warranty->getFirstSroId();
                    if ($warranty->isSubmitted()) {
                        $resultRedirect->setPath("warranty/sro/edit", array("id" => $warranty->getFirstSroId(), "war_id" => $warranty->getId()));
                        return $resultRedirect;
                    }
                }

                $warranty->setData($data);

                $customerId = $this->_customerSession->getCustomer()->getId();
                $companyId = $this->companyDetails->getInfo($customerId)->getId();
//                $adminCustomerId = $this->companyService->getAdminCustomerId($customerId);
//                $warranty->setCustomerId($adminCustomerId);
                $warranty->setCompanyId($companyId);
                try {
                    $warranty = $this->warrantyRepository->save($warranty);
                    if ($isNewWarranty) {

                        // generate sro
                        $sro = $this->sroFactory->create();
                        $sro->setWarrantyId($warranty->getId());
//                        $sro->setCustomerId($adminCustomerId);
                        $sro->setCompanyId($companyId);
                        $sro = $this->sroRepository->save($sro);
                        $warranty->setFirstSroId($sro->getId());
                        $warranty = $this->warrantyRepository->save($warranty);
                        $sroId = $sro->getId();
                    }
                    $resultRedirect->setPath("warranty/sro/edit", array("id" => $sroId, "war_id" => $warranty->getId()));
                    return $resultRedirect;
                } catch (\Exception $e) {
                    $this->messageManager->addErrorMessage($e->getMessage());
                    return $resultRedirect->setPath('*/*/new');
                }
            } else {
                $this->messageManager->addErrorMessage($validate["msg"]);
                return $resultRedirect->setPath('*/*/new');
            }
        }
        $resultRedirect->setPath('*/index/index');
        return $resultRedirect;
    }

    private function convertDateStringToObject($data)
    {
        if (isset($data['date_of_failure']) && $data['date_of_failure'] != '') {
            $data['date_of_failure'] = new \DateTime(strtotime($data['date_of_failure']));
        }

        if (isset($data['date_of_repair']) && $data['date_of_repair'] != '') {
            $data['date_of_repair'] = new \DateTime(strtotime($data['date_of_repair']));
        }

        return $data;
    }
}
