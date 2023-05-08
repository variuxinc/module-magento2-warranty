<?php

namespace Variux\Warranty\Controller\Sro\Labor;

use Magento\Company\Model\CompanyContext;
use Magento\Customer\Model\Session;
use Magento\Framework\Controller\ResultFactory;
use Variux\Warranty\Helper\SuggestHelper;
use Variux\Warranty\Model\SroLaborRepository;

class Remove extends \Variux\Warranty\Controller\AbstractAction
{

    /**
     * @var SroLaborRepository
     */
    protected $sroLaborRepository;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        CompanyContext $companyContext,
        \Psr\Log\LoggerInterface $logger,
        Session $_customerSession,
        \Variux\Warranty\Helper\Data $helperData,
        SuggestHelper $suggestHelper,
        SroLaborRepository $sroLaborRepository
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
        $this->sroLaborRepository = $sroLaborRepository;
    }

    public function execute()
    {

        try {
            $itemId = $this->getRequest()->getParam("item_id", false);
            $this->sroLaborRepository->deleteById($itemId);

            $response = [
                'msg' => __('Remove labor success')
            ];
        } catch (\Exception $e) {
            $response = [
                'error' => true,
                'msg' => $e->getMessage()
            ];
        }
        $resultJson = $this->resultFactory->create(ResultFactory::TYPE_JSON);
        $resultJson->setData($response);
        return $resultJson;
    }
}
