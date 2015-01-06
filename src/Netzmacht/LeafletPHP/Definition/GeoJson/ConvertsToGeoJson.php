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
 * Interface FeatureCollectionAggregate describes a definition which can be converted to a feature collection.
 *
 * @package Netzmacht\LeafletPHP\Definition\GeoJson
 */
interface ConvertsToGeoJson
{
    /**
     * Get definition as feature collection.
     *
     * @return Feature|FeatureCollection
     */
    public function toGeoJson();
}
