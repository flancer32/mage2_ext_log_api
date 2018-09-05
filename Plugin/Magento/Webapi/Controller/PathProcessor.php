<?php
/**
 * Authors: Alex Gusev <alex@flancer64.com>
 * Since: 2018
 */

namespace Flancer32\LogApi\Plugin\Webapi\Controller;

/**
 * Log API paths processing.
 *
 * '/rest/store_view_code/V1/carts/mine/shipping-information' => '/V1/carts/mine/shipping-information'
 */
class PathProcessor
{
    /** @var \Psr\Log\LoggerInterface */
    private $logger;

    public function __construct(
        \Flancer32\LogApi\App\Logger $logger
    ) {
        $this->logger = $logger;
    }

    /**
     * Log API paths processing.
     *
     * @param \Magento\Webapi\Controller\PathProcessor $subject
     * @param callable $proceed
     * @param $pathInfo
     * @return string
     */
    public function aroundProcess(
        \Magento\Webapi\Controller\PathProcessor $subject,
        callable $proceed,
        $pathInfo
    ) {
        $result = $proceed($pathInfo);
        $msg = "Route: '$pathInfo' => '$result'";
        $this->logger->info($msg);
        return $result;
    }

}