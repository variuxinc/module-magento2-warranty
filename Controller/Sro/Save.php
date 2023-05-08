<?php

namespace Variux\Warranty\Controller\Sro;

use Magento\Company\Model\CompanyContext;
use Magento\Customer\Model\Session;
use Variux\Warranty\Helper\SuggestHelper;
use Magento\Framework\Controller\ResultFactory;

class Save extends \Variux\Warranty\Controller\AbstractAction
{

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        CompanyContext                        $companyContext,
        \Psr\Log\LoggerInterface              $logger,
        Session                               $_customerSession,
        \Variux\Warranty\Helper\Data          $helperData,
        SuggestHelper                         $suggestHelper
    )
    {
        parent::__construct(
            $context,
            $companyContext,
            $logger,
            $_customerSession,
            $helperData,
            $suggestHelper
        );
    }

    public function execute()
    {
        $resultJson = $this->resultFactory->create(ResultFactory::TYPE_JSON);
        $response = [];
        $resultJson->setData(json_encode($response));
        return $resultJson;
    }
}
