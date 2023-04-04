<?php

namespace Variux\Warranty\Block\Index;

use Variux\Warranty\Model\WarrantyFactory;

class Edit extends \Magento\Framework\View\Element\Template
{
    /**
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    protected $storeManager;

    /**
     * @var WarrantyFactory
     */
    protected $warrantyFactory;

    /**
     * @var \Magento\Framework\View\Element\Html\Date
     */
    protected $dateElement;

    /**
     * @var \Magento\Customer\Model\Session
     */
    protected $customerSession;

    /**
     * @var \Variux\Warranty\Model\WarrantyRepository
     */
    protected $warrantyRepository;

    /**
     * @var \Variux\Warranty\Model\SroFactory
     */
    protected $sroFactory;

    /**
     * @var \Variux\Warranty\Model\SroRepository
     */
    protected $sroRepository;

    protected $dataHelper;

    protected $isWarrantySubmitted = null;

    /**
     * @var CompanyService
     */
    protected $companyService;

    /**
     * Edit constructor.
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param \Magento\Store\Model\StoreManagerInterface $storeManager
     * @param \Magento\Framework\View\Element\Html\Date $dateElement
     * @param \Magento\Customer\Model\Session $customerSession
     * @param WarrantyFactory $warrantyFactory
     * @param \Variux\Warranty\Model\WarrantyRepository $warrantyRepository
     * @param \Variux\Warranty\Model\SroFactory $sroFactory
     * @param \Variux\Warranty\Model\SroRepository $sroRepository
     * @param \Variux\Warranty\Helper\Data $dataHelper
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Framework\View\Element\Html\Date $dateElement,
        \Magento\Customer\Model\Session $customerSession,
        WarrantyFactory $warrantyFactory,
        \Variux\Warranty\Model\WarrantyRepository $warrantyRepository,
        \Variux\Warranty\Model\SroFactory $sroFactory,
        \Variux\Warranty\Model\SroRepository $sroRepository,
        \Variux\Warranty\Helper\Data $dataHelper,
        array $data = []
    )
    {
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
     * Retrieve form data
     *
     * @return array
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

    public function getCustomer()
    {
        return $this->customerSession->getCustomer();
    }

    public function isWarrantySubmitted()
    {
        if ($this->isWarrantySubmitted === null) {
            $warranty = $this->getWarranty();
            $this->isWarrantySubmitted = $warranty->getStatus() != \Variux\Warranty\Model\Warranty::STATUS_ARRAY["INCOMP"]["key"];
        }
        return $this->isWarrantySubmitted;
    }

    public function getWarranty()
    {
        $warrantyId = $this->getRequest()->getParam("id", false);
        if ($warrantyId) {
            $warranty = $this->warrantyRepository->getById($warrantyId);
        } else {
            /**
             * @var \Variux\Warranty\Api\Data\WarrantyInterface $warranty
             */
            $warranty = $this->generateNewWarrantyTicket();
        }

        return $warranty;
    }

    /**
     * @return \Variux\Warranty\Api\Data\WarrantyInterface|\Variux\Warranty\Model\Warranty
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function generateNewWarrantyTicket()
    {
        // generate warranty
        $warranty = $this->warrantyFactory->create();
        $customerId = $this->getCustomer()->getId();
        $adminCustomerId = $this->companyService->getAdminCustomerId($customerId);
        $warranty->setCustomerId($adminCustomerId);
        $warranty->setPartnerId($this->dataHelper->isPartner()->getId());
        $warranty = $this->warrantyRepository->save($warranty);

        // generate sro
        $sro = $this->sroFactory->create();
        $sro->setWarrantyId($warranty->getId());
        $sro->setCustomerId($adminCustomerId);
        $sro->setPartnerId($this->dataHelper->isPartner()->getId());
        $this->sroRepository->save($sro);

        return $warranty;
    }

    /**
     * Return data-validate rules
     *
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
     *
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
     *
     * @return string
     */
    public function getDateFormat()
    {
        return 'yyyy-MM-dd';
    }

    /**
     * Return first day of the week
     *
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
     */
    public function getInvoiceSuggestConfig()
    {
        return array(
            'url' => $this->getUrl(
                'warranty/autosuggest/invoicelisting',
                ['_secure' => $this->getRequest()->isSecure()]
            ),
            'resultContainerSelector' => '#invoicelisting_result_suggest_container',
            'loadingSelector' => '#invoicelisting_searchautosuggestLoading',
            'storeId' => $this->storeManager->getStore()->getId(),
            'delay' => 500,
            'minSearchLength' => 1
        );
    }

    /**
     * @return array
     */
    public function getEngineSuggestConfig()
    {
        return array(
            'url' => $this->getUrl(
                'warranty/autosuggest/engine',
                ['_secure' => $this->getRequest()->isSecure()]
            ),
            'resultContainerSelector' => '#engine_result_suggest_container',
            'loadingSelector' => '#engine_searchautosuggestLoading',
            'storeId' => $this->storeManager->getStore()->getId(),
            'delay' => 500,
            'minSearchLength' => 1
        );
    }

    /**
     * @return array
     */
    public function getDealerSuggestConfig()
    {
        return array(
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
        );
    }
}