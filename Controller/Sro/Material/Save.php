<?php

namespace Variux\Warranty\Controller\Sro\Material;

use Magento\Company\Model\CompanyContext;
use Magento\Customer\Model\Session;
use Magento\Framework\Controller\ResultFactory;
use Variux\Warranty\Helper\SuggestHelper;
use Variux\Warranty\Api\Data\SroMaterialInterfaceFactory;
use Variux\Warranty\Model\SroMaterialRepository;
use Variux\Warranty\Model\SroFactory;
use Variux\Warranty\Model\ResourceModel\Sro as SroResourceModel;
use Magento\Catalog\Model\ProductFactory;
use Magento\Catalog\Model\ResourceModel\Product as ProductResourceModel;
use Variux\Warranty\Model\WarrantyFactory;
use Variux\Warranty\Model\ResourceModel\Warranty as WarrantyResourceModel;
use Magento\Framework\Pricing\Helper\Data as PriceHelper;
use Variux\Warranty\Helper\CompanyDetails as CompanyDetails;
use NumberFormatter;

class Save extends \Variux\Warranty\Controller\AbstractAction
{
    /**
     * @var SroMaterialInterfaceFactory
     */
    protected $sroMaterialInterfaceFactory;
    /**
     * @var SroMaterialRepository
     */
    protected $sroMaterialRepository;
    /**
     * @var SroFactory
     */
    protected $sroFactory;
    /**
     * @var SroResourceModel
     */
    protected $sroResourceModel;
    /**
     * @var ProductFactory
     */
    protected $productFactory;
    /**
     * @var ProductResourceModel
     */
    protected $productResourceModel;
    /**
     * @var WarrantyFactory
     */
    protected $warrantyFactory;
    /**
     * @var WarrantyResourceModel
     */
    protected $warrantyResourceModel;
    protected $priceHelper;
    /**
     * @var CompanyDetails
     */
    protected $companyDetails;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        CompanyContext $companyContext,
        \Psr\Log\LoggerInterface $logger,
        Session $_customerSession,
        \Variux\Warranty\Helper\Data $helperData,
        SuggestHelper $suggestHelper,
        SroMaterialInterfaceFactory $sroMaterialInterfaceFactory,
        SroMaterialRepository $sroMaterialRepository,
        SroFactory $sroFactory,
        SroResourceModel $sroResourceModel,
        ProductFactory $productFactory,
        ProductResourceModel  $productResourceModel,
        WarrantyFactory $warrantyFactory,
        WarrantyResourceModel $warrantyResourceModel,
        PriceHelper $priceHelper,
        CompanyDetails $companyDetails

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
        $this->sroMaterialInterfaceFactory = $sroMaterialInterfaceFactory;
        $this->sroMaterialRepository = $sroMaterialRepository;
        $this->sroFactory = $sroFactory;
        $this->sroResourceModel = $sroResourceModel;
        $this->productFactory = $productFactory;
        $this->productResourceModel = $productResourceModel;
        $this->warrantyFactory = $warrantyFactory;
        $this->warrantyResourceModel = $warrantyResourceModel;
        $this->priceHelper = $priceHelper;
        $this->companyDetails = $companyDetails;
    }

    public function execute()
    {
        $resultJson = $this->resultFactory->create(ResultFactory::TYPE_JSON);
        $acceptedValue = [
            "item_id" => "",
            "sro_id" => "",
            "sro_line" => "",
            "sro_oper" => "",
            "customer_id" => "",
            "company_id" => "",
            "item" => "",
            "qty_conv" => "",
            "note" => "",
            "description" => "",
            "cost" => "",
            "price" => "",
            "total" => ""
        ];

        try {
            $data = $this->getRequest()->getParams();
            $data = array_intersect_key($data, $acceptedValue);
            $customerId = $this->_customerSession->getCustomerId();
            $companyId = $this->companyDetails->getInfo($customerId)->getId();
            $material = $this->sroMaterialInterfaceFactory->create();
            if (!$data["item_id"]) {
                unset($data["item_id"]);
            }
            $material->setData($data);
            $sro = $this->sroFactory->create();
            $this->sroResourceModel->load($sro, $material->getSroId());
            if ($sro->hasData() && $sro->getId() && $sro->getCustomerId() == $customerId) {
                $warranty = $this->warrantyFactory->create();
                $this->warrantyResourceModel->load($warranty, $sro->getWarrantyId());
                if ($warranty->getStatus() == \Variux\Warranty\Model\Warranty::STATUS_ARRAY["INCOMP"]["key"]) {
                    $fmt = new NumberFormatter('en_US', NumberFormatter::DECIMAL);
                    $tmp = $fmt->parse($material->getQtyConv());
                    $material->setQtyConv($tmp);
                    if ($material->getQtyConv() && $material->getQtyConv() > 0) {
                        if ($material->getItem() != "NPN") {
                            $product = $this->productFactory->create();
                            $productId = $this->productResourceModel->getIdBySku($material->getItem());
                            $this->productResourceModel->load($product, $productId);
                            if ($productId) {
                                $material->setDescription($product->getName());
                                $material->setPrice($this->getProductPrice($product));
                            } else {
                                $response = [
                                    'error' => true,
                                    'msg' => "Invalid item"
                                ];
                                $resultJson->setData(json_encode($response));
                                return $resultJson;
                            }
                        } else {
                            $tmp = $fmt->parse($material->getPrice());
                            $material->setPrice($tmp);
                        }
                        $material->setSroId($sro->getId());
                        $material->setCustomerId($customerId);
                        $material->setCompanyId($companyId);
                        $material->setSroOper(10);
                        $material->setSroLine(1);
                        $material->setTransDate($warranty->getDateOfRepair());
                        if($material->getPrice() > 0) {
                            $this->sroMaterialRepository->save($material);
                            $responseData = $material->getData();
                            $responseData["total"] = $this->priceHelper->currency($responseData["price"] * $responseData["qty_conv"], true, false);
                            $responseData["price"] = $this->priceHelper->currency($responseData["price"], true, false);
                            $responseData = array_intersect_key($responseData, $acceptedValue);
                            $response = [
                                'data' => $responseData,
                                'msg' => __('Update material success')
                            ];
                        } else {
                            $response = [
                                'error' => true,
                                'msg' => "Price value is invalid"
                            ];
                        }
                    } else {
                        $response = [
                            'error' => true,
                            'msg' => "Quantity value is invalid"
                        ];
                    }
                } else {
                    $response = [
                        'error' => true,
                        'msg' => "Warranty is submitted"
                    ];
                }
            } else {
                $response = [
                    'error' => true,
                    'msg' => "Invalid SRO ID"
                ];
            }
        }
        catch (\Exception $e) {
            $response = [
                'error' => true,
                'msg' => $e->getMessage()
            ];
        }
        $resultJson->setData(json_encode($response));
        return $resultJson;
    }
    public function getProductPrice($product){
        return (float)$product->getFinalPrice();
    }
}
