<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Variux\Warranty\Api;

use Magento\Framework\Api\SearchCriteriaInterface;

interface PartnerRepositoryInterface
{

    /**
     * Save Partner
     * @param \Variux\Warranty\Api\Data\PartnerInterface $partner
     * @return \Variux\Warranty\Api\Data\PartnerInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(
        \Variux\Warranty\Api\Data\PartnerInterface $partner
    );

    /**
     * Retrieve Partner
     * @param string $partnerId
     * @return \Variux\Warranty\Api\Data\PartnerInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function get($partnerId);

    /**
     * Retrieve Partner matching the specified criteria.
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Variux\Warranty\Api\Data\PartnerSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
    );

    /**
     * Delete Partner
     * @param \Variux\Warranty\Api\Data\PartnerInterface $partner
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(
        \Variux\Warranty\Api\Data\PartnerInterface $partner
    );

    /**
     * Delete Partner by ID
     * @param string $partnerId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($partnerId);
}
