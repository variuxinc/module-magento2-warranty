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

    private static $warranties = null;
    private static $warrantiesLoaded = [];

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
        \Magento\Framework\View\Element\Template\Context $context,
        CustomerSession $customerSession,
        WarrantyCollectionFactory $warrantyCollectionFactory,
        \Magento\Framework\Controller\Result\RedirectFactory $resultRedirectFactory,
        MessageManagerInterface $messageManager,
        array $data = []
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
         * @TODO - Review
         * Chỗ này a cần kiểm tra lại, hàm getWarranties mỗi lần gọi lại tạo 1 collection.
         */
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
        /**
         * @Hidro-Le
         * @TODO - Review
         * Chỗ này nên sử dụng customer là một param thay vì get trong session với lại
         *       collection chỗ này mỗi lần gọi thì lại tạo mới, nên tìm cách để không tạo mới mỗi lần gọi.
         *
         */
        $customer = $this->getCurrentCustomer();
        if ($customer) {
            $collection = self::$warranties;
            if(is_null($collection) || !in_array(spl_object_hash($collection), self::$warrantiesLoaded)) {
                $collection = $this->warrantyCollectionFactory->create()
                    ->addFieldToFilter("customer_id", ["eq" => $customer->getId()])->setOrder('created_at', 'DESC');
                $collection->setPageSize($this->getPageSize());
                $collection->setCurPage($this->getPage());
                $collection->applyFilterData($this->getFilterData());
                self::$warranties = $collection;
                self::$warrantiesLoaded[] = spl_object_hash($collection);
            }
            return $collection;
        }
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
        /**
         * @Hidro-Le
         * @TODO - fixed
         * Chỗ này tên hàm chưa phù hợp với nội dung của hàm.
         */
        return $warranty->hasSroDetails();
    }

    /**
     * @param $warranty
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
        if($sro) {
            return $this->getUrl(
                "warranty/sro/edit",
                ["id" => $sro->getId(), "war_id" => $warranty->getId()]
            );
        }
        return '';

    }

    /**
     * @return string
     */
    public function getAjaxUrl()
    {
        /**
         * @Hidro-Le
         * @TODO - fixed
         * Chỗ này thiếu return chỉ return !empty còn nếu mà empty thì return gì?
         */
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
