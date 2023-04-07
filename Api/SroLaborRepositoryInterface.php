<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Variux\Warranty\Api;

use Magento\Framework\Api\SearchCriteriaInterface;

interface SroLaborRepositoryInterface
{

    /**
     * Save SroLabor
     * @param \Variux\Warranty\Api\Data\SroLaborInterface $sroLabor
     * @return \Variux\Warranty\Api\Data\SroLaborInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(
        \Variux\Warranty\Api\Data\SroLaborInterface $sroLabor
    );

    /**
     * Retrieve SroLabor
     * @param string $srolaborId
     * @return \Variux\Warranty\Api\Data\SroLaborInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function get($srolaborId);

    /**
     * Retrieve SroLabor matching the specified criteria.
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Variux\Warranty\Api\Data\SroLaborSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
    );

    /**
     * Delete SroLabor
     * @param \Variux\Warranty\Api\Data\SroLaborInterface $sroLabor
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(
        \Variux\Warranty\Api\Data\SroLaborInterface $sroLabor
    );

    /**
     * Delete SroLabor by ID
     * @param string $srolaborId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($srolaborId);
}
