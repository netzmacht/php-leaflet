<?php

/**
 * @package    dev
 * @author     David Molineus <david.molineus@netzmacht.de>
 * @copyright  2015 netzmacht creative David Molineus
 * @license    LGPL 3.0
 * @filesource
 *
 */

namespace Netzmacht\LeafletPHP\Definition\Type;

use Netzmacht\LeafletPHP\Definition\AbstractDefinition;
use Netzmacht\LeafletPHP\Definition\HasOptions;
use Netzmacht\LeafletPHP\Definition\OptionsTrait;

abstract class AbstractIcon extends AbstractDefinition implements HasOptions, Icon
{
    use OptionsTrait;

    /**
     * Default class name.
     *
     * @var string
     */
    protected static $defaultClassName = '';

    /**
     * The icon size as point.
     *
     * @param array $size The icon size as point.
     *
     * @return $this
     * @see    http://leafletjs.com/reference.html#divicon-iconsize
     */
    public function setIconSize($size)
    {
        return $this->setOption('iconSize', $size);
    }

    /**
     * Get the icon size.
     *
     * @return array|null
     * @see    http://leafletjs.com/reference.html#divicon-iconsize
     */
    public function getIconSize()
    {
        return $this->getOption('iconSize');
    }

    /**
     * The coordinates of the "tip" of the icon (relative to its top left corner).
     *
     * @param array $point The coordinates as point
     *
     * @return $this
     * @see    http://leafletjs.com/reference.html#divicon-iconanchor
     */
    public function setIconAnchor($point)
    {
        return $this->setOption('iconAnchor', $point);
    }

    /**
     * Get the icon anchor.
     *
     * @return array|null
     * @see    http://leafletjs.com/reference.html#divicon-iconanchor
     */
    public function getIconAnchor()
    {
        return $this->getOption('iconAnchor');
    }

    /**
     * The coordinates of the point from which popups will "open", relative to the icon anchor.
     *
     * @param array $point The coordinates as point
     *
     * @return $this
     * @see    http://leafletjs.com/reference.html#divicon-popupanchor
     */
    public function setPopupAnchor($point)
    {
        return $this->setOption('popupAnchor', $point);
    }

    /**
     * Get the icon anchor.
     *
     * @return array|null
     * @see    http://leafletjs.com/reference.html#divicon-popupanchor
     */
    public function getPopupAnchor()
    {
        return $this->getOption('popupAnchor');
    }

    /**
     * Set a custom class name to assign to the icon.
     *
     * @param string $className The custom class name.
     *
     * @return $this
     * @see    http://leafletjs.com/reference.html#divicon-classname
     */
    public function setClassName($className)
    {
        return $this->setOption('className', $className);
    }

    /**
     * Get the clas name.
     *
     * @return string
     */
    public function getClassName()
    {
        return $this->getOption('className', static::$defaultClassName);
    }
}
