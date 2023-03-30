<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Variux\Warranty\Model;

use Magento\Framework\Model\AbstractModel;
use Variux\Warranty\Api\Data\UnitInterface;

class Unit extends AbstractModel implements UnitInterface
{

    /**
     * @inheritDoc
     */
    public function _construct()
    {
        $this->_init(\Variux\Warranty\Model\ResourceModel\Unit::class);
    }

    /**
     * @inheritDoc
     */
    public function getUnitId()
    {
        return $this->getData(self::UNIT_ID);
    }

    /**
     * @inheritDoc
     */
    public function setUnitId($unitId)
    {
        return $this->setData(self::UNIT_ID, $unitId);
    }

    /**
     * @inheritDoc
     */
    public function getSerialNo()
    {
        return $this->getData(self::SERIAL_NO);
    }

    /**
     * @inheritDoc
     */
    public function setSerialNo($serialNo)
    {
        return $this->setData(self::SERIAL_NO, $serialNo);
    }

    /**
     * @inheritDoc
     */
    public function getItem()
    {
        return $this->getData(self::ITEM);
    }

    /**
     * @inheritDoc
     */
    public function setItem($item)
    {
        return $this->setData(self::ITEM, $item);
    }

    /**
     * @inheritDoc
     */
    public function getDesctiption()
    {
        return $this->getData(self::DESCTIPTION);
    }

    /**
     * @inheritDoc
     */
    public function setDesctiption($desctiption)
    {
        return $this->setData(self::DESCTIPTION, $desctiption);
    }

    /**
     * @inheritDoc
     */
    public function getOrderNo()
    {
        return $this->getData(self::ORDER_NO);
    }

    /**
     * @inheritDoc
     */
    public function setOrderNo($orderNo)
    {
        return $this->setData(self::ORDER_NO, $orderNo);
    }

    /**
     * @inheritDoc
     */
    public function getShipDate()
    {
        return $this->getData(self::SHIP_DATE);
    }

    /**
     * @inheritDoc
     */
    public function setShipDate($shipDate)
    {
        return $this->setData(self::SHIP_DATE, $shipDate);
    }

    /**
     * @inheritDoc
     */
    public function getInstallDate()
    {
        return $this->getData(self::INSTALL_DATE);
    }

    /**
     * @inheritDoc
     */
    public function setInstallDate($installDate)
    {
        return $this->setData(self::INSTALL_DATE, $installDate);
    }

    /**
     * @inheritDoc
     */
    public function getWarrantyStartDate()
    {
        return $this->getData(self::WARRANTY_START_DATE);
    }

    /**
     * @inheritDoc
     */
    public function setWarrantyStartDate($warrantyStartDate)
    {
        return $this->setData(self::WARRANTY_START_DATE, $warrantyStartDate);
    }
}

