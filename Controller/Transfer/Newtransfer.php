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
     * @param \Magento\Framework\App\Action\Context $context
     * @param CompanyContext $companyContext
     * @param \Psr\Log\LoggerInterface $logger
     * @param Session $_customerSession
     * @param \Variux\Warranty\Helper\Data $helperData
     * @param SuggestHelper $suggestHelper
     */
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        CompanyContext                        $companyContext,
        \Psr\Log\LoggerInterface              $logger,
        Session                               $_customerSession,
        \Variux\Warranty\Helper\Data          $helperData,
        SuggestHelper                         $suggestHelper
    ) {
        parent::__construct($context, $companyContext, $logger, $_customerSession, $helperData, $suggestHelper);
    }

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
