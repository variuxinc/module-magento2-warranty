<?php

namespace Variux\Warranty\Controller\Engine;

use Magento\Framework\App\Action\Context;
use Magento\Company\Model\CompanyContext;
use Magento\Customer\Model\Session;
use Magento\Customer\Model\Url;
use Magento\Framework\Controller\ResultInterface;
use Variux\Warranty\Helper\Data;
use Magento\Framework\App\ResponseInterface;

class NewAction extends \Variux\Warranty\Controller\AbstractAction
{
    /**
     * Execute action based on request and return result
     *
     * Note: Request will be added as operation argument in future
     *
     * @return ResultInterface|ResponseInterface
     */
    public function execute()
    {
        $resultRedirect = $this->resultRedirectFactory->create();
        $resultRedirect->setPath("warranty/engine/edit");
        return $resultRedirect;
    }
}
