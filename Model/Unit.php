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
    const STATUS_EXPIRED = "expired";
    const STATUS_REGISTERED = "registered";
    const STATUS_UNREGISTERED = "unregistered";
    protected $_eventPrefix = 'variux_unit';

    /**
     * @var ResourceModel\Unit
     */
    protected $_resource;

    /**
     * @param \Magento\Framework\Model\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param ResourceModel\Unit $resource
     * @param ResourceModel\Unit\Collection $resourceCollection
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        \Variux\Warranty\Model\ResourceModel\Unit $resource,
        \Variux\Warranty\Model\ResourceModel\Unit\Collection $resourceCollection,
        array $data = []
    ) {
        parent::__construct($context, $registry, $resource, $resourceCollection, $data);
        $this->_resource = $resource;
    }

    /**
     * @inheritDoc
     */
    public function _construct()
    {
        $this->_init(\Variux\Warranty\Model\ResourceModel\Unit::class);
    }

    /**
     * @Hidro-Le
     * @TODO - Fixed
     * Thiếu document
     */
    /**
     * @param $number
     * @param $conditionType
     * @return $this
     */
    public function loadBySerial($number, $conditionType = false)
    {
        $this->_resource->loadBySerial($this, $number, $conditionType = false);
        return $this;
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

    /**
     * @inheritDoc
     */
    public function getWarrantyEndDate()
    {
        return $this->getData(self::WARRANTY_END_DATE);
    }

    /**
     * @inheritDoc
     */
    public function setWarrantyEndDate($warrantyEndDate)
    {
        return $this->setData(self::WARRANTY_END_DATE, $warrantyEndDate);
    }

    /**
     * @inheritDoc
     */
    public function getHullId()
    {
        return $this->getData(self::HULL_ID);
    }

    /**
     * @inheritDoc
     */
    public function setHullId($hullId)
    {
        return $this->setData(self::HULL_ID, $hullId);
    }

    /**
     * @inheritDoc
     */
    public function getEngineHours()
    {
        return $this->getData(self::ENGINE_HOURS);
    }

    /**
     * @inheritDoc
     */
    public function setEngineHours($engineHours)
    {
        return $this->setData(self::ENGINE_HOURS, $engineHours);
    }

    /**
     * @inheritDoc
     */
    public function getConsumerNum()
    {
        return $this->getData(self::CONSUMER_NUM);
    }

    /**
     * @inheritDoc
     */
    public function setConsumerNum($consumerNum)
    {
        return $this->setData(self::CONSUMER_NUM, $consumerNum);
    }

    /**
     * @inheritDoc
     */
    public function getConsumerSeq()
    {
        return $this->getData(self::CONSUMER_SEQ);
    }

    /**
     * @inheritDoc
     */
    public function setConsumerSeq($consumerSeq)
    {
        return $this->setData(self::CONSUMER_SEQ, $consumerSeq);
    }

    /**
     * @inheritDoc
     */
    public function getUnitRegistable()
    {
        return $this->getData(self::UNIT_REGISTABLE);
    }

    /**
     * @inheritDoc
     */
    public function setUnitRegistable($unitRegistable)
    {
        return $this->setData(self::UNIT_REGISTABLE, $unitRegistable);
    }

    /**
     * @inheritDoc
     */
    public function getCompanyId()
    {
        return $this->getData(self::COMPANY_ID);
    }

    /**
     * @inheritDoc
     */
    public function setCompanyId($companyId)
    {
        return $this->setData(self::COMPANY_ID, $companyId);
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
