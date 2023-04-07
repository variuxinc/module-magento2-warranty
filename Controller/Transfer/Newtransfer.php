<?php

namespace Variux\Warranty\Controller\Transfer;

use Magento\Company\Model\CompanyContext;
use Magento\Customer\Model\Session;

class Newtransfer extends \Variux\Warranty\Controller\AbstractAction
{
    public function __construct
    (
        \Magento\Framework\App\Action\Context $context,
        CompanyContext $companyContext,
        \Psr\Log\LoggerInterface $logger,
        Session $_customerSession,
        \Variux\Warranty\Helper\Data  $helperData
    ){
        parent::__construct($context, $companyContext, $logger, $_customerSession, $helperData);
    }

    public function execute()
    {
        $resultPage = $this->resultFactory->create(\Magento\Framework\Controller\ResultFactory::TYPE_PAGE);
        $resultPage->getConfig()->getTitle()->set(__('New Warranty Transfer'));
        return $resultPage;
    }
}
