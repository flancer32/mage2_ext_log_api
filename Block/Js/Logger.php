<?php
/**
 * Authors: Alex Gusev <alex@flancer64.com>
 * Since: 2018
 */

namespace Flancer32\LogApi\Block\Js;


class Logger
    extends \Magento\Ui\Block\Logger
{
    private const STORAGE_KEY = 'fl32JsErrorsLog';
    private const STORAGE_MAX_SIZE = 1048576; //1Mb

    /** @var \Flancer32\LogApi\Helper\Config */
    private $hlpCfg;

    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Ui\Model\Config $config,
        \Flancer32\LogApi\Helper\Config $hlpCfg,
        array $data = []
    ) {
        parent::__construct($context, $config, $data);
        $this->hlpCfg = $hlpCfg;
    }

    public function getStorageKey()
    {
        return self::STORAGE_KEY;
    }

    public function getLocalStorageMaxSize()
    {
        return self::STORAGE_MAX_SIZE;
    }

    public function getStorageKeyOrig()
    {
        $result = $this->getSessionStorageKey();
        return $result;
    }

    public function isLocalStorageEnabled()
    {
        $result = $this->hlpCfg->getJsEnabled();
        return $result;
    }

    public function isOriginalLoggingEnabled()
    {
        $result = $this->isLoggingEnabled();
        return $result;
    }
}