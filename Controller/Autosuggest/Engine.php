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
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Controller\ResultInterface;
use Psr\Log\LoggerInterface;
use Variux\Warranty\Helper\Data;
use Variux\Warranty\Helper\SuggestHelper;

class Engine extends \Variux\Warranty\Controller\AbstractAction
{
    /**
     * Engine constructor.
     * @param Context $context
     * @param CompanyContext $companyContext
     * @param LoggerInterface $logger
     * @param Session $_customerSession
     * @param Data $helperData
     * @param SuggestHelper $suggestHelper
     */
    public function __construct(
        Context                               $context,
        \Magento\Company\Model\CompanyContext $companyContext,
        \Psr\Log\LoggerInterface              $logger,
        \Magento\Customer\Model\Session       $_customerSession,
        \Variux\Warranty\Helper\Data          $helperData,
        \Variux\Warranty\Helper\SuggestHelper $suggestHelper
    )
    {
        parent::__construct($context, $companyContext, $logger, $_customerSession, $helperData, $suggestHelper);
    }

    /**
     * @return ResponseInterface|\Magento\Framework\Controller\Result\Json|ResultInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function execute()
    {
        $search = $this->getRequest()->getParam("q");
        $response = $this->suggestHelper->findEngine($search);
        /**
         * @Hidro-Le
         * @TODO - Fixed
         * Chỗ này a cần tìm hiểu cách response JSON thay vì set response kiểu vầy.
         *       Sample: $this->resultFactory->create(ResultFactory::TYPE_JSON);
         */
        $resultJson = $this->resultFactory->create(ResultFactory::TYPE_JSON);
        $resultJson->setData($response);
        return $resultJson;
    }
}
