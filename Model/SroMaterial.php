<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Variux\Warranty\Model;

use Magento\Framework\Model\AbstractModel;
use Variux\Warranty\Api\Data\SroMaterialInterface;

class SroMaterial extends AbstractModel implements SroMaterialInterface
{

    /**
     * @inheritDoc
     */
    public function _construct()
    {
        $this->_init(\Variux\Warranty\Model\ResourceModel\SroMaterial::class);
    }

    /**
     * @inheritDoc
     */
    public function getSromaterialId()
    {
        return $this->getData(self::SROMATERIAL_ID);
    }

    /**
     * @inheritDoc
     */
    public function setSromaterialId($sromaterialId)
    {
        return $this->setData(self::SROMATERIAL_ID, $sromaterialId);
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
    public function getUm()
    {
        return $this->getData(self::UM);
    }

    /**
     * @inheritDoc
     */
    public function setUm($um)
    {
        return $this->setData(self::UM, $um);
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
    public function getCost()
    {
        return $this->getData(self::COST);
    }

    /**
     * @inheritDoc
     */
    public function setCost($cost)
    {
        return $this->setData(self::COST, $cost);
    }

    /**
     * @inheritDoc
     */
    public function getPrice()
    {
        return $this->getData(self::PRICE);
    }

    /**
     * @inheritDoc
     */
    public function setPrice($price)
    {
        return $this->setData(self::PRICE, $price);
    }
}
