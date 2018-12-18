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

namespace Netzmacht\LeafletPHP\Definition\Control;

/**
 * Scale control.
 *
 * @package Netzmacht\LeafletPHP\Definition\Control
 */
class Scale extends AbstractControl
{
    /**
     * Default position.
     *
     * @var string
     */
    protected $defaultPosition = self::POSITION_BOTTOM_LEFT;

    /**
     * {@inheritdoc}
     */
    public static function getType()
    {
        return 'Control.Scale';
    }

    /**
     * Set the max width.
     *
     * @param int $width Max width of the control in pixels.
     *
     * @return $this
     * @see    http://leafletjs.com/reference.html#control-scale-maxwidth
     */
    public function setMaxWidth($width)
    {
        return $this->setOption('maxWidth', (int) $width);
    }

    /**
     * Get the max width.
     *
     * @return int
     * @see    http://leafletjs.com/reference.html#control-scale-maxwidth
     */
    public function getMaxWidth()
    {
        return $this->getOption('maxWidth', 100);
    }

    /**
     * Enable or disable the metric scale.
     *
     * @param bool $scale Enable or disable the scale.
     *
     * @return $this
     * @see    http://leafletjs.com/reference.html#control-scale-metric
     */
    public function setMetric($scale)
    {
        return $this->setOption('metric', (bool) $scale);
    }

    /**
     * Check if metric scale is enabled.
     *
     * @return bool
     * @see    http://leafletjs.com/reference.html#control-scale-metric
     */
    public function isMetric()
    {
        return $this->getOption('metric', true);
    }

    /**
     * Enable or disable the imperial scale.
     *
     * @param bool $scale Enable or disable the scale.
     *
     * @return $this
     * @see    http://leafletjs.com/reference.html#control-scale-imperial
     */
    public function setImperial($scale)
    {
        return $this->setOption('imperial', (bool) $scale);
    }

    /**
     * Check if imperial scale is enabled.
     *
     * @return bool
     * @see    http://leafletjs.com/reference.html#control-scale-imperial
     */
    public function isImperial()
    {
        return $this->getOption('imperial', true);
    }

    /**
     * Set update when idle.
     *
     * @param bool $update If true the control is updated on moveend.
     *
     * @return $this
     * @see    http://leafletjs.com/reference.html#control-scale-updatewhenidle
     */
    public function setUpdateWhenIdle($update)
    {
        return $this->setOption('updateWhenIdle', (bool) $update);
    }

    /**
     * Check if update when idle is enabled.
     *
     * @return bool
     * @see    http://leafletjs.com/reference.html#control-scale-updatewhenidle
     */
    public function isUpdateWhenIdle()
    {
        return $this->getOption('updateWhenIdle', false);
    }
}
