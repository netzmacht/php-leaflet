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

use Netzmacht\LeafletPHP\Assert\Assertion;
use Netzmacht\LeafletPHP\Assert\InvalidArgumentException;
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
     * List of LatLngs values as nested array.
     *
     * @var LatLng[][]
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
     * Call the getCenter method.
     *
     * @return $this
     */
    public function getCenter()
    {
        return $this->addMethod('getCenter');
    }

    /**
     * Add a latitude longitude position.
     *
     * This method differs from the Leaflet JS API! Instead of passing the shape as second argument you can define
     * the index of the ring.
     *
     * @param LatLng|array|string $latLng    LatLng coordinate.
     * @param int                 $ringIndex The index of the ring.
     *
     * @return $this
     */
    public function addLatLng($latLng, $ringIndex = 0)
    {
        if (is_scalar($latLng)) {
            $latLng = LatLng::fromNative($latLng);
        }

        Assertion::isInstanceOf($latLng, 'Netzmacht\LeafletPHP\Value\LatLng');

        $ringIndex                   = (int) $ringIndex;
        $this->latLngs[$ringIndex][] = $latLng;

        return $this;
    }

    /**
     * Add a list of values.
     *
     * @param array $values    Position list.
     * @param int   $ringIndex The index of the ring.
     *
     * @return $this
     * @throws InvalidArgumentException If LatLng could not be created.
     */
    public function addLatLngs($values, $ringIndex = 0)
    {
        foreach ($values as $position) {
            $this->addLatLng($position, $ringIndex);
        }

        return $this;
    }

    /**
     * Get all lat lngs.
     *
     * @param bool $preferFlat If true a flat array is returned instead of a list of rings.
     *
     * @return array
     */
    public function getLatLngs($preferFlat = true)
    {
        if ($preferFlat) {
            $value = [];

            foreach ($this->latLngs as $ring) {
                $value = array_merge($value, $ring);
            }

            return $value;
        }

        return $this->latLngs;
    }

    /**
     * Set affect bounds.
     *
     * @param boolean $affectsBounds If true bounds of map are affected.
     *
     * @return $this
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
        if ($this->isFlat()) {
            return array(
                'type'        => $this->getGeoJsonType(),
                'coordinates' => array_map(
                    function (LatLng $latLng) {
                        return $latLng->toGeoJson();
                    },
                    $this->getLatLngs()
                )
            );
        }

        return array(
            'type'        => $this->getGeoJsonType(),
            'coordinates' => array_map(
                function ($latLng) {
                    return array_map(
                        function (LatLng $latLng) {
                            return $latLng->toGeoJson();
                        },
                        $latLng
                    );
                },
                $this->getLatLngs(false)
            )
        );
    }

    /**
     * Check if vector is flat.
     *
     * @return bool
     */
    protected function isFlat()
    {
        return (count($this->latLngs) < 2);
    }

    /**
     * Get the GeoJSON type.
     *
     * @return string
     */
    protected function getGeoJsonType()
    {
        return $this->isFlat() ? 'LineString' : 'MultiLineString';
    }
}
