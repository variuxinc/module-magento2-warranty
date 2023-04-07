<?php

namespace Variux\Warranty\Helper;

class Data extends \Magento\Framework\App\Helper\AbstractHelper
{
    const DENY_ACCESS_URL = 'warranty/index/accessdeny';

    /**
     * @var Config
     */
    protected $configHelper;

    /**
     * @var \Magento\Customer\Model\Session
     */
    protected $customerSession;

    /**
     * @var \Variux\Warranty\Model\PartnerFactory
     */
    protected $partnerFactory;

    /**
     * @var \Variux\Warranty\Model\ResourceModel\UnitReg\CollectionFactory
     */
    protected $unitRegCollectionFactory;

    /**
     * @var \Magento\Framework\Serialize\Serializer\Json
     */
    protected $serialize;

    protected $partnerCache = null;

    public function __construct(
        \Magento\Framework\App\Helper\Context $context,
        \Magento\Customer\Model\Session $customerSession,
        \Variux\Warranty\Model\ResourceModel\UnitReg\CollectionFactory $unitRegCollectionFactory,
        Config $configHelper,
        \Magento\Framework\Serialize\Serializer\Json $serialize
    ) {
        parent::__construct($context);
        $this->configHelper = $configHelper;
        $this->customerSession = $customerSession;
        $this->unitRegCollectionFactory = $unitRegCollectionFactory;
        $this->serialize = $serialize;
    }

    /**
     * @param \Variux\Warranty\Model\Unit $unit
     * @return string
     */
    public function getEngineStatus(\Variux\Warranty\Model\Unit $unit)
    {
        $expiredMonths = $this->configHelper->getEngineExpired();
        $expiredMonths = $expiredMonths ?: 24;

        if ($unit->getConsumerNum()) {
            return \Variux\Warranty\Model\Unit::STATUS_REGISTERED;
        }
        $shipDate = $unit->getShipDate();
        $now = date(\Magento\Framework\Stdlib\DateTime::DATE_PHP_FORMAT, time());
        if ($shipDate && strtotime($shipDate . " +" . $expiredMonths . " months") < strtotime($now)) {
            return \Variux\Warranty\Model\Unit::STATUS_EXPIRED;
        }
        $collection = $this->unitRegCollectionFactory->create();
        $unitRegCount = $collection->addFieldToFilter("serial_no", ['eq' => $unit->getSerialNo()])->count();
        if ($unitRegCount > 0) {
            return \Variux\Warranty\Model\Unit::STATUS_REGISTERED;
        }
        return \Variux\Warranty\Model\Unit::STATUS_UNREGISTERED;
    }

    /**
     * @return array
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
     * @return number
     */
    public function getMaxFileSize()
    {
        return (int)$this->configHelper->getMaxFileSize();
    }
}
