<?php

namespace Variux\Warranty\Helper;

use Magento\Framework\App\Helper\Context;
use Magento\Framework\Exception\FileSystemException;
use Magento\Framework\Filesystem;
use Variux\Warranty\Helper\MyPdfX;
use Magento\Framework\App\Filesystem\DirectoryList;
use Zend_Validate_File_Exists;
use Magento\Framework\Filesystem\Io\File;

class GeneratePdf extends \Magento\Framework\App\Helper\AbstractHelper
{
    public const WARRANTY_FOLDER = "warranty/";

    /**
     * @var Filesystem\Directory\WriteInterface
     */
    protected $mediaDirectory;
    /**
     * @var File
     */
    protected $file;

    /**
     * @param Context $context
     * @param Filesystem $filesystem
     * @param File $file
     * @throws FileSystemException
     */
    public function __construct(Context $context, \Magento\Framework\Filesystem $filesystem, File $file)
    {
        parent::__construct($context);
        $this->mediaDirectory = $filesystem->getDirectoryWrite(DirectoryList::MEDIA);
        $this->file = $file;
    }

    /**
     * Generate Claim
     *
     * @param object $claim
     * @return string
     */
    public function generateClaimHtml($claim): string
    {
        return "
            <style>
                .xContent span {
                    color: black;
                    font-size: large;
                    font-weight: bold;
                }
                .xContent .childContent{
                    display: block;
                    margin: 10px 0;
                }
                .xContent .claimprop {
                    font-weight: normal;
                }
            </style>
            <h1>Warranty Information</h1>
            </br>
             <table class=\"data table table-warranty\"
                    cellspacing=\"1\"
                    cellpadding=\"1\"
                    border=\"1\"
                    align=\"center\" >
                    <thead>
                        <tr nobr=\"true\"
                            class=\"row\"
                            style=\"color: black;
                                    font-size: large;
                                    font-weight: bold; \">
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
                <div class=\"childContent\">
                    <span>
                        Item  : <span class=\"claimprop\">" . $claim->getItemSku() . "</span>
                    </span>
                </div>
                <div class=\"childContent\">
                    <span>
                        Boat Owner Name  : <span class=\"claimprop\">" . $claim->getBoatOwnerName() . "</span>
                    </span>
                </div>
                <div class=\"childContent\">
                    <span>
                        Dealer Claim/Reference #  :
                        <span class=\"claimprop\">" . $claim->getReferenceNumber() . "</span>
                    </span>
                </div>
                <div class=\"childContent\">
                     <span>
                        Date of Failure  #  : <span class=\"claimprop\">" . $claim->getDateOfFailure() . "</span>
                     </span>
                </div>
                <div class=\"childContent\">
                    <span>
                        Date of Repair   : <span class=\"claimprop\">" . $claim->getDateOfRepair() . "</span>
                    </span>
                </div>
                <div class=\"childContent\">
                    <span>
                        Engine Hours   : <span class=\"claimprop\">" . $claim->getEngineHour() . "</span>
                    </span>
                </div>
                <div class=\"childContent\">
                    <span>
                        Invoice Number  : <span class=\"claimprop\">" . $claim->getInvoiceNumber() . "</span>
                    </span>
                </div>
                <div class=\"childContent\">
                    <span>
                        Order Number  : <span class=\"claimprop\">" . $claim->getOrderNumber() . "</span>
                    </span>
                </div>
                <div class=\"childContent\">
                    <span>
                        Dealer Contact Name : <span class=\"claimprop\">" . $claim->getDealerName() . "</span>
                    </span>
                </div>
                <div class=\"childContent\">
                    <span>
                        Dealership Phone Number :
                        <span class=\"claimprop\">" . $claim->getDealerPhoneNumber() . "</span>
                    </span>
                </div>
                <div class=\"childContent\">
                    <span>
                        Claim Processors Email :
                        <span class=\"claimprop\">" . $claim->getClaimProcessorEmail() . "</span>
                    </span>
                </div>
                <div class=\"childContent\">
                    <span>
                        Brief Description : <span class=\"claimprop\">" . $claim->getBriefDescription() . "</span>
                    </span>
                </div>
                <div class=\"childContent\">
                    <span>
                        Reason Note : <span class=\"claimprop\">" . $claim->getReasonNote() . "</span>
                    </span>
                </div>
                <div class=\"childContent\">
                    <span>
                        Resolution Note : <span class=\"claimprop\">" . $claim->getResolutionNote() . "</span>
                    </span>
                </div>
             </div>
        ";
    }

    /**
     * Generate Sro Details
     *
     * @param string $materialHtml
     * @param string $laborHtml
     * @param string $miscHtml
     * @param string $docHtml
     * @return string
     */
    public function generateSroDetailsHtml($materialHtml, $laborHtml, $miscHtml, $docHtml): string
    {
            return "
                <h2 style=\"text-align: center;\">SRO Detail</h2>
                <h1>Material Items</h1>
                </br>
                <table class=\"data table table-warranty\"
                       cellspacing=\"1\"
                       cellpadding=\"1\"
                       border=\"1\"
                       align=\"center\">
                    <thead>
                        <tr nobr=\"true\"
                            class=\"row\"
                            style=\"color: black;font-size: large;font-weight: bold;padding: 10px;\">
                            <th>Item</th>
                            <th>Description</th>
                            <th>Qty</th>
                            <th>Price</th>
                            <th>Total</th>
                            <th>Note</th>
                        </tr>
                    </thead>
                    <tbody>
                        " . $materialHtml ."
                    </tbody>
                </table>
                </br>
                <h1>Labor Items</h1>
                </br>
                <table  class=\"data table table-warranty\"
                        cellspacing=\"1\"
                        cellpadding=\"1\"
                        border=\"1\"
                        align=\"center\">
                        <thead>
                            <tr nobr=\"true\"
                                class=\"row\"
                                style=\"color: black; font-size: large; font-weight: bold; padding: 10px;\">
                                <th>Work Code</th>
                                <th>Description</th>
                                <th>Hours</th>
                                <th>Labor Rate</th>
                                <th>Total</th>
                                <th>Note</th>
                            </tr>
                        </thead>
                        <tbody>
                            " . $laborHtml . "
                        </tbody>
                </table>
                </br>
                <h1>Freight Items</h1>
                </br>
                <table class=\"data table table-warranty\"
                       cellspacing=\"1\"
                       cellpadding=\"1\"
                       border=\"1\"
                       align=\"center\">
                    <thead>
                        <tr nobr=\"true\"
                            class=\"row\"
                            style=\"color: black;
                            font-size: large;
                            font-weight: bold;
                            padding: 10px;\">
                            <th>Misc Code</th>
                            <th>Description</th>
                            <th>Amount</th>
                            <th>Note</th>
                        </tr>
                    </thead>
                    <tbody>
                       " . $miscHtml . "
                    </tbody>
                </table>
                <p></p>
                <h1>Documents</h1>
                </br>
                <table class=\"data table table-warranty\"
                       cellspacing=\"1\"
                       cellpadding=\"1\"
                       border=\"1\"
                       align=\"center\">
                    <thead>
                        <tr nobr=\"true\"
                        class=\"row\"
                        style=\"color: black;
                                font-size: large;
                                font-weight: bold;
                                padding: 10px;\">
                            <th>Document</th>
                            <th>Link Download</th>
                        </tr>
                    </thead>
                    <tbody>
                        " . $docHtml . "
                    </tbody>
                </table>
            ";
    }

    /**
     * Get Material
     *
     * @param object $sro
     * @return string
     */
    public function getMaterialHtml($sro): string
    {
        $materialHtml = "";
        $totalQty = 0;
        $totalPrice = 0;
        $arrayDataMaterial = $sro->getMaterialsData();
        if ($arrayDataMaterial) {
            foreach ($arrayDataMaterial as $key => $value) {
                $totalQty += $value["qty_conv"];
                $price = number_format($value["price"], 2);
                $total = number_format($value["qty_conv"] * $value["price"], 2);
                $totalPrice += $value["qty_conv"] * $value["price"];
                $materialHtml = "
                    <tr nobr=\"true\">
                        <td>" . $value["item"] . "</td>
                        <td>" . $value["description"] . "</td>
                        <td>" . $value["qty_conv"] . "</td>
                        <td>$" . $price . "</td>
                        <td>$" . $total . "</td>
                        <td>" . $value["note"] . "</td>
                    </tr>

                ";
            }
            $materialHtml .= "
                <tr>
                    <td>Subtotal</td>
                    <td></td>
                    <td>" . number_format($totalQty, 4) . "</td>
                    <td></td>
                    <td>$" . number_format($totalPrice, 2) . "</td>
                    <td></td>
                </tr>
            ";
        }
        return $materialHtml;
    }

    /**
     * Get Labor
     *
     * @param object $sro
     * @return string
     */
    public function getLaborHtml($sro): string
    {
        $laborHtml = "";
        $totalQty = 0;
        $totalPrice = 0;
        $arrayDataMaterial = $sro->getLaborsData();
        if ($arrayDataMaterial) {
            foreach ($arrayDataMaterial as $key => $value) {
                $totalQty += $value["hour_worked"];
                $price = number_format($value["labor_hourly_rate"], 2);
                $total = number_format($value["hour_worked"] * $value["labor_hourly_rate"], 2);
                $totalPrice += $value["hour_worked"] * $value["labor_hourly_rate"];
                $laborHtml .= "
                    <tr nobr=\"true\">
                        <td>" . $value["work_code"] . "</td>
                        <td>" . $value["description"] . "</td>
                        <td>" . $value["hour_worked"] . "</td>
                        <td>$" . $price . "</td>
                        <td>$" . $total . "</td>
                        <td>" . $value["note"] . "</td>
                    </tr>
                ";
            }
            $laborHtml .= "
                <tr>
                    <td>Subtotal</td>
                    <td></td>
                    <td>" . number_format($totalQty, 4) . "</td>
                    <td></td>
                    <td>$" . number_format($totalPrice, 2) . "</td>
                    <td></td>
                </tr>
            ";
        }
        return $laborHtml;
    }

    /**
     * Get Misc
     *
     * @param object $sro
     * @return string
     */
    public function getMiscHtml($sro): string
    {
        $miscHtml = "";
        $totalQty = 0;
        $arrayMisc = $sro->getMiscsData();
        if ($arrayMisc) {
            foreach ($arrayMisc as $key => $value) {
                $totalQty += $value["amount"];
                $miscHtml .= "
                    <tr nobr=\"true\">
                        <td>" . $value["misc_code"] . "</td>
                        <td>" . $value["description"] . "</td>
                        <td>" . $value["amount"] . "</td>
                        <td>" . $value["note"] . "</td>
                    </tr>
                ";
            }
            $miscHtml .= "
                <tr>
                    <td>Subtotal</td>
                    <td></td>
                    <td>" . number_format($totalQty, 4) . "</td>
                    <td></td>
                </tr>
            ";
        }
        return $miscHtml;
    }

    /**
     * Get Document
     *
     * @param object $sro
     * @param object $storeManager
     * @return string
     */
    public function getDocumentsHtml($sro, $storeManager): string
    {
        $baseUrl = $storeManager->getStore()->getBaseUrl() . 'media/warranty/document';
        $docHtml = "";
        if ($sro) {
            $arrayDocs = $sro->getDocsData();
            foreach ($arrayDocs as $key => $value) {
                $urlDownload = $baseUrl . $value["file_path"];
                $docHtml .= "
                    <tr nobr=\"true\">
                        <td>" . $value["name"] . "</td>
                        <td><a href=\".$baseUrl.$urlDownload.\">Download</a></td>
                    </tr>
                ";
            }
        }
        return $docHtml;
    }

    /**
     * Generate
     *
     * @param object $claim
     * @return void
     */
    public function generateClaim($claim)
    {
        $path = $this->createFolderPDF();
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
        // set default header and footer data
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

        $sro = $claim->hasSroDetails();

        $claimHtml = $this->generateClaimHtml($claim);
        $pdf->writeHTMLCell(0, 0, '', '', $claimHtml, 0, 1, 0, true, '', true);

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

        $materialHtml = $this->getMaterialHtml($sro);
        $laborHtml = $this->getLaborHtml($sro);
        $miscHtml = $this->getMiscHtml($sro);
        $docHtml = $this->getDocumentsHtml($sro, $storeManager);

        $sroDetailsHtml = $this->generateSroDetailsHtml($materialHtml, $laborHtml, $miscHtml, $docHtml);

        // Print text using writeHTMLCell()
        $pdf->writeHTMLCell(0, 0, '', '', $sroDetailsHtml, 0, 1, 0, true, '', true);

        // ---------------------------------------------------------
        // Close and output PDF document
        // This method has several options, check the source code documentation for more information.
        $pdf->Output($path.'Claim_' . $claim->getId() . '.pdf', 'F');
    }

    /**
     * Create folder
     *
     * @return string
     */
    private function createFolderPDF(): string
    {
        $path = $this->getWarrantyPath().'pdf/';
        if (!$this->file->fileExists($path)) {
            try {
                $this->file->mkdir($path);
            } catch (\Throwable $e) {
                $path = $this->getWarrantyPath().'pdf/';
            }
        }
        return $path;
    }

    /**
     * Get Warranty
     *
     * @return string
     */
    private function getWarrantyPath(): string
    {
        return $this->mediaDirectory->getAbsolutePath(self::WARRANTY_FOLDER);
    }

    /**
     * Pdf Generated
     *
     * @param object $claim
     * @return bool
     */
    public function isPdfGenerated($claim): bool
    {
        $path = $this->getWarrantyPath().'pdf/';
        $fileName = $path . 'Claim_' . $claim->getId() . '.pdf';
        if (!$this->file->fileExists($fileName)) {
            return false;
        }
        return true;
    }

    /**
     * Get Warranty File Name
     *
     * @param object $claim
     * @return string
     */
    public function getWarrantyFileName($claim): string
    {
        $path = $this->getWarrantyPath().'pdf/';
        return $path . 'Claim_' . $claim->getId() . '.pdf';
    }
}
