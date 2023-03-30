<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Variux\Warranty\Api\Data;

interface WarrantyTransferSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{

    /**
     * Get WarrantyTransfer list.
     * @return \Variux\Warranty\Api\Data\WarrantyTransferInterface[]
     */
    public function getItems();

    /**
     * Set engine_serial_num list.
     * @param \Variux\Warranty\Api\Data\WarrantyTransferInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}