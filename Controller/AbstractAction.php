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
use Magento\Framework\Exception\NotFoundException;
use Magento\Framework\View\Result\Page\Interceptor;
use Psr\Log\LoggerInterface;
use Variux\Warranty\Helper\Data;
use Magento\Framework\Controller\Result\JsonFactory;
use Variux\Warranty\Helper\SuggestHelper;

/**
 * @Hidro-Le
 * @TODO - Fixed
 * Những class con của class này không sử dụng những hàm jsonSuccess, jsonError...
 */

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
     * @Hidro-Le
     * @TODO - Fixed
     * Biến này là protected không cần phải implement ở class con.
     */
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
     * @var JsonFactory
     */
    protected $resultJsonFactory;
    /**
     * @var SuggestHelper
     */
    protected $suggestHelper;

    /**
     * @param Context $context
     * @param CompanyContext $companyContext
     * @param LoggerInterface $logger
     * @param Session $_customerSession
     * @param Data $helperData
     * @param JsonFactory $resultJsonFactory
     * @param SuggestHelper $suggestHelper
     * @param Url|null $customerUrl
     */
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        CompanyContext                        $companyContext,
        \Psr\Log\LoggerInterface              $logger,
        Session                               $_customerSession,
        \Variux\Warranty\Helper\Data          $helperData,
        JsonFactory                           $resultJsonFactory,
        SuggestHelper                         $suggestHelper,
        ?Url                                  $customerUrl = null
    )
    {
        parent::__construct($context);
        $this->logger = $logger;
        $this->companyContext = $companyContext;
        $this->_customerSession = $_customerSession;
        $this->helperData = $helperData;
        $this->resultJsonFactory = $resultJsonFactory;
        $this->suggestHelper = $suggestHelper;
        $this->customerUrl = $customerUrl ?: ObjectManager::getInstance()->get(Url::class);
    }

    /**
     * @param RequestInterface $request
     * @return ResponseInterface|Interceptor
     * @throws NotFoundException
     * @throws \Magento\Framework\Exception\LocalizedException
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function dispatch(RequestInterface $request)
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
}
