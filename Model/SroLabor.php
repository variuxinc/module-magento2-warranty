<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Variux\Warranty\Model;

use Magento\Framework\Model\AbstractModel;
use Variux\Warranty\Api\Data\SroLaborInterface;

class SroLabor extends AbstractModel implements SroLaborInterface
{

    /**
     * @inheritDoc
     */
    public function _construct()
    {
        $this->_init(\Variux\Warranty\Model\ResourceModel\SroLabor::class);
    }

    /**
     * @inheritDoc
     */
    public function getSrolaborId()
    {
        return $this->getData(self::SROLABOR_ID);
    }

    /**
     * @inheritDoc
     */
    public function setSrolaborId($srolaborId)
    {
        return $this->setData(self::SROLABOR_ID, $srolaborId);
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
    public function getCompanyName()
    {
        return $this->getData(self::COMPANY_NAME);
    }

    /**
     * @inheritDoc
     */
    public function setCompanyName($companyName)
    {
        return $this->setData(self::COMPANY_NAME, $companyName);
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
    public function getWorkCode()
    {
        return $this->getData(self::WORK_CODE);
    }

    /**
     * @inheritDoc
     */
    public function setWorkCode($workCode)
    {
        return $this->setData(self::WORK_CODE, $workCode);
    }

    /**
     * @inheritDoc
     */
    public function getHourWorked()
    {
        return $this->getData(self::HOUR_WORKED);
    }

    /**
     * @inheritDoc
     */
    public function setHourWorked($hourWorked)
    {
        return $this->setData(self::HOUR_WORKED, $hourWorked);
    }

    /**
     * @inheritDoc
     */
    public function getValidate()
    {
        return $this->getData(self::VALIDATE);
    }

    /**
     * @inheritDoc
     */
    public function setValidate($validate)
    {
        return $this->setData(self::VALIDATE, $validate);
    }

    /**
     * @inheritDoc
     */
    public function getCostConv()
    {
        return $this->getData(self::COST_CONV);
    }

    /**
     * @inheritDoc
     */
    public function setCostConv($costConv)
    {
        return $this->setData(self::COST_CONV, $costConv);
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
    public function getLaborHourlyRate()
    {
        return $this->getData(self::LABOR_HOURLY_RATE);
    }

    /**
     * @inheritDoc
     */
    public function setLaborHourlyRate($laborHourlyRate)
    {
        return $this->setData(self::LABOR_HOURLY_RATE, $laborHourlyRate);
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

    /**
     * @return array|mixed|null
     */
    public function getPartnerId()
    {
        return $this->getData(self::PARTNER_ID);
    }

    /**
     * @param $partnerId
     * @return mixed|SroLabor
     */
    public function setPartnerId($partnerId)
    {
        return $this->setData(self::PARTNER_ID, $partnerId);
    }
}
