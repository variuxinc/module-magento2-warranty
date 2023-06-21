<?php

namespace Variux\Warranty\Helper;

use Magento\Company\Api\CompanyManagementInterface;
use Magento\Company\Api\CompanyRepositoryInterface;
use Magento\Framework\Exception\NoSuchEntityException;

class CompanyDetails
{
    /**
     * @var CompanyManagementInterface
     */
    private $companyManagement;

    /**
     * CompanyDetails constructor.
     * @param CompanyManagementInterface $companyManagement
     */
    public function __construct(
        CompanyManagementInterface $companyManagement
    ) {
        $this->companyManagement = $companyManagement;
    }

    /**
     * @param $customerId
     * @return \Magento\Company\Api\Data\CompanyInterface|null
     */
    public function getInfo($customerId)
    {
        try {
            return $this->companyManagement->getByCustomerId($customerId);
        } catch (NoSuchEntityException $noSuchEntityException) {
            return null;
        }
    }
}
