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


use Netzmacht\LeafletPHP\Definition\GeoJson\ConvertsToGeoJson;
use Netzmacht\LeafletPHP\Definition\GeoJson\Feature;
use Netzmacht\LeafletPHP\Definition\GeoJson\Geometry;
use Netzmacht\LeafletPHP\Definition\Group\FeatureGroup;
use Netzmacht\LeafletPHP\Definition\OptionsTrait;
use Netzmacht\LeafletPHP\Definition\PopupTrait;
use Netzmacht\LeafletPHP\Definition\Type\LatLng;

class MultiPolyline extends FeatureGroup implements Geometry, ConvertsToGeoJson
{
    use OptionsTrait;
    use PathOptionsTrait;
    use PopupTrait;

    private $latLngs = array();


    public function setLatLngs($latLngs)
    {
        $this->latLngs = $latLngs;

        return $this;
    }

    /**
     * @return array
     */
    public function getLatLngs()
    {
        return $this->latLngs;
    }

    public function jsonSerialize()
    {
        return array(
            'type'        => 'MultiLineString',
            'coordinates' => array_map(
                function($latLngs) {
                    return array_map(
                        function(LatLng $latLng) {
                            return $latLng->toGeoJson();
                        },
                        $latLngs
                    );
                },
                $this->getLatLngs()
            )
        );
    }

    public function toGeoJson()
    {
        $feature = new Feature(
            $this,
            $this->getId()
        );

        if ($this->getPopup()) {
            $feature->setProperty('popup', $this->getPopup());
        }

        if ($this->getPopupContent()) {
            $feature->setProperty('popupContent', $this->getPopupContent());
        }

        return $feature;
    }
}
