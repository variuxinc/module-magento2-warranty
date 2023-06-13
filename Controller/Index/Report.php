<?php

namespace Variux\Warranty\Controller\Index;

use Magento\Company\Model\CompanyContext;
use Magento\Customer\Model\Session;
use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Psr\Log\LoggerInterface;
use Variux\Warranty\Block\Index\Index;
use Variux\Warranty\Helper\Data;
use Variux\Warranty\Helper\SuggestHelper;
use Variux\Warranty\Helper\MyPdf;
use Variux\Warranty\Model\WarrantyFactory;
use Variux\Warranty\Model\ResourceModel\Warranty as WarrantyResourceModel;
use Variux\Warranty\Helper\MyPdfX;
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
        PdfHelper $pdfHelper
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

            /**
             * @Hidro-Le
             * @TODO - Review
             * Generate ở function này chưa có thông tin output ra đâu.
             *       A cần phải return out put là gì xử lý out put của hàm này như thế nào sau khi generate xong.
             */
//            $this->generateClaim($warranty);
            $this->pdfHelper->generateClaim($warranty);
        }
        /**
         * @Hidro-Le
         * @TODO - Review
         * Return result page cho 1 pdf file không có hợp lý. Controller này cũng không có layout nên sẽ return
         *       empty page nếu reload lại page do output bị cache.
         */
        $resultPage = $this->resultPageFactory->create();
        $resultPage->getConfig()->getTitle()->set($id ? __('Edit Warranty Claim') : __('New Warranty Claim'));
        return $resultPage;
    }

    public function generateClaim($claim)
    {
        /**
         * @Hidro-Le
         * @TODO - Review
         * 1. Chỗ này nên sử dụng block sau đó get HTML ra.
         * 2. Viêt generate PDF ở tần model truyền vào là HTML được generate từ Block ở #1.
         *
         */
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $storeManager = $objectManager->create(\Magento\Store\Model\StoreManagerInterface::class);
        $pdf = new MyPdfX(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        // set document information

        $pdf->setCreator(PDF_CREATOR);
        $pdf->setAuthor('Variux');
        $pdf->setTitle("Warranty Claim : " . $claim->getIncNum());
        $pdf->setSubject('Warranty Claim');
        $pdf->setKeywords('TCPDF, PDF, example, test, guide');

        $comPa = "variux.com";
        // set default header data
        $pdf->setHeaderData('', 0, "VARIUX", $comPa, [0, 64, 255], [0, 64, 128]);
        $pdf->setFooterData([0, 64, 0], [0, 64, 128]);

        // set header and footer fonts
        $pdf->setHeaderFont([PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN]);
        $pdf->setFooterFont([PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA]);

        // set default monospaced font
        $pdf->setDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        // set margins
        $pdf->setMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->setHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->setFooterMargin(PDF_MARGIN_FOOTER);

        // set auto page breaks
        $pdf->setAutoPageBreak(true, PDF_MARGIN_BOTTOM);

        // set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        // set some language-dependent strings (optional)

        // ---------------------------------------------------------

        // set default font subsetting mode
        $pdf->setFontSubsetting(true);

        // Set font
        // dejavusans is a UTF-8 Unicode font, if you only need to
        // print standard ASCII chars, you can use core fonts like
        // helvetica or times to reduce file size.
        $pdf->setFont('helvetica', '', 8, '', true);
        //page 1
        $pdf->AddPage();

        $sroNum = "";
        if ($this->indexBlock->getSroDetailNumber($claim)) {
            $sroNum = $this->indexBlock->getSroDetailNumber($claim);
        } else {
            $sroNum = "Details";
        }
        $sroPrepe = $claim->hasSroDetails();
        $html = "
        <style>
        .xContent{

        }
        .xContent span{
        color: black;
        font-size: large;
        font-weight: bold;


        }
        .xContent .nDung{
            display: block;
            margin: 10px 0;
        }
        .xContent .kohieu{
        font-weight: normal;
        }

    </style>
        <h1>Warranty Infomation</h1>
        </br>
        <table class=\"data table table-warranty\" cellspacing=\"1\" cellpadding=\"1\" border=\"1\" align=\"center\" >
            <thead>
            <tr nobr=\"true\" class=\"row\" style=\"
            color: black;
            font-size: large;
            font-weight: bold;

        \">
                <th>Warranty Claim</th>
                <th>Description</th>
                <th>Engine Serial #</th>
                <th>Date</th>
                <th>Status</th>
            </tr>
            </thead>
            <tbody >
            <tr nobr=\"true\">
            <td>" . $claim->getIncNum() . "</td>
            <td>" . $claim->getDescription() . "</td>
            <td>" . $claim->getEngine() . "</td>
            <td>" . $claim->getCreatedAt() . "</td>
            <td>" . $claim->getStatusString() . "</td>
        </tr>
            </tbody>
            </table>

        </br>
        <div class=\"xContent\">
        <div class=\"nDung\">

        </div>


        <div class=\"nDung\">
            <span>Item  : <span class=\"kohieu\">" . $claim->getItemSku() . "</span> </span>
        </div>

        <div class=\"nDung\">
            <span>Boat Owner Name  : <span class=\"kohieu\">" . $claim->getBoatOwnerName() . "</span> </span>
        </div>

        <div class=\"nDung\">
            <span>Dealer Claim/Reference #  : <span class=\"kohieu\">" . $claim->getReferenceNumber() . "</span> </span>
        </div>

        <div class=\"nDung\">
            <span>Date of Failure  #  : <span class=\"kohieu\">" . $claim->getDateOfFailure() . "</span> </span>
        </div>

        <div class=\"nDung\">
            <span>Date of Failure   : <span class=\"kohieu\">" . $claim->getDateOfFailure() . "</span> </span>
        </div>

        <div class=\"nDung\">
        <span>Date of Repair   : <span class=\"kohieu\">" . $claim->getDateOfRepair() . "</span> </span>
         </div>

         <div class=\"nDung\">
        <span>Engine Hours   : <span class=\"kohieu\">" . $claim->getEngineHour() . "</span> </span>
         </div>

         <div class=\"nDung\">
        <span>Invoice Number  : <span class=\"kohieu\">" . $claim->getInvoiceNumber() . "</span> </span>
         </div>

         <div class=\"nDung\">
        <span>Order Number  : <span class=\"kohieu\">" . $claim->getOrderNumber() . "</span> </span>
         </div>

         <div class=\"nDung\">
        <span>Dealer Contact Name : <span class=\"kohieu\">" . $claim->getDealerName() . "</span> </span>
         </div>

         <div class=\"nDung\">
        <span>Dealership Phone Number : <span class=\"kohieu\">" . $claim->getDealerPhoneNumber() . "</span> </span>
         </div>

         <div class=\"nDung\">
        <span>Claim Processors Email : <span class=\"kohieu\">" . $claim->getClaimProcessorEmail() . "</span> </span>
         </div>

         <div class=\"nDung\">
        <span>Brief Description : <span class=\"kohieu\">" . $claim->getBriefDescription() . "</span> </span>
         </div>

         <div class=\"nDung\">
        <span>Reason Note : <span class=\"kohieu\">" . $claim->getReasonNote() . "</span> </span>
         </div>

         <div class=\"nDung\">
        <span>Resolution Note : <span class=\"kohieu\">" . $claim->getResolutionNote() . "</span> </span>
         </div>
    </div>
";
        $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

        // Add a page 2
        // This method has several options, check the source code documentation for more information.
        $pdf->AddPage();

        // set text shadow effect
        $pdf->setTextShadow(
            ['enabled' => true,
                'depth_w' => 0.2,
                'depth_h' => 0.2,
                'color' => [196, 196, 196],
                'opacity' => 1,
                'blend_mode' => 'Normal'
            ]
        );

        // Set some content to print

        //get Materials Data
        $materialTemp = "";
        $totalQty = 0;
        $totalPrice = 0;
        $arrayDataMaterial = $sroPrepe->getMaterialsData();
        if ($arrayDataMaterial) {
            foreach ($arrayDataMaterial as $key => $value) {
                $totalQty += $value["qty_conv"];
                $price = number_format($value["price"], 2);
                $total = number_format($value["qty_conv"] * $value["price"], 2);
                $totalPrice += $value["qty_conv"] * $value["price"];
                $materialTemp .= "<tr nobr=\"true\">
                <td>" . $value["item"] . "</td>
                <td>" . $value["description"] . "</td>
                <td>" . $value["qty_conv"] . "</td>
                <td>$" . $price . "</td>
                <td>$" . $total . "</td>
                <td>" . $value["note"] . "</td>
            </tr>";
            }
            $materialTemp .= "<tr>
        <td>Subtotal</td>
        <td></td>
        <td>" . number_format($totalQty, 4) . "</td>
        <td></td>
        <td>$" . number_format($totalPrice, 2) . "</td>
        <td></td>
        </tr>";
        }
        //get Labor Items

        $laborTemp = "";
        $totalQty = 0;
        $totalPrice = 0;
        $arrayDataMaterial = $sroPrepe->getLaborsData();
        if ($arrayDataMaterial) {
            foreach ($arrayDataMaterial as $key => $value) {
                $totalQty += $value["hour_worked"];
                $price = number_format($value["labor_hourly_rate"], 2);
                $total = number_format($value["hour_worked"] * $value["labor_hourly_rate"], 2);
                $totalPrice += $value["hour_worked"] * $value["labor_hourly_rate"];
                $laborTemp .= "<tr nobr=\"true\">
            <td>" . $value["work_code"] . "</td>
            <td>" . $value["description"] . "</td>
            <td>" . $value["hour_worked"] . "</td>
            <td>$" . $price . "</td>
            <td>$" . $total . "</td>
            <td>" . $value["note"] . "</td>

        </tr>";
            }
            $laborTemp .= "<tr>
        <td>Subtotal</td>
        <td></td>
        <td>" . number_format($totalQty, 4) . "</td>
        <td></td>
        <td>$" . number_format($totalPrice, 2) . "</td>
        <td></td>
        </tr>";
        }

        //get Misc Items

        $miscTemp = "";
        $totalQty = 0;
        $arrayMisc = $sroPrepe->getMiscsData();
        if ($arrayMisc) {
            foreach ($arrayMisc as $key => $value) {
                $totalQty += $value["amount"];
                $miscTemp .= "<tr nobr=\"true\">
            <td>" . $value["misc_code"] . "</td>
            <td>" . $value["description"] . "</td>
            <td>" . $value["amount"] . "</td>
            <td>" . $value["note"] . "</td>

        </tr>";
            }
            $miscTemp .= "<tr>
         <td>Subtotal</td>
         <td></td>
         <td>" . number_format($totalQty, 4) . "</td>
         <td></td>
         </tr>";
        }

        //get Documents
        $baseUrl = $storeManager->getStore()->getBaseUrl() . 'media/warranty/document';
        $docTemp = "";
        if ($sroPrepe) {
            $arrayDocs = $sroPrepe->getDocsData();

            foreach ($arrayDocs as $key => $value) {
                $urlDownload = $baseUrl . $value["file_path"];
                $docTemp .= "<tr nobr=\"true\">
            <td>" . $value["name"] . "</td>
            <td><a href=\".$baseUrl.$urlDownload.\">Download</a></td>

        </tr>";

            }
        }
        $html = "
            <h2 style=\"text-align: center;\">SRO Detail</h2>
            <h1>Material Items</h1>
        </br>
        <table class=\"data table table-warranty\" cellspacing=\"1\" cellpadding=\"1\" border=\"1\" align=\"center\">
            <thead>
            <tr nobr=\"true\" class=\"row\" style=\"
            color: black;
            font-size: large;
            font-weight: bold;
            padding: 10px;
        \">
                <th>Item</th>
                <th>Description</th>
                <th>Qty</th>
                <th>Price</th>
                <th>Total</th>
                <th>Note</th>
            </tr>
            </thead>
            <tbody>
                 " . $materialTemp . "
            </tbody>
            </table>
<p></p>
            <h1>Labor Items</h1>
            </br>
            <table
            class=\"data table table-warranty\"
            cellspacing=\"1\"
            cellpadding=\"1\"
            border=\"1\"
            align=\"center\">
                <thead>
                <tr nobr=\"true\" class=\"row\" style=\"
                color: black;
                font-size: large;
                font-weight: bold;
                padding: 10px;
            \">
                    <th>Work Code</th>
                    <th>Description</th>
                    <th>Hours</th>
                    <th>Labor Rate</th>
                    <th>Total</th>
                    <th>Note</th>
                </tr>
                </thead>
                <tbody>
                    " . $laborTemp . "
                </tbody>
                </table>
            <p></p>
            <h1>Freight Items</h1>
            </br>
            <table
            class=\"data table table-warranty\"
                cellspacing=\"1\"
            cellpadding=\"1\"
            border=\"1\"
            align=\"center\">
                <thead>
                <tr nobr=\"true\" class=\"row\" style=\"
                color: black;
                font-size: large;
                font-weight: bold;
                padding: 10px;
            \">
                    <th>Misc Code</th>
                    <th>Description</th>
                    <th>Amount</th>
                    <th>Note</th>
                </tr>
                </thead>
                <tbody>
                       " . $miscTemp . "
                </tbody>
                </table>
                <p></p>
                <h1>Documents</h1>
            </br>
            <table
            class=\"data table table-warranty\"
            cellspacing=\"1\"
            cellpadding=\"1\"
            border=\"1\"
            align=\"center\">
                <thead>
                <tr nobr=\"true\" class=\"row\" style=\"
                color: black;
                font-size: large;
                font-weight: bold;
                padding: 10px;
            \">
                    <th>Document</th>
                    <th>Link Download</th>
                </tr>
                </thead>
                <tbody>
                " . $docTemp . "
                </tbody>
                </table>

            ";

        // Print text using writeHTMLCell()
        $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
        // ---------------------------------------------------------
        // Close and output PDF document
        // This method has several options, check the source code documentation for more information.
        $pdf->Output('Claim_' . $claim->getId() . '.pdf', 'I');
    }
}
