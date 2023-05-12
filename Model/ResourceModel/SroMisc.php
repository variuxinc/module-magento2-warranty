<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Variux\Warranty\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class SroMisc extends AbstractDb
{

    /**
     * @inheritDoc
     */
    protected function _construct()
    {
        $this->_init('variux_warranty_sromisc', 'item_id');
    }
}
