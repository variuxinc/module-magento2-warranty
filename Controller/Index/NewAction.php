<?php
/**
 * @author Variux Team
 * @copyright Copyright (c) 2023 Variux (https://www.variux.com)
 */

namespace Variux\Warranty\Controller\Index;

use Magento\Company\Model\CompanyContext;
use Magento\Customer\Model\Session;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\View\Result\PageFactory;
use Psr\Log\LoggerInterface;
use Variux\Warranty\Helper\Data;
use Variux\Warranty\Helper\SuggestHelper;

class NewAction extends \Variux\Warranty\Controller\AbstractAction
{
    /**
     * @var PageFactory
     */
    protected $resultPageFactory;

    /**
     * NewAction constructor.
     * @param Context $context
     * @param CompanyContext $companyContext
     * @param LoggerInterface $logger
     * @param Session $_customerSession
     * @param Data $helperData
     * @param SuggestHelper $suggestHelper
     * @param PageFactory $resultPageFactory
     */
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        CompanyContext                        $companyContext,
        \Psr\Log\LoggerInterface              $logger,
        Session                               $_customerSession,
        \Variux\Warranty\Helper\Data          $helperData,
        SuggestHelper                         $suggestHelper,
        PageFactory                           $resultPageFactory
    )
    {
        parent::__construct($context, $companyContext, $logger, $_customerSession, $helperData, $suggestHelper);
        $this->resultPageFactory = $resultPageFactory;
    }

    /**
     * Execute action based on request and return result
     *
     * Note: Request will be added as operation argument in future
     *
     * @return ResultInterface|ResponseInterface
     */
    public function execute()
    {
        $resultPage = $this->resultPageFactory->create();
        $resultPage->getConfig()->getTitle()->set(__('New Warranty Claim'));
        return $resultPage;
    }
}
