<?php
/**
 * @author Variux Team
 * @copyright Copyright (c) 2023 Variux (https://www.variux.com)
 */

namespace Variux\Warranty\Controller\Index;

use Magento\Company\Model\CompanyContext;
use Magento\Customer\Model\Session;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\Result\Redirect;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Data\Form\FormKey\Validator;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\View\Result\PageFactory;
use Psr\Log\LoggerInterface;
use Variux\Warranty\Model\SroFactory;
use Variux\Warranty\Model\SroRepository;
use Variux\Warranty\Model\WarrantyFactory;
use NumberFormatter;
use Variux\Warranty\Helper\CompanyDetails;
use Variux\Warranty\Model\WarrantyRepository;
use Variux\Warranty\Helper\SuggestHelper;

class Save extends \Variux\Warranty\Controller\AbstractAction
{
    /**
     * @var PageFactory
     */
    protected $resultPageFactory;

    /**
     * @var WarrantyFactory
     */
    protected $warrantyFactory;

    /**
     * @var WarrantyRepository
     */
    protected $warrantyRepository;

    /**
     * @var Validator
     */
    protected $formKeyValidator;

    /**
     * @var SroFactory
     */
    protected $sroFactory;

    /**
     * @var SroRepository
     */
    protected $sroRepository;

    /**
     * @var CompanyDetails
     */
    protected $companyDetails;

    /**
     * @param Context $context
     * @param CompanyContext $companyContext
     * @param LoggerInterface $logger
     * @param Session $_customerSession
     * @param PageFactory $resultPageFactory
     * @param Validator $formKeyValidator
     * @param WarrantyFactory $warrantyFactory
     * @param WarrantyRepository $warrantyRepository
     * @param SroFactory $sroFactory
     * @param SroRepository $sroRepository
     * @param CompanyDetails $companyDetails
     */
    public function __construct(
        Context                      $context,
        CompanyContext               $companyContext,
        LoggerInterface              $logger,
        Session                      $_customerSession,
        \Variux\Warranty\Helper\Data $helperData,
        SuggestHelper                $suggestHelper,
        PageFactory                  $resultPageFactory,
        Validator                    $formKeyValidator,
        WarrantyFactory              $warrantyFactory,
        WarrantyRepository           $warrantyRepository,
        SroFactory                   $sroFactory,
        SroRepository                $sroRepository,
        CompanyDetails               $companyDetails
    )
    {
        parent::__construct($context, $companyContext, $logger, $_customerSession, $helperData, $suggestHelper);
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
    private function validatedParams(): array
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
        /**
         * @Hidro-Le
         * @TODO - fixed
         * Không nên format number trước khi lưu vào DB, lúc echo mới cần format number.
         *
         */
        foreach ($acceptedValue as $key => $value) {
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
            if (isset($value["mysql-date"]) && $value["mysql-date"]) {
                if (date("Y-m-d", strtotime($result[$key])) != $result[$key]) {
                    return ["error" => true, "msg" => $key . " is date time and must have format 'YYYY-MM-DD'"];
                }
            }
        }
        return ["error" => false, "data" => $result];
    }

    /**
     * @return ResponseInterface|Redirect|ResultInterface
     * @throws LocalizedException
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
                    $sroId = $warranty->getFirstSroId();
                    if ($warranty->isSubmitted()) {
                        $resultRedirect->setPath(
                            "warranty/sro/edit",
                            ["id" => $warranty->getFirstSroId(), "war_id" => $warranty->getId()]
                        );
                        return $resultRedirect;
                    }
                }

                $warranty->setData($data);

                $customerId = $this->_customerSession->getCustomer()->getId();
                $companyId = $this->companyDetails->getInfo($customerId)->getId();
                $warranty->setCustomerId($customerId);
                $warranty->setCompanyId($companyId);
                try {
                    $warranty = $this->warrantyRepository->save($warranty);
                    if ($isNewWarranty) {

                        // generate sro
                        $sro = $this->sroFactory->create();
                        $sro->setWarrantyId($warranty->getId());
                        $sro->setCustomerId($customerId);
                        $sro->setCompanyId($companyId);
                        $sro = $this->sroRepository->save($sro);
                        $warranty->setFirstSroId($sro->getId());
                        $warranty = $this->warrantyRepository->save($warranty);
                        $sroId = $sro->getId();
                    }
                    $resultRedirect->setPath("warranty/sro/edit", ["id" => $sroId, "war_id" => $warranty->getId()]);
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

    /**
     * @param $data
     * @return mixed
     * @throws \Exception
     */
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
