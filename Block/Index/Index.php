<?php
/**
 * @author Variux Team
 * @copyright Copyright (c) 2023 Variux (https://www.variux.com)
 */
namespace Variux\Warranty\Block\Index;

use Magento\Framework\Exception\LocalizedException;
use Variux\Warranty\Model\ResourceModel\Warranty\Collection;
use Magento\Customer\Model\Session as CustomerSession;
use Variux\Warranty\Model\ResourceModel\Warranty\CollectionFactory as WarrantyCollectionFactory;

class Index extends \Magento\Framework\View\Element\Template
{
    /**
     * @var CustomerSession
     */
    protected $customerSession;

    /**
     * @var WarrantyCollectionFactory
     */
    protected $warrantyCollectionFactory;

    /**
     * Index constructor.
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param CustomerSession $customerSession
     * @param WarrantyCollectionFactory $warrantyCollectionFactory
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        CustomerSession $customerSession,
        WarrantyCollectionFactory $warrantyCollectionFactory,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->customerSession = $customerSession;
        $this->warrantyCollectionFactory = $warrantyCollectionFactory;
    }

    /**
     * Initializes toolbar
     *
     * @return \Magento\Framework\View\Element\AbstractBlock
     * @throws LocalizedException
     */
    protected function _prepareLayout()
    {
        if ($this->getWarranties()) {
            $this->addFilterBlock();
            $this->addToolbarBlock();
        }
        return parent::_prepareLayout();
    }

    /**
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function addFilterBlock()
    {
        $filter = $this->getLayout()->createBlock(
            \Magento\Framework\View\Element\Template::class,
            'customer_warranty_list.filter'
        )
            ->setTemplate("Variux_Warranty::index/filter.phtml")
            ->setFilterData(
                $this->getFilterData()
            )
            ->setCollection(
                $this->getWarranties()
            );

        $this->setChild('filter', $filter);
    }

    /**
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function addToolbarBlock()
    {
        $toolbar = $this->getLayout()->createBlock(
            \Magento\Theme\Block\Html\Pager::class,
            'customer_warranty_list.toolbar'
        )->setCollection(
            $this->getWarranties()
        );

        $this->setChild('toolbar', $toolbar);
    }

    /**
     * @return mixed
     */
    public function getFilterData()
    {
        return $this->getRequest()->getParam("filter", false);
    }

    /**
     * @return mixed
     */
    public function getPage()
    {
        return $this->getRequest()->getParam('p', 1);
    }

    /**
     * @return mixed
     */
    public function getPageSize()
    {
        return $this->getRequest()->getParam('limit', 10);
    }

    /**
     * @return Collection||boolean
     */
    public function getWarranties()
    {
        $customer = $this->getCurrentCustomer();
        if ($customer) {
            $collection = $this->warrantyCollectionFactory->create()
                ->addFieldToFilter("customer_id", ["eq" => $customer->getId()])->setOrder('created_at', 'DESC');
            $collection->setPageSize($this->getPageSize());
            $collection->setCurPage($this->getPage());
            $collection->applyFilterData($this->getFilterData());

            return $collection;
        }
        return false;
    }

    /**
     * @return \Magento\Customer\Model\Customer
     */
    public function getCurrentCustomer()
    {
        return $this->customerSession->getCustomer();
    }

    /**
     * @param $warranty
     * @return bool
     */
    public function hasSroDetail($warranty)
    {
        return $warranty->hasSro();
    }

    /**
     * @param $warranty
     * @return mixed
     */
    public function getSroDetailUrl($warranty)
    {
        $sro = $warranty->hasSro();
        return $this->getUrl(
            "warranty/sro/edit",
            ["id" => $sro->getId(), "war_id" => $warranty->getId()]
        );
    }

    /**
     * @param $warranty
     * @return mixed
     */
    public function getAjaxUrl()
    {
        $filterData = $this->getFilterData();
        if (!empty($filterData)) {
            return $this->getUrl(
                "warranty/index/ajax",
                [
                    "p" => $this->getPage(),
                    "limit" => $this->getPageSize(),
                    "serial_number" => $filterData["serial_number"]
                ]
            );
        }
    }

    /**
     * @param $warranty
     * @return string
     */
    public function getSroDetailNumber($warranty)
    {
        $sro = $warranty->hasSro();
        if ($sro) {
            return $sro->getSroNum();
        }
        return '';
    }

    /**
     * @param $dateString
     * @return false|string
     */
    public function dateFormat($dateString)
    {
        return date("d/m/Y H:i:s", strtotime($dateString));
    }

    /**
     * Get html code for filter
     *
     * @return string
     */
    public function getFilterHtml()
    {
        return $this->getChildHtml('filter');
    }

    /**
     * Get html code for toolbar
     *
     * @return string
     */
    public function getToolbarHtml()
    {
        return $this->getChildHtml('toolbar');
    }
}
