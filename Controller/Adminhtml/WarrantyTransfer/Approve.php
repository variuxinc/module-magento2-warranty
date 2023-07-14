<?php

namespace Variux\Warranty\Controller\Adminhtml\WarrantyTransfer;

use Magento\Backend\App\Action;
use Magento\Framework\View\Result\PageFactory;
use Magento\Backend\App\Action\Context;
use Variux\Warranty\Api\WarrantyTransferRepositoryInterface;

class Approve extends Action
{

    /**
     * @var PageFactory
     */
    protected $resultPageFactory;
    /**
     * @var WarrantyTransferRepositoryInterface
     */
    protected $warrantyTransferRepositoryInterface;

    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        WarrantyTransferRepositoryInterface $warrantyTransferRepositoryInterface
    )
    {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
        $this->warrantyTransferRepositoryInterface = $warrantyTransferRepositoryInterface;
    }

    public function execute()
    {
        $resultRedirect = $this->resultRedirectFactory->create();
        $warrantyTransferId = (int)$this->getRequest()->getParam('id');
        if ($warrantyTransferId) {
            try {
                $result = $this->warrantyTransferRepositoryInterface->approveById($warrantyTransferId);
                if ($result) {
                    $this->messageManager->addSuccessMessage(__('Warranty transfer has been successfully approved.'));
                    return $resultRedirect->setPath('*/*/');
                }
            } catch (\Exception $exception) {
                $this->messageManager->addErrorMessage($exception->getMessage());
            }
        }
        $this->messageManager->addErrorMessage(__('Cannot change warranty transfer status'));
        return $resultRedirect->setPath('*/*/');
    }
}
