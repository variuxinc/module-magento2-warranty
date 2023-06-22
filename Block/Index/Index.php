<?php
/**
 * @author Variux Team
 * @copyright Copyright (c) 2023 Variux (https://www.variux.com)
 */

namespace Variux\Warranty\Block\Index;

use Magento\Framework\Controller\Result\RedirectFactory;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\View\Element\Template\Context;
use Variux\Warranty\Model\ResourceModel\Warranty\Collection;
use Magento\Customer\Model\Session as CustomerSession;
use Variux\Warranty\Model\ResourceModel\Warranty\CollectionFactory as WarrantyCollectionFactory;
use Magento\Framework\Message\ManagerInterface as MessageManagerInterface;

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
     * @var \Magento\Framework\Controller\Result\RedirectFactory
     */
    protected $resultRedirectFactory;
    /**
     * @var MessageManagerInterface
     */
    protected $messageManager;

    protected $warranties;

    /**
     * Index constructor.
     * @param Context $context
     * @param CustomerSession $customerSession
     * @param WarrantyCollectionFactory $warrantyCollectionFactory
     * @param RedirectFactory $resultRedirectFactory
     * @param MessageManagerInterface $messageManager
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context     $context,
        CustomerSession                                      $customerSession,
        WarrantyCollectionFactory                            $warrantyCollectionFactory,
        \Magento\Framework\Controller\Result\RedirectFactory $resultRedirectFactory,
        MessageManagerInterface                              $messageManager,
        array                                                $data = []
    ) {
        parent::__construct($context, $data);
        $this->customerSession = $customerSession;
        $this->warrantyCollectionFactory = $warrantyCollectionFactory;
        $this->resultRedirectFactory = $resultRedirectFactory;
        $this->messageManager = $messageManager;
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
     * @return false|Collection
     */
    public function getWarranties()
    {

        if (!($customerId = $this->customerSession->getCustomerId())) {
            return false;
        };
        if (!$this->warranties) {
            $collection = $this->warrantyCollectionFactory->create()
                ->addFieldToFilter("customer_id", ["eq" => $customerId])->setOrder('created_at', 'DESC');
            $collection->setPageSize($this->getPageSize());
            $collection->setCurPage($this->getPage());
            $collection->applyFilterData($this->getFilterData());
            $this->warranties = $collection;
        }
        return $this->warranties;
    }

    /**
     * @param $warranty
     * @return bool
     */
    public function hasSroDetail($warranty)
    {
        return $warranty->hasSroDetails();
    }

    /**
     * @param $warranty
     * @return string
     */
    public function getSroDetailUrl($warranty)
    {
        $sro = $warranty->hasSroDetails();
        if ($sro) {
            return $this->getUrl(
                "warranty/sro/edit",
                ["id" => $sro->getId(), "war_id" => $warranty->getId()]
            );
        }
        return '';
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
        return date('Y-m-d H:i:s', strtotime($dateString));
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
