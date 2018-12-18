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

/**
 * Interface Vector describes basic vector layers.
 *
 * @package Netzmacht\LeafletPHP\Definition
 */
interface Vector extends Layer, HasOptions
{
    /**
     * Get latitude longitude list.
     *
     * @return array
     */
    public function getLatLngs();
}
