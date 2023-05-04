<?php

namespace Variux\Warranty\Controller\Sro;

use Magento\Company\Model\CompanyContext;
use Magento\Customer\Model\Session;
use Magento\Customer\Model\Url;
use PHPUnit\Framework\Exception;
use Variux\Warranty\Helper\SuggestHelper;

class Editpost extends \Variux\Warranty\Controller\AbstractAction
{

    /**
     * @var \Magento\Framework\Data\Form\FormKey\Validator
     */
    protected $formKeyValidator;
    /**
     * @var \Variux\Warranty\Model\WarrantyFactory
     */
    protected $warrantyFactory;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        CompanyContext $companyContext,
        \Psr\Log\LoggerInterface $logger,
        Session $_customerSession,
        \Variux\Warranty\Helper\Data $helperData,
        SuggestHelper $suggestHelper,
        \Magento\Framework\Data\Form\FormKey\Validator $formKeyValidator,
        \Variux\Warranty\Model\WarrantyFactory $warrantyFactory
    )
    {
        parent::__construct(
            $context,
            $companyContext,
            $logger,
            $_customerSession,
            $helperData,
            $suggestHelper
        );
        $this->formKeyValidator = $formKeyValidator;
        $this->warrantyFactory = $warrantyFactory;
    }

    public function execute()
    {
        $data = $this->getRequest()->getPostValue();
        $validFormKey = $this->formKeyValidator->validate($this->getRequest());

        $resultRedirect = $this->resultRedirectFactory->create();
        if($validFormKey && $this->getRequest()->isPost()) {
            if (isset($data['warranty_id']) && $data['warranty_id']) {
                $warranty = $this->warrantyFactory->create()->load($data['warranty_id']);
            } else {
                unset($data['warranty_id']);
                $warranty = $this->warrantyFactory->create();
            }

            $warranty->setData($data);
            $customerId = $this->_customerSession->getCustomerId();
            $warranty->setCustomerId($customerId);
            try {
                $warranty->save();
                return $resultRedirect->setPath('warranty');
            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage($this->escaper->escapeHtml($e->getMessage()));
                return $resultRedirect->setPath('warranty');
            }
        }
        $resultRedirect->setPath('*/*/edit');
        return $resultRedirect;
    }
}
