<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Variux\Warranty\Controller\Adminhtml\WarrantyTransfer;

class Edit extends \Variux\Warranty\Controller\Adminhtml\WarrantyTransfer
{
    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $resultPageFactory;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\Registry $coreRegistry
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\Registry $coreRegistry,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory
    ) {
        $this->resultPageFactory = $resultPageFactory;
        parent::__construct($context, $coreRegistry);
    }

    /**
     * Edit action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        // 1. Get ID and create model
        $id = $this->getRequest()->getParam('warrantytransfer_id');
        $model = $this->_objectManager->create(\Variux\Warranty\Model\WarrantyTransfer::class);

        // 2. Initial checking
        if ($id) {
            $model->load($id);
            if (!$model->getId()) {
                $this->messageManager->addErrorMessage(__('This Warrantytransfer no longer exists.'));
                /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
                $resultRedirect = $this->resultRedirectFactory->create();
                return $resultRedirect->setPath('*/*/');
            }
        }
        $this->_coreRegistry->register('variux_warranty_warrantytransfer', $model);

        // 3. Build edit form
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        $this->initPage($resultPage)->addBreadcrumb(
            $id ? __('Edit Warrantytransfer') : __('New Warrantytransfer'),
            $id ? __('Edit Warrantytransfer') : __('New Warrantytransfer')
        );
        $resultPage->getConfig()->getTitle()->prepend(__('Warrantytransfers'));
        $resultPage->getConfig()
                   ->getTitle()
                   ->prepend(
                       $model->getId() ?
                       __('Edit Warrantytransfer %1', $model->getId()) :
                       __('New Warrantytransfer')
                   );
        return $resultPage;
    }
}
