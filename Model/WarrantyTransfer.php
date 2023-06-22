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
     * @var string
     */
    protected $_eventPrefix = 'variux_warranty_transfer';

    /**
     * Overwirte __construct class
     *
     * @return void
     */
    public function _construct()
    {
        $this->_init(\Variux\Warranty\Model\ResourceModel\WarrantyTransfer::class);
    }

    /**
     * Get warranty transfer id
     *
     * @return array|mixed|string|null
     */
    public function getWarrantytransferId()
    {
        return $this->getData(self::WARRANTYTRANSFER_ID);
    }

    /**
     * Set warrenty transfer id
     *
     * @param int $warrantytransferId
     * @return WarrantyTransfer|\Variux\Warranty\WarrantyTransfer\Api\Data\WarrantyTransferInterface
     */
    public function setWarrantytransferId($warrantytransferId)
    {
        return $this->setData(self::WARRANTYTRANSFER_ID, $warrantytransferId);
    }

    /**
     * Get Engine Serial Number
     *
     * @return array|mixed|string|null
     */
    public function getEngineSerialNum()
    {
        return $this->getData(self::ENGINE_SERIAL_NUM);
    }

    /**
     * Set Engine Serial Number
     *
     * @param string $engineSerialNum
     * @return WarrantyTransfer|\Variux\Warranty\WarrantyTransfer\Api\Data\WarrantyTransferInterface
     */
    public function setEngineSerialNum($engineSerialNum)
    {
        return $this->setData(self::ENGINE_SERIAL_NUM, $engineSerialNum);
    }

    /**
     * Set Submit Email
     *
     * @return array|mixed|string|null
     */
    public function getSubmitterEmail()
    {
        return $this->getData(self::SUBMITTER_EMAIL);
    }

    /**
     * Set Submit Email
     *
     * @param string $submitterEmail
     * @return WarrantyTransfer|\Variux\Warranty\WarrantyTransfer\Api\Data\WarrantyTransferInterface
     */
    public function setSubmitterEmail($submitterEmail)
    {
        return $this->setData(self::SUBMITTER_EMAIL, $submitterEmail);
    }

    /**
     * Get Submit Name
     *
     * @return array|mixed|string|null
     */
    public function getSubmitterName()
    {
        return $this->getData(self::SUBMITTER_NAME);
    }

    /**
     * Set Submit Name
     *
     * @param string $submitterName
     * @return WarrantyTransfer|\Variux\Warranty\WarrantyTransfer\Api\Data\WarrantyTransferInterface
     */
    public function setSubmitterName($submitterName)
    {
        return $this->setData(self::SUBMITTER_NAME, $submitterName);
    }

    /**
     * Get Engine Hours
     *
     * @return array|mixed|string|null
     */
    public function getEngineHours()
    {
        return $this->getData(self::ENGINE_HOURS);
    }

    /**
     * Set Engine Hours
     *
     * @param string $engineHours
     * @return WarrantyTransfer|\Variux\Warranty\WarrantyTransfer\Api\Data\WarrantyTransferInterface
     */
    public function setEngineHours($engineHours)
    {
        return $this->setData(self::ENGINE_HOURS, $engineHours);
    }

    /**
     * Get Engine Model
     *
     * @return array|mixed|string|null
     */
    public function getEngineModel()
    {
        return $this->getData(self::ENGINE_MODEL);
    }

    /**
     * Set Engine Model
     *
     * @param string $engineModel
     * @return WarrantyTransfer|\Variux\Warranty\WarrantyTransfer\Api\Data\WarrantyTransferInterface
     */
    public function setEngineModel($engineModel)
    {
        return $this->setData(self::ENGINE_MODEL, $engineModel);
    }

    /**
     * Get TransSn
     *
     * @return array|mixed|string|null
     */
    public function getTransSn()
    {
        return $this->getData(self::TRANS_SN);
    }

    /**
     * Set TransSn
     *
     * @param string $transSn
     * @return WarrantyTransfer|\Variux\Warranty\WarrantyTransfer\Api\Data\WarrantyTransferInterface
     */
    public function setTransSn($transSn)
    {
        return $this->setData(self::TRANS_SN, $transSn);
    }

    /**
     * Get Make of boat
     *
     * @return array|mixed|string|null
     */
    public function getMakeOfBoat()
    {
        return $this->getData(self::MAKE_OF_BOAT);
    }

    /**
     * Set Make of boat
     *
     * @param string $makeOfBoat
     * @return WarrantyTransfer|\Variux\Warranty\WarrantyTransfer\Api\Data\WarrantyTransferInterface
     */
    public function setMakeOfBoat($makeOfBoat)
    {
        return $this->setData(self::MAKE_OF_BOAT, $makeOfBoat);
    }

    /**
     * Get Boat use
     *
     * @return array|mixed|string|null
     */
    public function getBoatUse()
    {
        return $this->getData(self::BOAT_USE);
    }

    /**
     * Set Boat use
     *
     * @param string $boatUse
     * @return WarrantyTransfer|\Variux\Warranty\WarrantyTransfer\Api\Data\WarrantyTransferInterface
     */
    public function setBoatUse($boatUse)
    {
        return $this->setData(self::BOAT_USE, $boatUse);
    }

    /**
     * Get Current Customer
     *
     * @return array|mixed|string|null
     */
    public function getCurrentCustomer()
    {
        return $this->getData(self::CURRENT_CUSTOMER);
    }

    /**
     * Set Current Customer
     *
     * @param string $currentCustomer
     * @return WarrantyTransfer|\Variux\Warranty\WarrantyTransfer\Api\Data\WarrantyTransferInterface
     */
    public function setCurrentCustomer($currentCustomer)
    {
        return $this->setData(self::CURRENT_CUSTOMER, $currentCustomer);
    }

    /**
     * Get Warranty Start Date
     *
     * @return array|mixed|string|null
     */
    public function getWarrantyStartDate()
    {
        return $this->getData(self::WARRANTY_START_DATE);
    }

    /**
     * Set Warranty Start Date
     *
     * @param string $warrantyStartDate
     * @return WarrantyTransfer|\Variux\Warranty\WarrantyTransfer\Api\Data\WarrantyTransferInterface
     */
    public function setWarrantyStartDate($warrantyStartDate)
    {
        return $this->setData(self::WARRANTY_START_DATE, $warrantyStartDate);
    }

    /**
     * Get Warranty End Date
     *
     * @return array|mixed|string|null
     */
    public function getWarrantyEndDate()
    {
        return $this->getData(self::WARRANTY_END_DATE);
    }

    /**
     * Set Warranty End Date
     *
     * @param string $warrantyEndDate
     * @return WarrantyTransfer|\Variux\Warranty\WarrantyTransfer\Api\Data\WarrantyTransferInterface
     */
    public function setWarrantyEndDate($warrantyEndDate)
    {
        return $this->setData(self::WARRANTY_END_DATE, $warrantyEndDate);
    }

    /**
     * Get Submit Date
     *
     * @return array|mixed|string|null
     */
    public function getSubmitDate()
    {
        return $this->getData(self::SUBMIT_DATE);
    }

    /**
     * Set Submit Date
     *
     * @param string $submitDate
     * @return WarrantyTransfer|\Variux\Warranty\WarrantyTransfer\Api\Data\WarrantyTransferInterface
     */
    public function setSubmitDate($submitDate)
    {
        return $this->setData(self::SUBMIT_DATE, $submitDate);
    }

    /**
     * Get Inspection Date
     *
     * @return array|mixed|string|null
     */
    public function getInspectionDate()
    {
        return $this->getData(self::INSPECTION_DATE);
    }

    /**
     * Set Inspection Date
     *
     * @param string $inspectionDate
     * @return WarrantyTransfer|\Variux\Warranty\WarrantyTransfer\Api\Data\WarrantyTransferInterface
     */
    public function setInspectionDate($inspectionDate)
    {
        return $this->setData(self::INSPECTION_DATE, $inspectionDate);
    }

    /**
     * Get Hull Id
     *
     * @return array|mixed|string|null
     */
    public function getHullId()
    {
        return $this->getData(self::HULL_ID);
    }

    /**
     * Set Hull Id
     *
     * @param int $hullId
     * @return WarrantyTransfer|\Variux\Warranty\WarrantyTransfer\Api\Data\WarrantyTransferInterface
     */
    public function setHullId($hullId)
    {
        return $this->setData(self::HULL_ID, $hullId);
    }

    /**
     * Get Eng Comp1
     *
     * @return array|mixed|string|null
     */
    public function getEngComp1()
    {
        return $this->getData(self::ENG_COMP_1);
    }

    /**
     * Set Eng Comp1
     *
     * @param string $engComp1
     * @return WarrantyTransfer|\Variux\Warranty\WarrantyTransfer\Api\Data\WarrantyTransferInterface
     */
    public function setEngComp1($engComp1)
    {
        return $this->setData(self::ENG_COMP_1, $engComp1);
    }

    /**
     * Get Eng Comp2
     *
     * @return array|mixed|string|null
     */
    public function getEngComp2()
    {
        return $this->getData(self::ENG_COMP_2);
    }

    /**
     * Set Eng Comp2
     *
     * @param string $engComp2
     * @return WarrantyTransfer|\Variux\Warranty\WarrantyTransfer\Api\Data\WarrantyTransferInterface
     */
    public function setEngComp2($engComp2)
    {
        return $this->setData(self::ENG_COMP_2, $engComp2);
    }

    /**
     * Get Eng Comp3
     *
     * @return array|mixed|string|null
     */
    public function getEngComp3()
    {
        return $this->getData(self::ENG_COMP_3);
    }

    /**
     * Set Eng Comp2
     *
     * @param string $engComp3
     * @return WarrantyTransfer|\Variux\Warranty\WarrantyTransfer\Api\Data\WarrantyTransferInterface
     */
    public function setEngComp3($engComp3)
    {
        return $this->setData(self::ENG_COMP_3, $engComp3);
    }

    /**
     * Get Eng Comp4
     *
     * @return array|mixed|string|null
     */
    public function getEngComp4()
    {
        return $this->getData(self::ENG_COMP_4);
    }

    /**
     * Set Eng Comp4
     *
     * @param string $engComp4
     * @return WarrantyTransfer|\Variux\Warranty\WarrantyTransfer\Api\Data\WarrantyTransferInterface
     */
    public function setEngComp4($engComp4)
    {
        return $this->setData(self::ENG_COMP_4, $engComp4);
    }

    /**
     * Get Name
     *
     * @return array|mixed|string|null
     */
    public function getName()
    {
        return $this->getData(self::NAME);
    }

    /**
     * Set Name
     *
     * @param string $name
     * @return WarrantyTransfer|\Variux\Warranty\WarrantyTransfer\Api\Data\WarrantyTransferInterface
     */
    public function setName($name)
    {
        return $this->setData(self::NAME, $name);
    }

    /**
     * Get Email
     *
     * @return array|mixed|string|null
     */
    public function getEmail()
    {
        return $this->getData(self::EMAIL);
    }

    /**
     * Set Email
     *
     * @param string $email
     * @return WarrantyTransfer|\Variux\Warranty\WarrantyTransfer\Api\Data\WarrantyTransferInterface
     */
    public function setEmail($email)
    {
        return $this->setData(self::EMAIL, $email);
    }

    /**
     * Get Phone
     *
     * @return array|mixed|string|null
     */
    public function getPhone()
    {
        return $this->getData(self::PHONE);
    }

    /**
     * Set Phone
     *
     * @param string $phone
     * @return WarrantyTransfer|\Variux\Warranty\WarrantyTransfer\Api\Data\WarrantyTransferInterface
     */
    public function setPhone($phone)
    {
        return $this->setData(self::PHONE, $phone);
    }

    /**
     * Get Phone Ext
     *
     * @return array|mixed|string|null
     */
    public function getPhoneExt()
    {
        return $this->getData(self::PHONE_EXT);
    }

    /**
     * Set Phone Ext
     *
     * @param string $phoneExt
     * @return WarrantyTransfer|\Variux\Warranty\WarrantyTransfer\Api\Data\WarrantyTransferInterface
     */
    public function setPhoneExt($phoneExt)
    {
        return $this->setData(self::PHONE_EXT, $phoneExt);
    }

    /**
     * Get Sale Date
     *
     * @return array|mixed|string|null
     */
    public function getSaleDate()
    {
        return $this->getData(self::SALE_DATE);
    }

    /**
     * Set Sale Date
     *
     * @param string $saleDate
     * @return WarrantyTransfer|\Variux\Warranty\WarrantyTransfer\Api\Data\WarrantyTransferInterface
     */
    public function setSaleDate($saleDate)
    {
        return $this->setData(self::SALE_DATE, $saleDate);
    }

    /**
     * Get Address 1
     *
     * @return array|mixed|string|null
     */
    public function getAddress1()
    {
        return $this->getData(self::ADDRESS_1);
    }

    /**
     * Set Address 1
     *
     * @param string $address1
     * @return WarrantyTransfer|\Variux\Warranty\WarrantyTransfer\Api\Data\WarrantyTransferInterface
     */
    public function setAddress1($address1)
    {
        return $this->setData(self::ADDRESS_1, $address1);
    }

    /**
     * Get Address 2
     *
     * @return array|mixed|string|null
     */
    public function getAddress2()
    {
        return $this->getData(self::ADDRESS_2);
    }

    /**
     * Set Address 2
     *
     * @param string $address2
     * @return WarrantyTransfer|\Variux\Warranty\WarrantyTransfer\Api\Data\WarrantyTransferInterface
     */
    public function setAddress2($address2)
    {
        return $this->setData(self::ADDRESS_2, $address2);
    }

    /**
     * Get City
     *
     * @return array|mixed|string|null
     */
    public function getCity()
    {
        return $this->getData(self::CITY);
    }

    /**
     * Set City
     *
     * @param string $city
     * @return WarrantyTransfer|\Variux\Warranty\WarrantyTransfer\Api\Data\WarrantyTransferInterface
     */
    public function setCity($city)
    {
        return $this->setData(self::CITY, $city);
    }

    /**
     * Get State
     *
     * @return array|mixed|string|null
     */
    public function getState()
    {
        return $this->getData(self::STATE);
    }

    /**
     * Set State
     *
     * @param string $state
     * @return WarrantyTransfer|\Variux\Warranty\WarrantyTransfer\Api\Data\WarrantyTransferInterface
     */
    public function setState($state)
    {
        return $this->setData(self::STATE, $state);
    }

    /**
     * Get Zip
     *
     * @return array|mixed|string|null
     */
    public function getZip()
    {
        return $this->getData(self::ZIP);
    }

    /**
     * Set Zip
     *
     * @param string $zip
     * @return WarrantyTransfer|\Variux\Warranty\WarrantyTransfer\Api\Data\WarrantyTransferInterface
     */
    public function setZip($zip)
    {
        return $this->setData(self::ZIP, $zip);
    }

    /**
     * Get Country
     *
     * @return array|mixed|string|null
     */
    public function getCountry()
    {
        return $this->getData(self::COUNTRY);
    }

    /**
     * Set Country
     *
     * @param string $country
     * @return WarrantyTransfer|\Variux\Warranty\WarrantyTransfer\Api\Data\WarrantyTransferInterface
     */
    public function setCountry($country)
    {
        return $this->setData(self::COUNTRY, $country);
    }

    /**
     * Get Status
     *
     * @return array|mixed|string|null
     */
    public function getStatus()
    {
        return $this->getData(self::STATUS);
    }

    /**
     * Set Status
     *
     * @param string $status
     * @return WarrantyTransfer|\Variux\Warranty\WarrantyTransfer\Api\Data\WarrantyTransferInterface
     */
    public function setStatus($status)
    {
        return $this->setData(self::STATUS, $status);
    }

    /**
     * Get Row Pointer
     *
     * @return array|mixed|string|null
     */
    public function getRowPointer()
    {
        return $this->getData(self::ROW_POINTER);
    }

    /**
     * Set Row Pointer
     *
     * @param string $rowPointer
     * @return WarrantyTransfer|\Variux\Warranty\WarrantyTransfer\Api\Data\WarrantyTransferInterface
     */
    public function setRowPointer($rowPointer)
    {
        return $this->setData(self::ROW_POINTER, $rowPointer);
    }

    /**
     * Get File Path Json
     *
     * @return array|mixed|string|null
     */
    public function getFilePathJson()
    {
        return $this->getData(self::FILE_PATH_JSON);
    }

    /**
     * Set File Path Json
     *
     * @param array $filePathJson
     * @return WarrantyTransfer|\Variux\Warranty\WarrantyTransfer\Api\Data\WarrantyTransferInterface
     */
    public function setFilePathJson($filePathJson)
    {
        return $this->setData(self::FILE_PATH_JSON, json_encode($filePathJson));
    }

    /**
     * Get Company id
     *
     * @return array|mixed|string|null
     */
    public function getCompanyId()
    {
        return $this->getData(self::COMPANY_ID);
    }

    /**
     * Set Company id
     *
     * @param string $companyId
     * @return WarrantyTransfer|\Variux\Warranty\WarrantyTransfer\Api\Data\WarrantyTransferInterface
     */
    public function setCompanyId($companyId)
    {
        return $this->setData(self::COMPANY_ID, $companyId);
    }

    /**
     * Get Create at
     *
     * @return array|mixed|string|null
     */
    public function getCreatedAt()
    {
        return $this->getData(self::CREATED_AT);
    }

    /**
     * Set Create at
     *
     * @param string $createdAt
     * @return WarrantyTransfer|\Variux\Warranty\WarrantyTransfer\Api\Data\WarrantyTransferInterface
     */
    public function setCreatedAt($createdAt)
    {
        return $this->setData(self::CREATED_AT, $createdAt);
    }

    /**
     * Get Update at
     *
     * @return array|mixed|string|null
     */
    public function getUpdatedAt()
    {
        return $this->getData(self::UPDATED_AT);
    }

    /**
     * Set Update at
     *
     * @param string $updatedAt
     * @return WarrantyTransfer|\Variux\Warranty\WarrantyTransfer\Api\Data\WarrantyTransferInterface
     */
    public function setUpdatedAt($updatedAt)
    {
        return $this->setData(self::UPDATED_AT, $updatedAt);
    }
}
