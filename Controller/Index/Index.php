<?php
/**
 * @author Variux Team
 * @copyright Copyright (c) 2023 Variux (https://www.variux.com)
 */

namespace Variux\Warranty\Controller\Index;

use Magento\Company\Api\CompanyManagementInterface;
use Magento\Company\Model\CompanyContext;
use Magento\Customer\Model\Session;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\Action\HttpGetActionInterface as HttpGetActionInterface;
use Magento\Framework\View\Result\Page;
use Psr\Log\LoggerInterface;

class Index extends \Variux\Warranty\Controller\AbstractAction implements HttpGetActionInterface
{
    /**
     * Authorization level of a company session.
     */
    const COMPANY_RESOURCE = 'Variux_Warranty::warranty_view';

    /**
     * @var CompanyContext
     */
    protected $companyContext;

    /**
     * @var CompanyManagementInterface
     */
    private $companyManagement;

    /**
     * Index constructor.
     *
     * @param Context $context
     * @param CompanyContext $companyContext
     * @param LoggerInterface $logger
     * @param Session $_customerSession
     * @param CompanyManagementInterface $companyManagement
     */
    public function __construct(
        Context                    $context,
        CompanyContext             $companyContext,
        \Psr\Log\LoggerInterface   $logger,
        Session                    $_customerSession,
        CompanyManagementInterface $companyManagement
    ) {
        parent::__construct($context, $companyContext, $logger, $_customerSession);
        $this->companyManagement = $companyManagement;
    }

    /**
     * Warranty dashboard.
     *
     * @return void
     * @throws \RuntimeException
     */
    public function execute()
    {
        if ($this->companyContext->getCustomerId()) {
            /** @var Page $resultPage */
            $resultPage = $this->resultFactory->create(\Magento\Framework\Controller\ResultFactory::TYPE_PAGE);
            $resultPage->getConfig()->getTitle()->set(__('Warranty Claim'));
        } else {
            $resultPage = $this->resultRedirectFactory->create()->setRefererUrl();
        }
    /**
     * @Hidro-Le
     * @TODO - Review
     * Return không đúng với define ở Document
     */
        return $resultPage;
    }
}
