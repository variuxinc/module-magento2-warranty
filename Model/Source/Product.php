<?php

namespace Variux\Warranty\Model\Source;

use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory;

class Product implements \Magento\Framework\Data\OptionSourceInterface
{
    /**
     * @var Collection
     */
    protected $collection;

    public function __construct(
        CollectionFactory $productCollectionFactory
    ) {
        $this->collection = $productCollectionFactory->create();
    }

    public function toOptionArray()
    {
        $items = $this->collection->getItems();
        $options = [];
        foreach ($items as $product) {
            $options[] = [
                'label' => $product->getSku(),
                'value' => $product->getSku()
            ];
        }
        return $options;
    }
}
