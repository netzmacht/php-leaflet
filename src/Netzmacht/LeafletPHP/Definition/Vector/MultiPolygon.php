<?php

/**
 * @package    dev
 * @author     David Molineus <david.molineus@netzmacht.de>
 * @copyright  2015 netzmacht creative David Molineus
 * @license    LGPL 3.0
 * @filesource
 *
 */

namespace Netzmacht\LeafletPHP\Definition\Vector;

use Netzmacht\LeafletPHP\Value\GeoJson\ConvertsToGeoJsonFeature;
use Netzmacht\LeafletPHP\Value\GeoJson\Feature;
use Netzmacht\LeafletPHP\Value\GeoJson\FeatureTrait;
use Netzmacht\LeafletPHP\Value\GeoJson\Geometry;
use Netzmacht\LeafletPHP\Definition\Group\FeatureGroup;
use Netzmacht\LeafletPHP\Definition\HasPopup;
use Netzmacht\LeafletPHP\Definition\OptionsTrait;
use Netzmacht\LeafletPHP\Definition\PopupTrait;
use Netzmacht\LeafletPHP\Value\LatLng;

/**
 * Class MultiPolygon is the definition for Leaflet multi polygon object.
 *
 * @package Netzmacht\LeafletPHP\Definition\Vector
 */
class MultiPolygon extends MultiPolyline
{
    /**
     * {@inheritdoc}
     */
    public static function getType()
    {
        return 'MultiPolygon';
    }

    /**
     * Name of the geo json representation.
     *
     * @var string
     */
    protected $geoJsonType = 'MultiPolygon';
}
