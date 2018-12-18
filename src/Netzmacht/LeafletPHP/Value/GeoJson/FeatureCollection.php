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

namespace Netzmacht\LeafletPHP\Value\GeoJson;

/**
 * FeatureCollection describes a geo json feature collection.
 *
 * @see     http://geojson.org/geojson-spec.html#feature-collection-objects
 * @package Netzmacht\LeafletPHP\Definition\GeoJson
 */
class FeatureCollection extends AbstractFeature implements \IteratorAggregate
{
    /**
     * GeoJson features.
     *
     * @var GeoJsonFeature[]
     */
    private $features = array();

    /**
     * Construct.
     *
     * @param GeoJsonFeature[] $features GeoJson features.
     */
    public function __construct($features = array())
    {
        $this->addFeatures($features);
    }

    /**
     * Add a geo json feature.
     *
     * @param GeoJsonFeature $feature Feature being added.
     *
     * @return $this
     */
    public function addFeature(GeoJsonFeature $feature)
    {
        $this->features[] = $feature;

        return $this;
    }

    /**
     * Add multiple features.
     *
     * @param GeoJsonFeature[] $features GeoJson features.
     *
     * @return $this
     */
    public function addFeatures($features)
    {
        foreach ($features as $feature) {
            $this->addFeature($feature);
        }

        return $this;
    }

    /**
     * Get all features.
     *
     * @return Feature[]
     */
    public function getFeatures()
    {
        return $this->features;
    }

    /**
     * {@inheritdoc}
     */
    public function getIterator()
    {
        return new \ArrayIterator($this->features);
    }

    /**
     * {@inheritdoc}
     */
    public function jsonSerialize()
    {
        $data = array(
            'type'     => 'FeatureCollection',
            'features' => $this->getFeatures()
        );

        if ($this->getBoundingBox()) {
            $data['bbox'] = $this->getBoundingBox()->toGeoJson();
        }

        return $data;
    }
}
