<?php

namespace Variux\Warranty\Controller\Sro;

use Magento\Company\Model\CompanyContext;
use Magento\Customer\Model\Session;
use PHPUnit\Framework\Exception;
use Variux\Warranty\Helper\SuggestHelper;
use Magento\Framework\Escaper;
use Variux\Warranty\Model\ResourceModel\Warranty as WarrantyResourceModel;

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
    /**
     * @var Escaper
     */
    protected $escaper;
    /**
     * @var WarrantyResourceModel
     */
    protected $warrantyResourceModel;

    /**
     * Construct
     *
     * @param \Magento\Framework\App\Action\Context $context
     * @param CompanyContext $companyContext
     * @param \Psr\Log\LoggerInterface $logger
     * @param Session $_customerSession
     * @param \Variux\Warranty\Helper\Data $helperData
     * @param SuggestHelper $suggestHelper
     * @param \Magento\Framework\Data\Form\FormKey\Validator $formKeyValidator
     * @param \Variux\Warranty\Model\WarrantyFactory $warrantyFactory
     * @param Escaper $escaper
     * @param WarrantyResourceModel $warrantyResourceModel
     */
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        CompanyContext $companyContext,
        \Psr\Log\LoggerInterface $logger,
        Session $_customerSession,
        \Variux\Warranty\Helper\Data $helperData,
        SuggestHelper $suggestHelper,
        \Magento\Framework\Data\Form\FormKey\Validator $formKeyValidator,
        \Variux\Warranty\Model\WarrantyFactory $warrantyFactory,
        Escaper $escaper,
        WarrantyResourceModel $warrantyResourceModel
    ) {
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
        $this->escaper = $escaper;
        $this->warrantyResourceModel = $warrantyResourceModel;
    }

    /**
     * Execute
     *
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\Result\Redirect|\Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $data = $this->getRequest()->getPostValue();
        $validFormKey = $this->formKeyValidator->validate($this->getRequest());

        $resultRedirect = $this->resultRedirectFactory->create();
        if ($validFormKey && $this->getRequest()->isPost()) {
            if (isset($data['warranty_id']) && $data['warranty_id']) {
                $warranty = $this->warrantyFactory->create();
                $this->warrantyResourceModel->load($warranty, $data['warranty_id']);
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
