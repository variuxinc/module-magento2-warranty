<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Variux\Warranty\Api\Data;

interface UnitRegSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{

    /**
     * Get UnitReg list.
     *
     * @return \Variux\Warranty\Api\Data\UnitRegInterface[]
     */
    public function getItems();

    /**
     * Set hull_id list.
     *
     * @param \Variux\Warranty\Api\Data\UnitRegInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}
