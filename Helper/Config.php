<?php

namespace Variux\Warranty\Helper;

class Config extends \Magento\Framework\App\Helper\AbstractHelper
{
    protected $configSection = "warranty";

    /**
     * Get Config
     *
     * @param string $path
     * @return mixed
     */
    public function getConfig($path)
    {
        return $this->scopeConfig->getValue(
            $this->configSection . "/" . $path,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * Get Um List
     *
     * @return mixed
     */
    public function getUmList()
    {
        return $this->getConfig("misc/um_list");
    }

    /**
     * Get Engine Expired
     *
     * @return mixed
     */
    public function getEngineExpired()
    {
        return $this->getConfig("engine/expired");
    }

    /**
     * Get Max File Size
     *
     * @return number
     */
    public function getMaxFileSize()
    {
        return $this->getConfig("material/max_file_size") ? : 20;
    }
}
