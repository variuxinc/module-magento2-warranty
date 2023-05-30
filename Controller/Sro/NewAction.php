<?php

namespace Variux\Warranty\Controller\Sro;

use Magento\Company\Model\CompanyContext;
use Magento\Customer\Model\Session;
use Magento\Customer\Model\Url;
use Variux\Warranty\Helper\SuggestHelper;
use Magento\Framework\Controller\Result\ForwardFactory;

class NewAction extends \Variux\Warranty\Controller\AbstractAction
{

    /**
     * @var ForwardFactory
     */
    protected $forwardFactory;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        CompanyContext $companyContext,
        \Psr\Log\LoggerInterface $logger,
        Session $_customerSession,
        \Variux\Warranty\Helper\Data $helperData,
        SuggestHelper $suggestHelper,
        ForwardFactory $forwardFactory
    ) {
        parent::__construct(
            $context,
            $companyContext,
            $logger,
            $_customerSession,
            $helperData,
            $suggestHelper
        );
        $this->forwardFactory = $forwardFactory;
    }

    public function execute()
    {
        $resultForward = $this->forwardFactory->create();
        return $resultForward->forward('edit');
    }
}
