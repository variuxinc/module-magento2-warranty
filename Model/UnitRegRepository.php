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
use Variux\Warranty\Api\Data\UnitRegInterface;
use Variux\Warranty\Api\Data\UnitRegInterfaceFactory;
use Variux\Warranty\Api\Data\UnitRegSearchResultsInterfaceFactory;
use Variux\Warranty\Api\UnitRegRepositoryInterface;
use Variux\Warranty\Model\ResourceModel\UnitReg as ResourceUnitReg;
use Variux\Warranty\Model\ResourceModel\UnitReg\CollectionFactory as UnitRegCollectionFactory;

class UnitRegRepository implements UnitRegRepositoryInterface
{

    /**
     * @var UnitReg
     */
    protected $searchResultsFactory;

    /**
     * @var UnitRegCollectionFactory
     */
    protected $unitRegCollectionFactory;

    /**
     * @var CollectionProcessorInterface
     */
    protected $collectionProcessor;

    /**
     * @var UnitRegInterfaceFactory
     */
    protected $unitRegFactory;

    /**
     * @var ResourceUnitReg
     */
    protected $resource;

    /**
     * @param ResourceUnitReg $resource
     * @param UnitRegInterfaceFactory $unitRegFactory
     * @param UnitRegCollectionFactory $unitRegCollectionFactory
     * @param UnitRegSearchResultsInterfaceFactory $searchResultsFactory
     * @param CollectionProcessorInterface $collectionProcessor
     */
    public function __construct(
        ResourceUnitReg $resource,
        UnitRegInterfaceFactory $unitRegFactory,
        UnitRegCollectionFactory $unitRegCollectionFactory,
        UnitRegSearchResultsInterfaceFactory $searchResultsFactory,
        CollectionProcessorInterface $collectionProcessor
    ) {
        $this->resource = $resource;
        $this->unitRegFactory = $unitRegFactory;
        $this->unitRegCollectionFactory = $unitRegCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->collectionProcessor = $collectionProcessor;
    }

    /**
     * @inheritDoc
     */
    public function save(UnitRegInterface $unitReg)
    {
        try {
            $this->resource->save($unitReg);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__(
                'Could not save the unitReg: %1',
                $exception->getMessage()
            ));
        }
        return $unitReg;
    }

    /**
     * @inheritDoc
     */
    public function get($unitRegId)
    {
        $unitReg = $this->unitRegFactory->create();
        $this->resource->load($unitReg, $unitRegId);
        if (!$unitReg->getId()) {
            throw new NoSuchEntityException(__('UnitReg with id "%1" does not exist.', $unitRegId));
        }
        return $unitReg;
    }

    /**
     * @inheritDoc
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $criteria
    ) {
        $collection = $this->unitRegCollectionFactory->create();

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
    public function delete(UnitRegInterface $unitReg)
    {
        try {
            $unitRegModel = $this->unitRegFactory->create();
            $this->resource->load($unitRegModel, $unitReg->getUnitregId());
            $this->resource->delete($unitRegModel);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__(
                'Could not delete the UnitReg: %1',
                $exception->getMessage()
            ));
        }
        return true;
    }

    /**
     * @inheritDoc
     */
    public function deleteById($unitRegId)
    {
        return $this->delete($this->get($unitRegId));
    }
}
