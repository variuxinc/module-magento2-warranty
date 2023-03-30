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
     * @param ResourceWarranty $resource
     * @param WarrantyInterfaceFactory $warrantyFactory
     * @param WarrantyCollectionFactory $warrantyCollectionFactory
     * @param WarrantySearchResultsInterfaceFactory $searchResultsFactory
     * @param CollectionProcessorInterface $collectionProcessor
     */
    public function __construct(
        ResourceWarranty $resource,
        WarrantyInterfaceFactory $warrantyFactory,
        WarrantyCollectionFactory $warrantyCollectionFactory,
        WarrantySearchResultsInterfaceFactory $searchResultsFactory,
        CollectionProcessorInterface $collectionProcessor
    ) {
        $this->resource = $resource;
        $this->warrantyFactory = $warrantyFactory;
        $this->warrantyCollectionFactory = $warrantyCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->collectionProcessor = $collectionProcessor;
    }

    /**
     * @inheritDoc
     */
    public function save(WarrantyInterface $warranty)
    {
        try {
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
}

