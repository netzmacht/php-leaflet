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

use Netzmacht\LeafletPHP\Definition\AbstractDefinition;
use Netzmacht\LeafletPHP\Definition\OptionsTrait;

/**
 * Class AbstractIcon is the base icon implementation.
 *
 * @package Netzmacht\LeafletPHP\Definition\Type
 */
abstract class AbstractIcon extends AbstractDefinition implements Icon
{
    use OptionsTrait;

    /**
     * Default class name.
     *
     * @var string
     */
    protected static $defaultClassName = '';

    /**
     * {@inheritdoc}
     */
    public function setIconSize($size)
    {
        return $this->setOption('iconSize', $size);
    }

    /**
     * {@inheritdoc}
     */
    public function getIconSize()
    {
        return $this->getOption('iconSize');
    }

    /**
     * {@inheritdoc}
     */
    public function setIconAnchor($point)
    {
        return $this->setOption('iconAnchor', $point);
    }

    /**
     * {@inheritdoc}
     */
    public function getIconAnchor()
    {
        return $this->getOption('iconAnchor');
    }

    /**
     * {@inheritdoc}
     */
    public function setPopupAnchor($point)
    {
        return $this->setOption('popupAnchor', $point);
    }

    /**
     * {@inheritdoc}
     */
    public function getPopupAnchor()
    {
        return $this->getOption('popupAnchor');
    }

    /**
     * {@inheritdoc}
     */
    public function setClassName($className)
    {
        return $this->setOption('className', $className);
    }

    /**
     * {@inheritdoc}
     */
    public function getClassName()
    {
        return $this->getOption('className', static::$defaultClassName);
    }
}
