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

namespace Netzmacht\LeafletPHP\Definition\Vector;

/**
 * Trait PathOptionsTrait.
 *
 * @package Netzmacht\LeafletPHP\Definition\Vector
 */
trait PathOptionsTrait
{
    /**
     * Set the stroke value.
     *
     * @param bool $value If true a stroke is drwan.
     *
     * @return $this
     * @see    http://leafletjs.com/reference.html#path-stroke
     */
    public function setStroke($value)
    {
        return $this->setOption('stroke', (bool) $value);
    }

    /**
     * Check if stroke is enabled.
     *
     * @return bool
     * @see    http://leafletjs.com/reference.html#path-stroke
     */
    public function hasStroke()
    {
        return $this->getOption('stroke', true);
    }

    /**
     * Set the stroke color.
     *
     * @param string $value Stroke color.
     *
     * @return $this
     * @see    http://leafletjs.com/reference.html#path-color
     */
    public function setColor($value)
    {
        return $this->setOption('color', $value);
    }

    /**
     * Get the stroke color.
     *
     * @return string
     * @see    http://leafletjs.com/reference.html#path-color
     */
    public function getColor()
    {
        return $this->getOption('color', '#03f');
    }

    /**
     * Set the stroke weight.
     *
     * @param int $value Stroke weight.
     *
     * @return $this
     * @see    http://leafletjs.com/reference.html#path-weight
     */
    public function setWeight($value)
    {
        return $this->setOption('weight', (int) $value);
    }

    /**
     * Get the stroke weight.
     *
     * @return int
     * @see    http://leafletjs.com/reference.html#path-weight
     */
    public function getWeight()
    {
        return $this->getOption('weight', 5);
    }

    /**
     * Set the opacity.
     *
     * @param float $value Path opacity.
     *
     * @return $this
     * @see    http://leafletjs.com/reference.html#path-opacity
     */
    public function setOpacity($value)
    {
        return $this->setOption('opacity', (float) $value);
    }

    /**
     * Get opacity.
     *
     * @return float
     * @see    http://leafletjs.com/reference.html#path-opacity
     */
    public function getOpacity()
    {
        return $this->getOption('opacity', 0.5);
    }

    /**
     * Fill the path.
     *
     * @param bool|string $value If true a fill is drwan.
     *
     * @return $this
     * @see    http://leafletjs.com/reference.html#path-fill
     */
    public function setFill($value)
    {
        return $this->setOption('fill', (bool) $value);
    }

    /**
     * Check if fill is enabled.
     *
     * @return bool|string
     * @see    http://leafletjs.com/reference.html#path-fill
     */
    public function isFill()
    {
        return $this->getOption('fill', 'depends');
    }

    /**
     * Set the stroke fill color.
     *
     * @param string $value Stroke fill color.
     *
     * @return $this
     * @see    http://leafletjs.com/reference.html#path-fillcolor
     */
    public function setFillColor($value)
    {
        return $this->setOption('fillColor', $value);
    }

    /**
     * Get the stroke fill color.
     *
     * @return string
     * @see    http://leafletjs.com/reference.html#path-fillcolor
     */
    public function getFillColor()
    {
        return $this->getOption('fillColor', '#03f');
    }

    /**
     * Set the fill opacity.
     *
     * @param float $value Fill opacity.
     *
     * @return $this
     * @see    http://leafletjs.com/reference.html#path-fillopacity
     */
    public function setFillOpacity($value)
    {
        return $this->setOption('fillOpacity', (float) $value);
    }

    /**
     * Get fill opacity.
     *
     * @return float
     * @see    http://leafletjs.com/reference.html#path-fillopacity
     */
    public function getFillOpacity()
    {
        return $this->getOption('fillOpacity', 0.2);
    }

    /**
     * Set the stroke dash pattern.
     *
     * @param string $value The dash pattern.
     *
     * @return $this
     * @see    http://leafletjs.com/reference.html#path-dasharray
     * @see    https://developer.mozilla.org/en/SVG/Attribute/stroke-dasharray
     */
    public function setDashArray($value)
    {
        return $this->setOption('dashArray', $value);
    }

    /**
     * Get stroke dash pattern.
     *
     * @return float
     * @see    http://leafletjs.com/reference.html#path-dasharray
     * @see    https://developer.mozilla.org/en/SVG/Attribute/stroke-dasharray
     */
    public function getDashArray()
    {
        return $this->getOption('dashArray', null);
    }

    /**
     * Set line cap string.
     *
     * @param string $value The line cap.
     *
     * @return $this
     * @see    http://leafletjs.com/reference.html#path-linecap
     * @see    https://developer.mozilla.org/en-US/docs/Web/SVG/Attribute/stroke-linecap
     */
    public function setLineCap($value)
    {
        return $this->setOption('lineCap', $value);
    }

    /**
     * Get the line cap string.
     *
     * @return float
     * @see    http://leafletjs.com/reference.html#path-linecap
     * @see    https://developer.mozilla.org/en/SVG/Attribute/stroke-linecap
     */
    public function getLineCap()
    {
        return $this->getOption('lineCap', null);
    }

    /**
     * Set line cap string.
     *
     * @param string $value The line cap.
     *
     * @return $this
     * @see    http://leafletjs.com/reference.html#path-linejoin
     * @see    https://developer.mozilla.org/en-US/docs/Web/SVG/Attribute/stroke-linejoin
     */
    public function setLineJoin($value)
    {
        return $this->setOption('lineJoin', $value);
    }

    /**
     * Get the line cap string.
     *
     * @return float
     * @see    http://leafletjs.com/reference.html#path-linejoin
     * @see    https://developer.mozilla.org/en/SVG/Attribute/stroke-linejoin
     */
    public function getLineJoin()
    {
        return $this->getOption('lineJoin', null);
    }

    /**
     * Set interactive.
     *
     * @param bool $value If true path is interactive.
     *
     * @return $this
     * @see    http://leafletjs.com/reference.html#path-interactive
     */
    public function setInteractive($value)
    {
        return $this->setOption('interactive', (bool) $value);
    }

    /**
     * Check if path is interactive.
     *
     * @return bool
     * @see    http://leafletjs.com/reference.html#path-interactive
     */
    public function isInteractive()
    {
        return $this->getOption('interactive', true);
    }

    /**
     * Set pointer events string.
     *
     * @param string $value The pointer events attribute.
     *
     * @return $this
     * @see    http://leafletjs.com/reference.html#path-pointerevents
     */
    public function setPointerEvents($value)
    {
        return $this->setOption('pointerEvents', $value);
    }

    /**
     * Get the pointer event attribute.
     *
     * @return string
     * @see    http://leafletjs.com/reference.html#path-pointerevents
     */
    public function getPointerEvents()
    {
        return $this->getOption('pointerEvents', null);
    }

    /**
     * Custom element class name.
     *
     * @param string $value The class name.
     *
     * @return $this
     * @see    http://leafletjs.com/reference.html#path-classname
     */
    public function setClassName($value)
    {
        return $this->setOption('className', $value);
    }

    /**
     * Get the classname.
     *
     * @return string
     * @see    http://leafletjs.com/reference.html#path-classname
     */
    public function getClassName()
    {
        return $this->getOption('className', '');
    }
}
