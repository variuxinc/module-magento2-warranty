<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Variux\Warranty\Api\Data;

interface SroMiscSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{

    /**
     * Get SroMisc list.
     *
     * @return \Variux\Warranty\Api\Data\SroMiscInterface[]
     */
    public function getItems();

    /**
     * Set sro_id list.
     *
     * @param \Variux\Warranty\Api\Data\SroMiscInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}
