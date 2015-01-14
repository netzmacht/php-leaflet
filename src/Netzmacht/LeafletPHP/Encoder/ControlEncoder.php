<?php

/**
 * @package    dev
 * @author     David Molineus <david.molineus@netzmacht.de>
 * @copyright  2014 netzmacht creative David Molineus
 * @license    LGPL 3.0
 * @filesource
 *
 */

namespace Netzmacht\LeafletPHP\Encoder;

use Netzmacht\Javascript\Encoder;
use Netzmacht\Javascript\Event\GetReferenceEvent;
use Netzmacht\LeafletPHP\Definition;
use Netzmacht\LeafletPHP\Definition\Control;
use Netzmacht\LeafletPHP\Definition\Control\Attribution;
use Netzmacht\LeafletPHP\Definition\Control\Layers;
use Netzmacht\LeafletPHP\Definition\Control\Scale;
use Netzmacht\LeafletPHP\Definition\Control\Zoom;
use Netzmacht\LeafletPHP\Definition\Layer;

/**
 * Class ControlEncoder encodes control elements.
 *
 * @package Netzmacht\LeafletPHP\Encoder
 */
class ControlEncoder extends AbstractEncoder
{
    /**
     * Compile scale object.
     *
     * @param Scale   $scale   The scale control.
     * @param Encoder $encoder The encoder.
     *
     * @return bool
     */
    public function encodeControlScale(Scale $scale, Encoder $encoder)
    {
        return $this->doControlEncode('scale', $scale, $encoder);
    }

    /**
     * Compile the zoom object.
     *
     * @param Zoom    $zoom    The zoom control.
     * @param Encoder $encoder The encoder.
     *
     * @return bool
     */
    public function encodeControlZoom(Zoom $zoom, Encoder $encoder)
    {
        return $this->doControlEncode('zoom', $zoom, $encoder);
    }

    /**
     * Compile attributions.
     *
     * @param Attribution $attribution The attributions.
     * @param Encoder     $encoder     The encoder.
     *
     * @return bool
     */
    public function encodeControlAttribution(Attribution $attribution, Encoder $encoder)
    {
        $result = $this->doControlEncode('attribution', $attribution, $encoder);

        foreach ($attribution->getAttributions() as $value) {
            $result .= sprintf(
                '%s.addAttribution(\'%s\');' . "\n",
                $encoder->encodeReference($attribution),
                $value
            );
        }

        return $result;
    }

    /**
     * Compile layer control.
     *
     * @param Layers  $layers  The layers control.
     * @param Encoder $encoder The encoder.
     *
     * @return bool
     */
    public function encodeControlLayers(Layers $layers, Encoder $encoder)
    {
        return sprintf(
            '%s = L.control.layers(%s, %s, %s);',
            $encoder->encodeReference($layers),
            $this->encodeLayersInformation($layers->getBaseLayers(), $encoder),
            $this->encodeLayersInformation($layers->getOverlays(), $encoder),
            $encoder->encodeValue($layers->getOptions())
        );
    }

    /**
     * {@inheritdoc}
     */
    public function setReference(Definition $definition, GetReferenceEvent $event)
    {
        if ($definition instanceof Control) {
            $event->setReference('controls.' . $definition->getId());
        }
    }

    /**
     * Compile a control.
     *
     * @param string  $type    The control type.
     * @param Control $control The control definition.
     * @param Encoder $encoder The encoder.
     *
     * @return string
     */
    private function doControlEncode($type, Control $control, Encoder $encoder)
    {
        return sprintf(
            '%s = L.control.%s(%s);',
            $encoder->encodeReference($control),
            $type,
            $encoder->encodeArguments(array($control->getOptions()))
        );
    }

    /**
     * Get layer information, so that label is used.
     *
     * @param Layer[] $layers  The layers.
     * @param Encoder $encoder The encoder.
     *
     * @return array
     */
    private function encodeLayersInformation($layers, Encoder $encoder)
    {
        $prepared = '';

        foreach ($layers as $layer) {
            if ($prepared) {
                $prepared .= ', ';
            }

            $prepared .= sprintf(
                '%s: %s',
                $encoder->encodeValue($layer->getLabel()),
                $encoder->encodeReference($layer)
            );
        }

        return '{' . $prepared . '}';
    }
}
