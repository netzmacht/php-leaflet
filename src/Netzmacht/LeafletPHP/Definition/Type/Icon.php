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

namespace Netzmacht\LeafletPHP\Definition\Type;

use Netzmacht\LeafletPHP\Definition;
use Netzmacht\LeafletPHP\Definition\HasOptions;

/**
 * Interface describes Icon objects for Leaflet.
 *
 * @package Netzmacht\LeafletPHP\Definition\Type
 */
interface Icon extends Definition, HasOptions
{
    /**
     * The icon size as point.
     *
     * @param array $size The icon size as point.
     *
     * @return $this
     * @see    http://leafletjs.com/reference.html#divicon-iconsize
     */
    public function setIconSize($size);

    /**
     * Get the icon size.
     *
     * @return array|null
     * @see    http://leafletjs.com/reference.html#divicon-iconsize
     */
    public function getIconSize();

    /**
     * The coordinates of the "tip" of the icon (relative to its top left corner).
     *
     * @param array $point The coordinates as point.
     *
     * @return $this
     * @see    http://leafletjs.com/reference.html#divicon-iconanchor
     */
    public function setIconAnchor($point);

    /**
     * Get the icon anchor.
     *
     * @return array|null
     * @see    http://leafletjs.com/reference.html#divicon-iconanchor
     */
    public function getIconAnchor();

    /**
     * The coordinates of the point from which popups will "open", relative to the icon anchor.
     *
     * @param array $point The coordinates as point.
     *
     * @return $this
     * @see    http://leafletjs.com/reference.html#divicon-popupanchor
     */
    public function setPopupAnchor($point);

    /**
     * Get the icon anchor.
     *
     * @return array|null
     * @see    http://leafletjs.com/reference.html#divicon-popupanchor
     */
    public function getPopupAnchor();

    /**
     * Set a custom class name to assign to the icon.
     *
     * @param string $className The custom class name.
     *
     * @return $this
     * @see    http://leafletjs.com/reference.html#divicon-classname
     */
    public function setClassName($className);

    /**
     * Get the class name.
     *
     * @return string
     */
    public function getClassName();
}
