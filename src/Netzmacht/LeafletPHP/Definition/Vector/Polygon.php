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
        return array(
            'type'        => 'Polygon',
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
}
