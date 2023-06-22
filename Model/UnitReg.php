<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Variux\Warranty\Model;

use Magento\Framework\Model\AbstractModel;
use Variux\Warranty\Api\Data\UnitRegInterface;

class UnitReg extends AbstractModel implements UnitRegInterface
{
    /**
     * @var string
     */
    protected $_eventPrefix = 'variux_unit_reg';

    /**
     * @inheritDoc
     */
    public function _construct()
    {
        $this->_init(\Variux\Warranty\Model\ResourceModel\UnitReg::class);
    }

    /**
     * @inheritDoc
     */
    public function getUnitregId()
    {
        return $this->getData(self::UNITREG_ID);
    }

    /**
     * @inheritDoc
     */
    public function setUnitregId($unitregId)
    {
        return $this->setData(self::UNITREG_ID, $unitregId);
    }

    /**
     * @inheritDoc
     */
    public function getHullId()
    {
        return $this->getData(self::HULL_ID);
    }

    /**
     * @inheritDoc
     */
    public function setHullId($hullId)
    {
        return $this->setData(self::HULL_ID, $hullId);
    }

    /**
     * @inheritDoc
     */
    public function getRegNotes()
    {
        return $this->getData(self::REG_NOTES);
    }

    /**
     * @inheritDoc
     */
    public function setRegNotes($regNotes)
    {
        return $this->setData(self::REG_NOTES, $regNotes);
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
    public function getTransNum()
    {
        return $this->getData(self::TRANS_NUM);
    }

    /**
     * @inheritDoc
     */
    public function setTransNum($transNum)
    {
        return $this->setData(self::TRANS_NUM, $transNum);
    }

    /**
     * @inheritDoc
     */
    public function getSerialNo()
    {
        return $this->getData(self::SERIAL_NO);
    }

    /**
     * @inheritDoc
     */
    public function setSerialNo($serialNo)
    {
        return $this->setData(self::SERIAL_NO, $serialNo);
    }

    /**
     * @inheritDoc
     */
    public function getItem()
    {
        return $this->getData(self::ITEM);
    }

    /**
     * @inheritDoc
     */
    public function setItem($item)
    {
        return $this->setData(self::ITEM, $item);
    }

    /**
     * @inheritDoc
     */
    public function getPosted()
    {
        return $this->getData(self::POSTED);
    }

    /**
     * @inheritDoc
     */
    public function setPosted($posted)
    {
        return $this->setData(self::POSTED, $posted);
    }

    /**
     * @inheritDoc
     */
    public function getRejected()
    {
        return $this->getData(self::REJECTED);
    }

    /**
     * @inheritDoc
     */
    public function setRejected($rejected)
    {
        return $this->setData(self::REJECTED, $rejected);
    }

    /**
     * @inheritDoc
     */
    public function getPostDate()
    {
        return $this->getData(self::POST_DATE);
    }

    /**
     * @inheritDoc
     */
    public function setPostDate($postDate)
    {
        return $this->setData(self::POST_DATE, $postDate);
    }

    /**
     * @inheritDoc
     */
    public function getErrMsg()
    {
        return $this->getData(self::ERR_MSG);
    }

    /**
     * @inheritDoc
     */
    public function setErrMsg($errMsg)
    {
        return $this->setData(self::ERR_MSG, $errMsg);
    }

    /**
     * @inheritDoc
     */
    public function getName()
    {
        return $this->getData(self::NAME);
    }

    /**
     * @inheritDoc
     */
    public function setName($name)
    {
        return $this->setData(self::NAME, $name);
    }

    /**
     * @inheritDoc
     */
    public function getAddress1()
    {
        return $this->getData(self::ADDRESS1);
    }

    /**
     * @inheritDoc
     */
    public function setAddress1($address1)
    {
        return $this->setData(self::ADDRESS1, $address1);
    }

    /**
     * @inheritDoc
     */
    public function getAddress2()
    {
        return $this->getData(self::ADDRESS2);
    }

    /**
     * @inheritDoc
     */
    public function setAddress2($address2)
    {
        return $this->setData(self::ADDRESS2, $address2);
    }

    /**
     * @inheritDoc
     */
    public function getAddress3()
    {
        return $this->getData(self::ADDRESS3);
    }

    /**
     * @inheritDoc
     */
    public function setAddress3($address3)
    {
        return $this->setData(self::ADDRESS3, $address3);
    }

    /**
     * @inheritDoc
     */
    public function getAddress4()
    {
        return $this->getData(self::ADDRESS4);
    }

    /**
     * @inheritDoc
     */
    public function setAddress4($address4)
    {
        return $this->setData(self::ADDRESS4, $address4);
    }

    /**
     * @inheritDoc
     */
    public function getCity()
    {
        return $this->getData(self::CITY);
    }

    /**
     * @inheritDoc
     */
    public function setCity($city)
    {
        return $this->setData(self::CITY, $city);
    }

    /**
     * @inheritDoc
     */
    public function getState()
    {
        return $this->getData(self::STATE);
    }

    /**
     * @inheritDoc
     */
    public function setState($state)
    {
        return $this->setData(self::STATE, $state);
    }

    /**
     * @inheritDoc
     */
    public function getZip()
    {
        return $this->getData(self::ZIP);
    }

    /**
     * @inheritDoc
     */
    public function setZip($zip)
    {
        return $this->setData(self::ZIP, $zip);
    }

    /**
     * @inheritDoc
     */
    public function getCountry()
    {
        return $this->getData(self::COUNTRY);
    }

    /**
     * @inheritDoc
     */
    public function setCountry($country)
    {
        return $this->setData(self::COUNTRY, $country);
    }

    /**
     * @inheritDoc
     */
    public function getEmail()
    {
        return $this->getData(self::EMAIL);
    }

    /**
     * @inheritDoc
     */
    public function setEmail($email)
    {
        return $this->setData(self::EMAIL, $email);
    }

    /**
     * @inheritDoc
     */
    public function getPhone()
    {
        return $this->getData(self::PHONE);
    }

    /**
     * @inheritDoc
     */
    public function setPhone($phone)
    {
        return $this->setData(self::PHONE, $phone);
    }

    /**
     * @inheritDoc
     */
    public function getIsCommercialUse()
    {
        return $this->getData(self::IS_COMMERCIAL_USE);
    }

    /**
     * @inheritDoc
     */
    public function setIsCommercialUse($isCommercialUse)
    {
        return $this->setData(self::IS_COMMERCIAL_USE, $isCommercialUse);
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
