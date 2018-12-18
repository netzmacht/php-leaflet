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

use Netzmacht\LeafletPHP\Definition\AbstractLayer;

/**
 * Class StaticFeature is a hybrid of a layer and geojson feature which contains static geojson data.
 *
 * The geojson data could be an array or string.
 *
 * @package Netzmacht\LeafletPHP\Definition\GeoJson
 */
class StaticFeature extends AbstractLayer implements GeoJsonFeature, ConvertsToGeoJsonFeature
{
    /**
     * Get the type of the definition.
     *
     * @return string
     */
    public static function getType()
    {
        return 'StaticFeature';
    }

    /**
     * GeoJSON data.
     *
     * @var array|string
     */
    private $geoJson;

    /**
     * Construct.
     *
     * @param string $geoJson The GeoJSON data.
     */
    public function __construct($geoJson)
    {
        $this->geoJson = $geoJson;
    }

    /**
     * Get the GeoJSON data.
     *
     * @return array|string
     */
    public function getGeoJson()
    {
        return $this->geoJson;
    }

    /**
     * {@inheritdoc}
     */
    public function jsonSerialize()
    {
        if (is_array($this->geoJson)) {
            return $this->geoJson;
        }

        return json_decode($this->geoJson, true);
    }

    /**
     * {@inheritdoc}
     */
    public function toGeoJsonFeature()
    {
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function convertsFullyToGeoJson()
    {
        return true;
    }
}
