<?php

namespace Variux\Warranty\Block\Transfer;

use Magento\Customer\Model\Session;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\View\Element\Html\Date;
use Magento\Framework\View\Element\Template\Context;
use Magento\Store\Model\StoreManagerInterface;
use Variux\Warranty\Helper\Data;

class NewTransfer extends \Magento\Framework\View\Element\Template
{
    /**
     * @var StoreManagerInterface
     */
    protected $storeManager;

    /**
     * @var Date
     */
    protected $dateElement;

    /**
     * @var Session
     */
    protected $customerSession;

    /**
     * @var Data
     */
    protected $dataHelper;

    /**
     * @param Context $context
     * @param StoreManagerInterface $storeManager
     * @param Date $dateElement
     * @param Session $customerSession
     * @param Data $dataHelper
     * @param array $data
     */
    public function __construct(
        Context $context,
        StoreManagerInterface $storeManager,
        Date $dateElement,
        Session $customerSession,
        Data $dataHelper,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->storeManager = $storeManager;
        $this->dateElement = $dateElement;
        $this->customerSession = $customerSession;
        $this->dataHelper = $dataHelper;
    }

    /**
     * Get JsLayout
     *
     * @return false|string
     */
    public function getJsLayout()
    {
        $this->jsLayout["components"] = [];
        $this->jsLayout["components"]["warranty-transfer"] = [
            "component" => $this->jsLayout[] = "Variux_Warranty/js/view/transfer/new",
            "children" => [
                "messages" => [
                    "component" => "Magento_Ui/js/view/messages",
                    "displayArea" => "warranty-message"
                ]
            ]
        ];
        return json_encode($this->jsLayout, JSON_HEX_TAG);
    }

    /**
     * Get Path
     *
     * @return string
     */
    public function getLoadingPath()
    {
        return $this->getViewFileUrl('images/loader-2.gif');
    }

    /**
     * Get Engine Suggest Config
     *
     * @return array
     * @throws NoSuchEntityException
     */
    public function getEngineSuggestConfig()
    {
        return [
            'url' => $this->getUrl(
                'warranty/autosuggest/engineforwarrantytransfer',
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
     * Get Init Data
     *
     * @return false|string
     * @throws NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getInitData()
    {
        $customer = $this->customerSession->getCustomer();
        $data["formData"] = [
            "engine_serial_num" => "",
            "submitter_name" => $customer->getName(),
            "submitter_email" => $customer->getEmail(),
            "engine_desc" => "",
            "engine_hours" => "",
            "engine_model" => "",
            "trans_sn" => "",
            "make_of_boat" => "",
            "boat_use" => "",
            "cur_cust" => $customer->getName(),
            "hull_id" => "",
            "warr_start_date" => "",
            "warr_end_date" => "",
            "submit_date" => "",
            "inspection_date" => "",
            "eng_comp_1" => "",
            "eng_comp_2" => "",
            "eng_comp_3" => "",
            "eng_comp_4" => "",
            "eng_comp_5" => "",
            "eng_comp_6" => "",
            "eng_comp_7" => "",
            "eng_comp_8" => "",
            "name" => "",
            "email" => "",
            "phone" => "",
            "phone_ext" => "",
            "fax_num" => "",
            "sale_date" => "",
            "addr_1" => "",
            "addr_2" => "",
            "addr_3" => "",
            "addr_4" => "",
            "city" => "",
            "state" => "",
            "zip" => "",
            "country" => ""
        ];
        $data["engineSuggestConfig"] = $this->getEngineSuggestConfig();
        return json_encode($data);
    }
}
