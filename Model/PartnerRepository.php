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
use Variux\Warranty\Api\Data\PartnerInterface;
use Variux\Warranty\Api\Data\PartnerInterfaceFactory;
use Variux\Warranty\Api\Data\PartnerSearchResultsInterfaceFactory;
use Variux\Warranty\Api\PartnerRepositoryInterface;
use Variux\Warranty\Model\ResourceModel\Partner as ResourcePartner;
use Variux\Warranty\Model\ResourceModel\Partner\CollectionFactory as PartnerCollectionFactory;

class PartnerRepository implements PartnerRepositoryInterface
{

    /**
     * @var ResourcePartner
     */
    protected $resource;

    /**
     * @var Partner
     */
    protected $searchResultsFactory;

    /**
     * @var CollectionProcessorInterface
     */
    protected $collectionProcessor;

    /**
     * @var PartnerCollectionFactory
     */
    protected $partnerCollectionFactory;

    /**
     * @var PartnerInterfaceFactory
     */
    protected $partnerFactory;

    /**
     * @param ResourcePartner $resource
     * @param PartnerInterfaceFactory $partnerFactory
     * @param PartnerCollectionFactory $partnerCollectionFactory
     * @param PartnerSearchResultsInterfaceFactory $searchResultsFactory
     * @param CollectionProcessorInterface $collectionProcessor
     */
    public function __construct(
        ResourcePartner $resource,
        PartnerInterfaceFactory $partnerFactory,
        PartnerCollectionFactory $partnerCollectionFactory,
        PartnerSearchResultsInterfaceFactory $searchResultsFactory,
        CollectionProcessorInterface $collectionProcessor
    ) {
        $this->resource = $resource;
        $this->partnerFactory = $partnerFactory;
        $this->partnerCollectionFactory = $partnerCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->collectionProcessor = $collectionProcessor;
    }

    /**
     * @inheritDoc
     */
    public function save(PartnerInterface $partner)
    {
        try {
            $this->resource->save($partner);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__(
                'Could not save the partner: %1',
                $exception->getMessage()
            ));
        }
        return $partner;
    }

    /**
     * @inheritDoc
     */
    public function get($partnerId)
    {
        $partner = $this->partnerFactory->create();
        $this->resource->load($partner, $partnerId);
        if (!$partner->getId()) {
            throw new NoSuchEntityException(__('Partner with id "%1" does not exist.', $partnerId));
        }
        return $partner;
    }

    /**
     * @inheritDoc
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $criteria
    ) {
        $collection = $this->partnerCollectionFactory->create();

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
    public function delete(PartnerInterface $partner)
    {
        try {
            $partnerModel = $this->partnerFactory->create();
            $this->resource->load($partnerModel, $partner->getPartnerId());
            $this->resource->delete($partnerModel);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__(
                'Could not delete the Partner: %1',
                $exception->getMessage()
            ));
        }
        return true;
    }

    /**
     * @inheritDoc
     */
    public function deleteById($partnerId)
    {
        return $this->delete($this->get($partnerId));
    }
}
