<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Variux\Warranty\Model\ResourceModel\Unit;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{

    /**
     * @var string
     */
    protected $_idFieldName = 'unit_id';

    /**
     * @inheritDoc
     */
    protected function _construct()
    {
        $this->_init(
            \Variux\Warranty\Model\Unit::class,
            \Variux\Warranty\Model\ResourceModel\Unit::class
        );
    }
}
