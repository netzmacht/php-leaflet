<?php

/**
 * @package    dev
 * @author     David Molineus <david.molineus@netzmacht.de>
 * @copyright  2015 netzmacht creative David Molineus
 * @license    LGPL 3.0
 * @filesource
 *
 */

namespace Netzmacht\LeafletPHP\Definition\GeoJson;

/**
 * FeatureCollection describes a geo json feature collection.
 *
 * @see     http://geojson.org/geojson-spec.html#feature-collection-objects
 * @package Netzmacht\LeafletPHP\Definition\GeoJson
 */
class FeatureCollection extends AbstractFeature implements \JsonSerializable, \IteratorAggregate
{
    /**
     * GeoJson features.
     *
     * @var Feature[]
     */
    private $features = array();

    /**
     * Construct.
     *
     * @param array $features GeoJson features.
     */
    public function __construct($features = array())
    {
        $this->addFeatures($features);
    }

    /**
     * Add a geo json feature.
     *
     * @param Feature $feature Feature being added.
     *
     * @return $this
     */
    public function addFeature(Feature $feature)
    {
        $this->features[] = $feature;

        return $this;
    }

    /**
     * Add multiple features.
     *
     * @param Feature[] $features GeoJson features.
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
