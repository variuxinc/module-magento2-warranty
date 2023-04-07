<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Variux\Warranty\Api\Data;

interface WarrantySearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{

    /**
     * Get Warranty list.
     * @return \Variux\Warranty\Api\Data\WarrantyInterface[]
     */
    public function getItems();

    /**
     * Set description list.
     * @param \Variux\Warranty\Api\Data\WarrantyInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}
