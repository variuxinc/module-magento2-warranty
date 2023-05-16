<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Variux\Warranty\Api\Data;

interface SroMiscInterface
{

    const ITEM_ID = 'item_id';
    const AMOUNT = 'amount';
    const CUSTOMER_ID = 'customer_id';
    const COMPANY_ID = 'company_id';
    const SRO_ID = 'sro_id';
    const UPDATED_AT = 'updated_at';
    const DESCRIPTION = 'description';
    const SRO_LINE = 'sro_line';
    const NOTE = 'note';
    const TYPE = 'type';
    const PARTNER_ID = 'partner_id';
    const PARTNER_NUM = 'partner_num';
    const MISC_CODE = 'misc_code';
    const CREATED_AT = 'created_at';
    const SRO_OPER = 'sro_oper';
    const QTY_CONV = 'qty_conv';
    const TRANS_DATE = 'trans_date';

    /**
     * Get sro_id
     * @return string|null
     */
    public function getSroId();

    /**
     * Set sro_id
     * @param string $sroId
     * @return \Variux\Warranty\SroMisc\Api\Data\SroMiscInterface
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
     * @return \Variux\Warranty\SroMisc\Api\Data\SroMiscInterface
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
     * @return \Variux\Warranty\SroMisc\Api\Data\SroMiscInterface
     */
    public function setSroOper($sroOper);

    /**
     * Get trans_date
     * @return string|null
     */
    public function getTransDate();

    /**
     * Set trans_date
     * @param string $transDate
     * @return \Variux\Warranty\SroMisc\Api\Data\SroMiscInterface
     */
    public function setTransDate($transDate);

    /**
     * Get company_id
     * @return string|null
     */
    public function getCompanyId();

    /**
     * Set company_id
     * @param string $companyId
     * @return \Variux\Warranty\SroMisc\Api\Data\SroMiscInterface
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
     * @return \Variux\Warranty\SroMisc\Api\Data\SroMiscInterface
     */
    public function setCustomerId($customerId);

    /**
     * Get misc_code
     * @return string|null
     */
    public function getMiscCode();

    /**
     * Set misc_code
     * @param string $miscCode
     * @return \Variux\Warranty\SroMisc\Api\Data\SroMiscInterface
     */
    public function setMiscCode($miscCode);

    /**
     * Get description
     * @return string|null
     */
    public function getDescription();

    /**
     * Set description
     * @param string $description
     * @return \Variux\Warranty\SroMisc\Api\Data\SroMiscInterface
     */
    public function setDescription($description);

    /**
     * Get qty_conv
     * @return string|null
     */
    public function getQtyConv();

    /**
     * Set qty_conv
     * @param string $qtyConv
     * @return \Variux\Warranty\SroMisc\Api\Data\SroMiscInterface
     */
    public function setQtyConv($qtyConv);

    /**
     * Get amount
     * @return string|null
     */
    public function getAmount();

    /**
     * Set amount
     * @param string $amount
     * @return \Variux\Warranty\SroMisc\Api\Data\SroMiscInterface
     */
    public function setAmount($amount);

    /**
     * Get note
     * @return string|null
     */
    public function getNote();

    /**
     * Set note
     * @param string $note
     * @return \Variux\Warranty\SroMisc\Api\Data\SroMiscInterface
     */
    public function setNote($note);

    /**
     * Get note
     * @return string|null
     */
    public function getType();

    /**
     * @param $type
     * @return mixed
     */
    public function setType($type);

    /**
     * @return mixed
     */
    public function getPartnerId();

    /**
     * @param $partnerId
     * @return mixed
     */
    public function setPartnerId($partnerId);

    /**
     * @return mixed
     */
    public function getPartnerNum();

    /**
     * @param $partnerNum
     * @return mixed
     */
    public function setPartnerNum($partnerNum);

    /**
     * Get created_at
     * @return string|null
     */
    public function getCreatedAt();

    /**
     * Set created_at
     * @param string $createdAt
     * @return \Variux\Warranty\SroMisc\Api\Data\SroMiscInterface
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
     * @return \Variux\Warranty\SroMisc\Api\Data\SroMiscInterface
     */
    public function setUpdatedAt($updatedAt);
}
