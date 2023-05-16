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

class Getsronumandincnum extends \Variux\Warranty\Controller\AbstractAction
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
        Context                         $context,
        CompanyContext                  $companyContext,
        \Psr\Log\LoggerInterface        $logger,
        \Magento\Customer\Model\Session $_customerSession,
        \Variux\Warranty\Helper\Data    $helperData,
        SuggestHelper                   $suggestHelper
    ) {
        parent::__construct($context, $companyContext, $logger, $_customerSession, $helperData, $suggestHelper);
        $this->suggestHelper = $suggestHelper;
    }

    /**
     * @return ResponseInterface|ResultInterface
     */
    public function execute()
    {
        $warrantyId = $this->getRequest()->getParam("warranty_id");
        $response = $this->suggestHelper->getSroNumAndIncNumByWarrantyId($warrantyId);
        /**
         * @Hidro-Le
         * @TODO - Fixed
         * Chỗ này a cần tìm hiểu cách response JSON thay vì set response kiểu vầy.
         *       Sample: $this->resultFactory->create(ResultFactory::TYPE_JSON);
         */
        $resultJson = $this->resultFactory->create(\Magento\Framework\Controller\ResultFactory::TYPE_JSON);
        $resultJson->setData(json_encode($response));
        return $resultJson;
    }
}
