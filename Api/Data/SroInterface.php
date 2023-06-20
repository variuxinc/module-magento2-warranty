<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Variux\Warranty\Api\Data;

interface SroInterface
{

    public const CUSTOMER_ID = 'customer_id';
    public const WARRANTY_ID = 'warranty_id';
    public const SRO_ID = 'sro_id';
    public const UPDATED_AT = 'updated_at';
    public const ADMIN_CUSTOMER_ID = 'admin_customer_id';
    public const CREATED_AT = 'created_at';
    public const SRO_NUMBER = 'sro_number';
    public const COMPANY_ID = 'company_id';

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
     * @return \Variux\Warranty\Sro\Api\Data\SroInterface
     */
    public function setSroId($sroId);

    /**
     * Get warranty_id
     *
     * @return string|null
     */
    public function getWarrantyId();

    /**
     * Set warranty_id
     *
     * @param string $warrantyId
     * @return \Variux\Warranty\Sro\Api\Data\SroInterface
     */
    public function setWarrantyId($warrantyId);

    /**
     * Get sro_number
     *
     * @return string|null
     */
    public function getSroNumber();

    /**
     * Set sro_number
     *
     * @param string $sroNumber
     * @return \Variux\Warranty\Sro\Api\Data\SroInterface
     */
    public function setSroNumber($sroNumber);

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
     * @return \Variux\Warranty\Sro\Api\Data\SroInterface
     */
    public function setCustomerId($customerId);

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
     * @return \Variux\Warranty\Sro\Api\Data\SroInterface
     */
    public function setCompanyId($companyId);

    /**
     * Get admin_customer_id
     *
     * @return string|null
     */
    public function getAdminCustomerId();

    /**
     * Set admin_customer_id
     *
     * @param string $adminCustomerId
     * @return \Variux\Warranty\Sro\Api\Data\SroInterface
     */
    public function setAdminCustomerId($adminCustomerId);

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
     * @return \Variux\Warranty\Sro\Api\Data\SroInterface
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
     * @return \Variux\Warranty\Sro\Api\Data\SroInterface
     */
    public function setUpdatedAt($updatedAt);
}
