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

namespace Netzmacht\LeafletPHP\Value\GeoJson;

/**
 * A geo json feature.
 *
 * @see     http://geojson.org/geojson-spec.html#feature-objects
 * @package Netzmacht\LeafletPHP\Definition\GeoJson
 */
class Feature extends AbstractFeature
{
    /**
     * The identifier.
     *
     * @var string
     */
    private $identifier;

    /**
     * The geometry.
     *
     * @var Geometry
     */
    private $geometry;

    /**
     * Feature properties.
     *
     * @var array
     */
    private $properties = array();

    /**
     * Construct.
     *
     * @param Geometry $geometry   The geometry.
     * @param string   $identifier The optional identifier.
     */
    public function __construct(Geometry $geometry, $identifier = null)
    {
        $this->identifier = $identifier;
        $this->geometry   = $geometry;
    }

    /**
     * Get the identifier.
     *
     * @return string
     */
    public function getIdentifier()
    {
        return $this->identifier;
    }

    /**
     * Get the geometry.
     *
     * @return Geometry
     */
    public function getGeometry()
    {
        return $this->geometry;
    }

    /**
     * Get all properties.
     *
     * @return array
     */
    public function getProperties()
    {
        return $this->properties;
    }

    /**
     * Set feature property.
     *
     * @param string $name  The property name.
     * @param mixed  $value The property value.
     *
     * @return $this
     */
    public function setProperty($name, $value)
    {
        $this->properties[$name] = $value;

        return $this;
    }

    /**
     * Get feature property.
     *
     * @param string $name The property name.
     *
     * @return $this
     */
    public function getProperty($name)
    {
        if (isset($this->properties[$name])) {
            return $this->properties[$name];
        }

        return null;
    }

    /**
     * Set feature properties.
     *
     * Properties are added. Existing properties are only overwritten if defined in the set.
     *
     * @param array $properties Properties.
     *
     * @return $this
     */
    public function setProperties($properties)
    {
        foreach ($properties as $name => $value) {
            $this->setProperty($name, $value);
        }

        return $this;
    }


    /**
     * {@inheritdoc}
     */
    public function jsonSerialize()
    {
        $data = array(
            'type'       => 'Feature',
            'geometry'   => $this->geometry,
            'properties' => $this->properties ?: null
        );

        if ($this->getBoundingBox()) {
            $data['bbox'] = $this->getBoundingBox()->toGeoJson();
        }

        if ($this->identifier) {
            $data['id'] = $this->identifier;
        }

        return $data;
    }
}
