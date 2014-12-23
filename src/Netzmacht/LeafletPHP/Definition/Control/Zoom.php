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


class Zoom extends AbstractControl
{
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
     * @see http://leafletjs.com/reference.html#control-zoom-zoomintext
     *      
     * @param string $value The text.
     *
     * @return $this
     */
    public function setZoomInText($value)
    {
        return $this->setOption('zoomInText', $value);
    }

    /**
     * Get the text on the zoom in button.
     * 
     * @see http://leafletjs.com/reference.html#control-zoom-zoomintext
     *      
     * @return string
     */
    public function getZoomInText()
    {
        return $this->getOption('zoomInText', '+');
    }

    /**
     * Set text on the zoom out button.
     *
     * @see http://leafletjs.com/reference.html#control-zoom-zoomouttext
     *
     * @param string $value The text.
     *
     * @return $this
     */
    public function setZoomOutText($value)
    {
        return $this->setOption('zoomOutText', $value);
    }
    
    /**
     * Set title on the zoom in button.
     *
     * @see http://leafletjs.com/reference.html#control-zoom-zoomintitle
     *
     * @param string $value The title.
     *
     * @return $this
     */
    public function setZoomInTitle($value)
    {
        return $this->setOption('zoomInTitle', $value);
    }

    /**
     * Get the text on the zoom out button.
     *
     * @see http://leafletjs.com/reference.html#control-zoom-zoomouttext
     *
     * @return string
     */
    public function getZoomOutText()
    {
        return $this->getOption('zoomOutText', '-');
    }

    /**
     * Get the title on the zoom in button.
     *
     * @see http://leafletjs.com/reference.html#control-zoom-zoomintitle
     *
     * @return string
     */
    public function getZoomInTitle()
    {
        return $this->getOption('zoomInTitle', 'Zoom in');
    }


    /**
     * Set title on the zoom out button.
     *
     * @see http://leafletjs.com/reference.html#control-zoom-zoomouttitle
     *
     * @param string $value The title.
     *
     * @return $this
     */
    public function setZoomOutTitle($value)
    {
        return $this->setOption('zoomOutTitle', $value);
    }

    /**
     * Get the title on the zoom out button.
     *
     * @see http://leafletjs.com/reference.html#control-zoom-zoomouttitle
     *
     * @return string
     */
    public function getZoomOutTitle()
    {
        return $this->getOption('zoomOutTitle', 'Zoom out');
    }
}
