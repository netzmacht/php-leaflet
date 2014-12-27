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
use Netzmacht\LeafletPHP\Encoder;

/**
 * Class LatLng.
 *
 * @package Netzmacht\LeafletPHP\Definition\Type
 */
class LatLng implements ConvertsToJson
{
    /**
     * Latitude value.
     *
     * @var float
     */
    private $latitude;

    /**
     * Longitude value.
     *
     * @var float
     */
    private $longitude;

    /**
     * Optional altitude value.
     *
     * @var float
     */
    private $altitude;

    /**
     * Construct.
     *
     * @param float $latitude  The latitude.
     * @param float $longitude The longitude.
     * @param float $altitude  Optional altitude.
     */
    public function __construct($latitude, $longitude, $altitude = null)
    {
        $this->latitude  = (float) $latitude;
        $this->longitude = (float) $longitude;
        $this->altitude  = $altitude;
    }

    /**
     * Create LatLng from array.
     *
     * @param array $native Native array.
     *                      Following keys are supported:
     *                       - Numeric keys 0-2
     *                       - Short names "lat", "lng", "alt"
     *                       - Long names "latitude", "longitude", "altitude".
     *
     * @return LatLng
     *
     * @throws \InvalidArgumentException If format is not supported.
     */
    public static function fromArray($native)
    {
        $keys = array(
            array(0, 1, 2),
            array('lat', 'lng', 'alt'),
            array('latitude', 'longitude', 'altitude'),
        );

        foreach ($keys as $key) {
            if (isset($native[$key[0]]) && isset($native[$key[1]])) {
                return new static(
                    $native[$key[0]],
                    $native[$key[1]],
                    empty($native[$key[2]]) ? null : $native[$key[2]]
                );
            }
        }

        throw new \InvalidArgumentException('LatLng format not supported');
    }

    /**
     * Get latitude.
     *
     * @return int
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * Get Longitude.
     *
     * @return int
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * Get altitude.
     *
     * @return int|null
     */
    public function getAltitude()
    {
        return $this->altitude;
    }

    /**
     * Check if altitude is set.
     *
     * @return bool
     */
    public function hasAltitude()
    {
        return $this->altitude !== null;
    }

    /**
     * Compare 2 coordinates. It ignores the altitude.
     *
     * @param LatLng $other Another coordinate.
     *
     * @return bool
     */
    public function equals(LatLng $other)
    {
        if ($this->getLatitude() !== $other->getLatitude()) {
            return false;
        }

        if ($this->getLongitude() !== $other->getLongitude()) {
            return false;
        }

        return true;
    }

    /**
     * Convert object to json ready data.
     *
     * @return string
     */
    public function toJson()
    {
        $raw = array (
            $this->getLatitude(),
            $this->getLongitude()
        );

        if ($this->hasAltitude()) {
            $raw[] = $this->getAltitude();
        }

        return json_encode($raw);
    }
}
