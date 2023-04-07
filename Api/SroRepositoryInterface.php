<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Variux\Warranty\Api;

use Magento\Framework\Api\SearchCriteriaInterface;

interface SroRepositoryInterface
{

    /**
     * Save Sro
     * @param \Variux\Warranty\Api\Data\SroInterface $sro
     * @return \Variux\Warranty\Api\Data\SroInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(
        \Variux\Warranty\Api\Data\SroInterface $sro
    );

    /**
     * Retrieve Sro
     * @param string $sroId
     * @return \Variux\Warranty\Api\Data\SroInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function get($sroId);

    /**
     * Retrieve Sro matching the specified criteria.
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Variux\Warranty\Api\Data\SroSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
    );

    /**
     * Delete Sro
     * @param \Variux\Warranty\Api\Data\SroInterface $sro
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(
        \Variux\Warranty\Api\Data\SroInterface $sro
    );

    /**
     * Delete Sro by ID
     * @param string $sroId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($sroId);
}
