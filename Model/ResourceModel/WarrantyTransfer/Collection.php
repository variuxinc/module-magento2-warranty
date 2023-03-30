<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Variux\Warranty\Model\ResourceModel\WarrantyTransfer;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{

    /**
     * @inheritDoc
     */
    protected $_idFieldName = 'warrantytransfer_id';

    /**
     * @inheritDoc
     */
    protected function _construct()
    {
        $this->_init(
            \Variux\Warranty\Model\WarrantyTransfer::class,
            \Variux\Warranty\Model\ResourceModel\WarrantyTransfer::class
        );
    }
}