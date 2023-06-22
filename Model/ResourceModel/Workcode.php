<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Variux\Warranty\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Workcode extends AbstractDb
{

    /**
     * @inheritDoc
     */
    protected function _construct()
    {
        $this->_init('variux_warranty_workcode', 'workcode_id');
    }

    /**
     * Load by code
     *
     * @param \Variux\Warranty\Model\Workcode $model
     * @param string $number
     * @param boolean $conditionType
     * @return $this
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function loadByCode(\Variux\Warranty\Model\Workcode $model, $number, $conditionType = false)
    {
        $conditionString = "";
        switch ($conditionType) {
            case "like":
                $conditionString = 'work_code like "'.$number.'"';
                break;
            case "%like":
                $conditionString = 'work_code like "%'.$number.'%"';
                break;
            default:
                $conditionString = 'work_code = "'.$number.'"';
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
}
