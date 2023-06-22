<?php

namespace Variux\Warranty\Controller\Sro\Document;

use Magento\Company\Model\CompanyContext;
use Magento\Customer\Model\Session;
use Magento\Framework\Controller\ResultFactory;
use Variux\Warranty\Helper\SuggestHelper;
use Variux\Warranty\Model\SroDocumentFactory;
use Variux\Warranty\Model\SroDocumentRepository;
use Variux\Warranty\Model\SroFactory;
use Variux\Warranty\Model\WarrantyFactory;
use Variux\Warranty\Model\ResourceModel\Warranty as WarrantyResourceModel;
use Variux\Warranty\Model\File\FileProcessor;
use Variux\Warranty\Helper\CompanyDetails;
use Variux\Warranty\Model\ResourceModel\Sro as SroResourceModel;
use Variux\Warranty\Model\Warranty;

class Save extends \Variux\Warranty\Controller\AbstractAction
{
    public const ERROR_MESS_EMPTY = 'Document file is required.';
    public const SUCCESS_MESS = 'The document is added.';
    public const ERROR_MESS_WARRANTY_SUBMITTED = 'Warranty was submitted.';
    public const ERROR_MESS_INVALID_SRO = 'Invalid SRO ID.';

    /**
     * @var SroDocumentFactory
     */
    protected $sroDocumentFactory;
    /**
     * @var SroDocumentRepository
     */
    protected $sroDocumentRepository;
    /**
     * @var SroFactory
     */
    protected $sroFactory;
    /**
     * @var WarrantyFactory
     */
    protected $warrantyFactory;
    /**
     * @var WarrantyResourceModel
     */
    protected $warrantyResourceModel;
    /**
     * @var FileProcessor
     */
    protected $fileProcessor;
    /**
     * @var CompanyDetails
     */
    protected $companyDetails;
    /**
     * @var SroResourceModel
     */
    protected $sroResourceModel;

    /**
     * @param \Magento\Framework\App\Action\Context $context
     * @param CompanyContext $companyContext
     * @param \Psr\Log\LoggerInterface $logger
     * @param Session $_customerSession
     * @param \Variux\Warranty\Helper\Data $helperData
     * @param SuggestHelper $suggestHelper
     * @param SroDocumentFactory $sroDocumentFactory
     * @param SroDocumentRepository $sroDocumentRepository
     * @param SroFactory $sroFactory
     * @param WarrantyFactory $warrantyFactory
     * @param WarrantyResourceModel $warrantyResourceModel
     * @param FileProcessor $fileProcessor
     * @param CompanyDetails $companyDetails
     * @param SroResourceModel $sroResourceModel
     */
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        CompanyContext $companyContext,
        \Psr\Log\LoggerInterface $logger,
        Session $_customerSession,
        \Variux\Warranty\Helper\Data  $helperData,
        SuggestHelper $suggestHelper,
        SroDocumentFactory $sroDocumentFactory,
        SroDocumentRepository $sroDocumentRepository,
        SroFactory $sroFactory,
        WarrantyFactory $warrantyFactory,
        WarrantyResourceModel $warrantyResourceModel,
        FileProcessor $fileProcessor,
        CompanyDetails $companyDetails,
        SroResourceModel $sroResourceModel
    ) {
        parent::__construct(
            $context,
            $companyContext,
            $logger,
            $_customerSession,
            $helperData,
            $suggestHelper
        );
        $this->sroDocumentFactory = $sroDocumentFactory;
        $this->sroDocumentRepository = $sroDocumentRepository;
        $this->sroFactory = $sroFactory;
        $this->warrantyFactory = $warrantyFactory;
        $this->warrantyResourceModel = $warrantyResourceModel;
        $this->fileProcessor = $fileProcessor;
        $this->companyDetails = $companyDetails;
        $this->sroResourceModel = $sroResourceModel;
    }

    /**
     * Execute
     *
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\Result\Json|(\Magento\Framework\Controller\Result\Json&\Magento\Framework\Controller\ResultInterface)|\Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $resultJson = $this->resultFactory->create(ResultFactory::TYPE_JSON);
        $acceptedValue = [
            "item_id" => "",
            "sro_id" => "",
            "name" => "",
            "file_path" => ""
        ];
        $response = [
            'error' => true,
            'msg' => ''
        ];
        $data = $this->getRequest()->getParams();
        $fileData = $files = $this->getRequest()->getFiles("file");
        if (empty($fileData)) {
            $response['msg'] = self::ERROR_MESS_EMPTY;
            $resultJson->setData(json_encode($response));
            return $resultJson;
        }
        try {
            $document = $this->sroDocumentFactory->create();
            $document->setData($data);
            $customerId = $this->_customerSession->getCustomerId();
            $adminId = $this->companyDetails->getInfo($customerId)->getId();
            $sro = $this->sroFactory->create();
            $this->sroResourceModel->load($sro, $document->getSroId());
            if ($sro->hasData() && $sro->getId() && $sro->getCustomerId() == $adminId) {
                $warranty = $this->warrantyFactory->create();
                $this->warrantyResourceModel->load($warranty, $sro->getWarrantyId());
                if ($warranty->getStatus() == Warranty::STATUS_ARRAY["INCOMP"]["key"]) {
                    $document->setSroId($sro->getId());
                    $fileResult = $this->processFile($fileData);
                    $document->setType($fileResult["file_type"]);
                    $document->setFilePath($fileResult["file_path"]);
                    $document->setName($fileResult["file_name"]);
                    $this->sroDocumentRepository->save($document);
                    $responseData = $document->getData();
                    $responseData = array_intersect_key($responseData, $acceptedValue);
                    $response = [
                        'error' => false,
                        'data' => $responseData,
                        'msg' => self::SUCCESS_MESS
                    ];
                } else {
                    $response['msg'] = self::ERROR_MESS_WARRANTY_SUBMITTED;
                }
            } else {
                $response['msg'] = self::ERROR_MESS_INVALID_SRO ;
            }

        } catch (\Exception $e) {
            $response['msg'] = $e->getMessage();
        }
        $resultJson->setData(json_encode($response));
        return $resultJson;
    }

    /**
     * Process File
     *
     * @param array $fileData
     * @return array
     * @throws \Magento\Framework\Exception\InputException
     */
    protected function processFile($fileData)
    {
        $result = $this->fileProcessor->processFileContent("warranty/document", $fileData);
        return [
            "file_path" => $result["file_path"],
            "file_name" => $fileData["name"],
            "file_type" => $result["file_mime"]
        ];
    }
}
