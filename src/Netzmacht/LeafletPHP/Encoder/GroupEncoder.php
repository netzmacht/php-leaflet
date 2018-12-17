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

namespace Netzmacht\LeafletPHP\Encoder;

use Netzmacht\JavascriptBuilder\Encoder;
use Netzmacht\JavascriptBuilder\Symfony\Event\EncodeReferenceEvent;
use Netzmacht\LeafletPHP\Definition;
use Netzmacht\LeafletPHP\Value\GeoJson\ConvertsToGeoJsonFeature;
use Netzmacht\LeafletPHP\Definition\Group\FeatureGroup;
use Netzmacht\LeafletPHP\Definition\Group\GeoJson;
use Netzmacht\LeafletPHP\Definition\Group\LayerGroup;
use Netzmacht\LeafletPHP\Definition\Layer;
use Netzmacht\LeafletPHP\Plugins\Omnivore\OmnivoreLayer;

/**
 * Class GroupEncoder encodes group elements.
 *
 * @package Netzmacht\LeafletPHP\Encoder
 */
class GroupEncoder extends AbstractEncoder
{
    /**
     * {@inheritdoc}
     */
    public function setReference(Definition $definition, EncodeReferenceEvent $event)
    {
        if ($definition instanceof LayerGroup) {
            $event->setReference('layers.' . $definition->getId());
        }
    }

    /**
     * Compile the layer group.
     *
     * @param LayerGroup $layerGroup The layer group.
     * @param Encoder    $builder    The builder.
     *
     * @return bool
     */
    public function encodeLayerGroup(LayerGroup $layerGroup, Encoder $builder)
    {
        return $this->doGroupEncode('layerGroup', $layerGroup, $builder);
    }

    /**
     * Encode a feature group.
     *
     * @param FeatureGroup $featureGroup The layer group.
     * @param Encoder      $encoder      The builder.
     *
     * @return bool
     */
    public function encodeFeatureGroup(FeatureGroup $featureGroup, Encoder $encoder)
    {
        return $this->doGroupEncode('featureGroup', $featureGroup, $encoder);
    }

    /**
     * Encode a feature group.
     *
     * @param GeoJson $geoJson The layer group.
     * @param Encoder $encoder The builder.
     *
     * @return bool
     */
    public function encodeGeoJson(GeoJson $geoJson, Encoder $encoder)
    {
        $buffer = sprintf(
            '%s = L.geoJson(%s, %s);',
            $encoder->encodeReference($geoJson),
            $encoder->encodeValue($geoJson->getInitializationData()),
            $encoder->encodeValue($geoJson->getOptions())
        );

        foreach ($geoJson->getLayers() as $layer) {
            $buffer .= "\n" . sprintf(
                '%s.addLayer(%s);',
                $encoder->encodeReference($geoJson),
                $encoder->encodeReference($layer)
            );
        }

        return $buffer;
    }

    /**
     * Encode the group.
     *
     * @param string     $type    The group type.
     * @param LayerGroup $group   The group instance.
     * @param Encoder    $encoder The encoder.
     *
     * @return string
     */
    private function doGroupEncode($type, LayerGroup $group, Encoder $encoder)
    {
        return sprintf(
            '%s = L.%s(%s);',
            $encoder->encodeReference($group),
            $type,
            $this->encodeLayersInformation($group->getLayers(), $encoder)
        );
    }

    /**
     * Get layer information correctly encoded.
     *
     * @param Layer[] $layers  The layers.
     * @param Encoder $encoder The encoder.
     *
     * @return array
     */
    private function encodeLayersInformation($layers, Encoder $encoder)
    {
        $layers = array_map(
            function ($layer) use ($encoder) {
                return $encoder->encodeReference($layer);
            },
            $layers
        );

        return '[' . implode(', ', $layers) . ']';
    }
}
