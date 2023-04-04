<?php

namespace Variux\Warranty\Controller\Autosuggest;

use Magento\Framework\App\Action\Context;

/**
 * Class Dealer
 * @package Variux\Warranty\Controller\Autosuggest
 */
class Dealer extends \Variux\Warranty\Controller\AbstractAction
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
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $search = $this->getRequest()->getParam("q");
        $jsonHelper = $this->_objectManager->create("Magento\Framework\Json\Helper\Data");

        $customerId = $this->_customerSession->getCustomer()->getId();

        $response = $this->suggestHelper->findDealer($search, $customerId);

        return $this->getResponse()->setBody($jsonHelper->jsonEncode($response));
    }
}
