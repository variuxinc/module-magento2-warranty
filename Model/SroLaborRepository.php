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
use Variux\Warranty\Api\Data\SroLaborInterface;
use Variux\Warranty\Api\Data\SroLaborInterfaceFactory;
use Variux\Warranty\Api\Data\SroLaborSearchResultsInterfaceFactory;
use Variux\Warranty\Api\SroLaborRepositoryInterface;
use Variux\Warranty\Model\ResourceModel\SroLabor as ResourceSroLabor;
use Variux\Warranty\Model\ResourceModel\SroLabor\CollectionFactory as SroLaborCollectionFactory;

class SroLaborRepository implements SroLaborRepositoryInterface
{

    /**
     * @var ResourceSroLabor
     */
    protected $resource;

    /**
     * @var SroLaborInterfaceFactory
     */
    protected $sroLaborFactory;

    /**
     * @var SroLaborCollectionFactory
     */
    protected $sroLaborCollectionFactory;

    /**
     * @var CollectionProcessorInterface
     */
    protected $collectionProcessor;

    /**
     * @var SroLabor
     */
    protected $searchResultsFactory;


    /**
     * @param ResourceSroLabor $resource
     * @param SroLaborInterfaceFactory $sroLaborFactory
     * @param SroLaborCollectionFactory $sroLaborCollectionFactory
     * @param SroLaborSearchResultsInterfaceFactory $searchResultsFactory
     * @param CollectionProcessorInterface $collectionProcessor
     */
    public function __construct(
        ResourceSroLabor $resource,
        SroLaborInterfaceFactory $sroLaborFactory,
        SroLaborCollectionFactory $sroLaborCollectionFactory,
        SroLaborSearchResultsInterfaceFactory $searchResultsFactory,
        CollectionProcessorInterface $collectionProcessor
    ) {
        $this->resource = $resource;
        $this->sroLaborFactory = $sroLaborFactory;
        $this->sroLaborCollectionFactory = $sroLaborCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->collectionProcessor = $collectionProcessor;
    }

    /**
     * @inheritDoc
     */
    public function save(SroLaborInterface $sroLabor)
    {
        try {
            $this->resource->save($sroLabor);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__(
                'Could not save the sroLabor: %1',
                $exception->getMessage()
            ));
        }
        return $sroLabor;
    }

    /**
     * @inheritDoc
     */
    public function get($sroLaborId)
    {
        $sroLabor = $this->sroLaborFactory->create();
        $this->resource->load($sroLabor, $sroLaborId);
        if (!$sroLabor->getId()) {
            throw new NoSuchEntityException(__('SroLabor with id "%1" does not exist.', $sroLaborId));
        }
        return $sroLabor;
    }

    /**
     * @inheritDoc
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $criteria
    ) {
        $collection = $this->sroLaborCollectionFactory->create();
        
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
    public function delete(SroLaborInterface $sroLabor)
    {
        try {
            $sroLaborModel = $this->sroLaborFactory->create();
            $this->resource->load($sroLaborModel, $sroLabor->getSrolaborId());
            $this->resource->delete($sroLaborModel);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__(
                'Could not delete the SroLabor: %1',
                $exception->getMessage()
            ));
        }
        return true;
    }

    /**
     * @inheritDoc
     */
    public function deleteById($sroLaborId)
    {
        return $this->delete($this->get($sroLaborId));
    }
}

