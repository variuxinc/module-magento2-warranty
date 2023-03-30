<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Variux\Warranty\Model;

use Magento\Framework\Model\AbstractModel;
use Variux\Warranty\Api\Data\SroInterface;

class Sro extends AbstractModel implements SroInterface
{

    /**
     * @inheritDoc
     */
    public function _construct()
    {
        $this->_init(\Variux\Warranty\Model\ResourceModel\Sro::class);
    }

    /**
     * @inheritDoc
     */
    public function getSroId()
    {
        return $this->getData(self::SRO_ID);
    }

    /**
     * @inheritDoc
     */
    public function setSroId($sroId)
    {
        return $this->setData(self::SRO_ID, $sroId);
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
    public function getSroNumber()
    {
        return $this->getData(self::SRO_NUMBER);
    }

    /**
     * @inheritDoc
     */
    public function setSroNumber($sroNumber)
    {
        return $this->setData(self::SRO_NUMBER, $sroNumber);
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

