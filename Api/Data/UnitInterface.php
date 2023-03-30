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
    const DESCTIPTION = 'desctiption';
    const INSTALL_DATE = 'install_date';
    const ORDER_NO = 'order_no';
    const WARRANTY_START_DATE = 'warranty_start_date';
    const UNIT_ID = 'unit_id';
    const SHIP_DATE = 'ship_date';
    const SERIAL_NO = 'serial_no';

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
     * Get desctiption
     * @return string|null
     */
    public function getDesctiption();

    /**
     * Set desctiption
     * @param string $desctiption
     * @return \Variux\Warranty\Unit\Api\Data\UnitInterface
     */
    public function setDesctiption($desctiption);

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
}

