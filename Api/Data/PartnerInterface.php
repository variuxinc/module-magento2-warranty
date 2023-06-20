<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Variux\Warranty\Api\Data;

interface PartnerInterface
{

    public const NAME = 'name';
    public const PARTNER_NUM = 'partner_num';
    public const UPDATED_AT = 'updated_at';
    public const LABOR_RATE = 'labor_rate';
    public const CREATED_AT = 'created_at';
    public const PARTNER_ID = 'partner_id';
    public const COMPANY_ID = 'company_id';

    /**
     * Get partner_id
     *
     * @return string|null
     */
    public function getPartnerId();

    /**
     * Set partner_id
     *
     * @param string $partnerId
     * @return \Variux\Warranty\Partner\Api\Data\PartnerInterface
     */
    public function setPartnerId($partnerId);

    /**
     * Get partner_num
     *
     * @return string|null
     */
    public function getPartnerNum();

    /**
     * Set partner_num
     *
     * @param string $partnerNum
     * @return \Variux\Warranty\Partner\Api\Data\PartnerInterface
     */
    public function setPartnerNum($partnerNum);

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
     * @return \Variux\Warranty\Partner\Api\Data\PartnerInterface
     */
    public function setCompanyId($companyId);

    /**
     * Get name
     *
     * @return string|null
     */
    public function getName();

    /**
     * Set name
     *
     * @param string $name
     * @return \Variux\Warranty\Partner\Api\Data\PartnerInterface
     */
    public function setName($name);

    /**
     * Get labor_rate
     *
     * @return string|null
     */
    public function getLaborRate();

    /**
     * Set labor_rate
     *
     * @param string $laborRate
     * @return \Variux\Warranty\Partner\Api\Data\PartnerInterface
     */
    public function setLaborRate($laborRate);

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
     * @return \Variux\Warranty\Partner\Api\Data\PartnerInterface
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
     * @return \Variux\Warranty\Partner\Api\Data\PartnerInterface
     */
    public function setUpdatedAt($updatedAt);
}
