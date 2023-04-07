<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Variux\Warranty\Api\Data;

interface SroMaterialSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{

    /**
     * Get SroMaterial list.
     * @return \Variux\Warranty\Api\Data\SroMaterialInterface[]
     */
    public function getItems();

    /**
     * Set sro_id list.
     * @param \Variux\Warranty\Api\Data\SroMaterialInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}
