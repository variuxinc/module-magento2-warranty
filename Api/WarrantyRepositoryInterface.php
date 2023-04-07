<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Variux\Warranty\Api;

use Magento\Framework\Api\SearchCriteriaInterface;

interface WarrantyRepositoryInterface
{

    /**
     * Save Warranty
     * @param \Variux\Warranty\Api\Data\WarrantyInterface $warranty
     * @return \Variux\Warranty\Api\Data\WarrantyInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(
        \Variux\Warranty\Api\Data\WarrantyInterface $warranty
    );

    /**
     * Retrieve Warranty
     * @param string $warrantyId
     * @return \Variux\Warranty\Api\Data\WarrantyInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function get($warrantyId);

    /**
     * Retrieve Warranty matching the specified criteria.
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Variux\Warranty\Api\Data\WarrantySearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
    );

    /**
     * Delete Warranty
     * @param \Variux\Warranty\Api\Data\WarrantyInterface $warranty
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(
        \Variux\Warranty\Api\Data\WarrantyInterface $warranty
    );

    /**
     * Delete Warranty by ID
     * @param string $warrantyId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($warrantyId);
}
