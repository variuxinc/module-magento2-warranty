<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Variux\Warranty\Model;

use Magento\Framework\Model\AbstractModel;
use Variux\Warranty\Api\Data\WarrantyInterface;

class Warranty extends AbstractModel implements WarrantyInterface
{

    /**
     * @inheritDoc
     */
    public function _construct()
    {
        $this->_init(\Variux\Warranty\Model\ResourceModel\Warranty::class);
    }

    /**
     * @inheritDoc
     */
    public function getWarrantyId()
    {
        return $this->getData(self::WARRANTY_ID);
    }

    /**
     * @inheritDoc
     */
    public function setWarrantyId($warrantyId)
    {
        return $this->setData(self::WARRANTY_ID, $warrantyId);
    }

    /**
     * @inheritDoc
     */
    public function getDescription()
    {
        return $this->getData(self::DESCRIPTION);
    }

    /**
     * @inheritDoc
     */
    public function setDescription($description)
    {
        return $this->setData(self::DESCRIPTION, $description);
    }

    /**
     * @inheritDoc
     */
    public function getCustomerId()
    {
        return $this->getData(self::CUSTOMER_ID);
    }

    /**
     * @inheritDoc
     */
    public function setCustomerId($customerId)
    {
        return $this->setData(self::CUSTOMER_ID, $customerId);
    }

    /**
     * @inheritDoc
     */
    public function getEngine()
    {
        return $this->getData(self::ENGINE);
    }

    /**
     * @inheritDoc
     */
    public function setEngine($engine)
    {
        return $this->setData(self::ENGINE, $engine);
    }

    /**
     * @inheritDoc
     */
    public function getEngineHour()
    {
        return $this->getData(self::ENGINE_HOUR);
    }

    /**
     * @inheritDoc
     */
    public function setEngineHour($engineHour)
    {
        return $this->setData(self::ENGINE_HOUR, $engineHour);
    }

    /**
     * @inheritDoc
     */
    public function getInvoiceNumber()
    {
        return $this->getData(self::INVOICE_NUMBER);
    }

    /**
     * @inheritDoc
     */
    public function setInvoiceNumber($invoiceNumber)
    {
        return $this->setData(self::INVOICE_NUMBER, $invoiceNumber);
    }

    /**
     * @inheritDoc
     */
    public function getOrderNumber()
    {
        return $this->getData(self::ORDER_NUMBER);
    }

    /**
     * @inheritDoc
     */
    public function setOrderNumber($orderNumber)
    {
        return $this->setData(self::ORDER_NUMBER, $orderNumber);
    }

    /**
     * @inheritDoc
     */
    public function getItemSku()
    {
        return $this->getData(self::ITEM_SKU);
    }

    /**
     * @inheritDoc
     */
    public function setItemSku($itemSku)
    {
        return $this->setData(self::ITEM_SKU, $itemSku);
    }

    /**
     * @inheritDoc
     */
    public function getBoatOwnerName()
    {
        return $this->getData(self::BOAT_OWNER_NAME);
    }

    /**
     * @inheritDoc
     */
    public function setBoatOwnerName($boatOwnerName)
    {
        return $this->setData(self::BOAT_OWNER_NAME, $boatOwnerName);
    }

    /**
     * @inheritDoc
     */
    public function getReferenceNumber()
    {
        return $this->getData(self::REFERENCE_NUMBER);
    }

    /**
     * @inheritDoc
     */
    public function setReferenceNumber($referenceNumber)
    {
        return $this->setData(self::REFERENCE_NUMBER, $referenceNumber);
    }

    /**
     * @inheritDoc
     */
    public function getDateOfFailure()
    {
        return $this->getData(self::DATE_OF_FAILURE);
    }

    /**
     * @inheritDoc
     */
    public function setDateOfFailure($dateOfFailure)
    {
        return $this->setData(self::DATE_OF_FAILURE, $dateOfFailure);
    }

    /**
     * @inheritDoc
     */
    public function getDateOfRepair()
    {
        return $this->getData(self::DATE_OF_REPAIR);
    }

    /**
     * @inheritDoc
     */
    public function setDateOfRepair($dateOfRepair)
    {
        return $this->setData(self::DATE_OF_REPAIR, $dateOfRepair);
    }

    /**
     * @inheritDoc
     */
    public function getClaimProcessorEmail()
    {
        return $this->getData(self::CLAIM_PROCESSOR_EMAIL);
    }

    /**
     * @inheritDoc
     */
    public function setClaimProcessorEmail($claimProcessorEmail)
    {
        return $this->setData(self::CLAIM_PROCESSOR_EMAIL, $claimProcessorEmail);
    }

    /**
     * @inheritDoc
     */
    public function getBriefDescription()
    {
        return $this->getData(self::BRIEF_DESCRIPTION);
    }

    /**
     * @inheritDoc
     */
    public function setBriefDescription($briefDescription)
    {
        return $this->setData(self::BRIEF_DESCRIPTION, $briefDescription);
    }

    /**
     * @inheritDoc
     */
    public function getReasonNote()
    {
        return $this->getData(self::REASON_NOTE);
    }

    /**
     * @inheritDoc
     */
    public function setReasonNote($reasonNote)
    {
        return $this->setData(self::REASON_NOTE, $reasonNote);
    }

    /**
     * @inheritDoc
     */
    public function getResolutionNote()
    {
        return $this->getData(self::RESOLUTION_NOTE);
    }

    /**
     * @inheritDoc
     */
    public function setResolutionNote($resolutionNote)
    {
        return $this->setData(self::RESOLUTION_NOTE, $resolutionNote);
    }

    /**
     * @inheritDoc
     */
    public function getStatus()
    {
        return $this->getData(self::STATUS);
    }

    /**
     * @inheritDoc
     */
    public function setStatus($status)
    {
        return $this->setData(self::STATUS, $status);
    }

    /**
     * @inheritDoc
     */
    public function getStoreId()
    {
        return $this->getData(self::STORE_ID);
    }

    /**
     * @inheritDoc
     */
    public function setStoreId($storeId)
    {
        return $this->setData(self::STORE_ID, $storeId);
    }

    /**
     * @inheritDoc
     */
    public function getIncidentNumber()
    {
        return $this->getData(self::INCIDENT_NUMBER);
    }

    /**
     * @inheritDoc
     */
    public function setIncidentNumber($incidentNumber)
    {
        return $this->setData(self::INCIDENT_NUMBER, $incidentNumber);
    }

    /**
     * @inheritDoc
     */
    public function getFirstSroNumber()
    {
        return $this->getData(self::FIRST_SRO_NUMBER);
    }

    /**
     * @inheritDoc
     */
    public function setFirstSroNumber($firstSroNumber)
    {
        return $this->setData(self::FIRST_SRO_NUMBER, $firstSroNumber);
    }

    /**
     * @inheritDoc
     */
    public function getDealerName()
    {
        return $this->getData(self::DEALER_NAME);
    }

    /**
     * @inheritDoc
     */
    public function setDealerName($dealerName)
    {
        return $this->setData(self::DEALER_NAME, $dealerName);
    }

    /**
     * @inheritDoc
     */
    public function getDealerPhoneNumber()
    {
        return $this->getData(self::DEALER_PHONE_NUMBER);
    }

    /**
     * @inheritDoc
     */
    public function setDealerPhoneNumber($dealerPhoneNumber)
    {
        return $this->setData(self::DEALER_PHONE_NUMBER, $dealerPhoneNumber);
    }

    /**
     * @inheritDoc
     */
    public function getIsSroDetailsFullySynced()
    {
        return $this->getData(self::IS_SRO_DETAILS_FULLY_SYNCED);
    }

    /**
     * @inheritDoc
     */
    public function setIsSroDetailsFullySynced($isSroDetailsFullySynced)
    {
        return $this->setData(self::IS_SRO_DETAILS_FULLY_SYNCED, $isSroDetailsFullySynced);
    }

    /**
     * @inheritDoc
     */
    public function getHasError()
    {
        return $this->getData(self::HAS_ERROR);
    }

    /**
     * @inheritDoc
     */
    public function setHasError($hasError)
    {
        return $this->setData(self::HAS_ERROR, $hasError);
    }

    /**
     * @inheritDoc
     */
    public function getErrorReason()
    {
        return $this->getData(self::ERROR_REASON);
    }

    /**
     * @inheritDoc
     */
    public function setErrorReason($errorReason)
    {
        return $this->setData(self::ERROR_REASON, $errorReason);
    }

    /**
     * @inheritDoc
     */
    public function getFirstSroId()
    {
        return $this->getData(self::FIRST_SRO_ID);
    }

    /**
     * @inheritDoc
     */
    public function setFirstSroId($firstSroId)
    {
        return $this->setData(self::FIRST_SRO_ID, $firstSroId);
    }

    /**
     * @inheritDoc
     */
    public function getWarrantyRegistered()
    {
        return $this->getData(self::WARRANTY_REGISTERED);
    }

    /**
     * @inheritDoc
     */
    public function setWarrantyRegistered($warrantyRegistered)
    {
        return $this->setData(self::WARRANTY_REGISTERED, $warrantyRegistered);
    }

    /**
     * @inheritDoc
     */
    public function getConsumerName()
    {
        return $this->getData(self::CONSUMER_NAME);
    }

    /**
     * @inheritDoc
     */
    public function setConsumerName($consumerName)
    {
        return $this->setData(self::CONSUMER_NAME, $consumerName);
    }

    /**
     * @inheritDoc
     */
    public function getWarrantyStartDate()
    {
        return $this->getData(self::WARRANTY_START_DATE);
    }

    /**
     * @inheritDoc
     */
    public function setWarrantyStartDate($warrantyStartDate)
    {
        return $this->setData(self::WARRANTY_START_DATE, $warrantyStartDate);
    }

    /**
     * @inheritDoc
     */
    public function getWarrantyEndDate()
    {
        return $this->getData(self::WARRANTY_END_DATE);
    }

    /**
     * @inheritDoc
     */
    public function setWarrantyEndDate($warrantyEndDate)
    {
        return $this->setData(self::WARRANTY_END_DATE, $warrantyEndDate);
    }

    /**
     * @inheritDoc
     */
    public function getCompanyId()
    {
        return $this->getData(self::COMPANY_ID);
    }

    /**
     * @inheritDoc
     */
    public function setCompanyId($companyId)
    {
        return $this->setData(self::COMPANY_ID, $companyId);
    }

    /**
     * @inheritDoc
     */
    public function getAdminCustomerId()
    {
        return $this->getData(self::ADMIN_CUSTOMER_ID);
    }

    /**
     * @inheritDoc
     */
    public function setAdminCustomerId($adminCustomerId)
    {
        return $this->setData(self::ADMIN_CUSTOMER_ID, $adminCustomerId);
    }

    /**
     * @inheritDoc
     */
    public function getCreatedAt()
    {
        return $this->getData(self::CREATED_AT);
    }

    /**
     * @inheritDoc
     */
    public function setCreatedAt($createdAt)
    {
        return $this->setData(self::CREATED_AT, $createdAt);
    }

    /**
     * @inheritDoc
     */
    public function getUpdatedAt()
    {
        return $this->getData(self::UPDATED_AT);
    }

    /**
     * @inheritDoc
     */
    public function setUpdatedAt($updatedAt)
    {
        return $this->setData(self::UPDATED_AT, $updatedAt);
    }
}

