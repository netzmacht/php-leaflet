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

use Netzmacht\LeafletPHP\Value\LatLng;

/**
 * Class Polygon represents a polygon on the map.
 *
 * @package Netzmacht\LeafletPHP\Definition\Vector
 */
class Polygon extends Polyline
{
    /**
     * {@inheritdoc}
     */
    public static function getType()
    {
        return 'Polygon';
    }

    /**
     * {@inheritdoc}
     */
    public function jsonSerialize()
    {
        if ($this->isFlat()) {
            return array(
                'type'        => $this->getGeoJsonType(),
                'coordinates' => array(
                    array_map(
                        function (LatLng $latLng) {
                            return $latLng->toGeoJson();
                        },
                        $this->getLatLngs()
                    )
                )
            );
        }

        return array(
            'type'        => $this->getGeoJsonType(),
            'coordinates' => array_map(
                function ($latLng) {
                    return array(
                        array_map(
                            function (LatLng $latLng) {
                                return $latLng->toGeoJson();
                            },
                            $latLng
                        )
                    );
                },
                $this->getLatLngs(false)
            )
        );
    }

    /**
     * Get the GeoJSON type.
     *
     * @return string
     */
    protected function getGeoJsonType()
    {
        return $this->isFlat() ? 'Polygon' : 'MultiPolygon';
    }
}
