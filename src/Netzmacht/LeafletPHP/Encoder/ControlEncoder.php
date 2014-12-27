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
     * @param Encoder $builder The builder.
     *
     * @return bool
     */
    public function encodeControlScale(Scale $scale, Encoder $builder)
    {
        return $this->doControlEncode('scale', $scale, $builder);
    }

    /**
     * Compile the zoom object.
     *
     * @param Zoom    $zoom    The zoom control.
     * @param Encoder $builder The builder.
     *
     * @return bool
     */
    public function encodeControlZoom(Zoom $zoom, Encoder $builder)
    {
        return $this->doControlEncode('zoom', $zoom, $builder);
    }

    /**
     * Compile attributions.
     *
     * @param Attribution $attribution The attributions.
     * @param Encoder     $builder     The builder.
     *
     * @return bool
     */
    public function encodeControlAttribution(Attribution $attribution, Encoder $builder)
    {
        $result = $this->doControlEncode('attribution', $attribution, $builder);

        foreach ($attribution->getAttributions() as $value) {
            $result[] = sprintf(
                '%s.addAttribution(\'%s\');',
                $builder->encodeReference($attribution),
                $value
            );
        }

        return $result;
    }

    /**
     * Compile layer control.
     *
     * @param Layers  $layers  The layers control.
     * @param Encoder $encoder The builder.
     *
     * @return bool
     */
    public function encodeControlLayers(Layers $layers, Encoder $encoder)
    {
        return array(
            sprintf(
                '%s = L.control.layers(%s);',
                $encoder->encodeReference($layers),
                $encoder->encodeArguments(
                    array(
                        $this->getLayersInformation($layers->getBaseLayers()),
                        $this->getLayersInformation($layers->getOverlays()),
                        $layers->getOptions()
                    )
                )
            )
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
     * @param Encoder $builder The builder.
     *
     * @return bool
     */
    private function doControlEncode($type, Control $control, Encoder $builder)
    {
        return array(
            sprintf(
                '%s = L.control.%s(%s);',
                $builder->encodeReference($control),
                $type,
                $builder->encodeArguments(array($control->getOptions()))
            )
        );
    }

    /**
     * Get layer information, so that label is used.
     *
     * @param Layer[] $layers The layers.
     *
     * @return array
     */
    private function getLayersInformation($layers)
    {
        $prepared = array();

        foreach ($layers as $layer) {
            $prepared[$layer->getLabel()] = $layer;
        }

        return $prepared;
    }
}
