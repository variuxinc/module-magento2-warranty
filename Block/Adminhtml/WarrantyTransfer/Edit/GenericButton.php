<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Variux\Warranty\Block\Adminhtml\WarrantyTransfer\Edit;

use Magento\Backend\Block\Widget\Context;
use Magento\Framework\Exception\NoSuchEntityException;
use Variux\Warranty\Logger\Logger;

abstract class GenericButton
{

    protected $context;
    /**
     * @var Logger
     */
    protected $logger;

    /**
     * @param Context $context
     * @param Logger $logger
     */
    public function __construct(Context $context, Logger $logger)
    {
        $this->context = $context;
        $this->logger = $logger;
    }

    /**
     * Return model ID
     *
     * @return int|null
     */
    public function getModelId()
    {
        return $this->context->getRequest()->getParam('warrantytransfer_id');
    }

    /**
     * Generate url by route and parameters
     *
     * @param   string $route
     * @param   array $params
     * @return  string
     */
    public function getUrl($route = '', $params = [])
    {
        return $this->context->getUrlBuilder()->getUrl($route, $params);
    }

    public function getId()
    {
        try {
            return $this->context->getRequest()->getParam('id');

        } catch (NoSuchEntityException $e) {
            $this->logger->error($e);
        }
        return null;
    }
}
