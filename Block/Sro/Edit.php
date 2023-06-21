<?php

namespace Variux\Warranty\Block\Sro;

use Variux\Warranty\Model\ResourceModel\Sro as SroResourceModel;
use Variux\Warranty\Model\ResourceModel\Warranty as WarrantyResourceModel;
use Variux\Warranty\Model\Sro;
use Variux\Warranty\Model\Warranty;
use Variux\Warranty\Model\SroFactory;
use Variux\Warranty\Model\WarrantyFactory;
use Magento\Customer\Model\Session;
use Magento\Framework\Exception\NoSuchEntityException;
use Variux\Warranty\Model\ResourceModel\Workcode\CollectionFactory as WorkcodeCollectionFactory;

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
     * @var Session
     */
    protected $customerSession;

    /**
     * @var \Variux\Warranty\Helper\Data
     */
    protected $dataHelper;

    /**
     * @var SroFactory
     */
    protected $sroFactory;

    /**
     * @var SroResourceModel
     */
    protected $sroResourceModel;

    /**
     * @var WarrantyResourceModel
     */
    protected $warrantyResourceModel;

    /**
     * @var int|boolean
     */
    protected $sroId = false;

    /**
     * @var Sro |boolean
     */
    protected $sro = false;

    /**
     * @var Warranty |boolean
     */
    protected $warranty = false;

    /**
     * @var \Magento\Framework\Pricing\Helper\Data
     */
    protected $_priceHelper;
    /**
     * @var WorkcodeCollectionFactory
     */
    protected $workcodeCollectionFactory;

    /**
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param \Magento\Store\Model\StoreManagerInterface $storeManager
     * @param \Magento\Framework\View\Element\Html\Date $dateElement
     * @param Session $customerSession
     * @param WarrantyFactory $warrantyFactory
     * @param \Variux\Warranty\Helper\Data $dataHelper
     * @param SroFactory $sroFactory
     * @param SroResourceModel $sroResourceModel
     * @param WarrantyResourceModel $warrantyResourceModel
     * @param \Magento\Framework\Pricing\Helper\Data $priceHelper
     * @param WorkcodeCollectionFactory $workcodeCollectionFactory
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Framework\View\Element\Html\Date $dateElement,
        Session $customerSession,
        WarrantyFactory $warrantyFactory,
        \Variux\Warranty\Helper\Data $dataHelper,
        SroFactory $sroFactory,
        SroResourceModel $sroResourceModel,
        WarrantyResourceModel $warrantyResourceModel,
        \Magento\Framework\Pricing\Helper\Data $priceHelper,
        WorkcodeCollectionFactory $workcodeCollectionFactory,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->storeManager = $storeManager;
        $this->dateElement = $dateElement;
        $this->customerSession = $customerSession;
        $this->warrantyFactory = $warrantyFactory;
        $this->dataHelper = $dataHelper;
        $this->sroFactory = $sroFactory;
        $this->sroResourceModel = $sroResourceModel;
        $this->warrantyResourceModel = $warrantyResourceModel;
        $this->_priceHelper = $priceHelper;
        $this->workcodeCollectionFactory = $workcodeCollectionFactory;
    }

    /**
     * Get JsLayout
     *
     * @return mixed|string
     */
    public function getJsLayout()
    {
        if ($this->getSroId()) {
            $this->jsLayout["components"] = [];
            $this->jsLayout["components"]["warranty-sro"] = [
                "component" => $this->jsLayout[] = "Variux_Warranty/js/view/warranty-sro",
                "children" => [
                    "messages" => [
                        "component" => "Magento_Ui/js/view/messages",
                        "displayArea" => "warranty-message"
                    ]
                ]
            ];
        }
        return json_encode($this->jsLayout, JSON_HEX_TAG);
    }

    /**
     * Get Json Data
     *
     * @return mixed|string
     * @throws NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getJsonData()
    {
        $data = [];
        $data['sro'] = $this->getSro()->getData();
        //temporarily comment out
         $partner = $this->dataHelper->getCurrentPartner();
         $data['labor_rate'] = $partner->getLaborRate();
        if ($data['labor_rate'] == null) {
            $data['labor_rate'] = '0';
        }
        $data['warranty'] = $this->getWarranty()->getData();
        $data['url'] = $this->getUrlData();

        $materials = $this->getSro()->getMaterialsData();
        foreach ($materials as $material) {
            $material["total"] = $this->_priceHelper->currency($material["price"] * $material["qty_conv"], true, false);
            $material["price"] = $this->_priceHelper->currency($material["price"], true, false);
            $material["qty_conv"] = (int)$material["qty_conv"];
            $data['materials'][] = array_intersect_key($material, [
                "item_id" => "",
                "sro_id" => "",
                "item" => "",
                "qty_conv" => "",
                "note" => "",
                "description" => "",
                "price" => "",
                "total" => ""
            ]);
        }
        $labors = $this->getSro()->getLaborsData();
        foreach ($labors as $labor) {
            $labor["total"] = $this->_priceHelper->currency(
                $labor["labor_hourly_rate"] * $labor["hour_worked"],
                true,
                false
            );
            $labor["labor_hourly_rate"] = $this->_priceHelper->currency(
                $labor["labor_hourly_rate"],
                true,
                false
            );
            $data['labors'][] = array_intersect_key($labor, [
                "item_id" => "",
                "sro_id" => "",
                "hour_worked" => "",
                "work_code" => "",
                "labor_hourly_rate" => "",
                "note" => "",
                "description" => "",
                "total" => ""
            ]);
        }

        $workCodes = $this->getWorkCodeCollection();
        foreach ($workCodes as $workCode) {
            $data['workCodes'][] = array_intersect_key($workCode, [
                "item_id" => "",
                "work_code" => "",
                "description" => "",
                "duration" => ""
            ]);
        }

        $miscs = $this->getSro()->getMiscsData();
        foreach ($miscs as $misc) {
            $data['miscs'][] = array_intersect_key($misc, [
                "item_id" => "",
                "sro_id" => "",
                "amount" => "",
                "misc_code" => "",
                "note" => "",
                "type" => "",
                "description" => ""
            ]);
        }

        $docs = $this->getSro()->getDocsData();
        foreach ($docs as $doc) {
            $data['docs'][] = array_intersect_key($doc, [
                "item_id" => "",
                "sro_id" => "",
                "name" => "",
                "file_path" => ""
            ]);
        }

        $data['dataConfig'] = $this->getDataConfig();

        $data['itemSuggestConfig'] = $this->getItemSuggestConfig();
        $data['workcodeSuggestConfig'] = $this->getWorkcodeSuggestConfig();
        $data['workcodepdf'] = $this->storeManager
                                    ->getStore()
                                    ->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA)
                                    . "Flat_Rate_Guide.pdf";
        $data['updateSroNumUrl'] = $this->getUrl(
            'warranty/autosuggest/getsronumandincnum',
            ['_secure' => $this->getRequest()->isSecure()]
        );
        return json_encode($data);
    }

    /**
     * Get Data Config
     *
     * @return array
     */
    public function getDataConfig()
    {
        $config = [];
        //temporarily comment out
        // $config["options"] = [
        //     "um" => $this->dataHelper->getUmOptions()
        // ];
        $config["maxFileSize"] = $this->getMaxFileSize();
        return $config;
    }

    /**
     * Get Sro Id
     *
     * @return bool|int|mixed
     */
    public function getSroId()
    {
        return $this->sroId ? $this->sroId : $this->getRequest()->getParam("id", false);
    }

    /**
     * Get Sro
     *
     * @return Sro
     */
    public function getSro()
    {
        if ($this->sro) {
            return $this->sro;
        }
        $sro = $this->sroFactory->create();
        $this->sroResourceModel->load($sro, $this->getSroId());
        $this->sro = $sro;
        return $this->sro;
    }

    /**
     * Get Warranty
     *
     * @return Warranty
     */
    public function getWarranty()
    {
        if ($this->warranty) {
            return $this->warranty;
        }
        $warranty = $this->warrantyFactory->create();
        $this->warrantyResourceModel->load($warranty, $this->getSro()->getWarrantyId());
        $this->warranty = $warranty;
        return $this->warranty;
    }

    /**
     * Get Work Code Collection
     *
     * @return array
     */
    public function getWorkCodeCollection()
    {
        $data = [];
        $workCodeCollection = $this->workcodeCollectionFactory->create();
        foreach ($workCodeCollection as $workCode) {
            $workCodeData = $workCode->getData();
            $data[] = $workCodeData;
        }
        return $data;
    }

    /**
     * Get Item Suggest Config
     *
     * @return array
     * @throws NoSuchEntityException
     */
    public function getItemSuggestConfig()
    {
        return [
            'url' => $this->getUrl(
                'warranty/autosuggest/item',
                ['_secure' => $this->getRequest()->isSecure()]
            ),
            'resultContainerSelector' => '#item_result_suggest_container',
            'loadingSelector' => '#item_searchautosuggestLoading',
            'storeId' => $this->storeManager->getStore()->getId(),
            'delay' => 500,
            'minSearchLength' => 2
        ];
    }

    /**
     * Get Work Code Suggest Config
     *
     * @return array
     * @throws NoSuchEntityException
     */
    public function getWorkcodeSuggestConfig()
    {
        return [
            'url' => $this->getUrl(
                'warranty/autosuggest/workcode',
                ['_secure' => $this->getRequest()->isSecure()]
            ),
            'resultContainerSelector' => '#workcode_result_suggest_container',
            'loadingSelector' => '#workcode_searchautosuggestLoading',
            'storeId' => $this->storeManager->getStore()->getId(),
            'delay' => 500,
            'minSearchLength' => 2
        ];
    }

    /**
     * Get Url Data
     *
     * @return array
     */
    public function getUrlData()
    {
        return [
            "backUrl" => $this->getUrl("warranty"),
            "saveSroUrl" => $this->getUrl("warranty/sro/save"),
            "submitClaimUrl" => $this->getUrl("warranty/sro/submit"),

            "saveMaterialUrl" => $this->getUrl("warranty/sro_material/save"),
            "removeMaterialUrl" => $this->getUrl("warranty/sro_material/remove"),

            "saveLaborUrl" => $this->getUrl("warranty/sro_labor/save"),
            "removeLaborUrl" => $this->getUrl("warranty/sro_labor/remove"),

            "saveMiscUrl" => $this->getUrl("warranty/sro_misc/save"),
            "removeMiscUrl" => $this->getUrl("warranty/sro_misc/remove"),

            "saveDocumentUrl" => $this->getUrl("warranty/sro_document/save")
        ];
    }

    /**
     * Get Loading Path
     *
     * @return string
     */
    public function getLoadingPath()
    {
        return $this->getViewFileUrl('images/loader-2.gif');
    }

    /**
     * Get Max File Size
     *
     * @return number
     */
    public function getMaxFileSize()
    {
        return $this->dataHelper->getMaxFileSize();
    }
}
