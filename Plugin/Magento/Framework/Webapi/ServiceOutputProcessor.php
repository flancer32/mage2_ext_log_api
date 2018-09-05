<?php
/**
 * Authors: Alex Gusev <alex@flancer64.com>
 * Since: 2018
 */

namespace Flancer32\LogApi\Plugin\Framework\Webapi;

/**
 * Log REST response data.
 */
class ServiceOutputProcessor
{
    /** @var \Psr\Log\LoggerInterface */
    private $logger;

    public function __construct(
        \Flancer32\LogApi\App\Logger $logger
    ) {
        $this->logger = $logger;
    }

    /**
     * Log REST response data. 'Around' decoration is used to get service class & method names.
     *
     * @param \Magento\Framework\Webapi\ServiceOutputProcessor $subject
     * @param callable $proceed
     * @param mixed $data
     * @param string $serviceClassName
     * @param string $serviceMethodName
     * @return array
     */
    public function aroundProcess(
        \Magento\Framework\Webapi\ServiceOutputProcessor $subject,
        callable $proceed,
        $data,
        $serviceClassName,
        $serviceMethodName
    ) {
        $result = $proceed($data, $serviceClassName, $serviceMethodName);
        try {
            $json = json_encode($result);
            if (
                ($serviceClassName != 'Magento\Integration\Api\AdminTokenServiceInterface') &&
                ($serviceMethodName != 'createAdminAccessToken')
            ) {
                $msg = "Response '$serviceClassName::$serviceMethodName()': ";
                $msg .= $json;
                $this->logger->info($msg);
            }
        } catch (\Throwable $e) {
            /* do nothing and stealth exception */
        }
        return $result;
    }
}