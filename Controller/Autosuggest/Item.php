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
use Magento\Framework\Exception\NoSuchEntityException;
use Psr\Log\LoggerInterface;
use Variux\Warranty\Helper\SuggestHelper;

class Item extends \Variux\Warranty\Controller\AbstractAction
{
    /**
     * @var SuggestHelper
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
        Context                  $context,
        CompanyContext           $companyContext,
        \Psr\Log\LoggerInterface $logger,
        Session                  $_customerSession,
        SuggestHelper            $suggestHelper
    ) {
        parent::__construct($context, $companyContext, $logger, $_customerSession);
        $this->suggestHelper = $suggestHelper;
    }

    /**
     * @return ResponseInterface|ResultInterface
     * @throws NoSuchEntityException
     */
    public function execute()
    {
        $search = $this->getRequest()->getParam("q");
        $jsonHelper = $this->_objectManager->create(\Magento\Framework\Json\Helper\Data::class);

        $customerId = $this->_customerSession->getCustomer()->getId();

        $response = $this->suggestHelper->findItem($search, $customerId);

        return $this->getResponse()->setBody($jsonHelper->jsonEncode($response));
    }
}
