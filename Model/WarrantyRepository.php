<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Variux\Warranty\Model;

use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Variux\Warranty\Api\Data\WarrantyInterface;
use Variux\Warranty\Api\Data\WarrantyInterfaceFactory;
use Variux\Warranty\Api\Data\WarrantySearchResultsInterfaceFactory;
use Variux\Warranty\Api\WarrantyRepositoryInterface;
use Variux\Warranty\Model\ResourceModel\Warranty as ResourceWarranty;
use Variux\Warranty\Model\ResourceModel\Warranty\CollectionFactory as WarrantyCollectionFactory;
use Magento\Store\Model\StoreManagerInterface;

class WarrantyRepository implements WarrantyRepositoryInterface
{

    /**
     * @var Warranty
     */
    protected $searchResultsFactory;

    /**
     * @var WarrantyInterfaceFactory
     */
    protected $warrantyFactory;

    /**
     * @var CollectionProcessorInterface
     */
    protected $collectionProcessor;

    /**
     * @var ResourceWarranty
     */
    protected $resource;

    /**
     * @var WarrantyCollectionFactory
     */
    protected $warrantyCollectionFactory;

    /**
     * @var \Magento\Customer\Model\Session
     */
    protected $customerSession;

    /**
     * @var StoreManagerInterface
     */
    private $storeManager;

    /**
     * @param ResourceWarranty $resource
     * @param WarrantyInterfaceFactory $warrantyFactory
     * @param WarrantyCollectionFactory $warrantyCollectionFactory
     * @param WarrantySearchResultsInterfaceFactory $searchResultsFactory
     * @param CollectionProcessorInterface $collectionProcessor
     * @param \Magento\Customer\Model\Session $customerSession
     * @param StoreManagerInterface $storeManager
     */
    public function __construct(
        ResourceWarranty $resource,
        WarrantyInterfaceFactory $warrantyFactory,
        WarrantyCollectionFactory $warrantyCollectionFactory,
        WarrantySearchResultsInterfaceFactory $searchResultsFactory,
        CollectionProcessorInterface $collectionProcessor,
        \Magento\Customer\Model\Session $customerSession,
        StoreManagerInterface $storeManager
    ) {
        $this->resource = $resource;
        $this->warrantyFactory = $warrantyFactory;
        $this->warrantyCollectionFactory = $warrantyCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->collectionProcessor = $collectionProcessor;
        $this->customerSession = $customerSession;
        $this->storeManager = $storeManager;
    }

    /**
     * @inheritDoc
     */
    public function save(WarrantyInterface $warranty)
    {
        try {
            $this->processCustomerData($warranty);
            $this->processStatus($warranty);
            $this->resource->save($warranty);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__(
                'Could not save the warranty: %1',
                $exception->getMessage()
            ));
        }
        return $warranty;
    }

    /**
     * @inheritDoc
     */
    public function get($warrantyId)
    {
        $warranty = $this->warrantyFactory->create();
        $this->resource->load($warranty, $warrantyId);
        if (!$warranty->getId()) {
            throw new NoSuchEntityException(__('Warranty with id "%1" does not exist.', $warrantyId));
        }
        return $warranty;
    }

    /**
     * @inheritDoc
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $criteria
    ) {
        $collection = $this->warrantyCollectionFactory->create();

        $this->collectionProcessor->process($criteria, $collection);

        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($criteria);

        $items = [];
        foreach ($collection as $model) {
            $items[] = $model;
        }

        $searchResults->setItems($items);
        $searchResults->setTotalCount($collection->getSize());
        return $searchResults;
    }

    /**
     * @inheritDoc
     */
    public function delete(WarrantyInterface $warranty)
    {
        try {
            $warrantyModel = $this->warrantyFactory->create();
            $this->resource->load($warrantyModel, $warranty->getWarrantyId());
            $this->resource->delete($warrantyModel);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__(
                'Could not delete the Warranty: %1',
                $exception->getMessage()
            ));
        }
        return true;
    }

    /**
     * @inheritDoc
     */
    public function deleteById($warrantyId)
    {
        return $this->delete($this->get($warrantyId));
    }

    public function processStatus(\Variux\Warranty\Model\Warranty $warranty)
    {
        if (!$warranty->getId()) {
            $warranty->setStatus(\Variux\Warranty\Model\Warranty::STATUS_ARRAY["INCOMP"]["key"]);
        }
    }

    public function processCustomerData(\Variux\Warranty\Model\Warranty $warranty)
    {
        $customerId = $this->customerSession->getCustomerId();
        if (!$warranty->getCustomerId()) {
            $warranty->setCustomerId($customerId);
        }

        if (!$warranty->getStoreId()) {
            $warranty->setStoreId($this->storeManager->getStore()->getId());
        }
    }

    /**
     * Load Warranty data by given Warranty Identity
     *
     * @param string $warrantyId
     * @return Warranty
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getById($warrantyId)
    {
        $model = $this->warrantyFactory->create();
        $this->resource->load($model, $warrantyId);
        if (!$model->getId()) {
            throw new NoSuchEntityException(__('The warranty with the "%1" ID doesn\'t exist.', $warrantyId));
        }
        return $model;
    }
}
