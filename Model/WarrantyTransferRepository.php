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
use Variux\Warranty\Api\Data\WarrantyTransferInterface;
use Variux\Warranty\Api\Data\WarrantyTransferInterfaceFactory;
use Variux\Warranty\Api\Data\WarrantyTransferSearchResultsInterfaceFactory;
use Variux\Warranty\Api\WarrantyTransferRepositoryInterface;
use Variux\Warranty\Model\ResourceModel\WarrantyTransfer as ResourceWarrantyTransfer;
use Variux\Warranty\Model\ResourceModel\WarrantyTransfer\CollectionFactory as WarrantyTransferCollectionFactory;

class WarrantyTransferRepository implements WarrantyTransferRepositoryInterface
{

    /**
     * @var ResourceWarrantyTransfer
     */
    protected $resource;

    /**
     * @var WarrantyTransferCollectionFactory
     */
    protected $warrantyTransferCollectionFactory;

    /**
     * @var CollectionProcessorInterface
     */
    protected $collectionProcessor;

    /**
     * @var WarrantyTransferInterfaceFactory
     */
    protected $warrantyTransferFactory;

    /**
     * @var WarrantyTransfer
     */
    protected $searchResultsFactory;


    /**
     * @param ResourceWarrantyTransfer $resource
     * @param WarrantyTransferInterfaceFactory $warrantyTransferFactory
     * @param WarrantyTransferCollectionFactory $warrantyTransferCollectionFactory
     * @param WarrantyTransferSearchResultsInterfaceFactory $searchResultsFactory
     * @param CollectionProcessorInterface $collectionProcessor
     */
    public function __construct(
        ResourceWarrantyTransfer $resource,
        WarrantyTransferInterfaceFactory $warrantyTransferFactory,
        WarrantyTransferCollectionFactory $warrantyTransferCollectionFactory,
        WarrantyTransferSearchResultsInterfaceFactory $searchResultsFactory,
        CollectionProcessorInterface $collectionProcessor
    ) {
        $this->resource = $resource;
        $this->warrantyTransferFactory = $warrantyTransferFactory;
        $this->warrantyTransferCollectionFactory = $warrantyTransferCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->collectionProcessor = $collectionProcessor;
    }

    /**
     * @inheritDoc
     */
    public function save(
        WarrantyTransferInterface $warrantyTransfer
    ) {
        try {
            $this->resource->save($warrantyTransfer);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__(
                'Could not save the warrantyTransfer: %1',
                $exception->getMessage()
            ));
        }
        return $warrantyTransfer;
    }

    /**
     * @inheritDoc
     */
    public function get($warrantyTransferId)
    {
        $warrantyTransfer = $this->warrantyTransferFactory->create();
        $this->resource->load($warrantyTransfer, $warrantyTransferId);
        if (!$warrantyTransfer->getId()) {
            throw new NoSuchEntityException(__('WarrantyTransfer with id "%1" does not exist.', $warrantyTransferId));
        }
        return $warrantyTransfer;
    }

    /**
     * @inheritDoc
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $criteria
    ) {
        $collection = $this->warrantyTransferCollectionFactory->create();
        
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
    public function delete(
        WarrantyTransferInterface $warrantyTransfer
    ) {
        try {
            $warrantyTransferModel = $this->warrantyTransferFactory->create();
            $this->resource->load($warrantyTransferModel, $warrantyTransfer->getWarrantytransferId());
            $this->resource->delete($warrantyTransferModel);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__(
                'Could not delete the WarrantyTransfer: %1',
                $exception->getMessage()
            ));
        }
        return true;
    }

    /**
     * @inheritDoc
     */
    public function deleteById($warrantyTransferId)
    {
        return $this->delete($this->get($warrantyTransferId));
    }
}