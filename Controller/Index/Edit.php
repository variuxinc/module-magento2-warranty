<?php

namespace Variux\Warranty\Controller\Index;

use Magento\Framework\App\Action\Context;

/**
 * Class Edit
 * @package Variux\Warranty\Controller\Index
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
        \Magento\Framework\App\Action\Context $context,
        \Magento\Company\Model\CompanyContext $companyContext,
        \Psr\Log\LoggerInterface $logger,
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
        $id = $this->getRequest()->getParam('id');
        $model = $this->warrantyFactory->create();
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($id) {
            $model->load($id);
            if (!$model->getId()) {
                $this->messageManager->addError(__('This warranty claim no longer exists.'));
                return $resultRedirect->setPath('*/*/');
            }
        }
        $resultPage = $this->resultPageFactory->create();
        $resultPage->getConfig()->getTitle()->set($id ? __('Edit Warranty Claim') : __('New Warranty Claim'));
        return $resultPage;
    }
}
