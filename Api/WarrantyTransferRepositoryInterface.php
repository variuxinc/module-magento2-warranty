<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Variux\Warranty\Api;

use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\LocalizedException;
use Variux\Warranty\Api\Data\WarrantyTransferInterface;

interface WarrantyTransferRepositoryInterface
{

    /**
     * Save WarrantyTransfer
     * @param WarrantyTransferInterface $warrantyTransfer
     * @return WarrantyTransferInterface
     * @throws LocalizedException
     */
    public function save(
        WarrantyTransferInterface $warrantyTransfer
    ): WarrantyTransferInterface;

    /**
     * Retrieve WarrantyTransfer
     * @param string $warrantytransferId
     * @return WarrantyTransferInterface
     * @throws LocalizedException
     */
    public function get($warrantytransferId);

    /**
     * Retrieve WarrantyTransfer matching the specified criteria.
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Variux\Warranty\Api\Data\WarrantyTransferSearchResultsInterface
     * @throws LocalizedException
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
    );

    /**
     * Delete WarrantyTransfer
     * @param WarrantyTransferInterface $warrantyTransfer
     * @return bool true on success
     * @throws LocalizedException
     */
    public function delete(
        WarrantyTransferInterface $warrantyTransfer
    );

    /**
     * Delete WarrantyTransfer by ID
     * @param string $warrantytransferId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws LocalizedException
     */
    public function deleteById($warrantytransferId);
}
