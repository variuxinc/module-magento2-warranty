<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Variux\Warranty\Api\Data;

interface PartnerSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{

    /**
     * Get Partner list.
     * @return \Variux\Warranty\Api\Data\PartnerInterface[]
     */
    public function getItems();

    /**
     * Set partner_num list.
     * @param \Variux\Warranty\Api\Data\PartnerInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}