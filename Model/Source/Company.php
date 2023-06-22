<?php

namespace Variux\Warranty\Model\Source;

use Magento\Company\Model\ResourceModel\Company\CollectionFactory;

class Company implements \Magento\Framework\Data\OptionSourceInterface
{
    /**
     * @var \Magento\Company\Model\ResourceModel\Company\Collection
     */
    protected $collection;

    /**
     * @param CollectionFactory $companyCollectionFactory
     */
    public function __construct(
        CollectionFactory $companyCollectionFactory
    ) {
        $this->collection = $companyCollectionFactory->create();
    }

    /**
     * Option Array
     *
     * @return array
     */
    public function toOptionArray()
    {
        $items = $this->collection->getItems();
        $options = [];
        foreach ($items as $company) {
            $options[] = [
                'label' => $company->getCompanyName(),
                'value' => $company->getId()
            ];
        }
        return $options;
    }
}
