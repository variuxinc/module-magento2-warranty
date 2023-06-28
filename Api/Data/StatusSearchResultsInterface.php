<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Variux\Warranty\Api\Data;

interface StatusSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{

    /**
     * Get Status list.
     * @return \Variux\Warranty\Api\Data\StatusInterface[]
     */
    public function getItems();

    /**
     * Set code list.
     * @param \Variux\Warranty\Api\Data\StatusInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}
