<?php
/**
 * Authors: Alex Gusev <alex@flancer64.com>
 * Since: 2018
 */

namespace Flancer32\LogApi\App;

/**
 * Log API related events into separate log file.
 */
class Logger
    extends \Magento\Framework\Logger\Monolog
{
    const FILENAME = 'api.log';
    const NAME = 'API';

    public function __construct()
    {
        $handlers = $this->initHandlers();
        $processors = [];
        parent::__construct(static::NAME, $handlers, $processors);
    }

    private function initFormatter()
    {
        $dateFormat = "Y-m-d H:i:s";
        $msgFormat = "%datetime%-%channel%.%level_name% - %message%\n";
        $result = new \Monolog\Formatter\LineFormatter($msgFormat, $dateFormat);
        return $result;
    }

    private function initHandlers()
    {
        $result = [];
        $formatter = $this->initFormatter();

        /* add file handler */
        $path = BP . '/var/log/' . static::FILENAME;
        $handler = new \Monolog\Handler\StreamHandler($path);
        $handler->setFormatter($formatter);
        $result[] = $handler;

        return $result;
    }
}