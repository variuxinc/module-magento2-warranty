<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Variux\Warranty\Api\Data;

interface SroMaterialInterface
{

    const CUSTOMER_ID = 'customer_id';
    const ITEM = 'item';
    const UM = 'um';
    const COST = 'cost';
    const SRO_ID = 'sro_id';
    const DESCRIPTION = 'description';
    const SRO_LINE = 'sro_line';
    const PRICE = 'price';
    const SROMATERIAL_ID = 'sromaterial_id';
    const SRO_OPER = 'sro_oper';
    const QTY_CONV = 'qty_conv';
    const COMPANY_ID = 'company_id';

    /**
     * Get sromaterial_id
     * @return string|null
     */
    public function getSromaterialId();

    /**
     * Set sromaterial_id
     * @param string $sromaterialId
     * @return \Variux\Warranty\SroMaterial\Api\Data\SroMaterialInterface
     */
    public function setSromaterialId($sromaterialId);

    /**
     * Get sro_id
     * @return string|null
     */
    public function getSroId();

    /**
     * Set sro_id
     * @param string $sroId
     * @return \Variux\Warranty\SroMaterial\Api\Data\SroMaterialInterface
     */
    public function setSroId($sroId);

    /**
     * Get sro_line
     * @return string|null
     */
    public function getSroLine();

    /**
     * Set sro_line
     * @param string $sroLine
     * @return \Variux\Warranty\SroMaterial\Api\Data\SroMaterialInterface
     */
    public function setSroLine($sroLine);

    /**
     * Get sro_oper
     * @return string|null
     */
    public function getSroOper();

    /**
     * Set sro_oper
     * @param string $sroOper
     * @return \Variux\Warranty\SroMaterial\Api\Data\SroMaterialInterface
     */
    public function setSroOper($sroOper);

    /**
     * Get company_id
     * @return string|null
     */
    public function getCompanyId();

    /**
     * Set company_id
     * @param string $companyId
     * @return \Variux\Warranty\SroMaterial\Api\Data\SroMaterialInterface
     */
    public function setCompanyId($companyId);

    /**
     * Get customer_id
     * @return string|null
     */
    public function getCustomerId();

    /**
     * Set customer_id
     * @param string $customerId
     * @return \Variux\Warranty\SroMaterial\Api\Data\SroMaterialInterface
     */
    public function setCustomerId($customerId);

    /**
     * Get item
     * @return string|null
     */
    public function getItem();

    /**
     * Set item
     * @param string $item
     * @return \Variux\Warranty\SroMaterial\Api\Data\SroMaterialInterface
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
     * @return \Variux\Warranty\SroMaterial\Api\Data\SroMaterialInterface
     */
    public function setDescription($description);

    /**
     * Get um
     * @return string|null
     */
    public function getUm();

    /**
     * Set um
     * @param string $um
     * @return \Variux\Warranty\SroMaterial\Api\Data\SroMaterialInterface
     */
    public function setUm($um);

    /**
     * Get qty_conv
     * @return string|null
     */
    public function getQtyConv();

    /**
     * Set qty_conv
     * @param string $qtyConv
     * @return \Variux\Warranty\SroMaterial\Api\Data\SroMaterialInterface
     */
    public function setQtyConv($qtyConv);

    /**
     * Get cost
     * @return string|null
     */
    public function getCost();

    /**
     * Set cost
     * @param string $cost
     * @return \Variux\Warranty\SroMaterial\Api\Data\SroMaterialInterface
     */
    public function setCost($cost);

    /**
     * Get price
     * @return string|null
     */
    public function getPrice();

    /**
     * Set price
     * @param string $price
     * @return \Variux\Warranty\SroMaterial\Api\Data\SroMaterialInterface
     */
    public function setPrice($price);
}

