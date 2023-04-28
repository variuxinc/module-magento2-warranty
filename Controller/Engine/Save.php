<?php

namespace Variux\Warranty\Controller\Engine;

use Magento\Company\Model\CompanyContext;
use Magento\Customer\Model\Session;
use Magento\Directory\Model\CountryFactory;
use Magento\Directory\Model\RegionFactory;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Data\Form\FormKey\Validator;
use Psr\Log\LoggerInterface;
use Variux\Warranty\Helper\Data;
use Magento\Authorization\Model\UserContextInterface;
use Variux\Warranty\Helper\CompanyDetails;
use Magento\Directory\Model\ResourceModel\Region as RegionResourceModel;
use Variux\Warranty\Model\UnitFactory;
use Variux\Warranty\Model\UnitRegFactory;
use Variux\Warranty\Model\ResourceModel\UnitReg as UnitRegResourceModel;
use Variux\Warranty\Helper\SuggestHelper;

class Save extends \Variux\Warranty\Controller\AbstractAction
{
    /**
     * @var UserContextInterface
     */
    protected $userContext;
    /**
     * @var CompanyDetails
     */
    protected $companyDetails;
    /**
     * @var Validator
     */
    protected $formKeyValidator;
    /**
     * @var CountryFactory
     */
    protected $countryFactory;
    /**
     * @var RegionFactory
     */
    protected $regionFactory;
    /**
     * @var RegionResourceModel
     */
    protected $regionResourceModel;
    /**
     * @var UnitFactory
     */
    protected $unitFactory;
    /**
     * @var UnitRegFactory
     */
    protected $unitRegFactory;
    /**
     * @var UnitRegResourceModel
     */
    protected $unitRegResourceModel;

    /**
     * @param Context $context
     * @param CompanyContext $companyContext
     * @param LoggerInterface $logger
     * @param Session $_customerSession
     * @param Data $helperData
     * @param SuggestHelper $suggestHelper
     * @param UserContextInterface $userContext
     * @param CompanyDetails $companyDetails
     * @param Validator $formKeyValidator
     * @param CountryFactory $countryFactory
     * @param RegionFactory $regionFactory
     * @param RegionResourceModel $regionResourceModel
     * @param UnitFactory $unitFactory
     * @param UnitRegFactory $unitRegFactory
     * @param UnitRegResourceModel $unitRegResourceModel
     */
    public function __construct(
        Context                  $context,
        CompanyContext           $companyContext,
        \Psr\Log\LoggerInterface $logger,
        Session                  $_customerSession,
        Data                     $helperData,
        SuggestHelper            $suggestHelper,
        UserContextInterface     $userContext,
        CompanyDetails           $companyDetails,
        Validator                $formKeyValidator,
        CountryFactory           $countryFactory,
        RegionFactory            $regionFactory,
        RegionResourceModel      $regionResourceModel,
        UnitFactory              $unitFactory,
        UnitRegFactory           $unitRegFactory,
        UnitRegResourceModel     $unitRegResourceModel
    )
    {
        parent::__construct($context, $companyContext, $logger, $_customerSession, $helperData, $suggestHelper);
        $this->userContext = $userContext;
        $this->companyDetails = $companyDetails;
        $this->formKeyValidator = $formKeyValidator;
        $this->countryFactory = $countryFactory;
        $this->regionFactory = $regionFactory;
        $this->regionResourceModel = $regionResourceModel;
        $this->unitFactory = $unitFactory;
        $this->unitRegFactory = $unitRegFactory;
        $this->unitRegResourceModel = $unitRegResourceModel;
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\Result\Redirect|\Magento\Framework\Controller\ResultInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function execute()
    {
        $userId = $this->userContext->getUserId();
        $company = $this->companyDetails->getInfo($userId);
        $resellerId = $company->getResellerId();
        $resellerName = $company->getCompanyName();
        $data = $this->getRequest()->getPostValue();
        $validFormKey = $this->formKeyValidator->validate($this->getRequest());

        $resultRedirect = $this->resultRedirectFactory->create();

        if ($validFormKey && $this->getRequest()->isPost()) {
            $status = $this->isAbleRegisterEngine();
            if ($status) {
                if ($status == \Variux\Warranty\Model\Unit::STATUS_UNREGISTERED) {
                    $country = $this->countryFactory->create()->loadByCode($data["country"]);
                    if ($country->hasData()) {
                        $data["country"] = $country->getName();
                    } else {
                        $this->messageManager->addErrorMessage(__("Invalid country code"));
                    }
                    if (isset($data["region_id"]) && $data["region_id"]) {
                        $region = $this->regionFactory->create();
                        $this->regionResourceModel->load($region, $data["region_id"]);
                        if ($region->hasData()) {
                            $data["state"] = $region->getCode();
                        } else {
                            $this->messageManager->addErrorMessage(__("Invalid region id"));
                        }
                    }
                    $data["dealer_num"] = $resellerId;
                    $data["dealer_name"] = $resellerName;
                    if (isset($data["state"]) && $data["state"]) {
                        $this->resolveWhenStateIsset($data);
                    } else {
                        $this->messageManager->addErrorMessage(__("State/Prov is required"));
                    }
                } elseif ($status == \Variux\Warranty\Model\Unit::STATUS_EXPIRED) {
                    $this->messageManager->addErrorMessage(__("You must call for registration"));
                } elseif ($status == \Variux\Warranty\Model\Unit::STATUS_REGISTERED) {
                    $this->messageManager->addErrorMessage(__("The engine is already registered"));
                }
            } else {
                $this->messageManager->addErrorMessage(__("The engine number doesn't exist"));
            }
        }

        $resultRedirect->setPath('*/*/edit/', ["engine" => $data["serial_no"]]);
        return $resultRedirect;
    }

    /**
     * @return false|string
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    protected function isAbleRegisterEngine()
    {
        $serialNo = $this->getRequest()->getParam("serial_no", false);

        if ($serialNo) {
            $unit = $this->unitFactory->create()->loadBySerial($serialNo);
            if ($unit->hasData()) {
                return $this->helperData->getEngineStatus($unit);
            }
        }
        return false;
    }

    /**
     * @param $data
     * @return \Magento\Framework\Controller\Result\Redirect|void
     */
    protected function resolveWhenStateIsset($data)
    {
        $resultRedirect = $this->resultRedirectFactory->create();
        if (isset($data["engine_hours"])
            && $data["engine_hours"]
            && is_numeric($data["engine_hours"])
            && $data["engine_hours"] >= 0) {
            if ($data["engine_hours"] <= 50) {
                $unitReg = $this->unitRegFactory->create();
                $unitReg->setData($data);
                try {
                    $this->unitRegResourceModel->save($unitReg);
                    $this->messageManager->addSuccessMessage(__("Engine Registration Successful"));
                    return $resultRedirect->setPath('*/*/new');
                } catch (\Exception $e) {
                    $this->messageManager->addErrorMessage($e->getMessage());
                }
            } else {
                $this->messageManager
                    ->addErrorMessage(__("For Engines with over 50 hours, please contact Customer Service."));
            }
        } else {
            $this->messageManager->addErrorMessage(__("Engine hours is required"));
        }
    }
}
