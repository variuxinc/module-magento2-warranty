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
use Variux\Warranty\Helper\Data;

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
    protected $companyManagement;

    /**
     * @param Context $context
     * @param CompanyContext $companyContext
     * @param LoggerInterface $logger
     * @param Session $_customerSession
     * @param Data $helperData
     * @param CompanyManagementInterface $companyManagement
     */
    public function __construct(
        Context                      $context,
        CompanyContext               $companyContext,
        \Psr\Log\LoggerInterface     $logger,
        Session                      $_customerSession,
        \Variux\Warranty\Helper\Data $helperData,
        CompanyManagementInterface   $companyManagement
    ) {
        parent::__construct($context, $companyContext, $logger, $_customerSession, $helperData);
        $this->companyManagement = $companyManagement;
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\Result\Redirect|\Magento\Framework\Controller\ResultInterface|Page
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
     * @TODO - fixed
     * Return không đúng với define ở Document
     */
        return $resultPage;
    }
}
