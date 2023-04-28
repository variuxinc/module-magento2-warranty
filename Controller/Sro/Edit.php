<?php
/**
 * @author Variux Team
 * @copyright Copyright (c) 2023 Variux (https://www.variux.com)
 */

namespace Variux\Warranty\Controller\Sro;

use Magento\Company\Model\CompanyContext;
use Magento\Customer\Model\Session;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\Result\Redirect;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\View\Result\Page;
use Magento\Framework\View\Result\PageFactory;
use Psr\Log\LoggerInterface;
use Variux\Warranty\Helper\Data;
use Variux\Warranty\Model\WarrantyRepository;
use Variux\Warranty\Helper\SuggestHelper;

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
     * @param Data $helperData
     * @param PageFactory $resultPageFactory
     * @param WarrantyRepository $warrantyRepository
     * @param SuggestHelper $suggestHelper
     */
    public function __construct(
        Context                               $context,
        \Magento\Company\Model\CompanyContext $companyContext,
        \Psr\Log\LoggerInterface              $logger,
        Session                               $_customerSession,
        \Variux\Warranty\Helper\Data          $helperData,
        PageFactory                           $resultPageFactory,
        WarrantyRepository                    $warrantyRepository,
        SuggestHelper                         $suggestHelper
    )
    {
        parent::__construct($context, $companyContext, $logger, $_customerSession, $helperData, $suggestHelper);
        $this->resultPageFactory = $resultPageFactory;
        $this->warrantyRepository = $warrantyRepository;
    }

    /**
     * @return ResponseInterface|Redirect|ResultInterface|Page
     * @throws NoSuchEntityException
     */
    public function execute()
    {
        $warrantyId = $this->getRequest()->getParam('war_id');
        $resultRedirect = $this->resultRedirectFactory->create();

        if (!$warrantyId) {
            $this->messageManager->addErrorMessage(__('This warranty no longer exists.'));
            return $resultRedirect->setPath('warranty');
        }
        $warranty = $this->warrantyRepository->getById($warrantyId);
        if (!$warranty->getId()) {
            $this->messageManager->addErrorMessage(__('This warranty no longer exists.'));
            return $resultRedirect->setPath('*/*/');
        }

        $resultPage = $this->resultPageFactory->create();

        $resultPage->getConfig()->getTitle()->set(__('SRO Detail'));
        return $resultPage;
    }
}
