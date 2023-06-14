<?php

namespace Variux\Warranty\Controller\Index;

use Magento\Company\Model\CompanyContext;
use Magento\Customer\Model\Session;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\Response\Http\FileFactory;
use Magento\Framework\View\Result\PageFactory;
use Psr\Log\LoggerInterface;
use Variux\Warranty\Block\Index\Index;
use Variux\Warranty\Helper\Data;
use Variux\Warranty\Helper\SuggestHelper;
use Variux\Warranty\Model\WarrantyFactory;
use Variux\Warranty\Model\ResourceModel\Warranty as WarrantyResourceModel;
use Variux\Warranty\Helper\GeneratePdf as PdfHelper;

class Report extends \Variux\Warranty\Controller\AbstractAction
{

    /**
     * @var PageFactory
     */
    protected $resultPageFactory;
    /**
     * @var WarrantyFactory
     */
    protected $warrantyFactory;
    /**
     * @var \Variux\Warranty\Block\Index\Index
     */
    protected $indexBlock;
    /**
     * @var WarrantyResourceModel
     */
    protected $warrantyResourceModel;
    /**
     * @var PdfHelper
     */
    protected $pdfHelper;
    /**
     * @var \Magento\Framework\App\Response\Http\FileFactory
     */
    protected $fileFactory;

    /**
     * @param Context $context
     * @param CompanyContext $companyContext
     * @param LoggerInterface $logger
     * @param Session $_customerSession
     * @param Data $helperData
     * @param SuggestHelper $suggestHelper
     * @param Index $indexBlock
     * @param PageFactory $resultPageFactory
     * @param WarrantyFactory $warrantyFactory
     * @param WarrantyResourceModel $warrantyResourceModel
     * @param PdfHelper $pdfHelper
     * @param FileFactory $fileFactory
     */
    public function __construct(
        Context                            $context,
        CompanyContext                     $companyContext,
        LoggerInterface                    $logger,
        Session                            $_customerSession,
        Data                               $helperData,
        SuggestHelper                      $suggestHelper,
        \Variux\Warranty\Block\Index\Index $indexBlock,
        PageFactory                        $resultPageFactory,
        WarrantyFactory                    $warrantyFactory,
        WarrantyResourceModel $warrantyResourceModel,
        PdfHelper $pdfHelper,
        \Magento\Framework\App\Response\Http\FileFactory $fileFactory
    ) {
        parent::__construct(
            $context,
            $companyContext,
            $logger,
            $_customerSession,
            $helperData,
            $suggestHelper
        );
        $this->indexBlock = $indexBlock;
        $this->resultPageFactory = $resultPageFactory;
        $this->warrantyFactory = $warrantyFactory;
        $this->warrantyResourceModel = $warrantyResourceModel;
        $this->pdfHelper = $pdfHelper;
        $this->fileFactory = $fileFactory;
    }

    public function execute()
    {
        $id = $this->getRequest()->getParam('id');
        $warranty = $this->warrantyFactory->create();
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($id) {
            $this->warrantyResourceModel->load($warranty, $id);
            if (!$this->warrantyResourceModel->load($warranty, $id)) {
                $this->messageManager->addError(__('This warranty claim no longer exists.'));
                return $resultRedirect->setPath('*/*/');
            }
            if (!$this->pdfHelper->isPdfGenerated($warranty)) {
                $this->pdfHelper->generateClaim($warranty);
            }
        }
        $warrantyFileName = $this->pdfHelper->getWarrantyFileName($warranty);
        return $this->fileFactory->create(
            $warrantyFileName,
            [
                'type'  => "filename",
                'value' => $warrantyFileName
            ],
            \Magento\Framework\App\Filesystem\DirectoryList::MEDIA
        );
    }
}
