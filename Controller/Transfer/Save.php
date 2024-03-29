<?php

namespace Variux\Warranty\Controller\Transfer;

use Magento\Company\Model\CompanyContext;
use Magento\Customer\Model\Session;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Exception\InputException;
use Magento\Framework\Json\Helper\Data as JsonHelper;
use Psr\Log\LoggerInterface;
use Variux\Warranty\Helper\Data;
use Variux\Warranty\Model\ResourceModel\Unit as UnitResourceModel;
use Variux\Warranty\Model\UnitFactory;
use Variux\Warranty\Model\WarrantyTransferFactory;
use NumberFormatter;
use Variux\Warranty\Helper\CompanyDetails;
use Variux\Warranty\Model\File\FileProcessor;
use Variux\Warranty\Model\ResourceModel\WarrantyTransfer as WarrantyTransferResourceModel;
use Magento\Framework\Mail\Template\TransportBuilder;
use Variux\Warranty\Helper\SuggestHelper;
use Variux\Warranty\Logger\Logger;
use Magento\Framework\App\Area;
use Magento\Store\Model\Store;

class Save extends \Variux\Warranty\Controller\AbstractAction
{
    /**
     * @var JsonHelper
     */
    protected $jsonHelper;
    /**
     * @var UnitFactory
     */
    protected $unitFactory;
    /**
     * @var UnitResourceModel
     */
    protected $unitResourceModel;
    /**
     * @var WarrantyTransferFactory
     */
    protected $warrantyTransferFactory;
    /**
     * @var CompanyDetails
     */
    protected $companyDetails;
    /**
     * @var FileProcessor
     */
    protected $fileProcessor;
    /**
     * @var WarrantyTransferResourceModel
     */
    protected $warrantyTransferResourceModel;
    /**
     * @var TransportBuilder
     */
    protected $transportBuilder;
    /**
     * @var Logger
     */
    protected $customLogger;

    /**
     * @param Context $context
     * @param CompanyContext $companyContext
     * @param LoggerInterface $logger
     * @param Session $_customerSession
     * @param Data $helperData
     * @param SuggestHelper $suggestHelper
     * @param JsonHelper $jsonHelper
     * @param UnitFactory $unitFactory
     * @param UnitResourceModel $unitResourceModel
     * @param WarrantyTransferFactory $warrantyTransferFactory
     * @param CompanyDetails $companyDetails
     * @param FileProcessor $fileProcessor
     * @param WarrantyTransferResourceModel $warrantyTransferResourceModel
     * @param TransportBuilder $transportBuilder
     * @param Logger $customLogger
     */
    public function __construct(
        Context                       $context,
        CompanyContext                $companyContext,
        \Psr\Log\LoggerInterface      $logger,
        Session                       $_customerSession,
        Data                          $helperData,
        SuggestHelper                 $suggestHelper,
        JsonHelper                    $jsonHelper,
        UnitFactory                   $unitFactory,
        UnitResourceModel             $unitResourceModel,
        WarrantyTransferFactory       $warrantyTransferFactory,
        CompanyDetails                $companyDetails,
        FileProcessor                 $fileProcessor,
        WarrantyTransferResourceModel $warrantyTransferResourceModel,
        TransportBuilder              $transportBuilder,
        Logger $customLogger
    ) {
        parent::__construct($context, $companyContext, $logger, $_customerSession, $helperData, $suggestHelper);
        $this->jsonHelper = $jsonHelper;
        $this->unitFactory = $unitFactory;
        $this->unitResourceModel = $unitResourceModel;
        $this->warrantyTransferFactory = $warrantyTransferFactory;
        $this->companyDetails = $companyDetails;
        $this->fileProcessor = $fileProcessor;
        $this->warrantyTransferResourceModel = $warrantyTransferResourceModel;
        $this->transportBuilder = $transportBuilder;
        $this->customLogger = $customLogger;
    }

    /**
     * @return ResponseInterface|ResultInterface
     */
    public function execute()
    {
        $resultJson = $this->resultFactory->create(ResultFactory::TYPE_JSON);
        $acceptedValue = [
            "engine_serial_num" => "",
            "engine_hours" => "",
            "trans_sn" => "",
            "make_of_boat" => "",
            "boat_use" => "",
            "inspection_date" => "",
            "eng_comp_1" => "",
            "eng_comp_2" => "",
            "eng_comp_3" => "",
            "eng_comp_4" => "",
            "eng_comp_5" => "",
            "eng_comp_6" => "",
            "eng_comp_7" => "",
            "eng_comp_8" => "",
            "name" => "",
            "email" => "",
            "phone" => "",
            "phone_ext" => "",
            "fax_num" => "",
            "sale_date" => "",
            "addr_1" => "",
            "addr_2" => "",
            "addr_3" => "",
            "addr_4" => "",
            "city" => "",
            "state" => "",
            "zip" => "",
            "hull_id" => "",
            "country" => "",
        ];
        try {
            $data = $this->getRequest()->getParams();
            $filesData = $files = $this->getRequest()->getFiles("files");
            $data = array_intersect_key($data, $acceptedValue);
            if ($data["engine_serial_num"]) {
                $unit = $this->unitFactory->create();
                $this->unitResourceModel->loadBySerial($unit, $data["engine_serial_num"]);
                if ($unit->getId()) {
                    /** @var $warrantyTransfer \Variux\Warranty\Model\WarrantyTransfer */
                    $warrantyTransfer = $this->warrantyTransferFactory->create();
                    $warrantyTransfer->setData($data);
                    $fmt = new NumberFormatter('en_US', NumberFormatter::DECIMAL);
                    $tmp = $fmt->parse($warrantyTransfer->getEngineHours());
                    $warrantyTransfer->setEngineHours($tmp);
                    if ($warrantyTransfer->getEngineHours() >= 0) {
                        $customer = $this->_customerSession->getCustomer();
                        $customerId = $customer->getId();
                        $companyId = $this->companyDetails->getInfo($customerId)->getId();
                        $partner = $this->helperData->getCurrentPartner();
//                        $warrantyTransfer->setCurrentCustomer($partner->getPartnerNum());
//                        $this->customLogger->info('partner num: ' . $partner->getCustomerNum());
                        $warrantyTransfer->setSubmitterName($customer->getName());
                        $this->customLogger->info('submitter name: ' . $customer->getName());
                        $warrantyTransfer->setSubmitterEmail($customer->getEmail());
                        $this->customLogger->info('submitter email: ' . $customer->getEmail());
                        $warrantyTransfer->setEngineModel($unit->getItem());
                        $this->customLogger->info('engine model: ' . $unit->getItem());
                        $warrantyTransfer->setWarrantyStartDate($unit->getWarrantyStartDate());
                        $warrantyTransfer->setWarrantyEndDate($unit->getWarrantyEndDate());
                        $warrantyTransfer->setCompanyId($companyId);
                        $warrantyTransfer->setStatus(0);
                        $filePath = [];
                        $this->processFiles($filesData, $filePath);
                        $warrantyTransfer->setFilePathJson($filePath);
                        $this->warrantyTransferResourceModel->save($warrantyTransfer);
                        $response = [
                            'error' => false,
                            'msg' => __('Warranty transfer is saved successfully')
                        ];

//                        $transport = $this->transportBuilder
//                            ->setTemplateIdentifier('new_warranty_transfer')
//                            ->setTemplateOptions(['area' => Area::AREA_ADMINHTML, 'store' => Store::DEFAULT_STORE_ID])
//                            ->setTemplateVars([
//                                'serial' => $data["engine_serial_num"],
//                                'company' => $customer->getName()
//                            ])
//                            ->setFromByScope("sales")
//                            ->addTo(['warrantyapp@indmar.com'])
//                            ->getTransport();
//                        $transport->sendMessage();
                    } else {
                        $response = [
                            'error' => true,
                            'msg' => __('Engine hours is invalid')
                        ];
                    }
                } else {
                    $response = [
                        'error' => true,
                        'msg' => __('Unit serial number is not exist')
                    ];
                }
            } else {
                $response = [
                    'error' => true,
                    'msg' => __('Unit serial number is not exist')
                ];
            }
        } catch (\Exception $e) {
            $response = [
                'error' => true,
                'msg' => $e->getMessage()
            ];
        }
        $resultJson->setData(json_encode($response));
        return $resultJson;
    }

    /**
     * @param $fileData
     * @return array
     * @throws InputException
     */
    protected function processFile($fileData): array
    {
        $result = $this->fileProcessor->processFileContent("warranty/transfer", $fileData);
        return [
            "file_path" => $result["file_path"],
            "file_name" => $fileData["name"],
            "file_type" => $result["file_mime"]
        ];
    }

    protected function processFiles($filesData, $filePath)
    {
        if ($filesData) {
            foreach ($filesData as $fileData) {
                if ($fileData["error"] == 0) {
                    $filePath[] = $this->processFile($fileData);
                }
            }
        }
    }
}
