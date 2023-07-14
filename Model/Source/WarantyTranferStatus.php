<?php

namespace Variux\Warranty\Model\Source;

class WarantyTranferStatus implements \Magento\Framework\Option\ArrayInterface
{

    /**
     * Options getter
     *
     * @return array
     */
    public function toOptionArray()
    {
        return [
            ['value' => 0, 'label' => __('Waiting for approval')],
            ['value' => 1, 'label' => __('Approved')],
            ['value' => 2, 'label' => __('Rejected')]
        ];
    }

    /**
     * Get options in "key-value" format
     *
     * @return array
     */
    public function toArray()
    {
        return [0 => __('Waiting for approval'), 1 => __('Approved'), 2 => __('Rejected')];
    }


}
