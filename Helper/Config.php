<?php
/**
 * Authors: Alex Gusev <alex@flancer64.com>
 * Since: 2018
 */

namespace Flancer32\LogApi\Helper;

use Magento\Framework\App\Config\ScopeConfigInterface as AScopeCfg;

/**
 * Helper to get store configuration parameters related to the module.
 *
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
    )
    {
        $this->scopeConfig = $scopeConfig;
        $this->appState = $appState;
    }

    /**
     * JS errors logging activity.
     *
     * @param string $scopeType
     * @param string $scopeCode
     * @return bool
     */
    public function getJsEnabled($scopeType = AScopeCfg::SCOPE_TYPE_DEFAULT, $scopeCode = null)
    {
        $result = $this->scopeConfig->getValue('system/flancer32_log_api/js_enabled', $scopeType, $scopeCode);
        $result = filter_var($result, FILTER_VALIDATE_BOOLEAN);
        return $result;
    }

    /**
     * Web API logging activity.
     *
     * @param string $scopeType
     * @param string $scopeCode
     * @return bool
     */
    public function getWebEnabled($scopeType = AScopeCfg::SCOPE_TYPE_DEFAULT, $scopeCode = null)
    {
        $result = $this->scopeConfig->getValue('system/flancer32_log_api/web_enabled', $scopeType, $scopeCode);
        $result = filter_var($result, FILTER_VALIDATE_BOOLEAN);
        return $result;
    }

    /**
     * Is Logging of request headers activated.
     *
     * @param string $scopeType
     * @param null $scopeCode
     * @return bool
     */
    public function getLogHeaderValues($scopeType = AScopeCfg::SCOPE_TYPE_DEFAULT, $scopeCode = null)
    {
        $result = $this->scopeConfig->getValue('system/flancer32_log_api/log_request_headers', $scopeType, $scopeCode);
        $result = filter_var($result, FILTER_VALIDATE_BOOLEAN);
        return $result;
    }

}