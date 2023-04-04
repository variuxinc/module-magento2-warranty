<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Variux\Warranty\Api\Data;

interface UnitInterface
{

    const ITEM = 'item';
    const DESCRIPTION = 'description';
    const INSTALL_DATE = 'install_date';
    const ORDER_NO = 'order_no';
    const WARRANTY_START_DATE = 'warranty_start_date';
    const WARRANTY_END_DATE = 'warranty_end_date';
    const UNIT_ID = 'unit_id';
    const SHIP_DATE = 'ship_date';
    const SERIAL_NO = 'serial_no';
    const CONSUMER_SEQ = 'consumer_seq';
    const HULL_ID = 'hull_id';
    const ENGINE_HOURS = 'engine_hours';
    const UNIT_REGISTABLE = 'unit_registable';
    const UPDATED_AT = 'updated_at';
    const CONSUMER_NUM = 'consumer_num';
    const CREATED_AT = 'created_at';
    const COMPANY_ID = 'company_id';

    /**
     * Get unit_id
     * @return string|null
     */
    public function getUnitId();

    /**
     * Set unit_id
     * @param string $unitId
     * @return \Variux\Warranty\Unit\Api\Data\UnitInterface
     */
    public function setUnitId($unitId);

    /**
     * Get serial_no
     * @return string|null
     */
    public function getSerialNo();

    /**
     * Set serial_no
     * @param string $serialNo
     * @return \Variux\Warranty\Unit\Api\Data\UnitInterface
     */
    public function setSerialNo($serialNo);

    /**
     * Get item
     * @return string|null
     */
    public function getItem();

    /**
     * Set item
     * @param string $item
     * @return \Variux\Warranty\Unit\Api\Data\UnitInterface
     */
    public function setItem($item);

    /**
     * Get description
     * @return string|null
     */
    public function getDescription();

    /**
     * Set description
     * @param string $description
     * @return \Variux\Warranty\Unit\Api\Data\UnitInterface
     */
    public function setDescription($description);

    /**
     * Get order_no
     * @return string|null
     */
    public function getOrderNo();

    /**
     * Set order_no
     * @param string $orderNo
     * @return \Variux\Warranty\Unit\Api\Data\UnitInterface
     */
    public function setOrderNo($orderNo);

    /**
     * Get ship_date
     * @return string|null
     */
    public function getShipDate();

    /**
     * Set ship_date
     * @param string $shipDate
     * @return \Variux\Warranty\Unit\Api\Data\UnitInterface
     */
    public function setShipDate($shipDate);

    /**
     * Get install_date
     * @return string|null
     */
    public function getInstallDate();

    /**
     * Set install_date
     * @param string $installDate
     * @return \Variux\Warranty\Unit\Api\Data\UnitInterface
     */
    public function setInstallDate($installDate);

    /**
     * Get warranty_start_date
     * @return string|null
     */
    public function getWarrantyStartDate();

    /**
     * Set warranty_start_date
     * @param string $warrantyStartDate
     * @return \Variux\Warranty\Unit\Api\Data\UnitInterface
     */
    public function setWarrantyStartDate($warrantyStartDate);

        /**
     * Get warranty_end_date
     * @return string|null
     */
    public function getWarrantyEndDate();

    /**
     * Set warranty_end_date
     * @param string $warrantyEndDate
     * @return \Variux\Warranty\Unit\Api\Data\UnitInterface
     */
    public function setWarrantyEndDate($warrantyEndDate);

    /**
     * Get hull_id
     * @return string|null
     */
    public function getHullId();

    /**
     * Set hull_id
     * @param string $hullId
     * @return \Variux\Warranty\Unit\Api\Data\UnitInterface
     */
    public function setHullId($hullId);

    /**
     * Get engine_hours
     * @return string|null
     */
    public function getEngineHours();

    /**
     * Set engine_hours
     * @param string $engineHours
     * @return \Variux\Warranty\Unit\Api\Data\UnitInterface
     */
    public function setEngineHours($engineHours);

    /**
     * Get consumer_num
     * @return string|null
     */
    public function getConsumerNum();

    /**
     * Set consumer_num
     * @param string $consumerNum
     * @return \Variux\Warranty\Unit\Api\Data\UnitInterface
     */
    public function setConsumerNum($consumerNum);

    /**
     * Get consumer_seq
     * @return string|null
     */
    public function getConsumerSeq();

    /**
     * Set consumer_seq
     * @param string $consumerSeq
     * @return \Variux\Warranty\Unit\Api\Data\UnitInterface
     */
    public function setConsumerSeq($consumerSeq);

    /**
     * Get unit_registable
     * @return string|null
     */
    public function getUnitRegistable();

    /**
     * Set unit_registable
     * @param string $unitRegistable
     * @return \Variux\Warranty\Unit\Api\Data\UnitInterface
     */
    public function setUnitRegistable($unitRegistable);

    /**
     * Get company_id
     * @return string|null
     */
    public function getCompanyId();

    /**
     * Set company_id
     * @param string $companyId
     * @return \Variux\Warranty\Unit\Api\Data\UnitInterface
     */
    public function setCompanyId($companyId);

    /**
     * Get created_at
     * @return string|null
     */
    public function getCreatedAt();

    /**
     * Set created_at
     * @param string $createdAt
     * @return \Variux\Warranty\Unit\Api\Data\UnitInterface
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
     * @return \Variux\Warranty\Unit\Api\Data\UnitInterface
     */
    public function setUpdatedAt($updatedAt);
}

