<?php

namespace Variux\Warranty\Block\Index;

use Magento\Customer\Model\Customer;
use Magento\Customer\Model\Session;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\View\Element\Html\Date;
use Magento\Framework\View\Element\Template\Context;
use Magento\Store\Model\StoreManagerInterface;
use Variux\Warranty\Api\Data\WarrantyInterface;
use Variux\Warranty\Helper\Data;
use Variux\Warranty\Model\SroFactory;
use Variux\Warranty\Model\SroRepository;
use Variux\Warranty\Model\WarrantyFactory;
use Variux\Warranty\Model\Warranty;
use Variux\Warranty\Model\WarrantyRepository;

/**
 * @Hidro-Le
 * @TODO - Fixed
 * Class này PHPDOC của các function,properties chưa define đúng.
 */
class Edit extends \Magento\Framework\View\Element\Template
{
    /**
     * @var StoreManagerInterface
     */
    protected $storeManager;

    /**
     * @var WarrantyFactory
     */
    protected $warrantyFactory;

    /**
     * @var Date
     */
    protected $dateElement;

    /**
     * @var Session
     */
    protected $customerSession;

    /**
     * @var WarrantyRepository
     */
    protected $warrantyRepository;

    /**
     * @var SroFactory
     */
    protected $sroFactory;

    /**
     * @var SroRepository
     */
    protected $sroRepository;

    protected $dataHelper;

    protected $isWarrantySubmitted = null;

    /**
     * Edit constructor.
     * @param Context $context
     * @param StoreManagerInterface $storeManager
     * @param Date $dateElement
     * @param Session $customerSession
     * @param WarrantyFactory $warrantyFactory
     * @param WarrantyRepository $warrantyRepository
     * @param SroFactory $sroFactory
     * @param SroRepository $sroRepository
     * @param Data $dataHelper
     * @param array $data
     */
    public function __construct(
        Context $context,
        StoreManagerInterface $storeManager,
        Date $dateElement,
        Session $customerSession,
        WarrantyFactory $warrantyFactory,
        WarrantyRepository $warrantyRepository,
        SroFactory $sroFactory,
        SroRepository $sroRepository,
        Data $dataHelper,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->storeManager = $storeManager;
        $this->dateElement = $dateElement;
        $this->customerSession = $customerSession;
        $this->warrantyFactory = $warrantyFactory;
        $this->warrantyRepository = $warrantyRepository;
        $this->sroFactory = $sroFactory;
        $this->sroRepository = $sroRepository;
        $this->dataHelper = $dataHelper;
    }

    /**
     * @return array|mixed|null
     * @throws LocalizedException
     * @throws NoSuchEntityException
     */
    public function getFormData()
    {
        $data = $this->getData('form_data');
        if ($data == null) {
            $warranty = $this->getWarranty();
            $data = $warranty->getData();
            $this->setData('form_data', $data);
        }
        return $data;
    }

    /**
     * @return Customer
     */
    public function getCustomer()
    {
        return $this->customerSession->getCustomer();
    }

    /**
     * @return bool
     * @throws LocalizedException
     * @throws NoSuchEntityException
     */
    public function isWarrantySubmitted()
    {
        if ($this->isWarrantySubmitted === null) {
            $warranty = $this->getWarranty();
            $this->isWarrantySubmitted = $warranty->getStatus() != Warranty::STATUS_ARRAY["INCOMP"]["key"];
        }
        return $this->isWarrantySubmitted;
    }

    /**
     * @return WarrantyInterface|Warranty
     * @throws NoSuchEntityException
     * @throws LocalizedException
     */
    public function getWarranty()
    {
        $warrantyId = $this->getRequest()->getParam("id", false);
        if ($warrantyId) {
            $warranty = $this->warrantyRepository->getById($warrantyId);
        } else {
            $warranty = $this->generateNewWarrantyTicket();
        }

        return $warranty;
    }

    /**
     * @return WarrantyInterface|\Variux\Warranty\Model\Warranty
     * @throws LocalizedException
     */
    public function generateNewWarrantyTicket()
    {
        // generate warranty
        $warranty = $this->warrantyFactory->create();
        $customerId = $this->getCustomer()->getId();
        $warranty->setCustomerId($customerId);
        /**
         * @Hidro-Le
         * @TODO - Fixed
         * isPartner có trường hợp return false. không phải object
         * Sẽ xảy ra trường hợp call a function of boolean variable.
         */
        $warranty->setPartnerId($this->dataHelper->getPartner()->getId());
        $warranty = $this->warrantyRepository->save($warranty);

        // generate sro
        $sro = $this->sroFactory->create();
        $sro->setWarrantyId($warranty->getId());
        $sro->setCustomerId($customerId);
        $sro->setPartnerId($this->dataHelper->getPartner()->getId());
        $this->sroRepository->save($sro);

        return $warranty;
    }

    /**
     * Return data-validate rules
     * @return string
     */
    public function getDateHtml($name, $value = false)
    {
        $this->dateElement->setData(
            [
                'extra_params' => $this->getHtmlExtraParams(),
                'name' => $name,
                'id' => $name,
                'class' => $this->getHtmlClass(),
                'value' => $value,
                'date_format' => $this->getDateFormat(),
                'image' => $this->getViewFileUrl('Magento_Theme::calendar.png'),
            //                'years_range' => '-120y:c+nn',
            //                'max_date' => '-1d',
                'change_month' => 'true',
                'change_year' => 'true',
                'show_on' => 'both',
                'first_day' => $this->getFirstDay(),
                'autoComplete' => false
            ]
        );
        return $this->dateElement->getHtml();
    }

    /**
     * Return data-validate rules
     * @return string
     */
    public function getHtmlExtraParams()
    {
        $validators = [];
        $validators['validate-date'] = [
            'dateFormat' => $this->getDateFormat()
        ];
        $validators['required'] = true;

        return 'data-validate="' . $this->_escaper->escapeHtml(json_encode($validators)) . '"';
    }

    /**
     * Returns format which will be applied for DOB in javascript
     * @return string
     */
    public function getDateFormat()
    {
        return 'yyyy-MM-dd';
    }

    /**
     * Return first day of the week
     * @return int
     */
    public function getFirstDay()
    {
        return (int)$this->_scopeConfig->getValue(
            'general/locale/firstday',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * @return array
     * @throws NoSuchEntityException
     */
    public function getEngineSuggestConfig()
    {
        return [
            'url' => $this->getUrl(
                'warranty/autosuggest/engine',
                ['_secure' => $this->getRequest()->isSecure()]
            ),
            'resultContainerSelector' => '#engine_result_suggest_container',
            'loadingSelector' => '#engine_searchautosuggestLoading',
            'storeId' => $this->storeManager->getStore()->getId(),
            'delay' => 500,
            'minSearchLength' => 1
        ];
    }

    /**
     * @return array
     * @throws NoSuchEntityException
     */
    public function getDealerSuggestConfig()
    {
        return [
            'url' => $this->getUrl(
                'warranty/autosuggest/dealer',
                ['_secure' => $this->getRequest()->isSecure()]
            ),
            'resultContainerSelector' => '#dealer_result_suggest_container',
            'loadingSelector' => '#dealer_searchautosuggestLoading',
            'storeId' => $this->storeManager->getStore()->getId(),
            'delay' => 500,
            'minSearchLength' => 1,
            'findAll' => true
        ];
    }
}
