<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Variux\Warranty\Api\Data;

interface SroSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{

    /**
     * Get Sro list.
     * @return \Variux\Warranty\Api\Data\SroInterface[]
     */
    public function getItems();

    /**
     * Set warranty_id list.
     * @param \Variux\Warranty\Api\Data\SroInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}

