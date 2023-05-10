<?php

namespace Variux\Warranty\Model\Source;

use Magento\Company\Model\ResourceModel\Company\CollectionFactory;

class Company implements \Magento\Framework\Data\OptionSourceInterface
{
    /**
     * @var Collection
     */
    protected $collection;

    public function __construct(
        CollectionFactory $companyCollectionFactory
    ) {
        $this->collection = $companyCollectionFactory->create();
    }


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
