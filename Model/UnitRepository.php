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
use Variux\Warranty\Api\Data\UnitInterface;
use Variux\Warranty\Api\Data\UnitInterfaceFactory;
use Variux\Warranty\Api\Data\UnitSearchResultsInterfaceFactory;
use Variux\Warranty\Api\UnitRepositoryInterface;
use Variux\Warranty\Model\ResourceModel\Unit as ResourceUnit;
use Variux\Warranty\Model\ResourceModel\Unit\CollectionFactory as UnitCollectionFactory;

class UnitRepository implements UnitRepositoryInterface
{

    /**
     * @var UnitCollectionFactory
     */
    protected $unitCollectionFactory;

    /**
     * @var UnitInterfaceFactory
     */
    protected $unitFactory;

    /**
     * @var Unit
     */
    protected $searchResultsFactory;

    /**
     * @var CollectionProcessorInterface
     */
    protected $collectionProcessor;

    /**
     * @var ResourceUnit
     */
    protected $resource;

    /**
     * @param ResourceUnit $resource
     * @param UnitInterfaceFactory $unitFactory
     * @param UnitCollectionFactory $unitCollectionFactory
     * @param UnitSearchResultsInterfaceFactory $searchResultsFactory
     * @param CollectionProcessorInterface $collectionProcessor
     */
    public function __construct(
        ResourceUnit $resource,
        UnitInterfaceFactory $unitFactory,
        UnitCollectionFactory $unitCollectionFactory,
        UnitSearchResultsInterfaceFactory $searchResultsFactory,
        CollectionProcessorInterface $collectionProcessor
    ) {
        $this->resource = $resource;
        $this->unitFactory = $unitFactory;
        $this->unitCollectionFactory = $unitCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->collectionProcessor = $collectionProcessor;
    }

    /**
     * @inheritDoc
     */
    public function save(UnitInterface $unit)
    {
        try {
            $this->resource->save($unit);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__(
                'Could not save the unit: %1',
                $exception->getMessage()
            ));
        }
        return $unit;
    }

    /**
     * @inheritDoc
     */
    public function get($unitId)
    {
        $unit = $this->unitFactory->create();
        $this->resource->load($unit, $unitId);
        if (!$unit->getId()) {
            throw new NoSuchEntityException(__('Unit with id "%1" does not exist.', $unitId));
        }
        return $unit;
    }

    /**
     * @inheritDoc
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $criteria
    ) {
        $collection = $this->unitCollectionFactory->create();

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
    public function delete(UnitInterface $unit)
    {
        try {
            $unitModel = $this->unitFactory->create();
            $this->resource->load($unitModel, $unit->getUnitId());
            $this->resource->delete($unitModel);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__(
                'Could not delete the Unit: %1',
                $exception->getMessage()
            ));
        }
        return true;
    }

    /**
     * @inheritDoc
     */
    public function deleteById($unitId)
    {
        return $this->delete($this->get($unitId));
    }
}
