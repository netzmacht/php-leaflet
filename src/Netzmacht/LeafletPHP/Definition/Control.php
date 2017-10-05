<?php

/**
 * PHP Leaflet library.
 *
 * @package    php-leaflet
 * @author     David Molineus <david.molineus@netzmacht.de>
 * @copyright  2014-2017 netzmacht David Molineus
 * @license    LGPL 3.0
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
