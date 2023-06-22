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

    /**
     * @param \Magento\Framework\App\Action\Context $context
     * @param CompanyContext $companyContext
     * @param \Psr\Log\LoggerInterface $logger
     * @param Session $_customerSession
     * @param \Variux\Warranty\Helper\Data $helperData
     * @param SuggestHelper $suggestHelper
     * @param SroMaterialRepository $sroMaterialRepository
     */
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

    /**
     * Execute
     *
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\Result\Json|(\Magento\Framework\Controller\Result\Json&\Magento\Framework\Controller\ResultInterface)|\Magento\Framework\Controller\ResultInterface
     */
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
