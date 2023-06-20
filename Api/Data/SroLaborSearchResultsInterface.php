<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Variux\Warranty\Api\Data;

interface SroLaborSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{

    /**
     * Get SroLabor list.
     *
     * @return \Variux\Warranty\Api\Data\SroLaborInterface[]
     */
    public function getItems();

    /**
     * Set sro_id list.
     *
     * @param \Variux\Warranty\Api\Data\SroLaborInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}
