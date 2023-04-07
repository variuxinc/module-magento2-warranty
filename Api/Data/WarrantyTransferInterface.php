<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Variux\Warranty\Api\Data;

interface WarrantyTransferInterface
{

    const ENG_COMP_4 = 'eng_comp_4';
    const WARRANTY_START_DATE = 'warranty_start_date';
    const WARRANTYTRANSFER_ID = 'warrantytransfer_id';
    const SUBMITTER_EMAIL = 'submitter_email';
    const TRANS_SN = 'trans_sn';
    const MAKE_OF_BOAT = 'make_of_boat';
    const CURRENT_CUSTOMER = 'current_customer';
    const CREATED_AT = 'created_at';
    const WARRANTY_END_DATE = 'warranty_end_date';
    const INSPECTION_DATE = 'inspection_date';
    const CITY = 'city';
    const ENG_COMP_1 = 'eng_comp_1';
    const COMPANY_ID = 'company_id';
    const HULL_ID = 'hull_id';
    const STATE = 'state';
    const PHONE_EXT = 'phone_ext';
    const COUNTRY = 'country';
    const ADDRESS_2 = 'address_2';
    const ENG_COMP_2 = 'eng_comp_2';
    const ADDRESS_1 = 'address_1';
    const ZIP = 'zip';
    const EMAIL = 'email';
    const PHONE = 'phone';
    const ENGINE_HOURS = 'engine_hours';
    const SALE_DATE = 'sale_date';
    const ENGINE_SERIAL_NUM = 'engine_serial_num';
    const ENG_COMP_3 = 'eng_comp_3';
    const BOAT_USE = 'boat_use';
    const SUBMIT_DATE = 'submit_date';
    const NAME = 'name';
    const STATUS = 'status';
    const FILE_PATH_JSON = 'file_path_json';
    const UPDATED_AT = 'updated_at';
    const SUBMITTER_NAME = 'submitter_name';
    const ROW_POINTER = 'row_pointer';
    const ENGINE_MODEL = 'engine_model';

    /**
     * Get warrantytransfer_id
     * @return string|null
     */
    public function getWarrantytransferId();

    /**
     * Set warrantytransfer_id
     * @param string $warrantytransferId
     * @return \Variux\Warranty\WarrantyTransfer\Api\Data\WarrantyTransferInterface
     */
    public function setWarrantytransferId($warrantytransferId);

    /**
     * Get engine_serial_num
     * @return string|null
     */
    public function getEngineSerialNum();

    /**
     * Set engine_serial_num
     * @param string $engineSerialNum
     * @return \Variux\Warranty\WarrantyTransfer\Api\Data\WarrantyTransferInterface
     */
    public function setEngineSerialNum($engineSerialNum);

    /**
     * Get submitter_email
     * @return string|null
     */
    public function getSubmitterEmail();

    /**
     * Set submitter_email
     * @param string $submitterEmail
     * @return \Variux\Warranty\WarrantyTransfer\Api\Data\WarrantyTransferInterface
     */
    public function setSubmitterEmail($submitterEmail);

    /**
     * Get submitter_name
     * @return string|null
     */
    public function getSubmitterName();

    /**
     * Set submitter_name
     * @param string $submitterName
     * @return \Variux\Warranty\WarrantyTransfer\Api\Data\WarrantyTransferInterface
     */
    public function setSubmitterName($submitterName);

    /**
     * Get engine_hours
     * @return string|null
     */
    public function getEngineHours();

    /**
     * Set engine_hours
     * @param string $engineHours
     * @return \Variux\Warranty\WarrantyTransfer\Api\Data\WarrantyTransferInterface
     */
    public function setEngineHours($engineHours);

    /**
     * Get engine_model
     * @return string|null
     */
    public function getEngineModel();

    /**
     * Set engine_model
     * @param string $engineModel
     * @return \Variux\Warranty\WarrantyTransfer\Api\Data\WarrantyTransferInterface
     */
    public function setEngineModel($engineModel);

    /**
     * Get trans_sn
     * @return string|null
     */
    public function getTransSn();

    /**
     * Set trans_sn
     * @param string $transSn
     * @return \Variux\Warranty\WarrantyTransfer\Api\Data\WarrantyTransferInterface
     */
    public function setTransSn($transSn);

    /**
     * Get make_of_boat
     * @return string|null
     */
    public function getMakeOfBoat();

    /**
     * Set make_of_boat
     * @param string $makeOfBoat
     * @return \Variux\Warranty\WarrantyTransfer\Api\Data\WarrantyTransferInterface
     */
    public function setMakeOfBoat($makeOfBoat);

    /**
     * Get boat_use
     * @return string|null
     */
    public function getBoatUse();

    /**
     * Set boat_use
     * @param string $boatUse
     * @return \Variux\Warranty\WarrantyTransfer\Api\Data\WarrantyTransferInterface
     */
    public function setBoatUse($boatUse);

    /**
     * Get current_customer
     * @return string|null
     */
    public function getCurrentCustomer();

    /**
     * Set current_customer
     * @param string $currentCustomer
     * @return \Variux\Warranty\WarrantyTransfer\Api\Data\WarrantyTransferInterface
     */
    public function setCurrentCustomer($currentCustomer);

    /**
     * Get warranty_start_date
     * @return string|null
     */
    public function getWarrantyStartDate();

    /**
     * Set warranty_start_date
     * @param string $warrantyStartDate
     * @return \Variux\Warranty\WarrantyTransfer\Api\Data\WarrantyTransferInterface
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
     * @return \Variux\Warranty\WarrantyTransfer\Api\Data\WarrantyTransferInterface
     */
    public function setWarrantyEndDate($warrantyEndDate);

    /**
     * Get submit_date
     * @return string|null
     */
    public function getSubmitDate();

    /**
     * Set submit_date
     * @param string $submitDate
     * @return \Variux\Warranty\WarrantyTransfer\Api\Data\WarrantyTransferInterface
     */
    public function setSubmitDate($submitDate);

    /**
     * Get inspection_date
     * @return string|null
     */
    public function getInspectionDate();

    /**
     * Set inspection_date
     * @param string $inspectionDate
     * @return \Variux\Warranty\WarrantyTransfer\Api\Data\WarrantyTransferInterface
     */
    public function setInspectionDate($inspectionDate);

    /**
     * Get hull_id
     * @return string|null
     */
    public function getHullId();

    /**
     * Set hull_id
     * @param string $hullId
     * @return \Variux\Warranty\WarrantyTransfer\Api\Data\WarrantyTransferInterface
     */
    public function setHullId($hullId);

    /**
     * Get eng_comp_1
     * @return string|null
     */
    public function getEngComp1();

    /**
     * Set eng_comp_1
     * @param string $engComp1
     * @return \Variux\Warranty\WarrantyTransfer\Api\Data\WarrantyTransferInterface
     */
    public function setEngComp1($engComp1);

    /**
     * Get eng_comp_2
     * @return string|null
     */
    public function getEngComp2();

    /**
     * Set eng_comp_2
     * @param string $engComp2
     * @return \Variux\Warranty\WarrantyTransfer\Api\Data\WarrantyTransferInterface
     */
    public function setEngComp2($engComp2);

    /**
     * Get eng_comp_3
     * @return string|null
     */
    public function getEngComp3();

    /**
     * Set eng_comp_3
     * @param string $engComp3
     * @return \Variux\Warranty\WarrantyTransfer\Api\Data\WarrantyTransferInterface
     */
    public function setEngComp3($engComp3);

    /**
     * Get eng_comp_4
     * @return string|null
     */
    public function getEngComp4();

    /**
     * Set eng_comp_4
     * @param string $engComp4
     * @return \Variux\Warranty\WarrantyTransfer\Api\Data\WarrantyTransferInterface
     */
    public function setEngComp4($engComp4);

    /**
     * Get name
     * @return string|null
     */
    public function getName();

    /**
     * Set name
     * @param string $name
     * @return \Variux\Warranty\WarrantyTransfer\Api\Data\WarrantyTransferInterface
     */
    public function setName($name);

    /**
     * Get email
     * @return string|null
     */
    public function getEmail();

    /**
     * Set email
     * @param string $email
     * @return \Variux\Warranty\WarrantyTransfer\Api\Data\WarrantyTransferInterface
     */
    public function setEmail($email);

    /**
     * Get phone
     * @return string|null
     */
    public function getPhone();

    /**
     * Set phone
     * @param string $phone
     * @return \Variux\Warranty\WarrantyTransfer\Api\Data\WarrantyTransferInterface
     */
    public function setPhone($phone);

    /**
     * Get phone_ext
     * @return string|null
     */
    public function getPhoneExt();

    /**
     * Set phone_ext
     * @param string $phoneExt
     * @return \Variux\Warranty\WarrantyTransfer\Api\Data\WarrantyTransferInterface
     */
    public function setPhoneExt($phoneExt);

    /**
     * Get sale_date
     * @return string|null
     */
    public function getSaleDate();

    /**
     * Set sale_date
     * @param string $saleDate
     * @return \Variux\Warranty\WarrantyTransfer\Api\Data\WarrantyTransferInterface
     */
    public function setSaleDate($saleDate);

    /**
     * Get address_1
     * @return string|null
     */
    public function getAddress1();

    /**
     * Set address_1
     * @param string $address1
     * @return \Variux\Warranty\WarrantyTransfer\Api\Data\WarrantyTransferInterface
     */
    public function setAddress1($address1);

    /**
     * Get address_2
     * @return string|null
     */
    public function getAddress2();

    /**
     * Set address_2
     * @param string $address2
     * @return \Variux\Warranty\WarrantyTransfer\Api\Data\WarrantyTransferInterface
     */
    public function setAddress2($address2);

    /**
     * Get city
     * @return string|null
     */
    public function getCity();

    /**
     * Set city
     * @param string $city
     * @return \Variux\Warranty\WarrantyTransfer\Api\Data\WarrantyTransferInterface
     */
    public function setCity($city);

    /**
     * Get state
     * @return string|null
     */
    public function getState();

    /**
     * Set state
     * @param string $state
     * @return \Variux\Warranty\WarrantyTransfer\Api\Data\WarrantyTransferInterface
     */
    public function setState($state);

    /**
     * Get zip
     * @return string|null
     */
    public function getZip();

    /**
     * Set zip
     * @param string $zip
     * @return \Variux\Warranty\WarrantyTransfer\Api\Data\WarrantyTransferInterface
     */
    public function setZip($zip);

    /**
     * Get country
     * @return string|null
     */
    public function getCountry();

    /**
     * Set country
     * @param string $country
     * @return \Variux\Warranty\WarrantyTransfer\Api\Data\WarrantyTransferInterface
     */
    public function setCountry($country);

    /**
     * Get status
     * @return string|null
     */
    public function getStatus();

    /**
     * Set status
     * @param string $status
     * @return \Variux\Warranty\WarrantyTransfer\Api\Data\WarrantyTransferInterface
     */
    public function setStatus($status);

    /**
     * Get row_pointer
     * @return string|null
     */
    public function getRowPointer();

    /**
     * Set row_pointer
     * @param string $rowPointer
     * @return \Variux\Warranty\WarrantyTransfer\Api\Data\WarrantyTransferInterface
     */
    public function setRowPointer($rowPointer);

    /**
     * Get file_path_json
     * @return string|null
     */
    public function getFilePathJson();

    /**
     * Set file_path_json
     * @param string $filePathJson
     * @return \Variux\Warranty\WarrantyTransfer\Api\Data\WarrantyTransferInterface
     */
    public function setFilePathJson($filePathJson);

    /**
     * Get company_id
     * @return string|null
     */
    public function getCompanyId();

    /**
     * Set company_id
     * @param string $companyId
     * @return \Variux\Warranty\WarrantyTransfer\Api\Data\WarrantyTransferInterface
     */
    public function setCompanyId($companyId);

    /**
     * Get created_at
     * @return string|null
     */
    public function getCreatedAt();

    /**
     * Set created_at
     * @param string $createdAt
     * @return \Variux\Warranty\WarrantyTransfer\Api\Data\WarrantyTransferInterface
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
     * @return \Variux\Warranty\WarrantyTransfer\Api\Data\WarrantyTransferInterface
     */
    public function setUpdatedAt($updatedAt);
}
