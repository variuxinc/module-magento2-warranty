<?php

namespace Variux\Warranty\Controller\Engine;

use Magento\Company\Model\CompanyContext;
use Magento\Customer\Model\Session;
use Magento\Customer\Model\Url;
use Magento\Framework\App\Action\Context;
use Variux\Warranty\Helper\Data;

class Index extends \Variux\Warranty\Controller\AbstractAction
{
    public function execute()
    {
        $resultPage = $this->resultFactory->create(\Magento\Framework\Controller\ResultFactory::TYPE_PAGE);
        $resultPage->getConfig()->getTitle()->set(__('Engine'));
        return $resultPage;
    }
}
