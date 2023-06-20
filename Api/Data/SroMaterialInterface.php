<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Variux\Warranty\Api\Data;

interface SroMaterialInterface
{
    public const ITEM_ID = 'item_id';
    public const CUSTOMER_ID = 'customer_id';
    public const ITEM = 'item';
    public const COST = 'cost';
    public const SRO_ID = 'sro_id';
    public const DESCRIPTION = 'description';
    public const SRO_LINE = 'sro_line';
    public const PRICE = 'price';
    public const SRO_OPER = 'sro_oper';
    public const QTY_CONV = 'qty_conv';
    public const COMPANY_ID = 'company_id';
    public const TRANS_DATE = 'trans_date';
    public const NOTE = 'note';

    /**
     * Get sro_id
     *
     * @return string|null
     */
    public function getSroId();

    /**
     * Set sro_id
     *
     * @param string $sroId
     * @return \Variux\Warranty\SroMaterial\Api\Data\SroMaterialInterface
     */
    public function setSroId($sroId);

    /**
     * Get sro_line
     *
     * @return string|null
     */
    public function getSroLine();

    /**
     * Set sro_line
     *
     * @param string $sroLine
     * @return \Variux\Warranty\SroMaterial\Api\Data\SroMaterialInterface
     */
    public function setSroLine($sroLine);

    /**
     * Get sro_oper
     *
     * @return string|null
     */
    public function getSroOper();

    /**
     * Set sro_oper
     *
     * @param string $sroOper
     * @return \Variux\Warranty\SroMaterial\Api\Data\SroMaterialInterface
     */
    public function setSroOper($sroOper);

    /**
     * Get company_id
     *
     * @return string|null
     */
    public function getCompanyId();

    /**
     * Set company_id
     *
     * @param string $companyId
     * @return \Variux\Warranty\SroMaterial\Api\Data\SroMaterialInterface
     */
    public function setCompanyId($companyId);

    /**
     * Get customer_id
     *
     * @return string|null
     */
    public function getCustomerId();

    /**
     * Set customer_id
     *
     * @param string $customerId
     * @return \Variux\Warranty\SroMaterial\Api\Data\SroMaterialInterface
     */
    public function setCustomerId($customerId);

    /**
     * Get item
     *
     * @return string|null
     */
    public function getItem();

    /**
     * Set item
     *
     * @param string $item
     * @return \Variux\Warranty\SroMaterial\Api\Data\SroMaterialInterface
     */
    public function setItem($item);

    /**
     * Get description
     *
     * @return string|null
     */
    public function getDescription();

    /**
     * Set description
     *
     * @param string $description
     * @return \Variux\Warranty\SroMaterial\Api\Data\SroMaterialInterface
     */
    public function setDescription($description);

    /**
     * Get qty_conv
     *
     * @return string|null
     */
    public function getQtyConv();

    /**
     * Set qty_conv
     *
     * @param string $qtyConv
     * @return \Variux\Warranty\SroMaterial\Api\Data\SroMaterialInterface
     */
    public function setQtyConv($qtyConv);

    /**
     * Get cost
     *
     * @return string|null
     */
    public function getCost();

    /**
     * Set cost
     *
     * @param string $cost
     * @return \Variux\Warranty\SroMaterial\Api\Data\SroMaterialInterface
     */
    public function setCost($cost);

    /**
     * Get price
     *
     * @return string|null
     */
    public function getPrice();

    /**
     * Set price
     *
     * @param string $price
     * @return \Variux\Warranty\SroMaterial\Api\Data\SroMaterialInterface
     */
    public function setPrice($price);

    /**
     * Get price
     *
     * @return string|null
     */
    public function getTransDate();

    /**
     * Set price
     *
     * @param string $transDate
     * @return \Variux\Warranty\SroMaterial\Api\Data\SroMaterialInterface
     */
    public function setTransDate($transDate);

    /**
     * Get price
     *
     * @return string|null
     */
    public function getNote();

    /**
     * Set price
     *
     * @param string $note
     * @return \Variux\Warranty\SroMaterial\Api\Data\SroMaterialInterface
     */
    public function setNote($note);
}
