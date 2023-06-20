<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Variux\Warranty\Api;

use Magento\Framework\Api\SearchCriteriaInterface;

interface UnitRepositoryInterface
{

    /**
     * Save Unit
     *
     * @param \Variux\Warranty\Api\Data\UnitInterface $unit
     * @return \Variux\Warranty\Api\Data\UnitInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(
        \Variux\Warranty\Api\Data\UnitInterface $unit
    );

    /**
     * Retrieve Unit
     *
     * @param string $unitId
     * @return \Variux\Warranty\Api\Data\UnitInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function get($unitId);

    /**
     * Retrieve Unit matching the specified criteria.
     *
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Variux\Warranty\Api\Data\UnitSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
    );

    /**
     * Delete Unit
     *
     * @param \Variux\Warranty\Api\Data\UnitInterface $unit
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(
        \Variux\Warranty\Api\Data\UnitInterface $unit
    );

    /**
     * Delete Unit by ID
     *
     * @param string $unitId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($unitId);
}
