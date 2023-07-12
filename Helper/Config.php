<?php

namespace Variux\Warranty\Helper;

use Magento\Store\Model\ScopeInterface;

class Config extends \Magento\Framework\App\Helper\AbstractHelper
{
    const MODULE_PATH = 'btob/website_configuration/warranty';
    const XML_PATH_IS_ACTIVE = "general/warranty_active";
    const XML_PATH_EMAIL_IDENTITY = 'notification/email_identity';
    const XML_PATH_EMAIL_TEMPLATE = 'notification/template';
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

    public function getEmailTemplate()
    {
        return $this->getModuleConfig(self::XML_PATH_EMAIL_TEMPLATE);
    }

    public function getIsModuleActive()
    {
        return $this->getModuleConfig(self::XML_PATH_IS_ACTIVE);
    }
}
