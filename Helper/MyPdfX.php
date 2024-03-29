<?php

namespace Variux\Warranty\Helper;

class MyPdfX extends MyPdf
{
    public function header()
    {
        // Logo
        $_objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $storeManager = $_objectManager->create(\Magento\Store\Model\StoreManagerInterface::class);
        $currentStore = $storeManager->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA);
        $image_file =$currentStore.'logo/stores/1/Indmar_Marine_Engines_Logo_1.jpg';

        $this->Image($image_file, 10, 10, 30, 10, 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);
        // Set font
        $this->SetFont('helvetica', 'B', 20);
        // Title
        $this->SetY(15);
        $this->Cell(0, 10, ' Warranty Claim Report ', 0, false, 'C', 0, '', 0, false, 'M', 'M');
    }

    public function footer()
    {
        // Position at 15 mm from bottom
        $this->SetY(-15);
        // Set font
        $this->SetFont('helvetica', 'I', 8);
        // Page number
        $this->Cell(0, 10, 'COPYRIGHT VARIUX - ALL RIGHTS RESERVED.', 0, false, 'C', 0, '', 0, false, 'T', 'M');
    }
}
