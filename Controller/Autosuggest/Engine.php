<?php
/**
 * @author Variux Team
 * @copyright Copyright (c) 2023 Variux (https://www.variux.com)
 */
namespace Variux\Warranty\Controller\Autosuggest;

use Magento\Company\Model\CompanyContext;
use Magento\Customer\Model\Session;
use Magento\Framework\App\Action\Context;
use Psr\Log\LoggerInterface;
use Variux\Warranty\Helper\SuggestHelper;

class Engine extends \Variux\Warranty\Controller\AbstractAction
{
    /**
     * @var \Variux\Warranty\Helper\SuggestHelper
     */
    protected $suggestHelper;

    /**
     * Engine constructor.
     * @param Context $context
     * @param CompanyContext $companyContext
     * @param LoggerInterface $logger
     * @param Session $_customerSession
     * @param SuggestHelper $suggestHelper
     */
    public function __construct(
        Context $context,
        \Magento\Company\Model\CompanyContext $companyContext,
        \Psr\Log\LoggerInterface              $logger,
        \Magento\Customer\Model\Session       $_customerSession,
        \Variux\Warranty\Helper\SuggestHelper $suggestHelper
    ) {
        parent::__construct($context, $companyContext, $logger, $_customerSession);
        $this->suggestHelper = $suggestHelper;
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $search = $this->getRequest()->getParam("q");
        $jsonHelper = $this->_objectManager->create(\Magento\Framework\Json\Helper\Data::class);

        $response = $this->suggestHelper->findEngine($search);

        return $this->getResponse()->setBody($jsonHelper->jsonEncode($response));
    }
}
