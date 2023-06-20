<?php
namespace Variux\Warranty\Logger;

use Monolog\Logger;

class Handler extends \Magento\Framework\Logger\Handler\Base
{
    /**
     * Logging level
     * @var int
     */
    protected $loggerType = Logger::INFO;

    /**
     * Logging File name
     * @var string
     */
    protected $fileName = '/var/log/warranty.log';
}
