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
 * Zoom control.
 *
 * @package Netzmacht\LeafletPHP\Definition\Control
 */
class Zoom extends AbstractControl
{
    /**
     * Default position.
     *
     * @var string
     */
    protected $defaultPosition = self::POSITION_TOP_LEFT;

    /**
     * {@inheritdoc}
     */
    public static function getType()
    {
        return 'Control.Zoom';
    }

    /**
     * Set text on the zoom in button.
     *
     * @param string $value The text.
     *
     * @return $this
     * @see    http://leafletjs.com/reference.html#control-zoom-zoomintext
     */
    public function setZoomInText($value)
    {
        return $this->setOption('zoomInText', $value);
    }

    /**
     * Get the text on the zoom in button.
     *
     * @return string
     * @see    http://leafletjs.com/reference.html#control-zoom-zoomintext
     */
    public function getZoomInText()
    {
        return $this->getOption('zoomInText', '+');
    }

    /**
     * Set text on the zoom out button.
     *
     * @param string $value The text.
     *
     * @return $this
     * @see    http://leafletjs.com/reference.html#control-zoom-zoomouttext
     */
    public function setZoomOutText($value)
    {
        return $this->setOption('zoomOutText', $value);
    }
    
    /**
     * Set title on the zoom in button.
     *
     * @param string $value The title.
     *
     * @return $this
     * @see    http://leafletjs.com/reference.html#control-zoom-zoomintitle
     */
    public function setZoomInTitle($value)
    {
        return $this->setOption('zoomInTitle', $value);
    }

    /**
     * Get the text on the zoom out button.
     *
     * @return string
     * @see    http://leafletjs.com/reference.html#control-zoom-zoomouttext
     */
    public function getZoomOutText()
    {
        return $this->getOption('zoomOutText', '-');
    }

    /**
     * Get the title on the zoom in button.
     *
     * @return string
     * @see    http://leafletjs.com/reference.html#control-zoom-zoomintitle
     */
    public function getZoomInTitle()
    {
        return $this->getOption('zoomInTitle', 'Zoom in');
    }


    /**
     * Set title on the zoom out button.
     *
     * @param string $value The title.
     *
     * @return $this
     * @see    http://leafletjs.com/reference.html#control-zoom-zoomouttitle
     */
    public function setZoomOutTitle($value)
    {
        return $this->setOption('zoomOutTitle', $value);
    }

    /**
     * Get the title on the zoom out button.
     *
     * @return string
     * @see    http://leafletjs.com/reference.html#control-zoom-zoomouttitle
     */
    public function getZoomOutTitle()
    {
        return $this->getOption('zoomOutTitle', 'Zoom out');
    }

    /**
     * Call enable method.
     *
     * @return $this
     */
    public function enable()
    {
        return $this->addMethod('enable');
    }

    /**
     * Call disable method.
     *
     * @return $this
     */
    public function disable()
    {
        return $this->addMethod('disable');
    }
}
