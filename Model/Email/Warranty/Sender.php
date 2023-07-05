<?php

namespace Variux\Warranty\Model\Email\Warranty;

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

    public function sendMail($emailTo, $sender, $storeId, $template, $warrantyId, $customerName, $status)
    {
        try {
            $transport = $this->transportBuilder->setTemplateIdentifier(
                $template
            )->setTemplateOptions(
                ['area' => Area::AREA_FRONTEND, 'store' => $storeId]
            )->setTemplateVars([
                'warranty_id' => $warrantyId,
                'customer_name' => $customerName,
                'status' => $status
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
