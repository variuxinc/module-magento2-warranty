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
     * @var string
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

    /**
     * Apply filter data
     *
     * @param array $data
     * @param string $type
     * @return $this
     */
    public function applyFilterData($data, $type = "like")
    {
        if ($data && is_array($data)) {
            $tableFields = array_keys($this->getConnection()->describeTable($this->getMainTable()));
            foreach ($data as $key => $value) {
                if ($value == false) {
                    continue;
                }

                if ($key == "warranty_ticket") {
                    $warIds = $this->getFilterTicketIds($value);
                    $this->addFieldToFilter("warranty_id", ["in" => $warIds]);
                    continue;
                } elseif ($key == "serial_number") {
                    $key = "engine";
                }

                if (in_array($key, $tableFields)) {
                    $this->addFieldToFilter($key, [$type => "%".$value."%"]);
                }
            }
        }
        return $this;
    }

    /**
     * Get Filter Ticket id
     *
     * @param string $number
     * @return array
     */
    public function getFilterTicketIds($number)
    {
        $ids = [];

        return $ids;
    }
}
