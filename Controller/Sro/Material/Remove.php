<?php

namespace Variux\Warranty\Controller\Sro\Material;

use Magento\Company\Model\CompanyContext;
use Magento\Customer\Model\Session;
use Magento\Framework\Controller\ResultFactory;
use Variux\Warranty\Helper\SuggestHelper;
use Variux\Warranty\Model\SroMaterialRepository;

class Remove extends \Variux\Warranty\Controller\AbstractAction
{
    /**
     * @var SroMaterialRepository
     */
    protected $sroMaterialRepository;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        CompanyContext $companyContext,
        \Psr\Log\LoggerInterface  $logger,
        Session $_customerSession,
        \Variux\Warranty\Helper\Data $helperData,
        SuggestHelper $suggestHelper,
        SroMaterialRepository $sroMaterialRepository
    ) {
        parent::__construct(
            $context,
            $companyContext,
            $logger,
            $_customerSession,
            $helperData,
            $suggestHelper
        );
        $this->sroMaterialRepository = $sroMaterialRepository;
    }

    public function execute()
    {
        $resultJson = $this->resultFactory->create(ResultFactory::TYPE_JSON);
        try {
            $itemId = $this->getRequest()->getParam("item_id", false);
            $this->sroMaterialRepository->deleteById($itemId);
            $response = [
                'msg' => __('Remove material success')
            ];
        } catch (\Exception $e) {
            $response = [
                'error' => true,
                'msg' => $e->getMessage()
            ];
        }
        $resultJson->setData(json_encode($response));
        return $resultJson;
    }
}
