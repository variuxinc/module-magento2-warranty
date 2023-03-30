<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Variux\Warranty\Api;

use Magento\Framework\Api\SearchCriteriaInterface;

interface SroMiscRepositoryInterface
{

    /**
     * Save SroMisc
     * @param \Variux\Warranty\Api\Data\SroMiscInterface $sroMisc
     * @return \Variux\Warranty\Api\Data\SroMiscInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(
        \Variux\Warranty\Api\Data\SroMiscInterface $sroMisc
    );

    /**
     * Retrieve SroMisc
     * @param string $sromiscId
     * @return \Variux\Warranty\Api\Data\SroMiscInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function get($sromiscId);

    /**
     * Retrieve SroMisc matching the specified criteria.
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Variux\Warranty\Api\Data\SroMiscSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
    );

    /**
     * Delete SroMisc
     * @param \Variux\Warranty\Api\Data\SroMiscInterface $sroMisc
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(
        \Variux\Warranty\Api\Data\SroMiscInterface $sroMisc
    );

    /**
     * Delete SroMisc by ID
     * @param string $sromiscId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($sromiscId);
}

