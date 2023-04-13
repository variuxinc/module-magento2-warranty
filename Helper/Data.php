<?php

namespace Variux\Warranty\Helper;

use Magento\Customer\Model\Session;
use Magento\Framework\App\Helper\Context;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Serialize\Serializer\Json;
use Variux\Warranty\Model\PartnerFactory;
use Variux\Warranty\Model\ResourceModel\Partner;
use Variux\Warranty\Model\ResourceModel\UnitReg\CollectionFactory;
use Variux\Warranty\Api\UnitRegRepositoryInterface;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Variux\Warranty\Model\Unit;
use Variux\Warranty\Api\Data\UnitRegInterface;

class Data extends \Magento\Framework\App\Helper\AbstractHelper
{
    const DENY_ACCESS_URL = 'warranty/index/accessdeny';

    /**
     * @var Config
     */
    protected $configHelper;

    /**
     * @var Session
     */
    protected $customerSession;

    /**
     * @var PartnerFactory
     */
    protected $partnerFactory;

    /**
     * @var CollectionFactory
     */
    protected $unitRegCollectionFactory;

    /**
     * @var Json
     */
    protected $serialize;

    protected $partnerCache = null;
    /**
     * @var Partner
     */
    protected $partnerResourceModel;
    /**
     * @var CompanyDetails
     */
    protected $companyDetails;
    /**
     * @var UnitRegRepositoryInterface
     */
    protected $unitRegRepository;
    /**
     * @var SearchCriteriaBuilder
     */
    protected $searchCriteriaBuilder;

    /**
     * @param Context $context
     * @param Session $customerSession
     * @param CollectionFactory $unitRegCollectionFactory
     * @param Config $configHelper
     * @param Json $serialize
     * @param Partner $partnerResourceModel
     * @param CompanyDetails $companyDetails
     * @param UnitRegRepositoryInterface $unitRegRepository
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     */
    public function __construct(
        Context $context,
        Session $customerSession,
        CollectionFactory $unitRegCollectionFactory,
        Config $configHelper,
        Json $serialize,
        Partner $partnerResourceModel,
        \Variux\Warranty\Helper\CompanyDetails $companyDetails,
        UnitRegRepositoryInterface $unitRegRepository,
        SearchCriteriaBuilder $searchCriteriaBuilder
    ) {
        parent::__construct($context);
        $this->configHelper = $configHelper;
        $this->customerSession = $customerSession;
        $this->unitRegCollectionFactory = $unitRegCollectionFactory;
        $this->serialize = $serialize;
        $this->partnerResourceModel = $partnerResourceModel;
        $this->companyDetails = $companyDetails;
        $this->unitRegRepository = $unitRegRepository;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
    }

    /**
     * @param Unit $unit
     * @return string
     * @throws LocalizedException
     */
    public function getEngineStatus(Unit $unit)
    {
        $expiredMonths = $this->configHelper->getEngineExpired();
        $expiredMonths = $expiredMonths ?: 24;

        if ($unit->getConsumerNum()) {
            return Unit::STATUS_REGISTERED;
        }
        $shipDate = $unit->getShipDate();
        $now = date(\Magento\Framework\Stdlib\DateTime::DATE_PHP_FORMAT, time());
        if ($shipDate && strtotime($shipDate . " +" . $expiredMonths . " months") < strtotime($now)) {
            return Unit::STATUS_EXPIRED;
        }
        /**
         * @Hidro-Le
         * @TODO - Fixed
         * Đây là class helper không sử dụng resource field to filter ở
         *       đây chuyển logic này xuống repository. getBySerialNo hoặc xài getList sử dụng $searchCriteria
         */
        $unitRegs = $this->getUnitRegBySerialNo($unit->getSerialNo());
        $unitRegCount = count($unitRegs);
        if ($unitRegCount > 0) {
            return Unit::STATUS_REGISTERED;
        }
        return Unit::STATUS_UNREGISTERED;
    }

    /**
     * @param $serialNo
     * @return UnitRegInterface[]
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getUnitRegBySerialNo($serialNo): array
    {
        $this->searchCriteriaBuilder->addFilter(
            UnitRegInterface::SERIAL_NO,
            $serialNo
        );
        $searchCriteria = $this->searchCriteriaBuilder->create();
        $result = $this->unitRegRepository->getList($searchCriteria);
        return $result->getItems();
    }

    /**
     * @return array|array[]
     */
    public function getUmOptions()
    {
        $umListConfig = $this->configHelper->getUmList();
        $umListConfig = $this->serialize->unserialize($umListConfig);
        if (!empty($umListConfig)) {
            $options[] = ['label' => __('Please select UOM'), 'value' => ''];
            foreach ($umListConfig as $row) {
                $options[] = [
                    'value' => $row['um'],
                    'label' => $row['description']
                ];
            }
            return $options;
        }
        return [
            ['label' => __('Please select UOM'), 'value' => ''],
            ['label' => __('BD - Bundle'), 'value' => 'BD'],
            ['label' => __('BG - Bag'), 'value' => 'BG'],
            ['label' => __('BX - Box'), 'value' => 'BX'],
            ['label' => __('CA - Case'), 'value' => 'CA'],
            ['label' => __('CF - Cubic Feet'), 'value' => 'CF'],
            ['label' => __('DD - Degree'), 'value' => 'DD'],
            ['label' => __('DR - Drum'), 'value' => 'DR'],
            ['label' => __('EA - Each'), 'value' => 'EA'],
            ['label' => __('FT - Foot'), 'value' => 'FT'],
            ['label' => __('GA - Gallon'), 'value' => 'GA'],
            ['label' => __('GR - Gram'), 'value' => 'GR'],
            ['label' => __('HR - Hours'), 'value' => 'HR'],
            ['label' => __('IN - Inch'), 'value' => 'IN'],
            ['label' => __('KG - Kilogram'), 'value' => 'KG'],
            ['label' => __('LB - Pound'), 'value' => 'LB'],
            ['label' => __('LF - Linear Foot'), 'value' => 'LF'],
            ['label' => __('M2 - Millimeter-Actual'), 'value' => 'M2'],
            ['label' => __('MB - Millimeter-Nominal'), 'value' => 'MB'],
            ['label' => __('MJ - Minutes'), 'value' => 'MJ'],
            ['label' => __('PR - Pair'), 'value' => 'PR'],
            ['label' => __('PS - Pounds per Sq. Inch'), 'value' => 'PS'],
            ['label' => __('PU - Mass Pounds'), 'value' => 'PU'],
            ['label' => __('QT - Quart'), 'value' => 'QT'],
            ['label' => __('RA - Rack'), 'value' => 'RA'],
            ['label' => __('RL - Roll'), 'value' => 'RL'],
            ['label' => __('SF - Square Foot'), 'value' => 'SF'],
            ['label' => __('SI - Square Inch'), 'value' => 'SI'],
            ['label' => __('ST - Set'), 'value' => 'ST'],
            ['label' => __('TN - Net Ton (2,000 LB)'), 'value' => 'TN'],
        ];
    }

    /**
     * @return int
     */
    public function getMaxFileSize()
    {
        return (int)$this->configHelper->getMaxFileSize();
    }

    /**
     * @return false|mixed|null
     * @throws LocalizedException
     */
    public function isPartner()
    {
        /**
         * @Hidro-Le
         * @TODO - Review
         * Nội dung hàm không đúng với tên hàm (Is partner nhưng lại return partner)
         *   Return type không consistency
         */
        if ($this->customerSession->isLoggedIn()) {
            if ($this->partnerCache !== null) {
                return $this->partnerCache;
            }
            $customerId = $this->customerSession->getCustomer()->getId();
            $companyId = $this->companyDetails->getInfo($customerId)->getId();
            $partner = $this->partnerFactory->create();
            $this->partnerResourceModel->loadByCompanyId($partner, $companyId);
            if ($partner->hasData()) {
                $this->partnerCache = $partner;
                return $partner;
            }
        }
        return false;
    }

    /**
     * @return false|mixed|null
     * @throws LocalizedException
     */
    public function getCurrentPartner()
    {
        if ($this->isPartner() !== false) {
            return $this->partnerCache;
        }
        return false;
    }
}
