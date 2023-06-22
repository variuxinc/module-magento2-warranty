<?php

namespace Variux\Warranty\Controller\Engine;

use Variux\Warranty\Model\UnitFactory;
use Magento\Framework\App\Action\Context;
use Magento\Company\Model\CompanyContext;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\View\Result\Page;
use Magento\Framework\View\Result\PageFactory;
use Psr\Log\LoggerInterface;
use Magento\Customer\Model\Session;
use Variux\Warranty\Helper\Data;
use Variux\Warranty\Helper\SuggestHelper;

class Edit extends \Variux\Warranty\Controller\AbstractAction
{
    /**
     * @var UnitFactory
     */
    protected $unitFactory;

    /**
     * @var PageFactory
     */
    protected $resultPageFactory;

    /**
     * @param Context $context
     * @param CompanyContext $companyContext
     * @param LoggerInterface $logger
     * @param Session $_customerSession
     * @param Data $helperData
     * @param SuggestHelper $suggestHelper
     * @param UnitFactory $unitFactory
     * @param PageFactory $resultPageFactory
     */
    public function __construct(
        Context                                    $context,
        CompanyContext                             $companyContext,
        LoggerInterface                            $logger,
        Session                                    $_customerSession,
        Data                                       $helperData,
        SuggestHelper                              $suggestHelper,
        UnitFactory                                $unitFactory,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory
    ) {
        parent::__construct($context, $companyContext, $logger, $_customerSession, $helperData, $suggestHelper);
        $this->unitFactory = $unitFactory;
        $this->resultPageFactory = $resultPageFactory;
    }

    /**
     * Execute
     *
     * @return \Magento\Framework\App\ResponseInterface|ResultInterface|Page
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function execute()
    {
        $engineNumber = $this->getRequest()->getParam("engine", false);
        if ($engineNumber) {
            $unit = $this->unitFactory->create()->loadBySerial($engineNumber);
            if ($unit && $unit->getId()) {
                $engineStatus = $this->helperData->getEngineStatus($unit);
                if ($engineStatus == \Variux\Warranty\Model\Unit::STATUS_EXPIRED) {
                    $this->messageManager->addErrorMessage("You must call for registration");
                } elseif ($engineStatus == \Variux\Warranty\Model\Unit::STATUS_REGISTERED) {
                    $this->messageManager->addErrorMessage("The engine is already registered");
                }
            } else {
                $this->messageManager->addErrorMessage("The engine number $engineNumber doesn't exist");
            }
        }

        return $this->resultPageFactory->create();
    }
}
