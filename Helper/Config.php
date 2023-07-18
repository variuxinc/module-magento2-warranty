<?php

namespace Variux\Warranty\Helper;

use Magento\Store\Model\ScopeInterface;

class Config extends \Magento\Framework\App\Helper\AbstractHelper
{
    const MODULE_PATH = 'btob/website_configuration/warranty/';
    const XML_PATH_IS_ACTIVE = "general/warranty_active";
    const XML_PATH_WARRANTY_EMAIL_IDENTITY = 'notification/warranty/email_identity';
    const XML_PATH_TRANSFER_EMAIL_IDENTITY = 'notification/transfer/email_identity';
    const XML_PATH_WARRANTY_EMAIL_TEMPLATE = 'notification/warranty/template';
    const XML_PATH_TRANSFER_EMAIL_TEMPLATE = 'notification/transfer/template';
    const XML_PATH_TRANSFER_EMAIL_TO = 'notification/transfer/mailTo';
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

    public function getWarrantyEmailIdentity()
    {
        return $this->getModuleConfig(self::XML_PATH_WARRANTY_EMAIL_IDENTITY);
    }

    public function getWarrantyEmailTemplate()
    {
        return $this->getModuleConfig(self::XML_PATH_WARRANTY_EMAIL_TEMPLATE);
    }

    public function getIsModuleActive()
    {
        return $this->getModuleConfig(self::XML_PATH_IS_ACTIVE);
    }

    public function getTransferEmailIdentity()
    {
        return $this->getModuleConfig(self::XML_PATH_TRANSFER_EMAIL_IDENTITY);
    }

    public function getTransferEmailTemplate()
    {
        return $this->getModuleConfig(self::XML_PATH_TRANSFER_EMAIL_TEMPLATE);
    }

    public function getTransferMailTo()
    {
        $emails =  $this->getModuleConfig(self::XML_PATH_TRANSFER_EMAIL_TO);
        if (!empty($emails)) {
            return array_map('trim', explode(',', $emails));
        }
        return null;
    }
}
