<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Variux\Warranty\Model;

use Magento\Framework\Model\AbstractModel;
use Variux\Warranty\Api\Data\WorkcodeInterface;

class Workcode extends AbstractModel implements WorkcodeInterface
{
    protected $_eventPrefix = 'variux_workcode';

    /**
     * @inheritDoc
     */
    public function _construct()
    {
        $this->_init(\Variux\Warranty\Model\ResourceModel\Workcode::class);
    }

    /**
     * @inheritDoc
     */
    public function getWorkcodeId()
    {
        return $this->getData(self::WORKCODE_ID);
    }

    /**
     * @inheritDoc
     */
    public function setWorkcodeId($workcodeId)
    {
        return $this->setData(self::WORKCODE_ID, $workcodeId);
    }

    /**
     * @inheritDoc
     */
    public function getWorkCode()
    {
        return $this->getData(self::WORK_CODE);
    }

    /**
     * @inheritDoc
     */
    public function setWorkCode($workCode)
    {
        return $this->setData(self::WORK_CODE, $workCode);
    }

    /**
     * @inheritDoc
     */
    public function getDescription()
    {
        return $this->getData(self::DESCRIPTION);
    }

    /**
     * @inheritDoc
     */
    public function setDescription($description)
    {
        return $this->setData(self::DESCRIPTION, $description);
    }

    /**
     * @inheritDoc
     */
    public function getDuration()
    {
        return $this->getData(self::DURATION);
    }

    /**
     * @inheritDoc
     */
    public function setDuration($duration)
    {
        return $this->setData(self::DURATION, $duration);
    }

    /**
     * @inheritDoc
     */
    public function getCreatedAt()
    {
        return $this->getData(self::CREATED_AT);
    }

    /**
     * @inheritDoc
     */
    public function setCreatedAt($createdAt)
    {
        return $this->setData(self::CREATED_AT, $createdAt);
    }

    /**
     * @inheritDoc
     */
    public function getUpdatedAt()
    {
        return $this->getData(self::UPDATED_AT);
    }

    /**
     * @inheritDoc
     */
    public function setUpdatedAt($updatedAt)
    {
        return $this->setData(self::UPDATED_AT, $updatedAt);
    }
}
