<?php
namespace Variux\Warranty\Block\Engine;

use Magento\Directory\Model\ResourceModel\Region\CollectionFactory;
use Magento\Framework\App\Cache\Type\Config;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Json\EncoderInterface;
use Magento\Framework\View\Element\Template\Context;
use Variux\Warranty\Helper\Data;
use Variux\Warranty\Model\UnitFactory;
use Magento\Customer\Helper\Address;
use Magento\Directory\Helper\Data as MagentoDirectoryHelper;

class Edit extends \Magento\Directory\Block\Data
{
    /**
     * @var UnitFactory
     */
    protected $unitFactory;

    /**
     * @var Data
     */
    protected $dataHelper;
    /**
     * @var Address
     */
    protected $addressHelper;
    /**
     * @var MagentoDirectoryHelper
     */
    protected $magentoDirectoryHelper;

    /**
     * @param Context $context
     * @param MagentoDirectoryHelper $directoryHelper
     * @param EncoderInterface $jsonEncoder
     * @param Config $configCacheType
     * @param CollectionFactory $regionCollectionFactory
     * @param \Magento\Directory\Model\ResourceModel\Country\CollectionFactory $countryCollectionFactory
     * @param UnitFactory $unitFactory
     * @param Data $dataHelper
     * @param Address $addressHelper
     * @param MagentoDirectoryHelper $magentoDirectoryHelper
     * @param array $data
     */
    public function __construct(
        Context $context,
        \Magento\Directory\Helper\Data $directoryHelper,
        EncoderInterface $jsonEncoder,
        Config $configCacheType,
        CollectionFactory $regionCollectionFactory,
        \Magento\Directory\Model\ResourceModel\Country\CollectionFactory $countryCollectionFactory,
        UnitFactory $unitFactory,
        Data $dataHelper,
        Address $addressHelper,
        MagentoDirectoryHelper $magentoDirectoryHelper,
        array $data = []
    ) {
        parent::__construct(
            $context,
            $directoryHelper,
            $jsonEncoder,
            $configCacheType,
            $regionCollectionFactory,
            $countryCollectionFactory,
            $data
        );

        $this->unitFactory = $unitFactory;
        $this->dataHelper = $dataHelper;
        $this->addressHelper = $addressHelper;
        $this->magentoDirectoryHelper = $magentoDirectoryHelper;
    }

    /**
     * Get config
     *
     * @param string $path
     * @return string|null
     */
    public function getConfig($path)
    {
        return $this->_scopeConfig->getValue($path, \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    /**
     * @return string
     */
    public function getSerialNo()
    {
        return $this->getUnit() ? $this->getUnit()->getSerialNo() : "";
    }

    /**
     * @return string|null
     */
    public function getUnitDescription()
    {
        return $this->getUnit() ? $this->getUnit()->getDescription() : "";
    }

    /**
     * @return string|null
     */
    public function getUnitItem()
    {
        return $this->getUnit() ? $this->getUnit()->getItem() : "";
    }

    /**
     * @return bool
     */
    public function isEngineNotExist()
    {
        return $this->getEngineNumber() && !$this->getUnit();
    }

    /**
     * @return bool
     */
    public function isRegistered()
    {
        return $this->getEngineStatus() == \Variux\Warranty\Model\Unit::STATUS_REGISTERED;
    }

    /**
     * @return bool
     */
    public function isUnRegistered()
    {
        return $this->getEngineStatus() == \Variux\Warranty\Model\Unit::STATUS_UNREGISTERED;
    }

    /**
     * @return bool
     */
    public function isExpired()
    {
        return $this->getEngineStatus() == \Variux\Warranty\Model\Unit::STATUS_EXPIRED;
    }

    /**
     * @return bool|string
     */
    public function getEngineStatus()
    {
        $unit = $this->getUnit();
        if ($unit) {
            return $this->dataHelper->getEngineStatus($unit);
        }

        return false;
    }

    /**
     * @return bool|\Variux\Warranty\Model\Unit
     */
    public function getUnit()
    {
        $serialNo = $this->getEngineNumber();
        if ($serialNo) {
            $unit = $this->unitFactory->create()->loadBySerial($serialNo);
            if ($unit->hasData()) {
                return $unit;
            }
        }
        return false;
    }

    /**
     * @return mixed
     */
    public function getEngineNumber()
    {
        return $this->getRequest()->getParam("engine", false);
    }

    /**
     * @throws LocalizedException
     */
    public function getAttributeValidationClass($attributeCode): string
    {
        return $this->addressHelper->getAttributeValidationClass($attributeCode);
    }

    /**
     * @throws NoSuchEntityException
     */
    public function getRegionJson(): string
    {
        return $this->magentoDirectoryHelper->getRegionJson();
    }

    public function getCountriesWithOptionalZip($asJson = false)
    {
        return $this->magentoDirectoryHelper->getCountriesWithOptionalZip($asJson);
    }
}
