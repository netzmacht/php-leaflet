<?php

/**
 * @package    dev
 * @author     David Molineus <david.molineus@netzmacht.de>
 * @copyright  2014 netzmacht creative David Molineus
 * @license    LGPL 3.0
 * @filesource
 *
 */

namespace Netzmacht\LeafletPHP\Definition\Group;

use Netzmacht\Javascript\Type\Call\AnonymousFunction;
use Netzmacht\Javascript\Type\Call\MethodCall;
use Netzmacht\LeafletPHP\Definition\AbstractDefinition;
use Netzmacht\LeafletPHP\Definition\GeoJson\Feature;
use Netzmacht\LeafletPHP\Definition\GeoJson\FeatureCollection;
use Netzmacht\LeafletPHP\Definition\GeoJson\ConvertsToGeoJson;
use Netzmacht\LeafletPHP\Definition\LabelTrait;
use Netzmacht\LeafletPHP\Definition\Layer;
use Netzmacht\LeafletPHP\Definition\MapObject;
use Netzmacht\LeafletPHP\Definition\MapObjectTrait;

/**
 * Basic layer group class.
 *
 * @package Netzmacht\LeafletPHP\Definition\Group
 */
class LayerGroup extends AbstractDefinition implements Layer, MapObject, ConvertsToGeoJson
{
    use LabelTrait;
    use MapObjectTrait;

    /**
     * Get the type of the definition.
     *
     * @return mixed
     */
    public static function getType()
    {
        return 'LayerGroup';
    }

    /**
     * Layers.
     *
     * @var Layer[]
     */
    private $layers = array();

    /**
     * Add a layer to the group.
     *
     * @param Layer $layer Layer being added.
     *
     * @return $this
     */
    public function addLayer(Layer $layer)
    {
        $this->layers[] = $layer;

        return $this;
    }

    /**
     * Get all layers.
     *
     * @return Layer[]
     */
    public function getLayers()
    {
        return $this->layers;
    }

    /**
     * Check if layer is part of the group.
     *
     * @param Layer $layer The layer being checked.
     *
     * @return bool
     */
    public function hasLayer(Layer $layer)
    {
        return in_array($layer, $this->layers);
    }

    /**
     * Get all method calls.
     *
     * @return MethodCall[]
     */
    public function getMethodCalls()
    {
        return array();
    }

    /**
     * Apply a closure to the layer.
     *
     * @param AnonymousFunction $closure The anonymous function.
     *
     * @return $this
     */
    public function eachLayer(AnonymousFunction $closure)
    {
        return $this->addMethod('eachLayer', $closure);
    }

    /**
     * Get definition as feature collection.
     *
     * @return FeatureCollection
     */
    public function toGeoJson()
    {
        $collection = new FeatureCollection();

        foreach ($this->getLayers() as $layer) {
            if ($layer instanceof ConvertsToGeoJson) {
                $geoJson = $layer->toGeoJson();

                if ($geoJson instanceof FeatureCollection) {
                    foreach ($geoJson as $feature) {
                        $collection->addFeature($feature);
                    }
                } elseif ($geoJson instanceof Feature) {
                    $collection->addFeature($geoJson);
                }
            }
        }

        return $collection;
    }
}
