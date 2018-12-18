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

namespace Netzmacht\LeafletPHP\Value;

/**
 * Class LatLngBounds defines a bounds on the map.
 *
 * @package Netzmacht\LeafletPHP\Definition\Type
 */
class LatLngBounds implements \JsonSerializable
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
     * Create from a string format.
     *
     * @param string $native    Bounds string representation.
     * @param string $separator Separator string of each value.
     *
     * @return LatLngBounds
     * @throws \InvalidArgumentException If an invalid value is given.
     */
    public static function fromString($native, $separator = ',')
    {
        $values = explode($separator, $native, 4);

        if (count($values) !== 4) {
            throw new \InvalidArgumentException(
                sprintf('LatLngBounds can not be created from string "%s"', $native)
            );
        }

        return new LatLngBounds(
            new LatLng($values[0], $values[1]),
            new LatLng($values[2], $values[3])
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
     * Check if bounds overlaps.
     *
     * @param LatLngBounds $other The over bounds to check.
     *
     * @return bool
     */
    public function overlaps(LatLngBounds $other)
    {
        $southWest = $other->getSouthWest();
        $northEast = $other->getNorthEast();

        $latOverlaps = ($northEast->getLatitude() > $this->southWest->getLatitude())
            && ($southWest->getLatitude() < $this->northEast->getLatitude());

        $lngOverlaps = ($northEast->getLongitude() > $this->southWest->getLongitude())
            && ($southWest->getLongitude() < $northEast->getLongitude());

        return $latOverlaps && $lngOverlaps;
    }

    /**
     * Check if bounds intersects.
     *
     * @param LatLngBounds $other The other bounds.
     *
     * @return bool
     */
    public function intersects(LatLngBounds $other)
    {
        $southWest = $other->getSouthWest();
        $northEast = $other->getNorthEast();

        $latOverlaps = ($northEast->getLatitude() >= $this->southWest->getLatitude())
            && ($southWest->getLatitude() <= $this->northEast->getLatitude());

        $lngOverlaps = ($northEast->getLongitude() >= $this->southWest->getLongitude())
            && ($southWest->getLongitude() <= $northEast->getLongitude());

        return $latOverlaps && $lngOverlaps;
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
     * Create a string representation.
     *
     * @param bool $ignoreAltitude If true the altitude is not included.
     *
     * @return string
     */
    public function toString($ignoreAltitude = false)
    {
        return sprintf(
            '%s,%s',
            $this->getSouthWest()->toString($ignoreAltitude),
            $this->getNorthEast()->toString($ignoreAltitude)
        );
    }

    /**
     * Check if given object in in the bounds.
     *
     * @param LatLng|LatLngBounds $object The given object.
     *
     * @return bool
     * @throws \RuntimeException If LatLngBounds is checked. Not implemented yet.
     */
    public function contains($object)
    {
        if ($object instanceof LatLng) {
            $lat = $object->getLatitude();
            $lng = $object->getLongitude();

            if ($this->getWest() > $lng || $this->getEast() < $lng) {
                return false;
            }

            return ($this->getSouth() <= $lat && $this->getNorth() >= $lat);
        } elseif ($object instanceof LatLngBounds) {
            throw new \RuntimeException('LatLngBounds checking not implemented so far');
        }

        return false;
    }
}
