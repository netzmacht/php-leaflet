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
 * Interface MapObject describes elements which can be added to a map.
 *
 * @package Netzmacht\LeafletPHP\Definition
 */
interface MapObject
{
    /**
     * Add object to the map.
     *
     * @param Map $map The map.
     *
     * @return $this
     */
    public function addTo(Map $map);
}
