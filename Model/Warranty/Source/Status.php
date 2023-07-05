<?php

namespace Variux\Warranty\Model\Warranty\Source;

use Variux\Warranty\Model\ResourceModel\Status\CollectionFactory;

class Status implements \Magento\Framework\Option\ArrayInterface
{

    /**
     * @var CollectionFactory
     */
    protected $statusCollectionFactory;

    /**
     * @param CollectionFactory $statusCollectionFactory
     */
    public function __construct(CollectionFactory $statusCollectionFactory)
    {
        $this->statusCollectionFactory = $statusCollectionFactory;
    }

    /**
     * @return array[]
     */
    public function toOptionArray(): array
    {
        return $this->getStatusArray();
    }

    /**
     * @return \Variux\Warranty\Model\ResourceModel\Status\Collection
     */
    private function getStatusCollection()
    {
        return $this->statusCollectionFactory->create()
                              ->addFieldToSelect("*");
    }

    /**
     * @return array[]
     */
    private function getStatusArray(): array
    {
        $statusArr = [];
        $statuses = $this->getStatusCollection();
        foreach ($statuses as $status) {
            $statusArr[] = ['value' => $status->getCode(), 'label' => $status->getName()];
        }
        return $statusArr;
    }
}
