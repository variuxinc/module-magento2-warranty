<?php

namespace Variux\Warranty\Controller\Sro;

use Magento\Company\Model\CompanyContext;
use Magento\Customer\Model\Session;
use Variux\Warranty\Helper\SuggestHelper;
use Magento\Framework\Controller\ResultFactory;

class Save extends \Variux\Warranty\Controller\AbstractAction
{
    public function execute()
    {
        $resultJson = $this->resultFactory->create(ResultFactory::TYPE_JSON);
        $response = [];
        $resultJson->setData(json_encode($response));
        return $resultJson;
    }
}
