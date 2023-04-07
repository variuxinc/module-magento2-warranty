<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Variux\Warranty\Api\Data;

interface WorkcodeInterface
{

    const WORKCODE_ID = 'workcode_id';
    const WORK_CODE = 'work_code';
    const UPDATED_AT = 'updated_at';
    const DESCRIPTION = 'description';
    const DURATION = 'duration';
    const CREATED_AT = 'created_at';

    /**
     * Get workcode_id
     * @return string|null
     */
    public function getWorkcodeId();

    /**
     * Set workcode_id
     * @param string $workcodeId
     * @return \Variux\Warranty\Workcode\Api\Data\WorkcodeInterface
     */
    public function setWorkcodeId($workcodeId);

    /**
     * Get work_code
     * @return string|null
     */
    public function getWorkCode();

    /**
     * Set work_code
     * @param string $workCode
     * @return \Variux\Warranty\Workcode\Api\Data\WorkcodeInterface
     */
    public function setWorkCode($workCode);

    /**
     * Get description
     * @return string|null
     */
    public function getDescription();

    /**
     * Set description
     * @param string $description
     * @return \Variux\Warranty\Workcode\Api\Data\WorkcodeInterface
     */
    public function setDescription($description);

    /**
     * Get duration
     * @return string|null
     */
    public function getDuration();

    /**
     * Set duration
     * @param string $duration
     * @return \Variux\Warranty\Workcode\Api\Data\WorkcodeInterface
     */
    public function setDuration($duration);

    /**
     * Get created_at
     * @return string|null
     */
    public function getCreatedAt();

    /**
     * Set created_at
     * @param string $createdAt
     * @return \Variux\Warranty\Workcode\Api\Data\WorkcodeInterface
     */
    public function setCreatedAt($createdAt);

    /**
     * Get updated_at
     * @return string|null
     */
    public function getUpdatedAt();

    /**
     * Set updated_at
     * @param string $updatedAt
     * @return \Variux\Warranty\Workcode\Api\Data\WorkcodeInterface
     */
    public function setUpdatedAt($updatedAt);
}
