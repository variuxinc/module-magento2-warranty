<?php

namespace Variux\Warranty\Helper;

class MyPdf extends \TCPDF {

    public function __construct()
    {
        parent::__construct();
    }

    public function Header() {
        // Logo
        $_objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $storeManager = $_objectManager->get('Magento\Store\Model\StoreManagerInterface');
        $currentStore = $storeManager->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA);
        $image_file =$currentStore.'logo/stores/1/Indmar_Marine_Engines_Logo_1.jpg';

        $this->Image($image_file, 10, 10, 30, 10, 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);
        // Set font
        $this->SetFont('helvetica', 'B', 20);
        // Title
        $this->SetY(15);
        $this->Cell(0, 10, ' Warranty Claim Report ', 0, false, 'C', 0, '', 0, false, 'M', 'M');
    }

    public function Footer() {
        // Position at 15 mm from bottom
        $this->SetY(-15);
        // Set font
        $this->SetFont('helvetica', 'I', 8);
        // Page number
        $this->Cell(0, 10, 'COPYRIGHT VARIUX PRODUCTS - ALL RIGHTS RESERVED.', 0, false, 'C', 0, '', 0, false, 'T', 'M');
    }
}
