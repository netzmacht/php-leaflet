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
use Netzmacht\Javascript\Exception\GetReferenceFailed;
use Netzmacht\LeafletPHP\Definition;
use Netzmacht\LeafletPHP\Definition\Group\FeatureGroup;
use Netzmacht\LeafletPHP\Definition\Group\GeoJson;
use Netzmacht\LeafletPHP\Definition\Group\LayerGroup;

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
    public function setReference(Definition $definition, GetReferenceEvent $event)
    {
        if ($definition instanceof LayerGroup) {
            $event->setReference('map.layers.' . $definition->getId());
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
        return array(
            sprintf(
                '%s = new L.geoJson(%s);',
                $encoder->encodeReference($geoJson),
                $encoder->encodeValue($geoJson->toGeoJson())
            )
        );
    }

    /**
     * Encode the group.
     *
     * @param string     $type    The group type.
     * @param LayerGroup $group   The group instance.
     * @param Encoder    $builder The builder.
     *
     * @return array
     *
     * @throws GetReferenceFailed If reference could not created.
     */
    private function doGroupEncode($type, LayerGroup $group, Encoder $builder)
    {
        return array(
            sprintf(
                '%s = L.%s(%s);',
                $builder->encodeReference($group),
                $type,
                $builder->encodeArguments(array($group->getLayers()))
            )
        );
    }
}
