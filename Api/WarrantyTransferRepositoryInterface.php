<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Variux\Warranty\Api;

use Magento\Framework\Api\SearchCriteriaInterface;

interface WarrantyTransferRepositoryInterface
{

    /**
     * Save WarrantyTransfer
     * @param \Variux\Warranty\Api\Data\WarrantyTransferInterface $warrantyTransfer
     * @return \Variux\Warranty\Api\Data\WarrantyTransferInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(
        \Variux\Warranty\Api\Data\WarrantyTransferInterface $warrantyTransfer
    );

    /**
     * Retrieve WarrantyTransfer
     * @param string $warrantytransferId
     * @return \Variux\Warranty\Api\Data\WarrantyTransferInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function get($warrantytransferId);

    /**
     * Retrieve WarrantyTransfer matching the specified criteria.
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Variux\Warranty\Api\Data\WarrantyTransferSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
    );

    /**
     * Delete WarrantyTransfer
     * @param \Variux\Warranty\Api\Data\WarrantyTransferInterface $warrantyTransfer
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(
        \Variux\Warranty\Api\Data\WarrantyTransferInterface $warrantyTransfer
    );

    /**
     * Delete WarrantyTransfer by ID
     * @param string $warrantytransferId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($warrantytransferId);
}
