<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Variux\Warranty\Model\ResourceModel;

use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Partner extends AbstractDb
{

    /**
     * @inheritDoc
     */
    protected function _construct()
    {
        $this->_init('variux_warranty_partner', 'partner_id');
    }

    /**
     * Load by company id
     *
     * @param \Variux\Warranty\Model\Partner $model
     * @param string $companyId
     * @return $this
     * @throws LocalizedException
     */
    public function loadByCompanyId(\Variux\Warranty\Model\Partner $model, $companyId): Partner
    {
        $connection = $this->getConnection();
        $select = $connection->select()->from(
            $this->getMainTable()
        )->where('company_id = "'.$companyId.'"');

        $id = $connection->fetchOne($select);
        if ($id) {
            $this->load($model, $id);
        } else {
            $model->setData([]);
        }

        return $this;
    }
}
