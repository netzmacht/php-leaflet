<?php

/**
 * PHP Leaflet library.
 *
 * @package    php-leaflet
 * @author     David Molineus <david.molineus@netzmacht.de>
 * @copyright  2014-2018 netzmacht David Molineus
 * @license    LGPL-3.0-or-later https://github.com/netzmacht/php-leaflet/blob/master/LICENSE
 * @filesource
 */

namespace Netzmacht\LeafletPHP\Definition;

use Netzmacht\LeafletPHP\Definition;

/**
 * Interface Control describe the Controls.
 *
 * @package Netzmacht\LeafletPHP\Definition
 */
interface Control extends Definition, MapObject
{
    /**
     * Get options of the control.
     *
     * @return mixed
     */
    public function getOptions();
}
