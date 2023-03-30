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
     * @inheritDoc
     */
    public function _construct()
    {
        $this->_init(\Variux\Warranty\Model\ResourceModel\WarrantyTransfer::class);
    }

    /**
     * @inheritDoc
     */
    public function getWarrantytransferId()
    {
        return $this->getData(self::WARRANTYTRANSFER_ID);
    }

    /**
     * @inheritDoc
     */
    public function setWarrantytransferId($warrantytransferId)
    {
        return $this->setData(self::WARRANTYTRANSFER_ID, $warrantytransferId);
    }

    /**
     * @inheritDoc
     */
    public function getEngineSerialNum()
    {
        return $this->getData(self::ENGINE_SERIAL_NUM);
    }

    /**
     * @inheritDoc
     */
    public function setEngineSerialNum($engineSerialNum)
    {
        return $this->setData(self::ENGINE_SERIAL_NUM, $engineSerialNum);
    }

    /**
     * @inheritDoc
     */
    public function getSubmitterEmail()
    {
        return $this->getData(self::SUBMITTER_EMAIL);
    }

    /**
     * @inheritDoc
     */
    public function setSubmitterEmail($submitterEmail)
    {
        return $this->setData(self::SUBMITTER_EMAIL, $submitterEmail);
    }

    /**
     * @inheritDoc
     */
    public function getSubmitterName()
    {
        return $this->getData(self::SUBMITTER_NAME);
    }

    /**
     * @inheritDoc
     */
    public function setSubmitterName($submitterName)
    {
        return $this->setData(self::SUBMITTER_NAME, $submitterName);
    }

    /**
     * @inheritDoc
     */
    public function getEngineHours()
    {
        return $this->getData(self::ENGINE_HOURS);
    }

    /**
     * @inheritDoc
     */
    public function setEngineHours($engineHours)
    {
        return $this->setData(self::ENGINE_HOURS, $engineHours);
    }

    /**
     * @inheritDoc
     */
    public function getEngineModel()
    {
        return $this->getData(self::ENGINE_MODEL);
    }

    /**
     * @inheritDoc
     */
    public function setEngineModel($engineModel)
    {
        return $this->setData(self::ENGINE_MODEL, $engineModel);
    }

    /**
     * @inheritDoc
     */
    public function getTransSn()
    {
        return $this->getData(self::TRANS_SN);
    }

    /**
     * @inheritDoc
     */
    public function setTransSn($transSn)
    {
        return $this->setData(self::TRANS_SN, $transSn);
    }

    /**
     * @inheritDoc
     */
    public function getMakeOfBoat()
    {
        return $this->getData(self::MAKE_OF_BOAT);
    }

    /**
     * @inheritDoc
     */
    public function setMakeOfBoat($makeOfBoat)
    {
        return $this->setData(self::MAKE_OF_BOAT, $makeOfBoat);
    }

    /**
     * @inheritDoc
     */
    public function getBoatUse()
    {
        return $this->getData(self::BOAT_USE);
    }

    /**
     * @inheritDoc
     */
    public function setBoatUse($boatUse)
    {
        return $this->setData(self::BOAT_USE, $boatUse);
    }

    /**
     * @inheritDoc
     */
    public function getCurrentCustomer()
    {
        return $this->getData(self::CURRENT_CUSTOMER);
    }

    /**
     * @inheritDoc
     */
    public function setCurrentCustomer($currentCustomer)
    {
        return $this->setData(self::CURRENT_CUSTOMER, $currentCustomer);
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
    public function getSubmitDate()
    {
        return $this->getData(self::SUBMIT_DATE);
    }

    /**
     * @inheritDoc
     */
    public function setSubmitDate($submitDate)
    {
        return $this->setData(self::SUBMIT_DATE, $submitDate);
    }

    /**
     * @inheritDoc
     */
    public function getInspectionDate()
    {
        return $this->getData(self::INSPECTION_DATE);
    }

    /**
     * @inheritDoc
     */
    public function setInspectionDate($inspectionDate)
    {
        return $this->setData(self::INSPECTION_DATE, $inspectionDate);
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
    public function getEngComp1()
    {
        return $this->getData(self::ENG_COMP_1);
    }

    /**
     * @inheritDoc
     */
    public function setEngComp1($engComp1)
    {
        return $this->setData(self::ENG_COMP_1, $engComp1);
    }

    /**
     * @inheritDoc
     */
    public function getEngComp2()
    {
        return $this->getData(self::ENG_COMP_2);
    }

    /**
     * @inheritDoc
     */
    public function setEngComp2($engComp2)
    {
        return $this->setData(self::ENG_COMP_2, $engComp2);
    }

    /**
     * @inheritDoc
     */
    public function getEngComp3()
    {
        return $this->getData(self::ENG_COMP_3);
    }

    /**
     * @inheritDoc
     */
    public function setEngComp3($engComp3)
    {
        return $this->setData(self::ENG_COMP_3, $engComp3);
    }

    /**
     * @inheritDoc
     */
    public function getEngComp4()
    {
        return $this->getData(self::ENG_COMP_4);
    }

    /**
     * @inheritDoc
     */
    public function setEngComp4($engComp4)
    {
        return $this->setData(self::ENG_COMP_4, $engComp4);
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
    public function getPhoneExt()
    {
        return $this->getData(self::PHONE_EXT);
    }

    /**
     * @inheritDoc
     */
    public function setPhoneExt($phoneExt)
    {
        return $this->setData(self::PHONE_EXT, $phoneExt);
    }

    /**
     * @inheritDoc
     */
    public function getSaleDate()
    {
        return $this->getData(self::SALE_DATE);
    }

    /**
     * @inheritDoc
     */
    public function setSaleDate($saleDate)
    {
        return $this->setData(self::SALE_DATE, $saleDate);
    }

    /**
     * @inheritDoc
     */
    public function getAddress1()
    {
        return $this->getData(self::ADDRESS_1);
    }

    /**
     * @inheritDoc
     */
    public function setAddress1($address1)
    {
        return $this->setData(self::ADDRESS_1, $address1);
    }

    /**
     * @inheritDoc
     */
    public function getAddress2()
    {
        return $this->getData(self::ADDRESS_2);
    }

    /**
     * @inheritDoc
     */
    public function setAddress2($address2)
    {
        return $this->setData(self::ADDRESS_2, $address2);
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
    public function getRowPointer()
    {
        return $this->getData(self::ROW_POINTER);
    }

    /**
     * @inheritDoc
     */
    public function setRowPointer($rowPointer)
    {
        return $this->setData(self::ROW_POINTER, $rowPointer);
    }

    /**
     * @inheritDoc
     */
    public function getFilePathJson()
    {
        return $this->getData(self::FILE_PATH_JSON);
    }

    /**
     * @inheritDoc
     */
    public function setFilePathJson($filePathJson)
    {
        return $this->setData(self::FILE_PATH_JSON, $filePathJson);
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