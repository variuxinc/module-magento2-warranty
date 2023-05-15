<?php

namespace Variux\Warranty\Controller\Index;

use Magento\Company\Model\CompanyContext;
use Magento\Customer\Model\Session;
use Variux\Warranty\Helper\SuggestHelper;

class Engineinfo extends \Variux\Warranty\Controller\AbstractAction
{
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        CompanyContext $companyContext,
        \Psr\Log\LoggerInterface $logger,
        Session $_customerSession,
        \Variux\Warranty\Helper\Data $helperData,
        SuggestHelper $suggestHelper
    ) {
        parent::__construct(
            $context,
            $companyContext,
            $logger,
            $_customerSession,
            $helperData,
            $suggestHelper
        );
    }

    public function execute()
    {
        $this->_view->loadLayout();
        $this->_view->getPage()->getConfig()->getTitle()->set(__('Engine Registration Information'));
        $this->_view->renderLayout();
    }
}
