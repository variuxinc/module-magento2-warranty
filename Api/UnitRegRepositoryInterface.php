<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Variux\Warranty\Api;

use Magento\Framework\Api\SearchCriteriaInterface;

interface UnitRegRepositoryInterface
{

    /**
     * Save UnitReg
     * @param \Variux\Warranty\Api\Data\UnitRegInterface $unitReg
     * @return \Variux\Warranty\Api\Data\UnitRegInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(
        \Variux\Warranty\Api\Data\UnitRegInterface $unitReg
    );

    /**
     * Retrieve UnitReg
     * @param string $unitregId
     * @return \Variux\Warranty\Api\Data\UnitRegInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function get($unitregId);

    /**
     * Retrieve UnitReg matching the specified criteria.
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Variux\Warranty\Api\Data\UnitRegSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
    );

    /**
     * Delete UnitReg
     * @param \Variux\Warranty\Api\Data\UnitRegInterface $unitReg
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(
        \Variux\Warranty\Api\Data\UnitRegInterface $unitReg
    );

    /**
     * Delete UnitReg by ID
     * @param string $unitregId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($unitregId);
}