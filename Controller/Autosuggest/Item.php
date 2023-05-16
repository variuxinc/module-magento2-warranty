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
use Magento\Framework\Exception\NoSuchEntityException;
use Psr\Log\LoggerInterface;
use Variux\Warranty\Helper\Data;
use Variux\Warranty\Helper\SuggestHelper;

class Item extends \Variux\Warranty\Controller\AbstractAction
{
    /**
     * @return ResponseInterface|ResultInterface
     * @throws NoSuchEntityException
     */
    public function execute()
    {
        $search = $this->getRequest()->getParam("q");
        $customerId = $this->_customerSession->getCustomer()->getId();
        $response = $this->suggestHelper->findItem($search, $customerId);
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
