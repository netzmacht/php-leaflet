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
 * Interface FeatureCollectionAggregate describes a definition which can be converted to a feature collection.
 *
 * @package Netzmacht\LeafletPHP\Definition\GeoJson
 */
interface ConvertsToGeoJsonFeature
{
    /**
     * Get definition as feature collection.
     *
     * @return GeoJsonFeature
     */
    public function toGeoJsonFeature();

    /**
     * Check if this object converts fully to geo json or other content is in it as well.
     *
     * @return bool
     */
    public function convertsFullyToGeoJson();
}
