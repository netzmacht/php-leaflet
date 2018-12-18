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

namespace Netzmacht\LeafletPHP\Plugins\ExtraMarkers;

use Netzmacht\JavascriptBuilder\Encoder;
use Netzmacht\JavascriptBuilder\Type\ConvertsToJavascript;
use Netzmacht\LeafletPHP\Definition\Type\AbstractIcon;
use Netzmacht\LeafletPHP\Encoder\EncodeHelperTrait;

/**
 * Class ExtraMarkers.
 *
 * @package Netzmacht\LeafletPHP\Plugins\ExtraMarkers
 */
class ExtraMarkersIcon extends AbstractIcon implements ConvertsToJavascript
{
    use EncodeHelperTrait;

    /**
     * {@inheritDoc}
     */
    public static function getType()
    {
        return 'ExtraMarkers.icon';
    }

    /**
     * {@inheritDoc}
     */
    public static function getRequiredLibraries()
    {
        $libs   = parent::getRequiredLibraries();
        $libs[] = 'leaflet-extra-markers';

        return $libs;
    }

    /**
     * Set the icon class.
     *
     * @param string $iconClass The icon class.
     *
     * @return $this
     */
    public function setIcon($iconClass)
    {
        return $this->setOption('icon', $iconClass);
    }

    /**
     * Get the icon class.
     *
     * @return string
     */
    public function getIcon()
    {
        return $this->getOption('icon');
    }

    /**
     * Set the iconColor.
     *
     * @param string $iconColor The iconColor.
     *
     * @return $this
     */
    public function setIconColor($iconColor)
    {
        return $this->setOption('iconColor', $iconColor);
    }

    /**
     * Get the iconColor.
     *
     * @return string
     */
    public function getIconColor()
    {
        return $this->getOption('iconColor', 'white');
    }

    /**
     * Set the markerColor.
     *
     * @param string $markerColor The markerColor.
     *
     * @return $this
     */
    public function setMarkerColor($markerColor)
    {
        return $this->setOption('markerColor', $markerColor);
    }

    /**
     * Get the markerColor.
     *
     * @return string
     */
    public function getMarkerColor()
    {
        return $this->getOption('markerColor', 'blue');
    }

    /**
     * Set the shape.
     *
     * @param string $shape The shape.
     *
     * @return $this
     */
    public function setShape($shape)
    {
        return $this->setOption('shape', $shape);
    }

    /**
     * Get the shape.
     *
     * @return string
     */
    public function getShape()
    {
        return $this->getOption('shape', 'circle');
    }

    /**
     * Set the number.
     *
     * @param string $number The number.
     *
     * @return $this
     */
    public function setNumber($number)
    {
        return $this->setOption('number', $number);
    }

    /**
     * Get the number.
     *
     * @return string
     */
    public function getNumber()
    {
        return $this->getOption('number');
    }

    /**
     * Set the prefix.
     *
     * @param string $prefix The prefix.
     *
     * @return $this
     */
    public function setPrefix($prefix)
    {
        return $this->setOption('prefix', $prefix);
    }

    /**
     * Get the prefix.
     *
     * @return string
     */
    public function getPrefix()
    {
        return $this->getOption('prefix');
    }

    /**
     * {@inheritDoc}
     */
    public function encode(Encoder $encoder, $flags = null)
    {
        $buffer = sprintf(
            '%s = L.ExtraMarkers.icon(%s)%s',
            $encoder->encodeReference($this),
            $encoder->encodeArray($this->getOptions(), JSON_FORCE_OBJECT),
            $encoder->close($flags)
        );

        $buffer .= $this->encodeMethodCalls($this->getMethodCalls(), $encoder, $flags);

        return $buffer;
    }
}
