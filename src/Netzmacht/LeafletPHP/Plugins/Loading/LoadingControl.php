<?php

/**
 * @package    dev
 * @author     David Molineus <david.molineus@netzmacht.de>
 * @copyright  2015 netzmacht creative David Molineus
 * @license    LGPL 3.0
 * @filesource
 *
 */

namespace Netzmacht\LeafletPHP\Plugins\Loading;


use Netzmacht\Javascript\Encoder;
use Netzmacht\Javascript\Type\ConvertsToJavascript;
use Netzmacht\LeafletPHP\Definition\Control\AbstractControl;
use Netzmacht\LeafletPHP\Definition\Control\Zoom;

/**
 * Class LoadingControl
 * @package Netzmacht\LeafletPHP\Plugins\Loading
 */
class LoadingControl extends AbstractControl implements ConvertsToJavascript
{
    /**
     * {@inheritdoc}
     */
    public static function getType()
    {
        return 'Control.Loading';
    }

    /**
     * {@inheritdoc}
     */
    public static function getRequiredLibraries()
    {
        $libs   = parent::getRequiredLibraries();
        $libs[] = 'leaflet-loading';

        return $libs;
    }

    /**
     * Set separate mode.
     *
     * @param bool $separate Is separate from a zoom control.
     *
     * @return $this
     */
    public function setSeparate($separate)
    {
        if ($separate) {
            $this->setOption('zoomControl', null);
        }

        return $this->setOption('separate', (bool) $separate);
    }

    /**
     * Check if control is separate.
     *
     * @return bool
     */
    public function isSeparate()
    {
        return $this->getOption('separate', false);
    }

    /**
     * Set the zoom control.
     *
     * @param Zoom $zoom The zoom control.
     *
     * @return $this
     */
    public function setZoomControl(Zoom $zoom)
    {
        $this->setOption('separate', false);

        return $this->setOption('zoomControl', $zoom);
    }

    /**
     * Get the zoom control.
     *
     * @return Zoom|null
     */
    public function getZoomControl()
    {
        return $this->getOption('zoomControl');
    }

    /**
     * Encode the javascript representation of the object.
     *
     * @param Encoder $encoder The javascript encoder.
     * @param bool    $finish  If true the statement should be finished with an semicolon.
     *
     * @return string
     */
    public function encode(Encoder $encoder, $finish = true)
    {
        return sprintf(
            '%s = L.Control.loading(%s)%s',
            $encoder->encodeReference($this),
            $encoder->encodeValue($this->getOptions()),
            $finish ? ';' : ''
        );
    }
}
