<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Variux\Warranty\Api\Data;

interface WarrantyInterface
{

    const ITEM_SKU = 'item_sku';
    const WARRANTY_START_DATE = 'warranty_start_date';
    const INVOICE_NUMBER = 'invoice_number';
    const CREATED_AT = 'created_at';
    const WARRANTY_END_DATE = 'warranty_end_date';
    const FIRST_SRO_ID = 'first_sro_id';
    const ENGINE = 'engine';
    const COMPANY_ID = 'company_id';
    const WARRANTY_REGISTERED = 'warranty_registered';
    const STORE_ID = 'store_id';
    const ORDER_NUMBER = 'order_number';
    const DATE_OF_REPAIR = 'date_of_repair';
    const FIRST_SRO_NUMBER = 'first_sro_number';
    const ADMIN_CUSTOMER_ID = 'admin_customer_id';
    const DESCRIPTION = 'description';
    const INCIDENT_NUMBER = 'incident_number';
    const ENGINE_HOUR = 'engine_hour';
    const DEALER_PHONE_NUMBER = 'dealer_phone_number';
    const IS_SRO_DETAILS_FULLY_SYNCED = 'is_sro_details_fully_synced';
    const BRIEF_DESCRIPTION = 'brief_description';
    const BOAT_OWNER_NAME = 'boat_owner_name';
    const CUSTOMER_ID = 'customer_id';
    const WARRANTY_ID = 'warranty_id';
    const CONSUMER_NAME = 'consumer_name';
    const STATUS = 'status';
    const RESOLUTION_NOTE = 'resolution_note';
    const REFERENCE_NUMBER = 'reference_number';
    const DEALER_NAME = 'dealer_name';
    const UPDATED_AT = 'updated_at';
    const ERROR_REASON = 'error_reason';
    const HAS_ERROR = 'has_error';
    const DATE_OF_FAILURE = 'date_of_failure';
    const REASON_NOTE = 'reason_note';
    const CLAIM_PROCESSOR_EMAIL = 'claim_processor_email';

    /**
     * Get warranty_id
     * @return string|null
     */
    public function getWarrantyId();

    /**
     * Set warranty_id
     * @param string $warrantyId
     * @return \Variux\Warranty\Warranty\Api\Data\WarrantyInterface
     */
    public function setWarrantyId($warrantyId);

    /**
     * Get description
     * @return string|null
     */
    public function getDescription();

    /**
     * Set description
     * @param string $description
     * @return \Variux\Warranty\Warranty\Api\Data\WarrantyInterface
     */
    public function setDescription($description);

    /**
     * Get customer_id
     * @return string|null
     */
    public function getCustomerId();

    /**
     * Set customer_id
     * @param string $customerId
     * @return \Variux\Warranty\Warranty\Api\Data\WarrantyInterface
     */
    public function setCustomerId($customerId);

    /**
     * Get engine
     * @return string|null
     */
    public function getEngine();

    /**
     * Set engine
     * @param string $engine
     * @return \Variux\Warranty\Warranty\Api\Data\WarrantyInterface
     */
    public function setEngine($engine);

    /**
     * Get engine_hour
     * @return string|null
     */
    public function getEngineHour();

    /**
     * Set engine_hour
     * @param string $engineHour
     * @return \Variux\Warranty\Warranty\Api\Data\WarrantyInterface
     */
    public function setEngineHour($engineHour);

    /**
     * Get invoice_number
     * @return string|null
     */
    public function getInvoiceNumber();

    /**
     * Set invoice_number
     * @param string $invoiceNumber
     * @return \Variux\Warranty\Warranty\Api\Data\WarrantyInterface
     */
    public function setInvoiceNumber($invoiceNumber);

    /**
     * Get order_number
     * @return string|null
     */
    public function getOrderNumber();

    /**
     * Set order_number
     * @param string $orderNumber
     * @return \Variux\Warranty\Warranty\Api\Data\WarrantyInterface
     */
    public function setOrderNumber($orderNumber);

    /**
     * Get item_sku
     * @return string|null
     */
    public function getItemSku();

    /**
     * Set item_sku
     * @param string $itemSku
     * @return \Variux\Warranty\Warranty\Api\Data\WarrantyInterface
     */
    public function setItemSku($itemSku);

    /**
     * Get boat_owner_name
     * @return string|null
     */
    public function getBoatOwnerName();

    /**
     * Set boat_owner_name
     * @param string $boatOwnerName
     * @return \Variux\Warranty\Warranty\Api\Data\WarrantyInterface
     */
    public function setBoatOwnerName($boatOwnerName);

    /**
     * Get reference_number
     * @return string|null
     */
    public function getReferenceNumber();

    /**
     * Set reference_number
     * @param string $referenceNumber
     * @return \Variux\Warranty\Warranty\Api\Data\WarrantyInterface
     */
    public function setReferenceNumber($referenceNumber);

    /**
     * Get date_of_failure
     * @return string|null
     */
    public function getDateOfFailure();

    /**
     * Set date_of_failure
     * @param string $dateOfFailure
     * @return \Variux\Warranty\Warranty\Api\Data\WarrantyInterface
     */
    public function setDateOfFailure($dateOfFailure);

    /**
     * Get date_of_repair
     * @return string|null
     */
    public function getDateOfRepair();

    /**
     * Set date_of_repair
     * @param string $dateOfRepair
     * @return \Variux\Warranty\Warranty\Api\Data\WarrantyInterface
     */
    public function setDateOfRepair($dateOfRepair);

    /**
     * Get claim_processor_email
     * @return string|null
     */
    public function getClaimProcessorEmail();

    /**
     * Set claim_processor_email
     * @param string $claimProcessorEmail
     * @return \Variux\Warranty\Warranty\Api\Data\WarrantyInterface
     */
    public function setClaimProcessorEmail($claimProcessorEmail);

    /**
     * Get brief_description
     * @return string|null
     */
    public function getBriefDescription();

    /**
     * Set brief_description
     * @param string $briefDescription
     * @return \Variux\Warranty\Warranty\Api\Data\WarrantyInterface
     */
    public function setBriefDescription($briefDescription);

    /**
     * Get reason_note
     * @return string|null
     */
    public function getReasonNote();

    /**
     * Set reason_note
     * @param string $reasonNote
     * @return \Variux\Warranty\Warranty\Api\Data\WarrantyInterface
     */
    public function setReasonNote($reasonNote);

    /**
     * Get resolution_note
     * @return string|null
     */
    public function getResolutionNote();

    /**
     * Set resolution_note
     * @param string $resolutionNote
     * @return \Variux\Warranty\Warranty\Api\Data\WarrantyInterface
     */
    public function setResolutionNote($resolutionNote);

    /**
     * Get status
     * @return string|null
     */
    public function getStatus();

    /**
     * Set status
     * @param string $status
     * @return \Variux\Warranty\Warranty\Api\Data\WarrantyInterface
     */
    public function setStatus($status);

    /**
     * Get store_id
     * @return string|null
     */
    public function getStoreId();

    /**
     * Set store_id
     * @param string $storeId
     * @return \Variux\Warranty\Warranty\Api\Data\WarrantyInterface
     */
    public function setStoreId($storeId);

    /**
     * Get incident_number
     * @return string|null
     */
    public function getIncidentNumber();

    /**
     * Set incident_number
     * @param string $incidentNumber
     * @return \Variux\Warranty\Warranty\Api\Data\WarrantyInterface
     */
    public function setIncidentNumber($incidentNumber);

    /**
     * Get first_sro_number
     * @return string|null
     */
    public function getFirstSroNumber();

    /**
     * Set first_sro_number
     * @param string $firstSroNumber
     * @return \Variux\Warranty\Warranty\Api\Data\WarrantyInterface
     */
    public function setFirstSroNumber($firstSroNumber);

    /**
     * Get dealer_name
     * @return string|null
     */
    public function getDealerName();

    /**
     * Set dealer_name
     * @param string $dealerName
     * @return \Variux\Warranty\Warranty\Api\Data\WarrantyInterface
     */
    public function setDealerName($dealerName);

    /**
     * Get dealer_phone_number
     * @return string|null
     */
    public function getDealerPhoneNumber();

    /**
     * Set dealer_phone_number
     * @param string $dealerPhoneNumber
     * @return \Variux\Warranty\Warranty\Api\Data\WarrantyInterface
     */
    public function setDealerPhoneNumber($dealerPhoneNumber);

    /**
     * Get is_sro_details_fully_synced
     * @return string|null
     */
    public function getIsSroDetailsFullySynced();

    /**
     * Set is_sro_details_fully_synced
     * @param string $isSroDetailsFullySynced
     * @return \Variux\Warranty\Warranty\Api\Data\WarrantyInterface
     */
    public function setIsSroDetailsFullySynced($isSroDetailsFullySynced);

    /**
     * Get has_error
     * @return string|null
     */
    public function getHasError();

    /**
     * Set has_error
     * @param string $hasError
     * @return \Variux\Warranty\Warranty\Api\Data\WarrantyInterface
     */
    public function setHasError($hasError);

    /**
     * Get error_reason
     * @return string|null
     */
    public function getErrorReason();

    /**
     * Set error_reason
     * @param string $errorReason
     * @return \Variux\Warranty\Warranty\Api\Data\WarrantyInterface
     */
    public function setErrorReason($errorReason);

    /**
     * Get first_sro_id
     * @return string|null
     */
    public function getFirstSroId();

    /**
     * Set first_sro_id
     * @param string $firstSroId
     * @return \Variux\Warranty\Warranty\Api\Data\WarrantyInterface
     */
    public function setFirstSroId($firstSroId);

    /**
     * Get warranty_registered
     * @return string|null
     */
    public function getWarrantyRegistered();

    /**
     * Set warranty_registered
     * @param string $warrantyRegistered
     * @return \Variux\Warranty\Warranty\Api\Data\WarrantyInterface
     */
    public function setWarrantyRegistered($warrantyRegistered);

    /**
     * Get consumer_name
     * @return string|null
     */
    public function getConsumerName();

    /**
     * Set consumer_name
     * @param string $consumerName
     * @return \Variux\Warranty\Warranty\Api\Data\WarrantyInterface
     */
    public function setConsumerName($consumerName);

    /**
     * Get warranty_start_date
     * @return string|null
     */
    public function getWarrantyStartDate();

    /**
     * Set warranty_start_date
     * @param string $warrantyStartDate
     * @return \Variux\Warranty\Warranty\Api\Data\WarrantyInterface
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
     * @return \Variux\Warranty\Warranty\Api\Data\WarrantyInterface
     */
    public function setWarrantyEndDate($warrantyEndDate);

    /**
     * Get company_id
     * @return string|null
     */
    public function getCompanyId();

    /**
     * Set company_id
     * @param string $companyId
     * @return \Variux\Warranty\Warranty\Api\Data\WarrantyInterface
     */
    public function setCompanyId($companyId);

    /**
     * Get admin_customer_id
     * @return string|null
     */
    public function getAdminCustomerId();

    /**
     * Set admin_customer_id
     * @param string $adminCustomerId
     * @return \Variux\Warranty\Warranty\Api\Data\WarrantyInterface
     */
    public function setAdminCustomerId($adminCustomerId);

    /**
     * Get created_at
     * @return string|null
     */
    public function getCreatedAt();

    /**
     * Set created_at
     * @param string $createdAt
     * @return \Variux\Warranty\Warranty\Api\Data\WarrantyInterface
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
     * @return \Variux\Warranty\Warranty\Api\Data\WarrantyInterface
     */
    public function setUpdatedAt($updatedAt);
}
