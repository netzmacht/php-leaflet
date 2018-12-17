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

namespace Netzmacht\LeafletPHP\Definition\Vector;

use Netzmacht\LeafletPHP\Value\GeoJson\Feature;
use Netzmacht\LeafletPHP\Value\GeoJson\FeatureCollection;
use Netzmacht\LeafletPHP\Value\GeoJson\FeatureTrait;
use Netzmacht\LeafletPHP\Value\GeoJson\Geometry;
use Netzmacht\LeafletPHP\Value\LatLngBounds;

/**
 * Class Rectangle describes an rectangle on the map.
 *
 * @package Netzmacht\LeafletPHP\Definition\Vector
 */
class Rectangle extends Polyline implements Geometry
{
    use FeatureTrait;

    /**
     * {@inheritdoc}
     */
    public static function getType()
    {
        return 'Rectangle';
    }

    /**
     * LatLng bounds which defines the rectangle.
     *
     * @var \Netzmacht\LeafletPHP\Value\LatLngBounds
     */
    private $bounds;

    /**
     * Construct.
     *
     * @param string       $identifier   The identifier.
     * @param LatLngBounds $latLngBounds The bounds which defines the rectangle.
     */
    public function __construct($identifier, LatLngBounds $latLngBounds)
    {
        parent::__construct($identifier);

        $this->bounds = $latLngBounds;
    }

    /**
     * {@inheritdoc}
     */
    public function getLatLngs($preferFlat = true)
    {
        return array(
            $this->bounds->getSouthWest(),
            $this->bounds->getNorthEast()
        );
    }

    /**
     * Get the bounds.
     *
     * @return LatLngBounds
     */
    public function getBounds()
    {
        return $this->bounds;
    }

    /**
     * Get definition as feature collection.
     *
     * @return Feature|FeatureCollection
     */
    public function jsonSerialize()
    {
        $bounds = $this->getBounds();

        // No rectangle support of geojson, so create a polygon
        return array(
            'type'        => 'Polygon',
            'coordinates' => array(
                array(
                    $bounds->getNorthEast()->toGeoJson(),
                    $bounds->getNorthWest()->toGeoJson(),
                    $bounds->getSouthWest()->toGeoJson(),
                    $bounds->getSouthEast()->toGeoJson()
                )
            )
        );
    }
}
