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

use Netzmacht\LeafletPHP\Value\GeoJson\Geometry;
use Netzmacht\LeafletPHP\Value\LatLng;

/**
 * Class CircleMarker represents a circle marker object.
 *
 * @package Netzmacht\LeafletPHP\Definition\Vector
 */
class CircleMarker extends Path implements Geometry
{
    /**
     * {@inheritdoc}
     */
    public static function getType()
    {
        return 'CircleMarker';
    }

    /**
     * The lat lng.
     *
     * @var LatLng
     */
    private $latLng = array();

    /**
     * The radius in meters.
     *
     * @var int
     */
    private $radius = 0;

    /**
     * Get the lat lang.
     *
     * @return LatLng|null
     */
    public function getLatLng()
    {
        return $this->latLng;
    }

    /**
     * Set the lat lang position.
     *
     * @param LatLng $latLng The coordinate.
     *
     * @return $this
     */
    public function setLatLng(LatLng $latLng)
    {
        $this->latLng = $latLng;

        return $this;
    }

    /**
     * Get the radius.
     *
     * @return int
     */
    public function getRadius()
    {
        return $this->radius;
    }

    /**
     * Set the radius.
     *
     * @param int $radius The radius in meters.
     *
     * @return $this
     */
    public function setRadius($radius)
    {
        $this->radius = (int) $radius;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function jsonSerialize()
    {
        return array(
            'type'        => 'Point',
            'coordinates' => $this->getLatLng()->toGeoJson()
        );
    }

    /**
     * {@inheritdoc}
     */
    public function toGeoJsonFeature()
    {
        $feature = $this->createFeature();
        $feature->setProperty('radius', $this->getRadius());

        return $feature;
    }
}
