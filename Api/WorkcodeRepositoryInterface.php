<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Variux\Warranty\Api;

use Magento\Framework\Api\SearchCriteriaInterface;

interface WorkcodeRepositoryInterface
{

    /**
     * Save Workcode
     * @param \Variux\Warranty\Api\Data\WorkcodeInterface $workcode
     * @return \Variux\Warranty\Api\Data\WorkcodeInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(
        \Variux\Warranty\Api\Data\WorkcodeInterface $workcode
    );

    /**
     * Retrieve Workcode
     * @param string $workcodeId
     * @return \Variux\Warranty\Api\Data\WorkcodeInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function get($workcodeId);

    /**
     * Retrieve Workcode matching the specified criteria.
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Variux\Warranty\Api\Data\WorkcodeSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
    );

    /**
     * Delete Workcode
     * @param \Variux\Warranty\Api\Data\WorkcodeInterface $workcode
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(
        \Variux\Warranty\Api\Data\WorkcodeInterface $workcode
    );

    /**
     * Delete Workcode by ID
     * @param string $workcodeId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($workcodeId);
}

