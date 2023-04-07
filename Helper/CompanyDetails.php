<?php

namespace Variux\Warranty\Helper;

use Magento\Company\Api\CompanyManagementInterface;
use Magento\Company\Api\CompanyRepositoryInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Message\ManagerInterface;

class CompanyDetails
{
    /**
     * @var CompanyRepositoryInterface
     */
    private $companyRepository;

    /**
     * @var CompanyManagementInterface
     */
    private $companyManagement;

    /**
     * @var ManagerInterface
     */
    private $messageManager;

    /**
     * CompanyDetails constructor.
     * @param CompanyRepositoryInterface $companyRepository
     * @param CompanyManagementInterface $companyManagement
     * @param ManagerInterface           $messageManager
     */
    public function __construct(
        CompanyRepositoryInterface $companyRepository,
        CompanyManagementInterface $companyManagement,
        ManagerInterface $messageManager
    ) {
        $this->companyRepository = $companyRepository;
        $this->companyManagement = $companyManagement;
        $this->messageManager = $messageManager;
    }

    /**
     * @param $id
     * @return \Magento\Company\Api\Data\CompanyInterface|ManagerInterface
     */
    public function getInfo($id)
    {
        try {
            $companyId = $this->companyManagement->getByCustomerId($id)->getId();
            /**
             * @Hidro-Le
             * @TODO - Review
             * Chỗ này chưa đúng concept, return 2 type khác nhau hoàn toàn về interface.
             *       Throw excetion hoặc return null instead.
             */
            return $this->companyRepository->get($companyId);
        } catch (NoSuchEntityException $noSuchEntityException) {
            return $this->messageManager->addErrorMessage(__('Customer is associated with any company'));
        }
    }
}
