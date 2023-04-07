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
use Variux\Warranty\Api\Data\WorkcodeInterface;
use Variux\Warranty\Api\Data\WorkcodeInterfaceFactory;
use Variux\Warranty\Api\Data\WorkcodeSearchResultsInterfaceFactory;
use Variux\Warranty\Api\WorkcodeRepositoryInterface;
use Variux\Warranty\Model\ResourceModel\Workcode as ResourceWorkcode;
use Variux\Warranty\Model\ResourceModel\Workcode\CollectionFactory as WorkcodeCollectionFactory;

class WorkcodeRepository implements WorkcodeRepositoryInterface
{

    /**
     * @var WorkcodeInterfaceFactory
     */
    protected $workcodeFactory;

    /**
     * @var ResourceWorkcode
     */
    protected $resource;

    /**
     * @var Workcode
     */
    protected $searchResultsFactory;

    /**
     * @var CollectionProcessorInterface
     */
    protected $collectionProcessor;

    /**
     * @var WorkcodeCollectionFactory
     */
    protected $workcodeCollectionFactory;

    /**
     * @param ResourceWorkcode $resource
     * @param WorkcodeInterfaceFactory $workcodeFactory
     * @param WorkcodeCollectionFactory $workcodeCollectionFactory
     * @param WorkcodeSearchResultsInterfaceFactory $searchResultsFactory
     * @param CollectionProcessorInterface $collectionProcessor
     */
    public function __construct(
        ResourceWorkcode $resource,
        WorkcodeInterfaceFactory $workcodeFactory,
        WorkcodeCollectionFactory $workcodeCollectionFactory,
        WorkcodeSearchResultsInterfaceFactory $searchResultsFactory,
        CollectionProcessorInterface $collectionProcessor
    ) {
        $this->resource = $resource;
        $this->workcodeFactory = $workcodeFactory;
        $this->workcodeCollectionFactory = $workcodeCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->collectionProcessor = $collectionProcessor;
    }

    /**
     * @inheritDoc
     */
    public function save(WorkcodeInterface $workcode)
    {
        try {
            $this->resource->save($workcode);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__(
                'Could not save the workcode: %1',
                $exception->getMessage()
            ));
        }
        return $workcode;
    }

    /**
     * @inheritDoc
     */
    public function get($workcodeId): WorkcodeInterface
    {
        $workcode = $this->workcodeFactory->create();
        $this->resource->load($workcode, $workcodeId);
        if (!$workcode->getId()) {
            throw new NoSuchEntityException(__('Workcode with id "%1" does not exist.', $workcodeId));
        }
        return $workcode;
    }

    /**
     * @inheritDoc
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $criteria
    ): \Variux\Warranty\Api\Data\WorkcodeSearchResultsInterface {
        $collection = $this->workcodeCollectionFactory->create();

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
    public function delete(WorkcodeInterface $workCode)
    {
        try {
            $workcodeModel = $this->workcodeFactory->create();
            $this->resource->load($workcodeModel, $workCode->getWorkcodeId());
            $this->resource->delete($workcodeModel);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__(
                'Could not delete the Workcode: %1',
                $exception->getMessage()
            ));
        }
        return true;
    }

    /**
     * @inheritDoc
     */
    public function deleteById($workcodeId)
    {
        return $this->delete($this->get($workcodeId));
    }
}
