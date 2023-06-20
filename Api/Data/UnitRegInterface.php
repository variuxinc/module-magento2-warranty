<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Variux\Warranty\Api\Data;

interface UnitRegInterface
{
    public const ITEM = 'item';
    public const REJECTED = 'rejected';
    public const ADDRESS3 = 'address3';
    public const CREATED_AT = 'created_at';
    public const CITY = 'city';
    public const HULL_ID = 'hull_id';
    public const POSTED = 'posted';
    public const STATE = 'state';
    public const COUNTRY = 'country';
    public const ERR_MSG = 'err_msg';
    public const ADDRESS2 = 'address2';
    public const ZIP = 'zip';
    public const EMAIL = 'email';
    public const TRANS_NUM = 'trans_num';
    public const PHONE = 'phone';
    public const ENGINE_HOUR = 'engine_hour';
    public const ADDRESS1 = 'address1';
    public const IS_COMMERCIAL_USE = 'is_commercial_use';
    public const REG_NOTES = 'reg_notes';
    public const UNITREG_ID = 'unitreg_id';
    public const ADDRESS4 = 'address4';
    public const NAME = 'name';
    public const DEALER_NAME = 'dealer_name';
    public const UPDATED_AT = 'updated_at';
    public const SERIAL_NO = 'serial_no';
    public const POST_DATE = 'post_date';

    /**
     * Get unitreg_id
     *
     * @return string|null
     */
    public function getUnitregId();

    /**
     * Set unitreg_id
     *
     * @param string $unitregId
     * @return \Variux\Warranty\UnitReg\Api\Data\UnitRegInterface
     */
    public function setUnitregId($unitregId);

    /**
     * Get hull_id
     *
     * @return string|null
     */
    public function getHullId();

    /**
     * Set hull_id
     *
     * @param string $hullId
     * @return \Variux\Warranty\UnitReg\Api\Data\UnitRegInterface
     */
    public function setHullId($hullId);

    /**
     * Get reg_notes
     *
     * @return string|null
     */
    public function getRegNotes();

    /**
     * Set reg_notes
     *
     * @param string $regNotes
     * @return \Variux\Warranty\UnitReg\Api\Data\UnitRegInterface
     */
    public function setRegNotes($regNotes);

    /**
     * Get engine_hour
     *
     * @return string|null
     */
    public function getEngineHour();

    /**
     * Set engine_hour
     *
     * @param string $engineHour
     * @return \Variux\Warranty\UnitReg\Api\Data\UnitRegInterface
     */
    public function setEngineHour($engineHour);

    /**
     * Get trans_num
     *
     * @return string|null
     */
    public function getTransNum();

    /**
     * Set trans_num
     *
     * @param string $transNum
     * @return \Variux\Warranty\UnitReg\Api\Data\UnitRegInterface
     */
    public function setTransNum($transNum);

    /**
     * Get serial_no
     *
     * @return string|null
     */
    public function getSerialNo();

    /**
     * Set serial_no
     *
     * @param string $serialNo
     * @return \Variux\Warranty\UnitReg\Api\Data\UnitRegInterface
     */
    public function setSerialNo($serialNo);

    /**
     * Get item
     *
     * @return string|null
     */
    public function getItem();

    /**
     * Set item
     *
     * @param string $item
     * @return \Variux\Warranty\UnitReg\Api\Data\UnitRegInterface
     */
    public function setItem($item);

    /**
     * Get posted
     *
     * @return string|null
     */
    public function getPosted();

    /**
     * Set posted
     *
     * @param string $posted
     * @return \Variux\Warranty\UnitReg\Api\Data\UnitRegInterface
     */
    public function setPosted($posted);

    /**
     * Get rejected
     *
     * @return string|null
     */
    public function getRejected();

    /**
     * Set rejected
     *
     * @param string $rejected
     * @return \Variux\Warranty\UnitReg\Api\Data\UnitRegInterface
     */
    public function setRejected($rejected);

    /**
     * Get post_date
     *
     * @return string|null
     */
    public function getPostDate();

    /**
     * Set post_date
     *
     * @param string $postDate
     * @return \Variux\Warranty\UnitReg\Api\Data\UnitRegInterface
     */
    public function setPostDate($postDate);

    /**
     * Get err_msg
     *
     * @return string|null
     */
    public function getErrMsg();

    /**
     * Set err_msg
     *
     * @param string $errMsg
     * @return \Variux\Warranty\UnitReg\Api\Data\UnitRegInterface
     */
    public function setErrMsg($errMsg);

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
     * @return \Variux\Warranty\UnitReg\Api\Data\UnitRegInterface
     */
    public function setName($name);

    /**
     * Get address1
     *
     * @return string|null
     */
    public function getAddress1();

    /**
     * Set address1
     *
     * @param string $address1
     * @return \Variux\Warranty\UnitReg\Api\Data\UnitRegInterface
     */
    public function setAddress1($address1);

    /**
     * Get address2
     *
     * @return string|null
     */
    public function getAddress2();

    /**
     * Set address2
     *
     * @param string $address2
     * @return \Variux\Warranty\UnitReg\Api\Data\UnitRegInterface
     */
    public function setAddress2($address2);

    /**
     * Get address3
     *
     * @return string|null
     */
    public function getAddress3();

    /**
     * Set address3
     *
     * @param string $address3
     * @return \Variux\Warranty\UnitReg\Api\Data\UnitRegInterface
     */
    public function setAddress3($address3);

    /**
     * Get address4
     *
     * @return string|null
     */
    public function getAddress4();

    /**
     * Set address4
     *
     * @param string $address4
     * @return \Variux\Warranty\UnitReg\Api\Data\UnitRegInterface
     */
    public function setAddress4($address4);

    /**
     * Get city
     *
     * @return string|null
     */
    public function getCity();

    /**
     * Set city
     *
     * @param string $city
     * @return \Variux\Warranty\UnitReg\Api\Data\UnitRegInterface
     */
    public function setCity($city);

    /**
     * Get state
     *
     * @return string|null
     */
    public function getState();

    /**
     * Set state
     *
     * @param string $state
     * @return \Variux\Warranty\UnitReg\Api\Data\UnitRegInterface
     */
    public function setState($state);

    /**
     * Get zip
     *
     * @return string|null
     */
    public function getZip();

    /**
     * Set zip
     *
     * @param string $zip
     * @return \Variux\Warranty\UnitReg\Api\Data\UnitRegInterface
     */
    public function setZip($zip);

    /**
     * Get country
     *
     * @return string|null
     */
    public function getCountry();

    /**
     * Set country
     *
     * @param string $country
     * @return \Variux\Warranty\UnitReg\Api\Data\UnitRegInterface
     */
    public function setCountry($country);

    /**
     * Get email
     *
     * @return string|null
     */
    public function getEmail();

    /**
     * Set email
     *
     * @param string $email
     * @return \Variux\Warranty\UnitReg\Api\Data\UnitRegInterface
     */
    public function setEmail($email);

    /**
     * Get phone
     *
     * @return string|null
     */
    public function getPhone();

    /**
     * Set phone
     *
     * @param string $phone
     * @return \Variux\Warranty\UnitReg\Api\Data\UnitRegInterface
     */
    public function setPhone($phone);

    /**
     * Get is_commercial_use
     *
     * @return string|null
     */
    public function getIsCommercialUse();

    /**
     * Set is_commercial_use
     *
     * @param string $isCommercialUse
     * @return \Variux\Warranty\UnitReg\Api\Data\UnitRegInterface
     */
    public function setIsCommercialUse($isCommercialUse);

    /**
     * Get dealer_name
     *
     * @return string|null
     */
    public function getDealerName();

    /**
     * Set dealer_name
     *
     * @param string $dealerName
     * @return \Variux\Warranty\UnitReg\Api\Data\UnitRegInterface
     */
    public function setDealerName($dealerName);

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
     * @return \Variux\Warranty\UnitReg\Api\Data\UnitRegInterface
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
     * @return \Variux\Warranty\UnitReg\Api\Data\UnitRegInterface
     */
    public function setUpdatedAt($updatedAt);
}
