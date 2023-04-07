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
use Magento\Framework\Controller\Result\Redirect;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\View\Result\Page;
use Magento\Framework\View\Result\PageFactory;
use Psr\Log\LoggerInterface;
use Variux\Warranty\Model\WarrantyFactory;
use Variux\Warranty\Model\WarrantyRepository;

class Edit extends \Variux\Warranty\Controller\AbstractAction
{
    /**
     * @var PageFactory
     */
    protected $resultPageFactory;

    /**
     * @var WarrantyRepository
     */
    protected $warrantyRepository;

    /**
     * @param Context $context
     * @param CompanyContext $companyContext
     * @param LoggerInterface $logger
     * @param Session $_customerSession
     * @param PageFactory $resultPageFactory
     * @param WarrantyRepository $warrantyRepository
     */
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Company\Model\CompanyContext $companyContext,
        \Psr\Log\LoggerInterface              $logger,
        Session                               $_customerSession,
        PageFactory                           $resultPageFactory,
        WarrantyRepository                    $warrantyRepository
    ) {
        parent::__construct($context, $companyContext, $logger, $_customerSession);
        $this->resultPageFactory = $resultPageFactory;
        $this->warrantyRepository = $warrantyRepository;
    }

    /**
     * @return ResponseInterface|Redirect|ResultInterface|Page
     */
    public function execute()
    {
        $id = $this->getRequest()->getParam('id');
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($id) {
            $warranty = $this->warrantyRepository->getById($id);
            if (!$warranty->getId()) {
                $this->messageManager->addError(__('This warranty claim no longer exists.'));
                return $resultRedirect->setPath('*/*/');
            }
        }
        $resultPage = $this->resultPageFactory->create();
        $resultPage->getConfig()->getTitle()->set($id ? __('Edit Warranty Claim') : __('New Warranty Claim'));
        return $resultPage;
    }
}
