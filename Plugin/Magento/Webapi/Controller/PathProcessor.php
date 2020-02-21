<?php
/**
 * Authors: Alex Gusev <alex@flancer64.com>
 * Since: 2018
 */

namespace Flancer32\LogApi\Plugin\Magento\Webapi\Controller;

use Flancer32\LogApi\Helper\Config;

/**
 * Log API paths processing.
 *
 * '/rest/store_view_code/V1/carts/mine/shipping-information' => '/V1/carts/mine/shipping-information'
 */
class PathProcessor
{

    /** @var \Magento\Framework\App\RequestInterface */
    private $request;

    /** @var Config */
    private $config;

    /** @var \Psr\Log\LoggerInterface */
    private $logger;

    public function __construct(
        \Magento\Framework\App\RequestInterface $request,
        \Flancer32\LogApi\Helper\Config $config,
        \Flancer32\LogApi\App\Logger $logger
    )
    {
        $this->request = $request;
        $this->config = $config;
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
    )
    {
        $result = $proceed($pathInfo);

        try {

            // get method and route
            $method = $this->request->getMethod();
            $msg = "Route ($method): '$pathInfo' => '$result'";

            $this->logger->info($msg);

            // log header (if setup in the config)
            if ($this->config->getLogHeaderValues()) {
                $this->logHeaders();
            }

        } catch (\Exception $e) {
            $this->logger->error($e->getMessage());
            $this->logger->error($e->getTraceAsString());
        }

        return $result;
    }

    private function logHeaders()
    {
        $headersAsString = $this->request->getHeaders()->toString();
        $msgHeaders = "Request-Headers: {$headersAsString}";
        $this->logger->info($msgHeaders);
    }

}