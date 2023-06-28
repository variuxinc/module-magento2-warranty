<?php

namespace Variux\Warranty\Helper;

use Magento\Store\Model\ScopeInterface;

class Config extends \Magento\Framework\App\Helper\AbstractHelper
{
    const MODULE_PATH = 'warranty_settings/';
    const XML_PATH_EMAIL_IDENTITY = 'email/identity';
    protected $configSection = "warranty";

    public function getModuleConfig($path, $storeId = null)
    {
        return $this->scopeConfig->getValue(
            self::MODULE_PATH . $path,
            ScopeInterface::SCOPE_STORE,
            $storeId
        );
    }

    /**
     * @param $path
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
     * @return mixed
     */
    public function getUmList()
    {
        return $this->getConfig("misc/um_list");
    }

    /**
     * @return mixed
     */
    public function getEngineExpired()
    {
        return $this->getConfig("engine/expired");
    }

    /**
     * @return number
     */
    public function getMaxFileSize()
    {
        return $this->getConfig("material/max_file_size") ? : 20;
    }

    public function getEmailIdentity()
    {
        return $this->getModuleConfig(self::XML_PATH_EMAIL_IDENTITY);
    }
}
