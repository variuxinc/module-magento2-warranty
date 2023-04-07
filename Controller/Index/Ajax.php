<?php
/**
 * @author Variux Team
 * @copyright Copyright (c) 2023 Variux (https://www.variux.com)
 */

namespace Variux\Warranty\Controller\Index;

use Magento\Company\Api\CompanyManagementInterface;
use Magento\Company\Model\CompanyContext;
use Magento\Customer\Model\Session;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Exception\NotFoundException;
use Psr\Log\LoggerInterface;
use Variux\Warranty\Helper\Data;
use Variux\Warranty\Model\Warranty;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\ResponseInterface;
use Magento\Customer\Model\Session as CustomerSession;
use Variux\Warranty\Model\ResourceModel\Warranty\CollectionFactory as WarrantyCollectionFactory;
use Magento\Framework\UrlInterface;

class Ajax extends \Variux\Warranty\Controller\AbstractAction
{
    /**
     * @var CompanyContext
     */
    protected $companyContext;

    /**
     * @var CompanyManagementInterface
     */
    private $companyManagement;
    /**
     * @var CustomerSession
     */
    protected $customerSession;

    /**
     * @var WarrantyCollectionFactory
     */
    protected $warrantyCollectionFactory;

    /**
     * @var UrlInterface
     */
    protected $urlBuilder;

    /**
     * Index constructor.
     * @param Context $context
     * @param CompanyContext $companyContext
     * @param LoggerInterface $logger
     * @param CustomerSession $_customerSession
     * @param Data $helperData
     * @param WarrantyCollectionFactory $warrantyCollectionFactory
     * @param UrlInterface $urlBuilder
     */
    public function __construct(
        Context                      $context,
        CompanyContext               $companyContext,
        \Psr\Log\LoggerInterface     $logger,
        Session                      $_customerSession,
        \Variux\Warranty\Helper\Data $helperData,
        WarrantyCollectionFactory    $warrantyCollectionFactory,
        UrlInterface                 $urlBuilder
    ) {
        parent::__construct($context, $companyContext, $logger, $_customerSession, $helperData);
        $this->warrantyCollectionFactory = $warrantyCollectionFactory;
        $this->urlBuilder = $urlBuilder;
    }

    /**
     * Execute action based on request and return result
     *
     * Note: Request will be added as operation argument in future
     *
     * @return ResultInterface|ResponseInterface
     * @throws NotFoundException
     */
    public function execute()
    {
        $customer = $this->_customerSession->getCustomer();
        $html = "";
        $needUpdateIncAndSro = false;
        if ($customer) {
            $page = $this->getRequest()->getParam('p', 1);
            $pageSize = $this->getRequest()->getParam('limit', 10);
            $filter = [
                'serial_number' => $this->getRequest()->getParam('serial_number', false)
            ];
            $this->getRequest()->getParam("filter", false);
            $collection = $this->warrantyCollectionFactory->create()
                ->addFieldToFilter("customer_id", ["eq" => $customer->getId()])->setOrder('created_at', 'DESC');
            $collection->setPageSize($pageSize);
            $collection->setCurPage($page);
            $collection->applyFilterData($filter);
            /** @var Warranty $warranty */
            foreach ($collection as $warranty) {
                if (empty($warranty->getIncNum()) || empty($warranty->getFirstSroNum())) {
                    $needUpdateIncAndSro = true;
                }
                $html .= "<tr class='row'>";
                $html .= "<td data-th='Warranty Claim' class='col-md-2 id''>";
                $html .= $warranty->getIncNum();
                $html .= "</td>";
                $html .= "<td data-th='Description' class='col-md-2 description'>";
                $html .= $warranty->getDescription();
                $html .= "</td>";
                $html .= "<td data-th='Engine Serial #' class='col-md-2 engine'>";
                $html .= $warranty->getEngine();
                $html .= "</td>";
                $html .= "<td data-th='SRO Detail' class='col-md-2 text-center sro-detail'>";
                $html .= "<a href='" . $this->urlBuilder->getUrl(
                    "warranty/sro/edit",
                    ['id' => $warranty->getFirstSroId(),
                            'war_id' => $warranty->getId()]
                )
                    . "'>"
                    . (empty($warranty->getFirstSroNum()) ? "Details" : $warranty->getFirstSroNum())
                    . "</a>";
                $html .= "</td>";
                $html .= "<td data-th='Date' class='col-md-2 date'>";
                $html .= $warranty->getCreatedAt();
                $html .= "</td>";
                $html .= "<td data-th='Status' class='col-md-1 status'>";
                $html .= $warranty->getStatusString();
                $html .= "</td>";
                $html .= "<td data-th='Actions' class='col-md-1 text-center actions'>";
                $html .= "<p><a href='"
                    . $this->urlBuilder->getUrl(
                        "warranty/index/edit",
                        ["id" => $warranty->getId()]
                    )
                    . "'><i class=\"fa fa-pencil\"></i></a>
                    <a href='"
                    . $this->urlBuilder->getUrl(
                        "warranty/index/report",
                        ["id" => $warranty->getId()]
                    )
                    . "' target=\"_blank\"><i class=\"fa fa-print\"></i></a></p>";

                $html .= "</td>";
            }
        }
        return $this->getResponse()
            ->setBody(json_encode(
                ["html" => $html, "needUpdateIncAndSro" => $needUpdateIncAndSro]
            ));
    }
}
