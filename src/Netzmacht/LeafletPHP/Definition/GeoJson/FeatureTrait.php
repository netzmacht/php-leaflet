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
 * Class FeatureTrait can be used to create a GeoJson feature of the definition.
 *
 * The definition must implement the HasOptions and Geometry interface.
 *
 * @package Netzmacht\LeafletPHP\Definition\GeoJson
 */
trait FeatureTrait
{
    /**
     * Create feature of the given definition.
     *
     * @return Feature
     */
    protected function createFeature()
    {
        $feature = new Feature($this, $this->getId());
        $feature->setProperty('type', lcfirst(static::getType()));
        $feature->setProperty('options', $this->getOptions());

        return $feature;
    }

    /**
     * {@inheritdoc}
     */
    public function toGeoJsonFeature()
    {
        return $this->createFeature();
    }
}
