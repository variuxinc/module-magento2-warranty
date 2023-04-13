<?php

namespace Variux\Warranty\Helper;

use Magento\Company\Api\CompanyManagementInterface;
use Magento\Company\Api\CompanyRepositoryInterface;
use Magento\Framework\Exception\NoSuchEntityException;

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
     * CompanyDetails constructor.
     * @param CompanyRepositoryInterface $companyRepository
     * @param CompanyManagementInterface $companyManagement
     */
    public function __construct(
        CompanyRepositoryInterface $companyRepository,
        CompanyManagementInterface $companyManagement
    ) {
        $this->companyRepository = $companyRepository;
        $this->companyManagement = $companyManagement;
    }

    /**
     * @Hidro-Le
     * @TODO - Review
     * paramater không rõ ngữ nghĩa.
     *       $id này không thể hiện là ID gì.
     */
    /**
     * @param $id
     * @return \Magento\Company\Api\Data\CompanyInterface|ManagerInterface
     */
    public function getInfo($id)
    {
        try {
            /**
             * @Hidro-Le
             * @TODO - Review
             * $this->companyManagement->getByCustomerId($id) return Company, không cần thiết load lại bằng Repository
             */
            $companyId = $this->companyManagement->getByCustomerId($id)->getId();
            /**
             * @Hidro-Le
             * @TODO - Fixed
             * Chỗ này chưa đúng concept, return 2 type khác nhau hoàn toàn về interface.
             *       Throw excetion hoặc return null instead.
             */
            return $this->companyRepository->get($companyId);
        } catch (NoSuchEntityException $noSuchEntityException) {
            return null;
        }
    }
}
