<?php

namespace Variux\Warranty\Helper;

use Variux\Warranty\Model\ResourceModel\Warranty as WarrantyResourceModel;
use Variux\Warranty\Model\UnitRepository;
use Variux\Warranty\Model\WarrantyFactory;
use Variux\Warranty\Model\WorkcodeRepository;
use Magento\Catalog\Model\ProductRepository;
use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory;
use Magento\Customer\Model\ResourceModel\Customer as CustomerResourceModel;
use Magento\Framework\Api\FilterBuilder;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Api\Search\FilterGroupBuilder;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Sales\Model\OrderFactory;
use Magento\Sales\Model\OrderRepository;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Customer\Model\Session as customerSession;

/**
 * @Hidro-Le
 * @TODO - fixed
 * Các hàm ở trong class này chưa được define document
 */
class SuggestHelper extends \Magento\Framework\App\Helper\AbstractHelper
{
    /**
     * @var OrderRepository
     */
    protected $orderRepository;

    /**
     * @var CollectionFactory
     */
    protected $productCollectionFactory;

    /**
     * @var OrderFactory
     */
    protected $orderFactory;

    /**
     * @var SearchCriteriaBuilder
     */
    protected $_searchCriteriaBuilder;

    /**
     * @var FilterBuilder
     */
    protected $_filterBuilder;

    /**
     * @var FilterGroupBuilder
     */
    protected $_filterGroupBuilder;

    /**
     * @var StoreManagerInterface
     */
    protected $_storeManager;

    /**
     * @var WorkcodeRepository
     */
    protected $workcodeRepository;

    /**
     * @var UnitRepository
     */
    protected $unitRepository;

    /**
     * @var CustomerFactory
     */
    protected $customerFactory;

    /**
     * @var CustomerResourceModel
     */
    protected $customerResourceModel;

    /**
     * @var CollectionProcessorInterface
     */
    protected $collectionProcessor;

    /**
     * @var customerSession
     */
    protected $_customerSession;

    /**
     * @var ProductRepository
     */
    protected $_productRepository;

    /**
     * @var \Magento\Framework\Pricing\Helper\Data
     */
    protected $_priceHelper;

    /**
     * @var WarrantyFactory
     */
    protected $warrantyFactory;

    /**
     * @var WarrantyResourceModel
     */
    protected $warrantyResourceModel;

    public function __construct(
        \Magento\Framework\App\Helper\Context           $context,
        CollectionFactory                               $productCollectionFactory,
        CollectionProcessorInterface                    $collectionProcessor,
        OrderRepository                                 $orderRepository,
        OrderFactory                                    $orderFactory,
        SearchCriteriaBuilder                           $searchCriteriaBuilder,
        FilterBuilder                                   $filterBuilder,
        FilterGroupBuilder                              $filterGroupBuilder,
        StoreManagerInterface                           $storeManager,
        WorkcodeRepository                              $workcodeRepository,
        UnitRepository                                  $unitRepository,
        \Magento\Customer\Model\CustomerFactory         $customerFactory,
        CustomerResourceModel                           $customerResourceModel,
        customerSession                                 $customerSession,
        \Magento\Catalog\Api\ProductRepositoryInterface $productRepository,
        \Magento\Framework\Pricing\Helper\Data          $priceHelper,
        WarrantyResourceModel                           $warrantyResourceModel,
        WarrantyFactory                                 $warrantyFactory
    ) {
        parent::__construct($context);
        $this->productCollectionFactory = $productCollectionFactory;
        $this->orderRepository = $orderRepository;
        $this->orderFactory = $orderFactory;
        $this->_searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->_filterBuilder = $filterBuilder;
        $this->_filterGroupBuilder = $filterGroupBuilder;
        $this->_storeManager = $storeManager;
        $this->workcodeRepository = $workcodeRepository;
        $this->unitRepository = $unitRepository;
        $this->customerFactory = $customerFactory;
        $this->customerResourceModel = $customerResourceModel;
        $this->_customerSession = $customerSession;
        $this->_productRepository = $productRepository;
        $this->collectionProcessor = $collectionProcessor;
        $this->_priceHelper = $priceHelper;
        $this->warrantyResourceModel = $warrantyResourceModel;
        $this->warrantyFactory = $warrantyFactory;
    }

    /**
     * @param $query
     * @param bool $customerId
     * @return array
     * @throws NoSuchEntityException
     */
    public function findItem($query, bool $customerId = false): array
    {
        $storeId = $this->_storeManager->getStore()->getId();
        $collection = $this->productCollectionFactory->create();
        $collection->addAttributeToSelect(["sku", "name"]);
        /**
         * @Hidro-Le
         * @TODO - Review
         * SQL injection, sử dụng thêm $query = $connection->quote($query)
         */
        $collection->addAttributeToFilter(
            [
                ['attribute' => 'name', 'like' => '%' . $query . '%'],
                ['attribute' => 'sku', 'like' => '%' . $query . '%']
            ]
        );
        $collection->addStoreFilter($storeId);
        $collection->addFinalPrice();
        $collection->load();

        $products = [];
        $products[] = [
            'name' => "Custom material",
            'sku' => "NPN",
            'price' => 0
        ];
        foreach ($collection->getItems() as $item) {
            $products[] = [
                'name' => $item->getName(),
                'sku' => $item->getSku(),
                'price' => $item->getFinalPrice()
            ];
        }
        /**
         * @Hidro-Le
         * @TODO - Review
         * sử dụng ->count() thay cho ->getSize(). Thiếu trường hợp cho no result thật sự lúc nào cũng trả về
         *       'noResults' => false
         */
        return [
            'totalItems' => $collection->getSize() + 1,
            'items' => $products,
            'noResults' => false
        ];
    }

    /**
     * @param $query
     * @param bool $customerId
     * @return array
     */
    public function findDealer($query, bool $customerId = false): array
    {
        $dealers = [
            [
                'id' => $customerId,
                'name' => __("Test")
            ]
        ];

        $response = [
            'totalItems' => 1,
            'items' => $dealers,
            'noResults' => false
        ];

        return $response;
    }

    /**
     * @param $query
     * @param bool $customerId
     * @return array
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function findWorkcode($query, bool $customerId = false): array
    {
        $searchCriteria = $this->_searchCriteriaBuilder;
        if ($query) {
            $attr1 = $this->_filterBuilder->setField('work_code')
                ->setValue("%" . $query . "%")
                ->setConditionType('like')
                ->create();
            $attr2 = $this->_filterBuilder->setField('description')
                ->setValue("%" . $query . "%")
                ->setConditionType('like')
                ->create();

            $filterOr = $this->_filterGroupBuilder
                ->addFilter($attr1)
                ->addFilter($attr2)
                ->create();
            $searchCriteria->setFilterGroups([$filterOr]);
        }
        $searchCriteria->setPageSize(50)->setCurrentPage(1);
        $searchCriteria = $searchCriteria->create();
        $searchResults = $this->workcodeRepository->getList($searchCriteria);
        $works = [];
        foreach ($searchResults->getItems() as $item) {
            $works[] = [
                'code' => $item->getWorkCode(),
                'description' => $item->getDescription(),
                'duration' => $item->getDuration()
            ];
        }
        $response = [
            'totalItems' => $searchResults->getTotalCount(),
            'items' => $works,
            'noResults' => $searchResults->getTotalCount() > 0 ? false : true
        ];

        return $response;
    }

    /**
     * @param $query
     * @return array
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function findEngine($query): array
    {
        $searchCriteria = $this->_searchCriteriaBuilder;
        if ($query) {
            $searchCriteria->addFilter("serial_no", "%" . $query . "%", "like");
        }
        $searchCriteria->setPageSize(50)->setCurrentPage(1);
        $searchCriteria = $searchCriteria->create();
        $searchResults = $this->unitRepository->getList($searchCriteria);
        $units = [];
        foreach ($searchResults->getItems() as $item) {
            $units[] = [
                'serial_no' => $item->getSerialNo(),
                'description' => $item->getDescription(),
                'item' => $item->getItem(),
                'warranty_start_date' => $item->getWarrantyStartDate(),
                'warranty_end_date' => $item->getWarrantyEndDate()
            ];
        }
        $response = [
            'totalItems' => $searchResults->getTotalCount(),
            'items' => $units,
            'noResults' => $searchResults->getTotalCount() > 0 ? false : true
        ];

        return $response;
    }

    /**
     * @param $query
     * @return array
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function findEngineForWarrantyTransfer($query): array
    {
        $searchCriteria = $this->_searchCriteriaBuilder;
        if ($query) {
            $searchCriteria->addFilter("serial_no", "%" . $query . "%", "like");
        }
        $searchCriteria->setPageSize(50)->setCurrentPage(1);
        $searchCriteria = $searchCriteria->create();
        $searchResults = $this->unitRepository->getList($searchCriteria);
        $units = [];
        foreach ($searchResults->getItems() as $item) {
            $units[] = [
                'serial_no' => $item->getSerialNo(),
                'description' => $item->getDescription(),
                'item' => $item->getItem(),
                'warranty_start_date' => $item->getWarrantyStartDate(),
                'warranty_end_date' => $item->getWarrantyEndDate(),
            ];
        }
        $response = [
            'totalItems' => $searchResults->getTotalCount(),
            'items' => $units,
            'noResults' => $searchResults->getTotalCount() > 0 ? false : true
        ];

        return $response;
    }

    /**
     * @param $query
     * @param bool $customerId
     * @return array
     */

    /**
     * @param $warrantyId
     * @return array|null[]
     */
    public function getSroNumAndIncNumByWarrantyId($warrantyId): array
    {
        $warranty = $this->warrantyFactory->create();
        $this->warrantyResourceModel->load($warranty, $warrantyId);
        if ($warranty->hasData()) {
            return [
                'inc_num' => $warranty->getIncNum(),
                'sro_num' => $warranty->getFirstSroNum()
            ];
        } else {
            return [
                'inc_num' => null,
                'sro_num' => null
            ];
        }
    }
}
