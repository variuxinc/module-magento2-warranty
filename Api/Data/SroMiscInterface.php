<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Variux\Warranty\Api\Data;

interface SroMiscInterface
{
    public const ITEM_ID = 'item_id';
    public const AMOUNT = 'amount';
    public const CUSTOMER_ID = 'customer_id';
    public const COMPANY_ID = 'company_id';
    public const SRO_ID = 'sro_id';
    public const UPDATED_AT = 'updated_at';
    public const DESCRIPTION = 'description';
    public const SRO_LINE = 'sro_line';
    public const NOTE = 'note';
    public const TYPE = 'type';
    public const PARTNER_ID = 'partner_id';
    public const PARTNER_NUM = 'partner_num';
    public const MISC_CODE = 'misc_code';
    public const CREATED_AT = 'created_at';
    public const SRO_OPER = 'sro_oper';
    public const QTY_CONV = 'qty_conv';
    public const TRANS_DATE = 'trans_date';

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
     * @return \Variux\Warranty\SroMisc\Api\Data\SroMiscInterface
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
     * @return \Variux\Warranty\SroMisc\Api\Data\SroMiscInterface
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
     * @return \Variux\Warranty\SroMisc\Api\Data\SroMiscInterface
     */
    public function setSroOper($sroOper);

    /**
     * Get trans_date
     *
     * @return string|null
     */
    public function getTransDate();

    /**
     * Set trans_date
     *
     * @param string $transDate
     * @return \Variux\Warranty\SroMisc\Api\Data\SroMiscInterface
     */
    public function setTransDate($transDate);

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
     * @return \Variux\Warranty\SroMisc\Api\Data\SroMiscInterface
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
     * @return \Variux\Warranty\SroMisc\Api\Data\SroMiscInterface
     */
    public function setCustomerId($customerId);

    /**
     * Get misc_code
     *
     * @return string|null
     */
    public function getMiscCode();

    /**
     * Set misc_code
     *
     * @param string $miscCode
     * @return \Variux\Warranty\SroMisc\Api\Data\SroMiscInterface
     */
    public function setMiscCode($miscCode);

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
     * @return \Variux\Warranty\SroMisc\Api\Data\SroMiscInterface
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
     * @return \Variux\Warranty\SroMisc\Api\Data\SroMiscInterface
     */
    public function setQtyConv($qtyConv);

    /**
     * Get amount
     *
     * @return string|null
     */
    public function getAmount();

    /**
     * Set amount
     *
     * @param string $amount
     * @return \Variux\Warranty\SroMisc\Api\Data\SroMiscInterface
     */
    public function setAmount($amount);

    /**
     * Get note
     *
     * @return string|null
     */
    public function getNote();

    /**
     * Set note
     *
     * @param string $note
     * @return \Variux\Warranty\SroMisc\Api\Data\SroMiscInterface
     */
    public function setNote($note);

    /**
     * Get note
     *
     * @return string|null
     */
    public function getType();

    /**
     * Set Type
     *
     * @param string $type
     * @return mixed
     */
    public function setType($type);

    /**
     * Get Partner Id
     *
     * @return mixed
     */
    public function getPartnerId();

    /**
     * Set Partner Id
     *
     * @param string $partnerId
     * @return mixed
     */
    public function setPartnerId($partnerId);

    /**
     * Get Partner Number
     *
     * @return mixed
     */
    public function getPartnerNum();

    /**
     * Set Partner Number
     *
     * @param string $partnerNum
     * @return mixed
     */
    public function setPartnerNum($partnerNum);

    /**
     * Get created_at
     *
     * @return string|null
     */
    public function getCreatedAt();

    /**
     * Set created_at
     *
     * @param string $createdAt
     * @return \Variux\Warranty\SroMisc\Api\Data\SroMiscInterface
     */
    public function setCreatedAt($createdAt);

    /**
     * Get updated_at
     *
     * @return string|null
     */
    public function getUpdatedAt();

    /**
     * Set updated_at
     *
     * @param string $updatedAt
     * @return \Variux\Warranty\SroMisc\Api\Data\SroMiscInterface
     */
    public function setUpdatedAt($updatedAt);
}
