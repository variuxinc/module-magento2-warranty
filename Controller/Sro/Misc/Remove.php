<?php

namespace Variux\Warranty\Controller\Sro\Misc;

use Magento\Company\Model\CompanyContext;
use Magento\Customer\Model\Session;
use Magento\Customer\Model\Url;
use Magento\Framework\Controller\ResultFactory;
use Variux\Warranty\Helper\SuggestHelper;

class Remove extends \Variux\Warranty\Controller\AbstractAction
{

    /**
     * @var \Variux\Warranty\Model\SroMiscRepository
     */
    protected $sroMiscRepository;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        CompanyContext $companyContext,
        \Psr\Log\LoggerInterface  $logger,
        Session $_customerSession,
        \Variux\Warranty\Helper\Data $helperData,
        SuggestHelper $suggestHelper,
        \Variux\Warranty\Model\SroMiscRepository $sroMiscRepository
    ) {
        parent::__construct(
            $context,
            $companyContext,
            $logger,
            $_customerSession,
            $helperData,
            $suggestHelper
        );
        $this->sroMiscRepository = $sroMiscRepository;
    }

    public function execute()
    {
        try {
            $itemId = $this->getRequest()->getParam("item_id", false);
            $this->sroMiscRepository->deleteById($itemId);
            $response = [
                'msg' => __('Remove misc success')
            ];
        } catch (\Exception $e) {
            $response = [
                'error' => true,
                'msg' => $e->getMessage()
            ];
        }
        $resultJson = $this->resultFactory->create(ResultFactory::TYPE_JSON);
        $resultJson->setData(json_encode($response));
        return $resultJson;
    }
}
