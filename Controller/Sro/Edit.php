<?php

namespace Variux\Warranty\Controller\Sro;

use Magento\Framework\App\Action\Context;

/**
 * Class Edit
 * @package Variux\Warranty\Controller\Ticket
 */
class Edit extends \Variux\Warranty\Controller\AbstractAction
{
    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $resultPageFactory;

    /**
     * @var \Variux\Warranty\Model\WarrantyFactory
     */
    protected $warrantyFactory;

    /**
     * @param Context $context
     */
    public function __construct(
        Context $context,
        \Magento\Company\Model\CompanyContext $companyContext,
        \Psr\Log\LoggerInterface $logger,
        \Magento\Framework\Controller\ResultFactory $resultFactory,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Variux\Warranty\Model\WarrantyFactory $warrantyFactory
    ) {
        parent::__construct($context, $companyContext, $logger);

        $this->resultPageFactory = $resultPageFactory;
        $this->warrantyFactory = $warrantyFactory;
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\Result\Redirect|\Magento\Framework\Controller\ResultInterface|\Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        $warrantyId = $this->getRequest()->getParam('war_id');
        $model = $this->warrantyFactory->create();
        $resultRedirect = $this->resultRedirectFactory->create();

        if (!$warrantyId) {
            $this->messageManager->addErrorMessage(__('This warranty no longer exists.'));
            return $resultRedirect->setPath('warranty');
        }

        $model->load($warrantyId);
        if (!$model->getId()) {
            $this->messageManager->addErrorMessage(__('This warranty no longer exists.'));
            return $resultRedirect->setPath('*/*/');
        }

        /** @var \Magento\Framework\View\Result\Page $resultPage */
        $resultPage = $this->resultPageFactory->create();

        $resultPage->getConfig()->getTitle()->set(__('SRO Detail'));
        return $resultPage;
    }
}
