<?php
/**
 * @author Variux Team
 * @copyright Copyright (c) 2023 Variux (https://www.variux.com)
 */

namespace Variux\Warranty\Controller\Autosuggest;

use Magento\Company\Model\CompanyContext;
use Magento\Customer\Model\Session;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultInterface;
use Psr\Log\LoggerInterface;
use Variux\Warranty\Helper\Data;
use Magento\Framework\Controller\Result\JsonFactory;
use Variux\Warranty\Helper\SuggestHelper;

use Magento\Framework\Controller\ResultFactory;

class Dealer extends \Variux\Warranty\Controller\AbstractAction
{
    /**
     * Engine constructor.
     * @param Context $context
     * @param CompanyContext $companyContext
     * @param LoggerInterface $logger
     * @param Session $_customerSession
     * @param Data $helperData
     * @param JsonFactory $resultJsonFactory
     * @param SuggestHelper $suggestHelper
     */
    public function __construct(
        Context                                          $context,
        \Magento\Company\Model\CompanyContext            $companyContext,
        \Psr\Log\LoggerInterface                         $logger,
        \Magento\Customer\Model\Session                  $_customerSession,
        \Variux\Warranty\Helper\Data                     $helperData,
        \Magento\Framework\Controller\Result\JsonFactory $resultJsonFactory,
        SuggestHelper                                    $suggestHelper
    )
    {
        parent::__construct($context, $companyContext, $logger, $_customerSession, $helperData, $resultJsonFactory, $suggestHelper);
    }

    /**
     * @return ResponseInterface|ResultInterface
     */
    public function execute()
    {
        $search = $this->getRequest()->getParam("q");
        $customerId = $this->_customerSession->getCustomer()->getId();
        $response = $this->suggestHelper->findDealer($search, $customerId);

        /**
         * @Hidro-Le
         * @TODO - Fixed
         * Chỗ này a cần tìm hiểu cách response JSON thay vì set response kiểu vầy.
         *       Sample: $this->resultFactory->create(ResultFactory::TYPE_JSON);
         */
        $resultJson = $this->resultJsonFactory->create();
        $resultJson->setData($response);
        return $resultJson;
    }
}
