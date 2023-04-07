<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Variux\Warranty\Model;

use Magento\Framework\Model\AbstractModel;
use Variux\Warranty\Api\Data\WarrantyTransferInterface;

class WarrantyTransfer extends AbstractModel implements WarrantyTransferInterface
{

    /**
     * @return void
     */
    public function _construct()
    {
        $this->_init(\Variux\Warranty\Model\ResourceModel\WarrantyTransfer::class);
    }

    /**
     * @return array|mixed|string|null
     */
    public function getWarrantytransferId()
    {
        return $this->getData(self::WARRANTYTRANSFER_ID);
    }

    /**
     * @param $warrantytransferId
     * @return WarrantyTransfer|\Variux\Warranty\WarrantyTransfer\Api\Data\WarrantyTransferInterface
     */
    public function setWarrantytransferId($warrantytransferId)
    {
        return $this->setData(self::WARRANTYTRANSFER_ID, $warrantytransferId);
    }

    /**
     * @return array|mixed|string|null
     */
    public function getEngineSerialNum()
    {
        return $this->getData(self::ENGINE_SERIAL_NUM);
    }

    /**
     * @param $engineSerialNum
     * @return WarrantyTransfer|\Variux\Warranty\WarrantyTransfer\Api\Data\WarrantyTransferInterface
     */
    public function setEngineSerialNum($engineSerialNum)
    {
        return $this->setData(self::ENGINE_SERIAL_NUM, $engineSerialNum);
    }

    /**
     * @return array|mixed|string|null
     */
    public function getSubmitterEmail()
    {
        return $this->getData(self::SUBMITTER_EMAIL);
    }

    /**
     * @param $submitterEmail
     * @return WarrantyTransfer|\Variux\Warranty\WarrantyTransfer\Api\Data\WarrantyTransferInterface
     */
    public function setSubmitterEmail($submitterEmail)
    {
        return $this->setData(self::SUBMITTER_EMAIL, $submitterEmail);
    }

    /**
     * @return array|mixed|string|null
     */
    public function getSubmitterName()
    {
        return $this->getData(self::SUBMITTER_NAME);
    }

    /**
     * @param $submitterName
     * @return WarrantyTransfer|\Variux\Warranty\WarrantyTransfer\Api\Data\WarrantyTransferInterface
     */
    public function setSubmitterName($submitterName)
    {
        return $this->setData(self::SUBMITTER_NAME, $submitterName);
    }

    /**
     * @return array|mixed|string|null
     */
    public function getEngineHours()
    {
        return $this->getData(self::ENGINE_HOURS);
    }

    /**
     * @param $engineHours
     * @return WarrantyTransfer|\Variux\Warranty\WarrantyTransfer\Api\Data\WarrantyTransferInterface
     */
    public function setEngineHours($engineHours)
    {
        return $this->setData(self::ENGINE_HOURS, $engineHours);
    }

    /**
     * @return array|mixed|string|null
     */
    public function getEngineModel()
    {
        return $this->getData(self::ENGINE_MODEL);
    }

    /**
     * @param $engineModel
     * @return WarrantyTransfer|\Variux\Warranty\WarrantyTransfer\Api\Data\WarrantyTransferInterface
     */
    public function setEngineModel($engineModel)
    {
        return $this->setData(self::ENGINE_MODEL, $engineModel);
    }

    /**
     * @return array|mixed|string|null
     */
    public function getTransSn()
    {
        return $this->getData(self::TRANS_SN);
    }

    /**
     * @param $transSn
     * @return WarrantyTransfer|\Variux\Warranty\WarrantyTransfer\Api\Data\WarrantyTransferInterface
     */
    public function setTransSn($transSn)
    {
        return $this->setData(self::TRANS_SN, $transSn);
    }

    /**
     * @return array|mixed|string|null
     */
    public function getMakeOfBoat()
    {
        return $this->getData(self::MAKE_OF_BOAT);
    }

    /**
     * @param $makeOfBoat
     * @return WarrantyTransfer|\Variux\Warranty\WarrantyTransfer\Api\Data\WarrantyTransferInterface
     */
    public function setMakeOfBoat($makeOfBoat)
    {
        return $this->setData(self::MAKE_OF_BOAT, $makeOfBoat);
    }

    /**
     * @return array|mixed|string|null
     */
    public function getBoatUse()
    {
        return $this->getData(self::BOAT_USE);
    }

    /**
     * @param $boatUse
     * @return WarrantyTransfer|\Variux\Warranty\WarrantyTransfer\Api\Data\WarrantyTransferInterface
     */
    public function setBoatUse($boatUse)
    {
        return $this->setData(self::BOAT_USE, $boatUse);
    }

    /**
     * @return array|mixed|string|null
     */
    public function getCurrentCustomer()
    {
        return $this->getData(self::CURRENT_CUSTOMER);
    }

    /**
     * @param $currentCustomer
     * @return WarrantyTransfer|\Variux\Warranty\WarrantyTransfer\Api\Data\WarrantyTransferInterface
     */
    public function setCurrentCustomer($currentCustomer)
    {
        return $this->setData(self::CURRENT_CUSTOMER, $currentCustomer);
    }

    /**
     * @return array|mixed|string|null
     */
    public function getWarrantyStartDate()
    {
        return $this->getData(self::WARRANTY_START_DATE);
    }

    /**
     * @param $warrantyStartDate
     * @return WarrantyTransfer|\Variux\Warranty\WarrantyTransfer\Api\Data\WarrantyTransferInterface
     */
    public function setWarrantyStartDate($warrantyStartDate)
    {
        return $this->setData(self::WARRANTY_START_DATE, $warrantyStartDate);
    }

    /**
     * @return array|mixed|string|null
     */
    public function getWarrantyEndDate()
    {
        return $this->getData(self::WARRANTY_END_DATE);
    }

    /**
     * @param $warrantyEndDate
     * @return WarrantyTransfer|\Variux\Warranty\WarrantyTransfer\Api\Data\WarrantyTransferInterface
     */
    public function setWarrantyEndDate($warrantyEndDate)
    {
        return $this->setData(self::WARRANTY_END_DATE, $warrantyEndDate);
    }

    /**
     * @return array|mixed|string|null
     */
    public function getSubmitDate()
    {
        return $this->getData(self::SUBMIT_DATE);
    }

    /**
     * @param $submitDate
     * @return WarrantyTransfer|\Variux\Warranty\WarrantyTransfer\Api\Data\WarrantyTransferInterface
     */
    public function setSubmitDate($submitDate)
    {
        return $this->setData(self::SUBMIT_DATE, $submitDate);
    }

    /**
     * @return array|mixed|string|null
     */
    public function getInspectionDate()
    {
        return $this->getData(self::INSPECTION_DATE);
    }

    /**
     * @param $inspectionDate
     * @return WarrantyTransfer|\Variux\Warranty\WarrantyTransfer\Api\Data\WarrantyTransferInterface
     */
    public function setInspectionDate($inspectionDate)
    {
        return $this->setData(self::INSPECTION_DATE, $inspectionDate);
    }

    /**
     * @return array|mixed|string|null
     */
    public function getHullId()
    {
        return $this->getData(self::HULL_ID);
    }

    /**
     * @param $hullId
     * @return WarrantyTransfer|\Variux\Warranty\WarrantyTransfer\Api\Data\WarrantyTransferInterface
     */
    public function setHullId($hullId)
    {
        return $this->setData(self::HULL_ID, $hullId);
    }

    /**
     * @return array|mixed|string|null
     */
    public function getEngComp1()
    {
        return $this->getData(self::ENG_COMP_1);
    }

    /**
     * @param $engComp1
     * @return WarrantyTransfer|\Variux\Warranty\WarrantyTransfer\Api\Data\WarrantyTransferInterface
     */
    public function setEngComp1($engComp1)
    {
        return $this->setData(self::ENG_COMP_1, $engComp1);
    }

    /**
     * @return array|mixed|string|null
     */
    public function getEngComp2()
    {
        return $this->getData(self::ENG_COMP_2);
    }

    /**
     * @param $engComp2
     * @return WarrantyTransfer|\Variux\Warranty\WarrantyTransfer\Api\Data\WarrantyTransferInterface
     */
    public function setEngComp2($engComp2)
    {
        return $this->setData(self::ENG_COMP_2, $engComp2);
    }

    /**
     * @return array|mixed|string|null
     */
    public function getEngComp3()
    {
        return $this->getData(self::ENG_COMP_3);
    }

    /**
     * @param $engComp3
     * @return WarrantyTransfer|\Variux\Warranty\WarrantyTransfer\Api\Data\WarrantyTransferInterface
     */
    public function setEngComp3($engComp3)
    {
        return $this->setData(self::ENG_COMP_3, $engComp3);
    }

    /**
     * @return array|mixed|string|null
     */
    public function getEngComp4()
    {
        return $this->getData(self::ENG_COMP_4);
    }

    /**
     * @param $engComp4
     * @return WarrantyTransfer|\Variux\Warranty\WarrantyTransfer\Api\Data\WarrantyTransferInterface
     */
    public function setEngComp4($engComp4)
    {
        return $this->setData(self::ENG_COMP_4, $engComp4);
    }

    /**
     * @return array|mixed|string|null
     */
    public function getName()
    {
        return $this->getData(self::NAME);
    }

    /**
     * @param $name
     * @return WarrantyTransfer|\Variux\Warranty\WarrantyTransfer\Api\Data\WarrantyTransferInterface
     */
    public function setName($name)
    {
        return $this->setData(self::NAME, $name);
    }

    /**
     * @return array|mixed|string|null
     */
    public function getEmail()
    {
        return $this->getData(self::EMAIL);
    }

    /**
     * @param $email
     * @return WarrantyTransfer|\Variux\Warranty\WarrantyTransfer\Api\Data\WarrantyTransferInterface
     */
    public function setEmail($email)
    {
        return $this->setData(self::EMAIL, $email);
    }

    /**
     * @return array|mixed|string|null
     */
    public function getPhone()
    {
        return $this->getData(self::PHONE);
    }

    /**
     * @param $phone
     * @return WarrantyTransfer|\Variux\Warranty\WarrantyTransfer\Api\Data\WarrantyTransferInterface
     */
    public function setPhone($phone)
    {
        return $this->setData(self::PHONE, $phone);
    }

    /**
     * @return array|mixed|string|null
     */
    public function getPhoneExt()
    {
        return $this->getData(self::PHONE_EXT);
    }

    /**
     * @param $phoneExt
     * @return WarrantyTransfer|\Variux\Warranty\WarrantyTransfer\Api\Data\WarrantyTransferInterface
     */
    public function setPhoneExt($phoneExt)
    {
        return $this->setData(self::PHONE_EXT, $phoneExt);
    }

    /**
     * @return array|mixed|string|null
     */
    public function getSaleDate()
    {
        return $this->getData(self::SALE_DATE);
    }

    /**
     * @param $saleDate
     * @return WarrantyTransfer|\Variux\Warranty\WarrantyTransfer\Api\Data\WarrantyTransferInterface
     */
    public function setSaleDate($saleDate)
    {
        return $this->setData(self::SALE_DATE, $saleDate);
    }

    /**
     * @return array|mixed|string|null
     */
    public function getAddress1()
    {
        return $this->getData(self::ADDRESS_1);
    }

    /**
     * @param $address1
     * @return WarrantyTransfer|\Variux\Warranty\WarrantyTransfer\Api\Data\WarrantyTransferInterface
     */
    public function setAddress1($address1)
    {
        return $this->setData(self::ADDRESS_1, $address1);
    }

    /**
     * @return array|mixed|string|null
     */
    public function getAddress2()
    {
        return $this->getData(self::ADDRESS_2);
    }

    /**
     * @param $address2
     * @return WarrantyTransfer|\Variux\Warranty\WarrantyTransfer\Api\Data\WarrantyTransferInterface
     */
    public function setAddress2($address2)
    {
        return $this->setData(self::ADDRESS_2, $address2);
    }

    /**
     * @return array|mixed|string|null
     */
    public function getCity()
    {
        return $this->getData(self::CITY);
    }

    /**
     * @param $city
     * @return WarrantyTransfer|\Variux\Warranty\WarrantyTransfer\Api\Data\WarrantyTransferInterface
     */
    public function setCity($city)
    {
        return $this->setData(self::CITY, $city);
    }

    /**
     * @return array|mixed|string|null
     */
    public function getState()
    {
        return $this->getData(self::STATE);
    }

    /**
     * @param $state
     * @return WarrantyTransfer|\Variux\Warranty\WarrantyTransfer\Api\Data\WarrantyTransferInterface
     */
    public function setState($state)
    {
        return $this->setData(self::STATE, $state);
    }

    /**
     * @return array|mixed|string|null
     */
    public function getZip()
    {
        return $this->getData(self::ZIP);
    }

    /**
     * @param $zip
     * @return WarrantyTransfer|\Variux\Warranty\WarrantyTransfer\Api\Data\WarrantyTransferInterface
     */
    public function setZip($zip)
    {
        return $this->setData(self::ZIP, $zip);
    }

    /**
     * @return array|mixed|string|null
     */
    public function getCountry()
    {
        return $this->getData(self::COUNTRY);
    }

    /**
     * @param $country
     * @return WarrantyTransfer|\Variux\Warranty\WarrantyTransfer\Api\Data\WarrantyTransferInterface
     */
    public function setCountry($country)
    {
        return $this->setData(self::COUNTRY, $country);
    }

    /**
     * @return array|mixed|string|null
     */
    public function getStatus()
    {
        return $this->getData(self::STATUS);
    }

    /**
     * @param $status
     * @return WarrantyTransfer|\Variux\Warranty\WarrantyTransfer\Api\Data\WarrantyTransferInterface
     */
    public function setStatus($status)
    {
        return $this->setData(self::STATUS, $status);
    }

    /**
     * @return array|mixed|string|null
     */
    public function getRowPointer()
    {
        return $this->getData(self::ROW_POINTER);
    }

    /**
     * @param $rowPointer
     * @return WarrantyTransfer|\Variux\Warranty\WarrantyTransfer\Api\Data\WarrantyTransferInterface
     */
    public function setRowPointer($rowPointer)
    {
        return $this->setData(self::ROW_POINTER, $rowPointer);
    }

    /**
     * @return array|mixed|string|null
     */
    public function getFilePathJson()
    {
        return $this->getData(self::FILE_PATH_JSON);
    }

    /**
     * @param array $filePathJson
     * @return WarrantyTransfer|\Variux\Warranty\WarrantyTransfer\Api\Data\WarrantyTransferInterface
     */
    public function setFilePathJson($filePathJson)
    {
        return $this->setData(self::FILE_PATH_JSON, $filePathJson);
    }

    /**
     * @return array|mixed|string|null
     */
    public function getCompanyId()
    {
        return $this->getData(self::COMPANY_ID);
    }

    /**
     * @param $companyId
     * @return WarrantyTransfer|\Variux\Warranty\WarrantyTransfer\Api\Data\WarrantyTransferInterface
     */
    public function setCompanyId($companyId)
    {
        return $this->setData(self::COMPANY_ID, $companyId);
    }

    /**
     * @return array|mixed|string|null
     */
    public function getCreatedAt()
    {
        return $this->getData(self::CREATED_AT);
    }

    /**
     * @param $createdAt
     * @return WarrantyTransfer|\Variux\Warranty\WarrantyTransfer\Api\Data\WarrantyTransferInterface
     */
    public function setCreatedAt($createdAt)
    {
        return $this->setData(self::CREATED_AT, $createdAt);
    }

    /**
     * @return array|mixed|string|null
     */
    public function getUpdatedAt()
    {
        return $this->getData(self::UPDATED_AT);
    }

    /**
     * @param $updatedAt
     * @return WarrantyTransfer|\Variux\Warranty\WarrantyTransfer\Api\Data\WarrantyTransferInterface
     */
    public function setUpdatedAt($updatedAt)
    {
        return $this->setData(self::UPDATED_AT, $updatedAt);
    }
}
