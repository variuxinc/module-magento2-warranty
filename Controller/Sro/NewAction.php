<?php

namespace Variux\Warranty\Controller\Sro;

use Magento\Company\Model\CompanyContext;
use Magento\Customer\Model\Session;
use Magento\Customer\Model\Url;
use Variux\Warranty\Helper\SuggestHelper;

class NewAction extends \Variux\Warranty\Controller\AbstractAction
{
    public function execute()
    {
        $this->_forward("edit");
    }
}
