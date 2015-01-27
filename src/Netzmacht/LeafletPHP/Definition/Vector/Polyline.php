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

use Netzmacht\LeafletPHP\Assert\Assertion;
use Netzmacht\LeafletPHP\Assert\InvalidArgumentException;
use Netzmacht\LeafletPHP\Value\GeoJson\ConvertsToGeoJsonFeature;
use Netzmacht\LeafletPHP\Value\GeoJson\Geometry;
use Netzmacht\LeafletPHP\Value\LatLng;
use Netzmacht\LeafletPHP\Definition\Vector;

/**
 * Class Polyline represents a map polyline.
 *
 * @package Netzmacht\LeafletPHP\Definition\Vector
 */
class Polyline extends Path implements Vector, Geometry
{
    /**
     * List of latitude and longitude values.
     *
     * @var array[[lat, lng]]
     */
    private $latLngs = array();

    /**
     * If true polyline will affect the bounds.
     *
     * @var bool
     */
    private $affectsBounds = true;

    /**
     * Get the type of the definition.
     *
     * @return mixed
     */
    public static function getType()
    {
        return 'Polyline';
    }
    
    /**
     * Set smooth factor.
     *
     * @param string $value The smooth factor.
     *
     * @return $this
     * @see    http://leafletjs.com/reference.html#polyline-smoothfactor
     */
    public function setSmoothFactor($value)
    {
        return $this->setOption('smoothFactor', $value);
    }

    /**
     * Get the smooth factor.
     *
     * @return float
     * @see    http://leafletjs.com/reference.html#polyline-smoothfactor
     */
    public function getSmoothFactor()
    {
        return $this->getOption('smoothFactor', 1.0);
    }

    /**
     * Enable or disable polyline clipping.
     *
     * @param bool $value Enable or disable.
     *
     * @return $this
     * @see    http://leafletjs.com/reference.html#polyline-noclip
     */
    public function setNoClip($value)
    {
        return $this->setOption('noClip', (bool) $value);
    }

    /**
     * Check if no clipping is enabled.
     *
     * @return float
     * @see    http://leafletjs.com/reference.html#polyline-noclip
     */
    public function getNoClip()
    {
        return $this->getOption('noClip', false);
    }

    /**
     * Add a latitude longitude position.
     *
     * @param \Netzmacht\LeafletPHP\Value\LatLng|array|string $latLng LatLng coordinate.
     *
     * @return $this
     * @throws InvalidArgumentException If LatLng could not be created.
     */
    public function addLatLng($latLng)
    {
        if (is_scalar($latLng)) {
            $latLng = LatLng::fromNative($latLng);
        }

        Assertion::isInstanceOf($latLng, 'Netzmacht\LeafletPHP\Value\LatLng');

        $this->latLngs[] = $latLng;

        return $this;
    }

    /**
     * Add a list of values.
     *
     * @param array $values Position list.
     *
     * @return $this
     * @throws InvalidArgumentException If LatLng could not be created.
     */
    public function addLatLngs($values)
    {
        foreach ($values as $position) {
            $this->addLatLng($position);
        }

        return $this;
    }

    /**
     * Get all lat lngs.
     *
     * @return array
     */
    public function getLatLngs()
    {
        return $this->latLngs;
    }

    /**
     * Set affect bounds.
     *
     * @param boolean $affectsBounds If true bounds of map are affected.
     *
     * @return bool
     */
    public function setAffectsBounds($affectsBounds)
    {
        $this->affectsBounds = (bool) $affectsBounds;

        return $this;
    }

    /**
     * Check if bounds are affected.
     *
     * @return bool
     */
    public function isAffectBounds()
    {
        return $this->affectsBounds;
    }

    /**
     * {@inheritdoc}
     */
    public function jsonSerialize()
    {
        return array(
            'type'        => 'LineString',
            'coordinates' => array_map(
                function (LatLng $latLng) {
                    return $latLng->toGeoJson();
                },
                $this->getLatLngs()
            )
        );
    }
}
