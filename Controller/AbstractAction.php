<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Variux\Warranty\Controller;

use Magento\Company\Model\CompanyContext;
use Magento\Customer\Model\Session;
use Magento\Customer\Model\Url;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\ObjectManager;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\Result\Json;
use Magento\Framework\Exception\NotFoundException;
use Psr\Log\LoggerInterface;
use Variux\Warranty\Helper\Data;

/**
 * Class AbstractAction.
 *
 * @SuppressWarnings(PHPMD.NumberOfChildren)
 */
abstract class AbstractAction extends \Magento\Framework\App\Action\Action
{
    /**
     * Authorization level of a company session.
     */
    const COMPANY_RESOURCE = 'Magento_Company::index';

    /**
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * @var CompanyContext
     */
    protected $companyContext;

    /**
     * @var Url
     */
    private $customerUrl;

    /**
     * @var Session
     */
    protected $_customerSession;
    /**
     * @var Data
     */
    protected $helperData;

    /**
     * AbstractAction constructor.
     *
     * @param Context $context
     * @param CompanyContext $companyContext
     * @param LoggerInterface $logger
     * @param Session $_customerSession
     * @param Data $helperData
     * @param Url|null $customerUrl
     */
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        CompanyContext                        $companyContext,
        \Psr\Log\LoggerInterface              $logger,
        Session                               $_customerSession,
        \Variux\Warranty\Helper\Data          $helperData,
        ?Url                                  $customerUrl = null
    ) {
        parent::__construct($context);
        $this->logger = $logger;
        $this->companyContext = $companyContext;
        $this->_customerSession = $_customerSession;
        $this->helperData = $helperData;
        $this->customerUrl = $customerUrl ?: ObjectManager::getInstance()->get(Url::class);
    }

    /**
     * Authenticate customer.
     *
     * @param RequestInterface $request
     * @return ResponseInterface
     * @throws NotFoundException
     */
    public function dispatch(RequestInterface $request): ResponseInterface
    {
        if (!$this->companyContext->isModuleActive()) {
            throw new NotFoundException(__('Page not found.'));
        }

        if (!$this->companyContext->isCustomerLoggedIn()) {
            $this->_actionFlag->set('', 'no-dispatch', true);
            $redirectUrl = $this->customerUrl->getLoginUrl();
            return $this->_redirect($redirectUrl);
        }

        if (!$this->isAllowed()) {
            $this->_actionFlag->set('', 'no-dispatch', true);

            if ($this->companyContext->isCurrentUserCompanyUser()) {
                return $this->_redirect('warranty/accessdenied');
            }

            return $this->_redirect('noroute');
        }

        return parent::dispatch($request);
    }

    /**
     * Checks if the access is allowed.
     *
     * @return bool
     */
    protected function isAllowed(): bool
    {
        return $this->companyContext->isResourceAllowed(static::COMPANY_RESOURCE);
    }

    /**
     * Returns JSON error.
     *
     * @param string $message
     * @param array $payload
     * @return Json
     * @throws \InvalidArgumentException
     */
    protected function jsonError(string $message, array $payload = []): Json
    {
        /** @var Json $resultJson */
        $resultJson = $this->resultFactory->create(\Magento\Framework\Controller\ResultFactory::TYPE_JSON);
        $resultJson->setData(
            [
                'status' => 'error',
                'message' => $message,
                'payload' => $payload
            ]
        );

        return $resultJson;
    }

    /**
     * Returns JSON success.
     *
     * @param array $payload
     * @param string $message
     * @return Json
     * @throws \InvalidArgumentException
     */
    protected function jsonSuccess(array $payload, string $message = ''): Json
    {
        /** @var Json $resultJson */
        $resultJson = $this->resultFactory->create(\Magento\Framework\Controller\ResultFactory::TYPE_JSON);
        $resultJson->setData(
            [
                'status' => 'ok',
                'message' => $message,
                'data' => $payload
            ]
        );

        return $resultJson;
    }

    /**
     * Handle error message.
     *
     * @param string|null $errorMessage
     * @return Json
     */
    protected function handleJsonError(string $errorMessage = null): Json
    {
        $errorMessage = $errorMessage ?: __('Something went wrong.');
        $this->messageManager->addErrorMessage($errorMessage);

        return $this->jsonError($errorMessage);
    }

    /**
     * Handle success message.
     *
     * @param string $successMessage
     * @param array $payload
     * @return Json
     */
    protected function handleJsonSuccess(string $successMessage, array $payload = []): Json
    {
        $this->messageManager->addSuccessMessage($successMessage);

        return $this->jsonSuccess($payload, $successMessage);
    }
}
