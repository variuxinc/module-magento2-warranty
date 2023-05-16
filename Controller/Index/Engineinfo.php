<?php

namespace Variux\Warranty\Controller\Index;

use Magento\Company\Model\CompanyContext;
use Magento\Customer\Model\Session;
use Variux\Warranty\Helper\SuggestHelper;

class Engineinfo extends \Variux\Warranty\Controller\AbstractAction
{
    public function execute()
    {
        $this->_view->loadLayout();
        $this->_view->getPage()->getConfig()->getTitle()->set(__('Engine Registration Information'));
        $this->_view->renderLayout();
    }
}
