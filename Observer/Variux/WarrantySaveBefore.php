<?php

namespace Variux\Warranty\Observer\Variux;

use Magento\Framework\Event\Observer;
use Variux\Warranty\Logger\Logger;
use Variux\Warranty\Model\Email\Warranty\Sender as WarrantyEmailSender;
use Magento\Customer\Api\CustomerRepositoryInterface as CustomerRepository;
use Variux\Warranty\Helper\Config as Config;
use Variux\Warranty\Api\WarrantyRepositoryInterface;
use Variux\Warranty\Api\StatusRepositoryInterface;

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
     * @var Config
     */
    protected $config;
    /**
     * @var WarrantyRepositoryInterface
     */
    protected $warrantyRepository;
    /**
     * @var StatusRepositoryInterface
     */
    protected $statusRepository;

    /**
     * @param Logger $logger
     * @param WarrantyEmailSender $warrantyEmailSender
     * @param CustomerRepository $customerRepository
     * @param Config $config
     * @param WarrantyRepositoryInterface $warrantyRepository
     * @param StatusRepositoryInterface $statusRepository
     */
    public function __construct(
        Logger $logger,
        WarrantyEmailSender $warrantyEmailSender,
        CustomerRepository $customerRepository,
        Config $config,
        WarrantyRepositoryInterface $warrantyRepository,
        StatusRepositoryInterface $statusRepository
    ) {
        $this->logger = $logger;
        $this->warrantyEmailSender = $warrantyEmailSender;
        $this->customerRepository = $customerRepository;
        $this->config = $config;
        $this->warrantyRepository = $warrantyRepository;
        $this->statusRepository = $statusRepository;
    }

    public function execute(Observer $observer)
    {
        $warranty = $observer->getEvent()->getDataObject();
        if ($warranty->getId()) {
            $status = $warranty->getStatus();
            if ($status != 'INCOMP' && $status != 'NewCont') {
                $warrantyInDb = $this->warrantyRepository->getById($warranty->getId());
                $statusInDb = $warrantyInDb->getStatus();
                $statusObj = $this->statusRepository->getByCode($status);
                $statusName = $statusObj->getName();
                if ($status != $statusInDb) {
                    try {
                        $emailTo = $this->customerRepository->getById($warranty->getCustomerId())->getEmail();
                        $this->logger->info('Email to : ' . $emailTo);
                        $senderEmail = $this->config->getWarrantyEmailIdentity();
                        $this->logger->info('Email sender : ' . $senderEmail);
                        $storeId = 1;
                        $template = $this->config->getWarrantyEmailTemplate();
                        $this->logger->info('Email Template : ' . $template);
                        $warrantyId = $warranty->getId();
                        $customerName = $this->customerRepository->getById($warranty->getCustomerId())->getLastname();
                        $this->warrantyEmailSender
                            ->sendMail(
                                $emailTo,
                                $senderEmail,
                                $storeId,
                                $template,
                                $warrantyId,
                                $customerName,
                                $statusName
                            );
                    } catch (\Exception $e) {
                        $this->logger->critical($e);
                    }
                }
            }
        }
    }
}
