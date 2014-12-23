<?php

/**
 * @package    dev
 * @author     David Molineus <david.molineus@netzmacht.de>
 * @copyright  2014 netzmacht creative David Molineus
 * @license    LGPL 3.0
 * @filesource
 *
 */

namespace Netzmacht\LeafletPHP\Definition\Control;


class Scale extends AbstractControl
{
    /**
     * {@inheritdoc}
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
     * @see http://leafletjs.com/reference.html#control-scale-maxwidth
     *
     * @param int $width Max width of the control in pixels.
     *
     * @return $this
     */
    public function setMaxWidth($width)
    {
        return $this->setOption('maxWidth', (int) $width);
    }

    /**
     * Get the max width.
     *
     * @see http://leafletjs.com/reference.html#control-scale-maxwidth
     *
     * @return int
     */
    public function getMaxWidth()
    {
        return $this->getOption('maxWidth', 100);
    }

    /**
     * Enable or disable the metric scale.
     *
     * @see http://leafletjs.com/reference.html#control-scale-metric
     *
     * @param bool $scale Enable or disable the scale.
     *
     * @return $this
     */
    public function setMetric($scale)
    {
        return $this->setOption('metric', (bool) $scale);
    }

    /**
     * Check if metric scale is enabled.
     *
     * @see http://leafletjs.com/reference.html#control-scale-metric
     *
     * @return bool
     */
    public function isMetric()
    {
        return $this->getOption('metric', true);
    }

    /**
     * Enable or disable the imperial scale.
     *
     * @see http://leafletjs.com/reference.html#control-scale-imperial
     *
     * @param bool $scale Enable or disable the scale.
     *
     * @return $this
     */
    public function setImperial($scale)
    {
        return $this->setOption('imperial', (bool) $scale);
    }

    /**
     * Check if imperial scale is enabled.
     *
     * @see http://leafletjs.com/reference.html#control-scale-imperial
     *
     * @return bool
     */
    public function isImperial()
    {
        return $this->getOption('imperial', true);
    }

    /**
     * Set update when idle.
     *
     * @see http://leafletjs.com/reference.html#control-scale-updatewhenidle
     *
     * @param bool $update If true the control is updated on moveend.
     *
     * @return $this
     */
    public function setUpdateWhenIdle($update)
    {
        return $this->setOption('updateWhenIdle', (bool) $update);
    }

    /**
     * Check if update when idle is enabled.
     *
     * @see http://leafletjs.com/reference.html#control-scale-updatewhenidle
     *
     * @return bool
     */
    public function isUpdateWhenIdle()
    {
        return $this->getOption('updateWhenIdle', false);
    }
}
