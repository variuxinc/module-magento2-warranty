<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Variux\Warranty\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Sro extends AbstractDb
{

    /**
     * @inheritDoc
     */
    protected function _construct()
    {
        $this->_init('variux_warranty_sro', 'sro_id');
    }

    /**
     * Load by Number
     *
     * @param \Variux\Warranty\Model\Sro $model
     * @param string $number
     * @param boolean $conditionType
     * @return $this
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function loadByNumber(\Variux\Warranty\Model\Sro $model, $number, $conditionType = false)
    {
        $conditionString = "";
        switch ($conditionType) {
            case "like":
                $conditionString = 'sro_num like "'.$number.'"';
                break;
            case "%like":
                $conditionString = 'sro_num like "%'.$number.'%"';
                break;
            default:
                $conditionString = 'sro_num = "'.$number.'"';
                break;
        }
        $connection = $this->getConnection();
        $select = $connection->select()->from(
            $this->getMainTable()
        )->where($conditionString);

        $id = $connection->fetchOne($select);
        if ($id) {
            $this->load($model, $id);
        } else {
            $model->setData([]);
        }

        return $this;
    }

    /**
     * Load warranty id
     *
     * @param \Variux\Warranty\Model\Sro $model
     * @param string $warId
     * @return $this
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function loadByWarrantyId(\Variux\Warranty\Model\Sro $model, $warId)
    {
        $connection = $this->getConnection();
        $select = $connection->select()->from(
            $this->getMainTable()
        )->where('warranty_id = "'.$warId.'"');

        $id = $connection->fetchOne($select);
        if ($id) {
            $this->load($model, $id);
        } else {
            $model->setData([]);
        }

        return $this;
    }
}
