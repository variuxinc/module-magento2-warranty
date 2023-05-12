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
    const ERROR_MESS_EMPTY = 'Document file is required.';
    const SUCCESS_MESS = 'The document is added.';
    const ERROR_MESS_WARRANTY_SUBMITTED = 'Warranty was submitted.';
    const ERROR_MESS_INVALID_SRO = 'Invalid SRO ID.';

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
        $this->sroDocumentFactory = $sroDocumentFactory;
        $this->sroDocumentRepository = $sroDocumentRepository;
        $this->sroFactory = $sroFactory;
        $this->warrantyFactory = $warrantyFactory;
        $this->warrantyResourceModel = $warrantyResourceModel;
        $this->fileProcessor = $fileProcessor;
        $this->companyDetails = $companyDetails;
        $this->sroResourceModel = $sroResourceModel;
    }

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
            'error' => TRUE,
            'msg' => ''
        ];
        $data = $this->getRequest()->getParams();
        $fileData = $files = $this->getRequest()->getFiles("file");
        if(empty($fileData)){
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
                        'error' => FALSE,
                        'data' => $responseData,
                        'msg' => self::SUCCESS_MESS
                    ];
                } else {
                    $response['msg'] = self::ERROR_MESS_WARRANTY_SUBMITTED;
                }
            } else {
                $response['msg'] = self::ERROR_MESS_INVALID_SRO ;
            }

        } catch (\Exception $e){
            $response['msg'] = $e->getMessage();
        }
        $resultJson->setData(json_encode($response));
        return $resultJson;
    }

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
