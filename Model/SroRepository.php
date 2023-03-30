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
use Variux\Warranty\Api\Data\SroInterface;
use Variux\Warranty\Api\Data\SroInterfaceFactory;
use Variux\Warranty\Api\Data\SroSearchResultsInterfaceFactory;
use Variux\Warranty\Api\SroRepositoryInterface;
use Variux\Warranty\Model\ResourceModel\Sro as ResourceSro;
use Variux\Warranty\Model\ResourceModel\Sro\CollectionFactory as SroCollectionFactory;

class SroRepository implements SroRepositoryInterface
{

    /**
     * @var ResourceSro
     */
    protected $resource;

    /**
     * @var SroInterfaceFactory
     */
    protected $sroFactory;

    /**
     * @var Sro
     */
    protected $searchResultsFactory;

    /**
     * @var CollectionProcessorInterface
     */
    protected $collectionProcessor;

    /**
     * @var SroCollectionFactory
     */
    protected $sroCollectionFactory;


    /**
     * @param ResourceSro $resource
     * @param SroInterfaceFactory $sroFactory
     * @param SroCollectionFactory $sroCollectionFactory
     * @param SroSearchResultsInterfaceFactory $searchResultsFactory
     * @param CollectionProcessorInterface $collectionProcessor
     */
    public function __construct(
        ResourceSro $resource,
        SroInterfaceFactory $sroFactory,
        SroCollectionFactory $sroCollectionFactory,
        SroSearchResultsInterfaceFactory $searchResultsFactory,
        CollectionProcessorInterface $collectionProcessor
    ) {
        $this->resource = $resource;
        $this->sroFactory = $sroFactory;
        $this->sroCollectionFactory = $sroCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->collectionProcessor = $collectionProcessor;
    }

    /**
     * @inheritDoc
     */
    public function save(SroInterface $sro)
    {
        try {
            $this->resource->save($sro);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__(
                'Could not save the sro: %1',
                $exception->getMessage()
            ));
        }
        return $sro;
    }

    /**
     * @inheritDoc
     */
    public function get($sroId)
    {
        $sro = $this->sroFactory->create();
        $this->resource->load($sro, $sroId);
        if (!$sro->getId()) {
            throw new NoSuchEntityException(__('Sro with id "%1" does not exist.', $sroId));
        }
        return $sro;
    }

    /**
     * @inheritDoc
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $criteria
    ) {
        $collection = $this->sroCollectionFactory->create();
        
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
    public function delete(SroInterface $sro)
    {
        try {
            $sroModel = $this->sroFactory->create();
            $this->resource->load($sroModel, $sro->getSroId());
            $this->resource->delete($sroModel);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__(
                'Could not delete the Sro: %1',
                $exception->getMessage()
            ));
        }
        return true;
    }

    /**
     * @inheritDoc
     */
    public function deleteById($sroId)
    {
        return $this->delete($this->get($sroId));
    }
}

