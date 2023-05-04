<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Variux\Warranty\Model;

use Magento\Framework\Model\AbstractModel;
use Variux\Warranty\Api\Data\SroMiscInterface;

class SroMisc extends AbstractModel implements SroMiscInterface
{

    /**
     * @inheritDoc
     */
    public function _construct()
    {
        $this->_init(\Variux\Warranty\Model\ResourceModel\SroMisc::class);
    }

    /**
     * @inheritDoc
     */
    public function getSromiscId()
    {
        return $this->getData(self::SROMISC_ID);
    }

    /**
     * @inheritDoc
     */
    public function setSromiscId($sromiscId)
    {
        return $this->setData(self::SROMISC_ID, $sromiscId);
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
    public function getSroLine()
    {
        return $this->getData(self::SRO_LINE);
    }

    /**
     * @inheritDoc
     */
    public function setSroLine($sroLine)
    {
        return $this->setData(self::SRO_LINE, $sroLine);
    }

    /**
     * @inheritDoc
     */
    public function getSroOper()
    {
        return $this->getData(self::SRO_OPER);
    }

    /**
     * @inheritDoc
     */
    public function setSroOper($sroOper)
    {
        return $this->setData(self::SRO_OPER, $sroOper);
    }

    /**
     * @inheritDoc
     */
    public function getTransDate()
    {
        return $this->getData(self::TRANS_DATE);
    }

    /**
     * @inheritDoc
     */
    public function setTransDate($transDate)
    {
        return $this->setData(self::TRANS_DATE, $transDate);
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
    public function getMiscCode()
    {
        return $this->getData(self::MISC_CODE);
    }

    /**
     * @inheritDoc
     */
    public function setMiscCode($miscCode)
    {
        return $this->setData(self::MISC_CODE, $miscCode);
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
    public function getQtyConv()
    {
        return $this->getData(self::QTY_CONV);
    }

    /**
     * @inheritDoc
     */
    public function setQtyConv($qtyConv)
    {
        return $this->setData(self::QTY_CONV, $qtyConv);
    }

    /**
     * @inheritDoc
     */
    public function getAmount()
    {
        return $this->getData(self::AMOUNT);
    }

    /**
     * @inheritDoc
     */
    public function setAmount($amount)
    {
        return $this->setData(self::AMOUNT, $amount);
    }

    /**
     * @inheritDoc
     */
    public function getNote()
    {
        return $this->getData(self::NOTE);
    }

    /**
     * @inheritDoc
     */
    public function setNote($note)
    {
        return $this->setData(self::NOTE, $note);
    }

    /**
     * @inheritDoc
     */
    public function getType()
    {
        return $this->getData(self::TYPE);
    }

    /**
     * @inheritDoc
     */
    public function setType($type)
    {
        return $this->setData(self::TYPE, $type);
    }

    /**
     * @inheritDoc
     */
    public function getPartnerId()
    {
        return $this->getData(self::PARTNER_ID);
    }

    /**
     * @inheritDoc
     */
    public function setPartnerId($partnerId)
    {
        return $this->setData(self::PARTNER_ID, $partnerId);
    }

    /**
     * @inheritDoc
     */
    public function getPartnerNum()
    {
        return $this->getData(self::PARTNER_NUM);
    }

    /**
     * @inheritDoc
     */
    public function setPartnerNum($partnerNum)
    {
        return $this->setData(self::PARTNER_NUM, $partnerNum);
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
