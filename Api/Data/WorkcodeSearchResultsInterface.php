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
     * Get WorkCode list.
     *
     * @return WorkcodeInterface[]
     */
    public function getItems(): array;

    /**
     * Set work_code list.
     *
     * @param WorkcodeInterface[] $items
     * @return $this
     */
    public function setItems(array $items): WorkcodeSearchResultsInterface;
}
