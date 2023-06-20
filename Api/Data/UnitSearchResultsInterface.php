<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Variux\Warranty\Api\Data;

interface UnitSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{

    /**
     * Get Unit list.
     *
     * @return \Variux\Warranty\Api\Data\UnitInterface[]
     */
    public function getItems();

    /**
     * Set serial_no list.
     *
     * @param \Variux\Warranty\Api\Data\UnitInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}
