<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Variux\Warranty\Api\Data;

interface SroLaborInterface
{

    const ITEM_ID = 'item_id';
    const CUSTOMER_ID = 'customer_id';
    const HOUR_WORKED = 'hour_worked';
    const LABOR_HOURLY_RATE = 'labor_hourly_rate';
    const WORK_CODE = 'work_code';
    const SRO_ID = 'sro_id';
    const UPDATED_AT = 'updated_at';
    const DESCRIPTION = 'description';
    const SRO_LINE = 'sro_line';
    const NOTE = 'note';
    const COST_CONV = 'cost_conv';
    const TRANS_DATE = 'trans_date';
    const CREATED_AT = 'created_at';
    const COMPANY_NAME = 'company_name';
    const SRO_NUMBER = 'sro_number';
    const SRO_OPER = 'sro_oper';
    const VALIDATE = 'validate';
    const COMPANY_ID = 'company_id';
    const PARTNER_ID = 'partner_id';

    /**
     * Get sro_id
     * @return string|null
     */
    public function getSroId();

    /**
     * Set sro_id
     * @param string $sroId
     * @return \Variux\Warranty\SroLabor\Api\Data\SroLaborInterface
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
     * @return \Variux\Warranty\SroLabor\Api\Data\SroLaborInterface
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
     * @return \Variux\Warranty\SroLabor\Api\Data\SroLaborInterface
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
     * @return \Variux\Warranty\SroLabor\Api\Data\SroLaborInterface
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
     * @return \Variux\Warranty\SroLabor\Api\Data\SroLaborInterface
     */
    public function setCompanyId($companyId);

    /**
     * Get company_name
     * @return string|null
     */
    public function getCompanyName();

    /**
     * Set company_name
     * @param string $companyName
     * @return \Variux\Warranty\SroLabor\Api\Data\SroLaborInterface
     */
    public function setCompanyName($companyName);

    /**
     * Get customer_id
     * @return string|null
     */
    public function getCustomerId();

    /**
     * Set customer_id
     * @param string $customerId
     * @return \Variux\Warranty\SroLabor\Api\Data\SroLaborInterface
     */
    public function setCustomerId($customerId);

    /**
     * Get work_code
     * @return string|null
     */
    public function getWorkCode();

    /**
     * Set work_code
     * @param string $workCode
     * @return \Variux\Warranty\SroLabor\Api\Data\SroLaborInterface
     */
    public function setWorkCode($workCode);

    /**
     * Get hour_worked
     * @return string|null
     */
    public function getHourWorked();

    /**
     * Set hour_worked
     * @param string $hourWorked
     * @return \Variux\Warranty\SroLabor\Api\Data\SroLaborInterface
     */
    public function setHourWorked($hourWorked);

    /**
     * Get validate
     * @return string|null
     */
    public function getValidate();

    /**
     * Set validate
     * @param string $validate
     * @return \Variux\Warranty\SroLabor\Api\Data\SroLaborInterface
     */
    public function setValidate($validate);

    /**
     * Get cost_conv
     * @return string|null
     */
    public function getCostConv();

    /**
     * Set cost_conv
     * @param string $costConv
     * @return \Variux\Warranty\SroLabor\Api\Data\SroLaborInterface
     */
    public function setCostConv($costConv);

    /**
     * Get note
     * @return string|null
     */
    public function getNote();

    /**
     * Set note
     * @param string $note
     * @return \Variux\Warranty\SroLabor\Api\Data\SroLaborInterface
     */
    public function setNote($note);

    /**
     * Get description
     * @return string|null
     */
    public function getDescription();

    /**
     * Set description
     * @param string $description
     * @return \Variux\Warranty\SroLabor\Api\Data\SroLaborInterface
     */
    public function setDescription($description);

    /**
     * Get labor_hourly_rate
     * @return string|null
     */
    public function getLaborHourlyRate();

    /**
     * Set labor_hourly_rate
     * @param string $laborHourlyRate
     * @return \Variux\Warranty\SroLabor\Api\Data\SroLaborInterface
     */
    public function setLaborHourlyRate($laborHourlyRate);

    /**
     * Get sro_number
     * @return string|null
     */
    public function getSroNumber();

    /**
     * Set sro_number
     * @param string $sroNumber
     * @return \Variux\Warranty\SroLabor\Api\Data\SroLaborInterface
     */
    public function setSroNumber($sroNumber);

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
     * Get created_at
     * @return string|null
     */
    public function getCreatedAt();

    /**
     * Set created_at
     * @param string $createdAt
     * @return \Variux\Warranty\SroLabor\Api\Data\SroLaborInterface
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
     * @return \Variux\Warranty\SroLabor\Api\Data\SroLaborInterface
     */
    public function setUpdatedAt($updatedAt);
}
