<?php

namespace Variux\Warranty\Model\Source;

use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory;

class Product implements \Magento\Framework\Data\OptionSourceInterface
{
    /**
     * @var \Magento\Catalog\Model\ResourceModel\Product\Collection
     */
    protected $collection;

    /**
     * @param CollectionFactory $productCollectionFactory
     */
    public function __construct(
        CollectionFactory $productCollectionFactory
    ) {
        $this->collection = $productCollectionFactory->create();
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
        foreach ($items as $product) {
            $options[] = [
                'label' => $product->getSku(),
                'value' => $product->getSku()
            ];
        }
        return $options;
    }
}
