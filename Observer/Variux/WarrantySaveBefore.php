<?php

namespace Variux\Warranty\Observer\Variux;

use Magento\Framework\Event\Observer;
use Variux\Warranty\Logger\Logger;
use Variux\Warranty\Model\Email\Warranty\Sender as WarrantyEmailSender;
use Magento\Customer\Api\CustomerRepositoryInterface as CustomerRepository;
use Variux\Warranty\Helper\Config as Config;

class WarrantySaveBefore implements \Magento\Framework\Event\ObserverInterface
{
    /**
     * @var Logger
     */
    protected $logger;
    /**
     * @var WarrantyEmailSender
     */
    protected $warrantyEmailSender;
    /**
     * @var CustomerRepository
     */
    protected $customerRepository;

    /**
     * @param Logger $logger
     * @param WarrantyEmailSender $warrantyEmailSender
     * @param CustomerRepository $customerRepository
     */
    public function __construct(
        Logger $logger,
        WarrantyEmailSender $warrantyEmailSender,
        CustomerRepository $customerRepository,
        Config $config
    ) {
        $this->logger = $logger;
        $this->warrantyEmailSender = $warrantyEmailSender;
        $this->customerRepository = $customerRepository;
        $this->config = $config;
    }

    public function execute(Observer $observer)
    {
        $warranty = $observer->getEvent()->getDataObject();
        if ($warranty->getId()) {
            try {
                $emailTo = $this->customerRepository->getById($warranty->getCustomerId())->getEmail();
                $senderEmail = $this->config->getEmailIdentity();
                $storeId = 1;
                $template = 'claim_status_change_template';
                $warrantyId = $warranty->getId();
                $customerName = $this->customerRepository->getById($warranty->getCustomerId())->getLastname();
                $status = $warranty->getStatus();
                $this->warrantyEmailSender->sendMail($emailTo, $senderEmail, $storeId, $template, $warrantyId, $customerName, $status);
            }
            catch (\Exception $e) {
                $this->logger->critical($e);
            }
        }
    }
}
