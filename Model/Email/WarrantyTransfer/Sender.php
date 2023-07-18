<?php

namespace Variux\Warranty\Model\Email\WarrantyTransfer;

use Magento\Framework\Mail\Template\TransportBuilder;
use Magento\Framework\App\Area;
use Variux\Warranty\Logger\Logger;

class Sender
{
    /**
     * @var TransportBuilder
     */
    protected $transportBuilder;
    /**
     * @var Logger
     */
    protected $logger;

    public function __construct(
        TransportBuilder $transportBuilder,
        Logger $logger
    ) {
        $this->transportBuilder = $transportBuilder;
        $this->logger = $logger;
    }

    public function sendMail($emailTo, $sender, $storeId, $template, $customerName, $serial)
    {
        try {
            $transport = $this->transportBuilder->setTemplateIdentifier(
                $template
            )->setTemplateOptions(
                ['area' => Area::AREA_ADMINHTML, 'store' => $storeId]
            )->setTemplateVars([
                'serial' => $serial,
                'customer_name' => $customerName
            ])->setFrom(
                $sender
            )->addTo(
                $emailTo
            )->getTransport();
            $transport->sendMessage();
        } catch (\Exception $e) {
            $this->logger->critical($e);
        }
    }

}
