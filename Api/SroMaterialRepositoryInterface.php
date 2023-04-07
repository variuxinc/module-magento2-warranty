<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Variux\Warranty\Api;

use Magento\Framework\Api\SearchCriteriaInterface;

interface SroMaterialRepositoryInterface
{

    /**
     * Save SroMaterial
     * @param \Variux\Warranty\Api\Data\SroMaterialInterface $sroMaterial
     * @return \Variux\Warranty\Api\Data\SroMaterialInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(
        \Variux\Warranty\Api\Data\SroMaterialInterface $sroMaterial
    );

    /**
     * Retrieve SroMaterial
     * @param string $sromaterialId
     * @return \Variux\Warranty\Api\Data\SroMaterialInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function get($sromaterialId);

    /**
     * Retrieve SroMaterial matching the specified criteria.
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Variux\Warranty\Api\Data\SroMaterialSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
    );

    /**
     * Delete SroMaterial
     * @param \Variux\Warranty\Api\Data\SroMaterialInterface $sroMaterial
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(
        \Variux\Warranty\Api\Data\SroMaterialInterface $sroMaterial
    );

    /**
     * Delete SroMaterial by ID
     * @param string $sromaterialId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($sromaterialId);
}
