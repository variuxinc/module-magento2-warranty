<?php

namespace Variux\Warranty\Controller\Autosuggest;

use Variux\Warranty\Controller\AbstractAction;
use Variux\Warranty\Helper\Data;
use Variux\Warranty\Helper\SuggestHelper;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultInterface;

/**
 * Class Invoicelisting
 * @package Variux\Warranty\Controller\Autosuggest
 */
class Invoicelisting extends AbstractAction
{
    /**
     * @var \Variux\Warranty\Helper\SuggestHelper
     */
    protected $suggestHelper;

    /**
     * Engine constructor.
     * @param Context $context
     * @param \Magento\Company\Model\CompanyContext $companyContext
     * @param \Variux\Warranty\Helper\SuggestHelper $suggestHelper
     * @param \Psr\Log\LoggerInterface $logger
     */
    public function __construct(
        Context $context,
        \Magento\Company\Model\CompanyContext $companyContext,
        \Psr\Log\LoggerInterface $logger,
        \Variux\Warranty\Helper\SuggestHelper $suggestHelper
    ) {
        parent::__construct($context, $companyContext, $logger);
        $this->suggestHelper = $suggestHelper;
    }

    /**
     * @return ResponseInterface|ResultInterface
     */
    public function execute()
    {
        $search = $this->getRequest()->getParam("q");
        $jsonHelper = $this->_objectManager->create("Magento\Framework\Json\Helper\Data");

        $customerId = $this->_customerSession->getCustomer()->getId();

        $response = $this->suggestHelper->findInvoiceListingByCustomer($search, $customerId);

        return $this->getResponse()->setBody($jsonHelper->jsonEncode($response));
    }
}
