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

namespace Netzmacht\LeafletPHP\Definition\Group;

use Netzmacht\JavascriptBuilder\Type\AnonymousFunction;
use Netzmacht\JavascriptBuilder\Type\Call\MethodCall;
use Netzmacht\LeafletPHP\Definition\AbstractLayer;
use Netzmacht\LeafletPHP\Value\GeoJson\FeatureCollection;
use Netzmacht\LeafletPHP\Value\GeoJson\ConvertsToGeoJsonFeature;
use Netzmacht\LeafletPHP\Value\GeoJson\GeoJsonFeature;
use Netzmacht\LeafletPHP\Definition\Layer;
use Netzmacht\LeafletPHP\Definition\Map;

/**
 * Basic layer group class.
 *
 * @package Netzmacht\LeafletPHP\Definition\Group
 */
class LayerGroup extends AbstractLayer implements ConvertsToGeoJsonFeature
{
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
     * Apply a closure to the layer.
     *
     * @param AnonymousFunction $closure The anonymous function.
     *
     * @return $this
     */
    public function eachLayer(AnonymousFunction $closure)
    {
        return $this->addMethod('eachLayer', array($closure));
    }

    /**
     * {@inheritdoc}
     */
    public function toGeoJsonFeature()
    {
        $collection = new FeatureCollection();

        foreach ($this->getLayers() as $layer) {
            if ($layer instanceof GeoJsonFeature) {
                $collection->addFeature($layer);
            } elseif ($layer instanceof ConvertsToGeoJsonFeature) {
                $collection->addFeature($layer->toGeoJsonFeature());
            }
        }

        return $collection;
    }

    /**
     * {@inheritdoc}
     */
    public function convertsFullyToGeoJson()
    {
        foreach ($this->getLayers() as $layer) {
            if ($layer instanceof GeoJsonFeature) {
                // Layer is a geo json feature, it is fully a geo json object
                continue;
            } elseif ($layer instanceof ConvertsToGeoJsonFeature) {
                // check children of the layer.
                if (!$layer->convertsFullyToGeoJson()) {
                    return false;
                }
            } else {
                // Unknown layer, return false.
                return false;
            }
        }

        return true;
    }
}
