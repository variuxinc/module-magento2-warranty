<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Variux\Warranty\Api;

use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\LocalizedException;
use Variux\Warranty\Api\Data\WorkcodeInterface;
use Variux\Warranty\Api\Data\WorkcodeSearchResultsInterface;

interface WorkcodeRepositoryInterface
{

    /**
     * Save Workcode
     * @param WorkcodeInterface $workcode
     * @return WorkcodeInterface
     * @throws LocalizedException
     */
    public function save(
        WorkcodeInterface $workcode
    );

    /**
     * Retrieve Workcode
     * @param $workcodeId
     * @return WorkcodeInterface
     * @throws LocalizedException
     */
    public function get($workcodeId): WorkcodeInterface;

    /**
     * Retrieve Workcode matching the specified criteria.
     * @param SearchCriteriaInterface $searchCriteria
     * @return WorkcodeSearchResultsInterface
     * @throws LocalizedException
     */
    public function getList(
        SearchCriteriaInterface $searchCriteria
    ): WorkcodeSearchResultsInterface;

    /**
     * Delete Workcode
     * @param WorkcodeInterface $workcode
     * @return bool true on success
     * @throws LocalizedException
     */
    public function delete(
        WorkcodeInterface $workcode
    );

    /**
     * Delete Workcode by ID
     * @param string $workcodeId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws LocalizedException
     */
    public function deleteById($workcodeId);
}
