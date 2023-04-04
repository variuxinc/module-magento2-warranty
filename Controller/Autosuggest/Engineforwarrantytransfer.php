<?php

namespace Variux\Warranty\Controller\Autosuggest;

use Magento\Framework\App\Action\Context;

/**
 * Class Engine
 * @package Variux\Warranty\Controller\Autosuggest
 */
class Engineforwarrantytransfer extends \Variux\Warranty\Controller\AbstractAction
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
        $response = $this->suggestHelper->findEngineForWarrantyTransfer($search);
        return $this->getResponse()->setBody($jsonHelper->jsonEncode($response));
    }
}
