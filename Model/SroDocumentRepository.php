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
use Variux\Warranty\Api\Data\SroDocumentInterface;
use Variux\Warranty\Api\Data\SroDocumentInterfaceFactory;
use Variux\Warranty\Api\Data\SroDocumentSearchResultsInterfaceFactory;
use Variux\Warranty\Api\SroDocumentRepositoryInterface;
use Variux\Warranty\Model\ResourceModel\SroDocument as ResourceSroDocument;
use Variux\Warranty\Model\ResourceModel\SroDocument\CollectionFactory as SroDocumentCollectionFactory;

class SroDocumentRepository implements SroDocumentRepositoryInterface
{

    /**
     * @var SroDocumentCollectionFactory
     */
    protected $sroDocumentCollectionFactory;

    /**
     * @var ResourceSroDocument
     */
    protected $resource;

    /**
     * @var SroDocument
     */
    protected $searchResultsFactory;

    /**
     * @var SroDocumentInterfaceFactory
     */
    protected $sroDocumentFactory;

    /**
     * @var CollectionProcessorInterface
     */
    protected $collectionProcessor;

    /**
     * @param ResourceSroDocument $resource
     * @param SroDocumentInterfaceFactory $sroDocumentFactory
     * @param SroDocumentCollectionFactory $sroDocumentCollectionFactory
     * @param SroDocumentSearchResultsInterfaceFactory $searchResultsFactory
     * @param CollectionProcessorInterface $collectionProcessor
     */
    public function __construct(
        ResourceSroDocument $resource,
        SroDocumentInterfaceFactory $sroDocumentFactory,
        SroDocumentCollectionFactory $sroDocumentCollectionFactory,
        SroDocumentSearchResultsInterfaceFactory $searchResultsFactory,
        CollectionProcessorInterface $collectionProcessor
    ) {
        $this->resource = $resource;
        $this->sroDocumentFactory = $sroDocumentFactory;
        $this->sroDocumentCollectionFactory = $sroDocumentCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->collectionProcessor = $collectionProcessor;
    }

    /**
     * @inheritDoc
     */
    public function save(SroDocumentInterface $sroDocument)
    {
        try {
            $this->resource->save($sroDocument);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__(
                'Could not save the sroDocument: %1',
                $exception->getMessage()
            ));
        }
        return $sroDocument;
    }

    /**
     * @inheritDoc
     */
    public function get($sroDocumentId)
    {
        $sroDocument = $this->sroDocumentFactory->create();
        $this->resource->load($sroDocument, $sroDocumentId);
        if (!$sroDocument->getId()) {
            throw new NoSuchEntityException(__('SroDocument with id "%1" does not exist.', $sroDocumentId));
        }
        return $sroDocument;
    }

    /**
     * @inheritDoc
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $criteria
    ) {
        $collection = $this->sroDocumentCollectionFactory->create();

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
    public function delete(SroDocumentInterface $sroDocument)
    {
        try {
            $sroDocumentModel = $this->sroDocumentFactory->create();
            $this->resource->load($sroDocumentModel, $sroDocument->getSrodocumentId());
            $this->resource->delete($sroDocumentModel);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__(
                'Could not delete the SroDocument: %1',
                $exception->getMessage()
            ));
        }
        return true;
    }

    /**
     * @inheritDoc
     */
    public function deleteById($sroDocumentId)
    {
        return $this->delete($this->get($sroDocumentId));
    }
}
