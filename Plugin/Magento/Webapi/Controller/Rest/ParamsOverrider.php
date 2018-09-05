<?php
/**
 * Authors: Alex Gusev <alex@flancer64.com>
 * Since: 2018
 */

namespace Flancer32\LogApi\Plugin\Magento\Webapi\Controller\Rest;


/**
 * Log request JSON.
 */
class ParamsOverrider
{
    /** @var \Psr\Log\LoggerInterface */
    private $logger;

    public function __construct(
        \Flancer32\LogApi\App\Logger $logger
    ) {
        $this->logger = $logger;
    }

    /**
     * Log request JSON.
     *
     * @param \Magento\Webapi\Controller\Rest\ParamsOverrider $subject
     * @param $result
     * @return mixed
     */
    public function afterOverride(
        \Magento\Webapi\Controller\Rest\ParamsOverrider $subject,
        $result
    ) {
        try {
            $json = json_encode($result);
            /* don't log admin token requests */
            if (!(
                strstr($json, '"username":')
                && strstr($json, '"password":'))
            ) {
                $this->logger->info("Request: " . $json);
            } else {
                $this->logger->info("Request is skipped because contains 'username' and 'password' data.");
            }
        } catch (\Throwable $e) {
            /* do nothing and stealth exception */
        }
        return $result;
    }

}