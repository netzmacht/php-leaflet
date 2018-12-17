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

namespace Netzmacht\LeafletPHP;

/**
 * Interface Assets describes the result of the leaflet building.
 *
 * @package Netzmacht\LeafletPHP
 */
interface Assets
{
    const TYPE_SOURCE = 'source';
    const TYPE_FILE   = 'file';
    const TYPE_URL    = 'url';

    /**
     * Add a javascript.
     *
     * @param string $script Javascript source.
     * @param string $type   The resource type.
     *
     * @return $this
     */
    public function addJavascript($script, $type = self::TYPE_SOURCE);

    /**
     * Add a stylesheet.
     *
     * @param string $stylesheet The stylesheet.
     * @param string $type       The resource type.
     *
     * @return $this
     */
    public function addStylesheet($stylesheet, $type = self::TYPE_FILE);

    /**
     * Set the map javascript.
     *
     * @param string $map The map javscript.
     *
     * @return $this
     */
    public function setMap($map);

    /**
     * Get the map javascript.
     *
     * @return string
     */
    public function getMap();
}
