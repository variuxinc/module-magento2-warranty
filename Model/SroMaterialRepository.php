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
use Variux\Warranty\Api\Data\SroMaterialInterface;
use Variux\Warranty\Api\Data\SroMaterialInterfaceFactory;
use Variux\Warranty\Api\Data\SroMaterialSearchResultsInterfaceFactory;
use Variux\Warranty\Api\SroMaterialRepositoryInterface;
use Variux\Warranty\Model\ResourceModel\SroMaterial as ResourceSroMaterial;
use Variux\Warranty\Model\ResourceModel\SroMaterial\CollectionFactory as SroMaterialCollectionFactory;

class SroMaterialRepository implements SroMaterialRepositoryInterface
{

    /**
     * @var ResourceSroMaterial
     */
    protected $resource;

    /**
     * @var SroMaterialCollectionFactory
     */
    protected $sroMaterialCollectionFactory;

    /**
     * @var SroMaterial
     */
    protected $searchResultsFactory;

    /**
     * @var SroMaterialInterfaceFactory
     */
    protected $sroMaterialFactory;

    /**
     * @var CollectionProcessorInterface
     */
    protected $collectionProcessor;

    /**
     * @param ResourceSroMaterial $resource
     * @param SroMaterialInterfaceFactory $sroMaterialFactory
     * @param SroMaterialCollectionFactory $sroMaterialCollectionFactory
     * @param SroMaterialSearchResultsInterfaceFactory $searchResultsFactory
     * @param CollectionProcessorInterface $collectionProcessor
     */
    public function __construct(
        ResourceSroMaterial $resource,
        SroMaterialInterfaceFactory $sroMaterialFactory,
        SroMaterialCollectionFactory $sroMaterialCollectionFactory,
        SroMaterialSearchResultsInterfaceFactory $searchResultsFactory,
        CollectionProcessorInterface $collectionProcessor
    ) {
        $this->resource = $resource;
        $this->sroMaterialFactory = $sroMaterialFactory;
        $this->sroMaterialCollectionFactory = $sroMaterialCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->collectionProcessor = $collectionProcessor;
    }

    /**
     * @inheritDoc
     */
    public function save(SroMaterialInterface $sroMaterial)
    {
        try {
            $this->resource->save($sroMaterial);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__(
                'Could not save the sroMaterial: %1',
                $exception->getMessage()
            ));
        }
        return $sroMaterial;
    }

    /**
     * @inheritDoc
     */
    public function get($sroMaterialId)
    {
        $sroMaterial = $this->sroMaterialFactory->create();
        $this->resource->load($sroMaterial, $sroMaterialId);
        if (!$sroMaterial->getId()) {
            throw new NoSuchEntityException(__('SroMaterial with id "%1" does not exist.', $sroMaterialId));
        }
        return $sroMaterial;
    }

    /**
     * @inheritDoc
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $criteria
    ) {
        $collection = $this->sroMaterialCollectionFactory->create();

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
    public function delete(SroMaterialInterface $sroMaterial)
    {
        try {
            $sroMaterialModel = $this->sroMaterialFactory->create();
            $this->resource->load($sroMaterialModel, $sroMaterial->getSromaterialId());
            $this->resource->delete($sroMaterialModel);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__(
                'Could not delete the SroMaterial: %1',
                $exception->getMessage()
            ));
        }
        return true;
    }

    /**
     * @inheritDoc
     */
    public function deleteById($sroMaterialId)
    {
        return $this->delete($this->get($sroMaterialId));
    }
}
