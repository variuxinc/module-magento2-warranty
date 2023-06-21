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

    /**
     * @var Collection
     */
    protected $warranties;

    /**
     * Index constructor.
     *
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
        /**
         * @Hidro-Le
         * @TODO - Fixed
         * Chỗ này a cần kiểm tra lại, hàm getWarranties mỗi lần gọi lại tạo 1 collection.
         */
        if ($this->getWarranties()) {
            $this->addFilterBlock();
            $this->addToolbarBlock();
        }
        return parent::_prepareLayout();
    }

    /**
     * Add Filter
     *
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
     * Add Toolbar
     *
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
     * Get Filter Data
     *
     * @return mixed
     */
    public function getFilterData()
    {
        return $this->getRequest()->getParam("filter", false);
    }

    /**
     * Get Page
     *
     * @return mixed
     */
    public function getPage()
    {
        return $this->getRequest()->getParam('p', 1);
    }

    /**
     * Get Page Size
     *
     * @return mixed
     */
    public function getPageSize()
    {
        return $this->getRequest()->getParam('limit', 10);
    }

    /**
     * Get Warranties
     *
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
        /**
         * @Hidro-Le
         * @TODO - Fixed
         * Chỗ này nên sử dụng customer là một param thay vì get trong session với lại
         *       collection chỗ này mỗi lần gọi thì lại tạo mới, nên tìm cách để không tạo mới mỗi lần gọi.
         *
         */
    }

    /**
     * Sro Detail
     *
     * @param object $warranty
     * @return bool
     */
    public function hasSroDetail($warranty)
    {
        /**
         * @Hidro-Le
         * @TODO - fixed
         * Chỗ này tên hàm chưa phù hợp với nội dung của hàm.
         */
        return $warranty->hasSroDetails();
    }

    /**
     * Get Sro Detail Url
     *
     * @param object $warranty
     * @return string
     */
    public function getSroDetailUrl($warranty)
    {
        $sro = $warranty->hasSroDetails();
        /**
         * @Hidro-Le
         * @TODO - Fixed
         * Chỗ này nếu $syro == null thì xử lý như thế nào, có trường hợp nào $sro == null ko?
         */
        if ($sro) {
            return $this->getUrl(
                "warranty/sro/edit",
                ["id" => $sro->getId(), "war_id" => $warranty->getId()]
            );
        }
        return '';
    }

    /**
     * Get Sro Detail Number
     *
     * @param object $warranty
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
     * Data Format
     *
     * @param object $dateString
     * @return false|string
     */
    public function dateFormat($dateString)
    {
        /**
         * @Hidro-Le
         * @TODO - fixed
         * Cần sử dụng DateTime default của Magento a kiếm chỗ nào xử lý vụ datetime giống vầy trong vendor
         */
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
