<?php

namespace Variux\Warranty\Controller\Transfer;

use Magento\Company\Model\CompanyContext;
use Magento\Customer\Model\Session;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\View\Result\Page;
use Variux\Warranty\Helper\SuggestHelper;

class Newtransfer extends \Variux\Warranty\Controller\AbstractAction
{
    /**
     * @return ResponseInterface|ResultInterface|Page|(Page&ResultInterface)
     */
    public function execute()
    {
        $resultPage = $this->resultFactory->create(\Magento\Framework\Controller\ResultFactory::TYPE_PAGE);
        $resultPage->getConfig()->getTitle()->set(__('New Warranty Transfer'));
        return $resultPage;
    }
}
