<?php

namespace Variux\Warranty\Block\Suggestion;

use Magento\Framework\View\Element\Template;

class Engine extends \Magento\Framework\View\Element\Template
{
    /**
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    protected $storeManager;

    public function __construct(Template\Context $context, \Magento\Store\Model\StoreManagerInterface $storeManager, array $data = [])
    {
        parent::__construct($context, $data);
        $this->storeManager = $storeManager;
    }

    public function getJsLayout()
    {
        $this->jsLayout["components"] = [];
        $this->jsLayout["components"]["suggestion-engine"] = [
            "component" => $this->jsLayout[] = "Variux_Warranty/js/lib/suggestion/engine",
            "children" => [
                "messages" => [
                    "component" => "Magento_Ui/js/view/messages",
                    "displayArea" => "warranty-message"
                ]
            ]
        ];
        return json_encode($this->jsLayout, JSON_HEX_TAG);
    }

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

}
