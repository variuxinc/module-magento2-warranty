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
use Variux\Warranty\Api\Data\SroMiscInterface;
use Variux\Warranty\Api\Data\SroMiscInterfaceFactory;
use Variux\Warranty\Api\Data\SroMiscSearchResultsInterfaceFactory;
use Variux\Warranty\Api\SroMiscRepositoryInterface;
use Variux\Warranty\Model\ResourceModel\SroMisc as ResourceSroMisc;
use Variux\Warranty\Model\ResourceModel\SroMisc\CollectionFactory as SroMiscCollectionFactory;

class SroMiscRepository implements SroMiscRepositoryInterface
{

    /**
     * @var SroMiscInterfaceFactory
     */
    protected $sroMiscFactory;

    /**
     * @var CollectionProcessorInterface
     */
    protected $collectionProcessor;

    /**
     * @var SroMisc
     */
    protected $searchResultsFactory;

    /**
     * @var SroMiscCollectionFactory
     */
    protected $sroMiscCollectionFactory;

    /**
     * @var ResourceSroMisc
     */
    protected $resource;


    /**
     * @param ResourceSroMisc $resource
     * @param SroMiscInterfaceFactory $sroMiscFactory
     * @param SroMiscCollectionFactory $sroMiscCollectionFactory
     * @param SroMiscSearchResultsInterfaceFactory $searchResultsFactory
     * @param CollectionProcessorInterface $collectionProcessor
     */
    public function __construct(
        ResourceSroMisc $resource,
        SroMiscInterfaceFactory $sroMiscFactory,
        SroMiscCollectionFactory $sroMiscCollectionFactory,
        SroMiscSearchResultsInterfaceFactory $searchResultsFactory,
        CollectionProcessorInterface $collectionProcessor
    ) {
        $this->resource = $resource;
        $this->sroMiscFactory = $sroMiscFactory;
        $this->sroMiscCollectionFactory = $sroMiscCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->collectionProcessor = $collectionProcessor;
    }

    /**
     * @inheritDoc
     */
    public function save(SroMiscInterface $sroMisc)
    {
        try {
            $this->resource->save($sroMisc);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__(
                'Could not save the sroMisc: %1',
                $exception->getMessage()
            ));
        }
        return $sroMisc;
    }

    /**
     * @inheritDoc
     */
    public function get($sroMiscId)
    {
        $sroMisc = $this->sroMiscFactory->create();
        $this->resource->load($sroMisc, $sroMiscId);
        if (!$sroMisc->getId()) {
            throw new NoSuchEntityException(__('SroMisc with id "%1" does not exist.', $sroMiscId));
        }
        return $sroMisc;
    }

    /**
     * @inheritDoc
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $criteria
    ) {
        $collection = $this->sroMiscCollectionFactory->create();
        
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
    public function delete(SroMiscInterface $sroMisc)
    {
        try {
            $sroMiscModel = $this->sroMiscFactory->create();
            $this->resource->load($sroMiscModel, $sroMisc->getSromiscId());
            $this->resource->delete($sroMiscModel);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__(
                'Could not delete the SroMisc: %1',
                $exception->getMessage()
            ));
        }
        return true;
    }

    /**
     * @inheritDoc
     */
    public function deleteById($sroMiscId)
    {
        return $this->delete($this->get($sroMiscId));
    }
}

