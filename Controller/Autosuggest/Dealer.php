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
use Variux\Warranty\Helper\SuggestHelper;

use Magento\Framework\Controller\ResultFactory;

class Dealer extends \Variux\Warranty\Controller\AbstractAction
{
    /**
     * @return ResponseInterface|ResultInterface
     */
    public function execute()
    {
        $search = $this->getRequest()->getParam("q");
        $customerId = $this->_customerSession->getCustomer()->getId();
        $response = $this->suggestHelper->findDealer($search, $customerId);
        $resultJson = $this->resultFactory->create(ResultFactory::TYPE_JSON);
        $resultJson->setData(json_encode($response));
        return $resultJson;
    }
}
