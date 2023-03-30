<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Variux\Warranty\Model\ResourceModel\Warranty;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{

    /**
     * @inheritDoc
     */
    protected $_idFieldName = 'warranty_id';

    /**
     * @inheritDoc
     */
    protected function _construct()
    {
        $this->_init(
            \Variux\Warranty\Model\Warranty::class,
            \Variux\Warranty\Model\ResourceModel\Warranty::class
        );
    }
}

