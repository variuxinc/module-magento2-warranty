<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Variux\Warranty\Observer\Variux;

use Variux\Warranty\Logger\Logger;

class UnitBeforeSave implements \Magento\Framework\Event\ObserverInterface
{

    /**
     * @var Logger
     */
    protected $logger;
    /**
     * @var \Magento\Catalog\Model\ProductRepository
     */
    protected $productRepository;

    public function __construct(
        Logger $logger,
        \Magento\Catalog\Model\ProductRepository $productRepository
    )
    {
        $this->logger = $logger;
        $this->productRepository = $productRepository;
    }

    /**
     * Execute observer
     *
     * @param \Magento\Framework\Event\Observer $observer
     * @return void
     */
    public function execute(
        \Magento\Framework\Event\Observer $observer
    ) {
        $unit = $observer->getEvent()->getDataObject();
        $productSku = $unit->getItem();
        $product = $this->productRepository->get($productSku);

        if(empty($unit->getDescription())) {
        $unit->setDescription($product->getName());
        }
    }
}
