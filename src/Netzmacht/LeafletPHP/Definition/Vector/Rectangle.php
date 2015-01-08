<?php

/**
 * @package    dev
 * @author     David Molineus <david.molineus@netzmacht.de>
 * @copyright  2014 netzmacht creative David Molineus
 * @license    LGPL 3.0
 * @filesource
 *
 */

namespace Netzmacht\LeafletPHP\Definition\Vector;

use Netzmacht\LeafletPHP\Definition\GeoJson\ConvertsToGeoJson;
use Netzmacht\LeafletPHP\Definition\GeoJson\Feature;
use Netzmacht\LeafletPHP\Definition\GeoJson\FeatureCollection;
use Netzmacht\LeafletPHP\Definition\GeoJson\FeatureTrait;
use Netzmacht\LeafletPHP\Definition\GeoJson\Geometry;
use Netzmacht\LeafletPHP\Definition\Type\LatLngBounds;

/**
 * Class Rectangle describes an rectangle on the map.
 *
 * @package Netzmacht\LeafletPHP\Definition\Vector
 */
class Rectangle extends Path implements ConvertsToGeoJson, Geometry
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
     * @var LatLngBounds
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
