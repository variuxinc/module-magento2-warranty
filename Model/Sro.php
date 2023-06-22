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
     * @var string
     */
    protected $_eventPrefix = 'variux_sro';

    /**
     * @var ResourceModel\SroLabor\CollectionFactory
     */
    protected $laborCollectionFactory;

    /**
     * @var ResourceModel\SroMaterial\CollectionFactory
     */
    protected $materialCollectionFactory;

    /**
     * @var ResourceModel\SroMisc\CollectionFactory
     */
    protected $miscCollectionFactory;

    /**
     * @var ResourceModel\SroDocument\CollectionFactory
     */
    protected $docsCollectionFactory;

    /**
     * @var \Variux\Warranty\Model\ResourceModel\Sro
     */
    protected $_resource;

    /**
     * Overwirte Class
     *
     * @return void
     */
    public function _construct()
    {
        $this->_init(\Variux\Warranty\Model\ResourceModel\Sro::class);
    }

    /**
     * @param \Magento\Framework\Model\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param ResourceModel\Sro $resource
     * @param ResourceModel\Sro\Collection $resourceCollection
     * @param ResourceModel\SroLabor\CollectionFactory $laborCollectionFactory
     * @param ResourceModel\SroMaterial\CollectionFactory $materialCollectionFactory
     * @param ResourceModel\SroMisc\CollectionFactory $miscCollectionFactory
     * @param ResourceModel\SroDocument\CollectionFactory $docsCollectionFactory
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        \Variux\Warranty\Model\ResourceModel\Sro $resource,
        \Variux\Warranty\Model\ResourceModel\Sro\Collection $resourceCollection,
        \Variux\Warranty\Model\ResourceModel\SroLabor\CollectionFactory $laborCollectionFactory,
        \Variux\Warranty\Model\ResourceModel\SroMaterial\CollectionFactory $materialCollectionFactory,
        \Variux\Warranty\Model\ResourceModel\SroMisc\CollectionFactory $miscCollectionFactory,
        \Variux\Warranty\Model\ResourceModel\SroDocument\CollectionFactory $docsCollectionFactory,
        array $data = []
    ) {
        parent::__construct($context, $registry, $resource, $resourceCollection, $data);
        $this->laborCollectionFactory = $laborCollectionFactory;
        $this->materialCollectionFactory = $materialCollectionFactory;
        $this->miscCollectionFactory = $miscCollectionFactory;
        $this->docsCollectionFactory = $docsCollectionFactory;
        $this->_resource = $resource;
    }

    /**
     * Load By Number
     *
     * @param string $number
     * @param bool $conditionType
     * @return $this
     */
    public function loadByNumber($number, $conditionType = false)
    {
        $this->_resource->loadByNumber($this, $number, $conditionType = false);
        return $this;
    }

    /**
     * Load by warranty id
     *
     * @param string $warId
     * @return $this
     */
    public function loadByWarrantyId($warId)
    {
        $this->_resource->loadByWarrantyId($this, $warId);
        return $this;
    }

    /**
     * Get Material Collection
     *
     * @return ResourceModel\SroMaterial\Collection
     */
    public function getMaterialCollection()
    {
        return $this->materialCollectionFactory->create()
            ->addFieldToFilter("sro_id", ["eq" => $this->getId()]);
    }

    /**
     * Get Labor Collection
     *
     * @return ResourceModel\SroLabor\Collection
     */
    public function getLaborCollection()
    {
        return $this->laborCollectionFactory->create()
            ->addFieldToFilter("sro_id", ["eq" => $this->getId()]);
    }

    /**
     * Get Misc Collection
     *
     * @return ResourceModel\SroMisc\Collection
     */
    public function getMiscCollection()
    {
        return $this->miscCollectionFactory->create()
            ->addFieldToFilter("sro_id", ["eq" => $this->getId()]);
    }

    /**
     * Get Document Collection
     *
     * @return ResourceModel\SroDocument\Collection
     */
    public function getDocumentCollection()
    {
        return $this->docsCollectionFactory->create()
            ->addFieldToFilter("sro_id", ["eq" => $this->getId()]);
    }

    /**
     * Get Labors Data
     *
     * @return array
     */
    public function getLaborsData()
    {
        $data = [];
        foreach ($this->getLaborCollection() as $labor) {
            $data[] = $labor->getData();
        }
        return $data;
    }

    /**
     * Get Material Data
     *
     * @return array
     */
    public function getMaterialsData()
    {
        $data = [];
        foreach ($this->getMaterialCollection() as $material) {
            $data[] = $material->getData();
        }
        return $data;
    }

    /**
     * Get Misc Data
     *
     * @return array
     */
    public function getMiscsData()
    {
        $data = [];
        foreach ($this->getMiscCollection() as $misc) {
            $miscData = $misc->getData();
            $data[] = $miscData;
        }
        return $data;
    }

    /**
     * Get Docs Data
     *
     * @return array
     */
    public function getDocsData()
    {
        $data = [];
        foreach ($this->getDocumentCollection() as $misc) {
            $miscData = $misc->getData();
            $data[] = $miscData;
        }
        return $data;
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
