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

namespace Netzmacht\LeafletPHP\Assets;

/**
 * Interface GeneratesHtml describes an Assets object which generates the assets output.
 *
 * @package Netzmacht\LeafletPHP\Assets
 */
interface GeneratesHtml
{
    /**
     * Get map javascript with script tags.
     *
     * @return string
     */
    public function getMapHtml();

    /**
     * Get scripts html.
     *
     * @return string
     */
    public function getScriptsHtml();

    /**
     * Get styles html.
     *
     * @return string
     */
    public function getStylesHtml();

    /**
     * Get html.
     *
     * @param bool $includeMap Also include the map.
     *
     * @return string
     */
    public function getHtml($includeMap = true);
}
