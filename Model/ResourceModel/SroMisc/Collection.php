<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Variux\Warranty\Model\ResourceModel\SroMisc;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{

    /**
     * @inheritDoc
     */
    protected $_idFieldName = 'sromisc_id';

    /**
     * @inheritDoc
     */
    protected function _construct()
    {
        $this->_init(
            \Variux\Warranty\Model\SroMisc::class,
            \Variux\Warranty\Model\ResourceModel\SroMisc::class
        );
    }
}

