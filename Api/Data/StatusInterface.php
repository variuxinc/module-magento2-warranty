<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Variux\Warranty\Api\Data;

interface StatusInterface
{

    const CODE = 'code';
    const STATUS_ID = 'status_id';
    const NAME = 'name';

    /**
     * Get status_id
     * @return string|null
     */
    public function getStatusId();

    /**
     * Set status_id
     * @param string $statusId
     * @return \Variux\Warranty\Status\Api\Data\StatusInterface
     */
    public function setStatusId($statusId);

    /**
     * Get code
     * @return string|null
     */
    public function getCode();

    /**
     * Set code
     * @param string $code
     * @return \Variux\Warranty\Status\Api\Data\StatusInterface
     */
    public function setCode($code);

    /**
     * Get name
     * @return string|null
     */
    public function getName();

    /**
     * Set name
     * @param string $name
     * @return \Variux\Warranty\Status\Api\Data\StatusInterface
     */
    public function setName($name);
}
