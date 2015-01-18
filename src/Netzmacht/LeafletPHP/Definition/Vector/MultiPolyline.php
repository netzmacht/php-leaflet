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

use Netzmacht\LeafletPHP\Definition\GeoJson\ConvertsToGeoJsonFeature;
use Netzmacht\LeafletPHP\Definition\GeoJson\Feature;
use Netzmacht\LeafletPHP\Definition\GeoJson\FeatureTrait;
use Netzmacht\LeafletPHP\Definition\GeoJson\Geometry;
use Netzmacht\LeafletPHP\Definition\Group\FeatureGroup;
use Netzmacht\LeafletPHP\Definition\HasPopup;
use Netzmacht\LeafletPHP\Definition\OptionsTrait;
use Netzmacht\LeafletPHP\Definition\PopupTrait;
use Netzmacht\LeafletPHP\Definition\Type\LatLng;

/**
 * Class MultiPolyline is the definition for the leaflet multi polyline layer type.
 *
 * @package Netzmacht\LeafletPHP\Definition\Vector
 */
class MultiPolyline extends FeatureGroup implements Geometry, HasPopup
{
    use OptionsTrait;
    use PathOptionsTrait;
    use PopupTrait;
    use FeatureTrait;

    /**
     * {@inheritdoc}
     */
    public static function getType()
    {
        return 'MultiPolyline';
    }

    /**
     * Name of the geojson representation.
     *
     * @var string
     */
    protected $geoJsonType = 'MultiLineString';

    /**
     * Set of latlangs.
     *
     * @var LatLng[][]
     */
    private $latLngs = array();

    /**
     * Set latlngs.
     *
     * @param LatLng[][] $latLngs Multi polyline latlngs.
     *
     * @return $this
     */
    public function setLatLngs($latLngs)
    {
        $this->latLngs = $latLngs;

        return $this;
    }

    /**
     * Get all LatLngs.
     *
     * @return LatLng[][]
     */
    public function getLatLngs()
    {
        return $this->latLngs;
    }

    /**
     * {@inheritdoc}
     */
    public function jsonSerialize()
    {
        return array(
            'type'        => $this->geoJsonType,
            'coordinates' => array(
                array_map(
                    function ($latLngs) {
                        return array_map(
                            function (LatLng $latLng) {
                                return $latLng->toGeoJson();
                            },
                            $latLngs
                        );
                    },
                    $this->getLatLngs()
                )
            )
        );
    }
}
