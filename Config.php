<?php
/**
 * Container for module's constants (hardcoded configuration).
 *
 * Authors: Alex Gusev <alex@flancer64.com>
 * Since: 2018
 */

namespace Flancer32\LogApi;

class Config
{
    /** This module name. */
    const MODULE = self::MODULE_VENDOR . '_' . self::MODULE_PACKAGE;
    const MODULE_PACKAGE = 'LogApi';
    const MODULE_VENDOR = 'Flancer32';
    /** see ./etc/frontend/routes.xml */
    const ROUTE_FRONT = 'fl32log';
}