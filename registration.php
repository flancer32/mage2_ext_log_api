<?php
/**
 * Register Magneto module on composer's 'install' event.
 *
 * Authors: Alex Gusev <alex@flancer64.com>
 * Since: 2018
 */

\Magento\Framework\Component\ComponentRegistrar::register(
    \Magento\Framework\Component\ComponentRegistrar::MODULE,
    \Flancer32\LogApi\Config::MODULE, __DIR__);