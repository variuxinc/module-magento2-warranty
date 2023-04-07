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
use Variux\Warranty\Helper\SuggestHelper;

class Workcode extends \Variux\Warranty\Controller\AbstractAction
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
        Context $context,
        CompanyContext $companyContext,
        \Psr\Log\LoggerInterface $logger,
        Session       $_customerSession,
        SuggestHelper $suggestHelper
    ) {
        parent::__construct($context, $companyContext, $logger, $_customerSession);
        $this->suggestHelper = $suggestHelper;
    }

    /**
     * @return ResponseInterface|ResultInterface
     */
    public function execute()
    {
        $search = $this->getRequest()->getParam("q");
        $jsonHelper = $this->_objectManager->create(\Magento\Framework\Json\Helper\Data::Class);

        $response = $this->suggestHelper->findWorkcode($search);
        /**
         * @Hidro-Le
         * @TODO - Review
         * Chỗ này a cần tìm hiểu cách response JSON thay vì set response kiểu vầy.
         *       Sample: $this->resultFactory->create(ResultFactory::TYPE_JSON);
         */
        return $this->getResponse()->setBody($jsonHelper->jsonEncode($response));
    }
}
