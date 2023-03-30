<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Variux\Warranty\Api\Data;

interface WorkcodeSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{

    /**
     * Get Workcode list.
     * @return \Variux\Warranty\Api\Data\WorkcodeInterface[]
     */
    public function getItems();

    /**
     * Set work_code list.
     * @param \Variux\Warranty\Api\Data\WorkcodeInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}

