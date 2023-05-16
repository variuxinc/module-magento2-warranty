<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Variux\Warranty\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Unit extends AbstractDb
{

    /**
     * @inheritDoc
     */
    protected function _construct()
    {
        $this->_init('variux_warranty_unit', 'unit_id');
    }

    /**
     * @param \Variux\Warranty\Model\Unit $model
     * @param $number
     * @param $conditionType
     * @return \Variux\Warranty\Model\Unit
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function loadBySerial(\Variux\Warranty\Model\Unit $model, $number, $conditionType = false)
    {
        $conditionString = "";
        switch ($conditionType) {
            case "like":
                $conditionString = 'serial_no like "'.$number.'"';
                break;
            case "%like":
                $conditionString = 'serial_no like "%'.$number.'%"';
                break;
            default:
                $conditionString = 'serial_no = "'.$number.'"';
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
        return $model;
    }
}
