<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Variux\Warranty\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Status extends AbstractDb
{

    /**
     * @inheritDoc
     */
    protected function _construct()
    {
        $this->_init('variux_warranty_status', 'status_id');
    }

    /**
     * @param $code
     * @return string
     */
    public function getIdByCode($code)
    {
        $connection = $this->getConnection();
        $select = $connection->select()->from('variux_warranty_status', 'status_id')->where('code = :code');
        $bind = [':code' => (string)$code];
        return $connection->fetchOne($select, $bind);
    }
}
