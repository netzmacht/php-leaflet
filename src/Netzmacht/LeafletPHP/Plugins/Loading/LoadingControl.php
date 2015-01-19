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


use Netzmacht\JavascriptBuilder\Encoder;
use Netzmacht\JavascriptBuilder\Exception\EncodeValueFailed;
use Netzmacht\JavascriptBuilder\Output;
use Netzmacht\JavascriptBuilder\Type\ConvertsToJavascript;
use Netzmacht\JavascriptBuilder\Util\Flags;
use Netzmacht\LeafletPHP\Definition\Control\AbstractControl;
use Netzmacht\LeafletPHP\Definition\Control\Zoom;

/**
 * Class LoadingControl represents the Leaflet.loading control plugin.
 *
 * @package Netzmacht\LeafletPHP\Plugins\Loading
 * @see     https://github.com/ebrelsford/Leaflet.loading
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
     * {@inheritdoc}
     */
    public function encode(Encoder $encoder, $flags = null)
    {
        $buffer = sprintf(
            '%s = L.Control.loading(%s)%s',
            $encoder->encodeReference($this),
            $encoder->encodeValue($this->getOptions()),
            $encoder->close($flags)
        );

        $flags = Flags::add(Encoder::CLOSE_STATEMENT, $flags);

        foreach ($this->getMethodCalls() as $method) {
            $buffer .= "\n" . $method->encode($encoder, $flags);
        }

        return $buffer;
    }
}
