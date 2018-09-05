<?php
/**
 * Authors: Alex Gusev <alex@flancer64.com>
 * Since: 2018
 */

namespace Flancer32\LogApi\Helper;

/**
 * Helper to get configuration parameters related to the module.
 * @SuppressWarnings(PHPMD.BooleanGetMethodName)
 */
class Config
{
    /** @var \Magento\Framework\App\State */
    private $appState;
    /** @var \Magento\Framework\App\Config\ScopeConfigInterface */
    private $scopeConfig;

    public function __construct(
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        \Magento\Framework\App\State $appState
    ) {
        $this->scopeConfig = $scopeConfig;
        $this->appState = $appState;
    }

    /**
     * Web API logging activity.
     *
     * @return bool
     */
    public function getEnabled()
    {
        $result = $this->scopeConfig->getValue('dev/flancer32_log_api/enabled');
        $result = filter_var($result, FILTER_VALIDATE_BOOLEAN);
        return $result;
    }

}