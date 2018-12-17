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

use Netzmacht\LeafletPHP\Definition\UI\Popup;

/**
 * Interface HasPopup describes definitions which can open a popup.
 *
 * @package Netzmacht\LeafletPHP\Definition
 */
interface HasPopup
{
    /**
     * Set the popup content.
     *
     * @param string $content The popup content.
     *
     * @return $this
     */
    public function setPopupContent($content);

    /**
     * Get the popup content.
     *
     * @return string
     */
    public function getPopupContent();

    /**
     * Bind marker to a popup.
     *
     * @param Popup|string $popup   The popup.
     * @param array|null   $options Optional popup options.
     *
     * @return $this
     */
    public function bindPopup($popup, $options = null);

    /**
     * Get bound popup.
     *
     * @return Popup|string
     */
    public function getPopup();

    /**
     * Get popup options.
     *
     * @return array|null
     */
    public function getPopupOptions();

    /**
     * Unbind a popup.
     *
     * @return $this
     */
    public function unbindPopup();
}
