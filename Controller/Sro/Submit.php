<?php

namespace Variux\Warranty\Controller\Sro;

use Magento\Company\Model\CompanyContext;
use Magento\Customer\Model\Session;
use Magento\Framework\Controller\ResultFactory;
use Variux\Warranty\Helper\SuggestHelper;

class Submit extends \Variux\Warranty\Controller\AbstractAction
{

    /**
     * @var \Variux\Warranty\Model\WarrantyRepository
     */
    protected $warrantyRepository;

    /**
     * @param \Magento\Framework\App\Action\Context $context
     * @param CompanyContext $companyContext
     * @param \Psr\Log\LoggerInterface $logger
     * @param Session $_customerSession
     * @param \Variux\Warranty\Helper\Data $helperData
     * @param SuggestHelper $suggestHelper
     * @param \Variux\Warranty\Model\WarrantyRepository $warrantyRepository
     */
    public function __construct(
        \Magento\Framework\App\Action\Context     $context,
        CompanyContext                            $companyContext,
        \Psr\Log\LoggerInterface                  $logger,
        Session                                   $_customerSession,
        \Variux\Warranty\Helper\Data              $helperData,
        SuggestHelper                             $suggestHelper,
        \Variux\Warranty\Model\WarrantyRepository $warrantyRepository
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
        $this->warrantyRepository = $warrantyRepository;
    }

    public function execute()
    {
        $warrantyData = $this->getRequest()->getParam("warranty");
        $warrantyId = $warrantyData['warranty_id'] ?? null;
        try {
            $warranty = $this->warrantyRepository->getById($warrantyId);
            $warranty->setStatus(\Variux\Warranty\Model\Warranty::STATUS_ARRAY["NewCont"]["key"]);
            $this->warrantyRepository->save($warranty);
            $response = [
                "msg" => __("Submit warranty success")
            ];
        } catch (\Exception $e) {
            $response = [
                "error" => true,
                "msg" => $e->getMessage()
            ];
        }
        $resultJson = $this->resultFactory->create(ResultFactory::TYPE_JSON);
        $resultJson->setData($response);
        return $resultJson;
    }
}
