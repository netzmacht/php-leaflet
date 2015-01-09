<?php

/**
 * @package    dev
 * @author     David Molineus <david.molineus@netzmacht.de>
 * @copyright  2014 netzmacht creative David Molineus
 * @license    LGPL 3.0
 * @filesource
 *
 */

namespace Netzmacht\LeafletPHP\Definition\Type;

use Netzmacht\Javascript\Type\Value\ConvertsToJson;

/**
 * Class LatLngBounds defines a bounds on the map.
 *
 * @package Netzmacht\LeafletPHP\Definition\Type
 */
class LatLngBounds implements ConvertsToJson
{
    /**
     * South west boundary.
     *
     * @var LatLng
     */
    private $southWest;

    /**
     * North east boundary.
     *
     * @var LatLng
     */
    private $northEast;

    /**
     * Construct.
     *
     * @param LatLng $southWest South west corner of the bounds.
     * @param LatLng $northEast North east corner of the bounds.
     */
    public function __construct(LatLng $southWest, LatLng $northEast)
    {
        $this->southWest = $southWest;
        $this->northEast = $northEast;
    }

    /**
     * Create from native array format.
     *
     * @param array $native The native boundary.
     *
     * @return LatLngBounds
     *
     * @throws \InvalidArgumentException If the array format is not supported.
     */
    public static function fromArray(array $native)
    {
        if (!isset($native[0]) || !isset($native[1])) {
            throw new \InvalidArgumentException('LatLngBounds array format not supported.');
        }

        return new static(
            LatLng::fromArray($native[0]),
            LatLng::fromArray($native[1])
        );
    }

    /**
     * Get south west corner.
     *
     * @return LatLng
     */
    public function getSouthWest()
    {
        return $this->southWest;
    }

    /**
     * Get south east corner.
     *
     * @return LatLng
     */
    public function getSouthEast()
    {
        return new LatLng($this->southWest->getLatitude(), $this->northEast->getLongitude());
    }

    /**
     * Get north east corner.
     *
     * @return LatLng
     */
    public function getNorthEast()
    {
        return $this->northEast;
    }

    /**
     * Get south east corner.
     *
     * @return LatLng
     */
    public function getNorthWest()
    {
        return new LatLng($this->northEast->getLatitude(), $this->southWest->getLongitude());
    }

    /**
     * Get west longitude.
     *
     * @return int
     */
    public function getWest()
    {
        return $this->southWest->getLongitude();
    }

    /**
     * Get south latitude.
     *
     * @return int
     */
    public function getSouth()
    {
        return $this->southWest->getLatitude();
    }

    /**
     * Get east longitude.
     *
     * @return int
     */
    public function getEast()
    {
        return $this->northEast->getLongitude();
    }

    /**
     * Get the center.
     *
     * @return LatLng
     */
    public function getCenter()
    {
        return new LatLng(
            ($this->getNorth() - $this->getSouth()),
            ($this->getWest() - $this->getEast())
        );
    }

    /**
     * Get north latitude.
     *
     * @return int
     */
    public function getNorth()
    {
        return $this->northEast->getLatitude();
    }

    /**
     * Compare two bounds.
     *
     * @param LatLngBounds $other The other bounds.
     *
     * @return bool
     */
    public function equals(LatLngBounds $other)
    {
        if (!$this->getNorthEast()->equals($other->getNorthEast())) {
            return false;
        }

        return $this->getSouthWest()->equals($other->getSouthWest());
    }

    /**
     * Get value as valid json string.
     *
     * @return array
     */
    public function jsonSerialize()
    {
        return array(
            $this->getSouthWest(),
            $this->getNorthEast()
        );
    }

    /**
     * Get bounds as geo json coordinate.
     *
     * @return array
     */
    public function toGeoJson()
    {
        return array(
            $this->getSouthWest()->toGeoJson(),
            $this->getNorthEast()->toGeoJson()
        );
    }

    /**
     * Check if given object in in the bounds.
     *
     * @param $object
     *
     * @return bool
     */
    public function contains($object)
    {
        // TODO: Implement
    }
}
