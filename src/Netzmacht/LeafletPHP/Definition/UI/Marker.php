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

namespace Netzmacht\LeafletPHP\Definition\UI;

use Netzmacht\LeafletPHP\Definition\AbstractLayer;
use Netzmacht\LeafletPHP\Definition\EventsTrait;
use Netzmacht\LeafletPHP\Value\GeoJson\ConvertsToGeoJsonFeature;
use Netzmacht\LeafletPHP\Value\GeoJson\Feature;
use Netzmacht\LeafletPHP\Value\GeoJson\Geometry;
use Netzmacht\LeafletPHP\Definition\HasOptions;
use Netzmacht\LeafletPHP\Definition\HasPopup;
use Netzmacht\LeafletPHP\Definition\OptionsTrait;
use Netzmacht\LeafletPHP\Definition\PopupTrait;
use Netzmacht\LeafletPHP\Definition\Type\Icon;
use Netzmacht\LeafletPHP\Value\LatLng;

/**
 * Class Marker is the Marker definition for the Leaflet marker.
 *
 * @package Netzmacht\LeafletPHP\Definition\UI
 */
class Marker extends AbstractLayer implements HasOptions, Geometry, ConvertsToGeoJsonFeature, HasPopup
{
    use OptionsTrait;
    use EventsTrait;
    use PopupTrait;

    /**
     * Get the type of the definition.
     *
     * @return string
     */
    public static function getType()
    {
        return 'Marker';
    }

    /**
     * Coordinates of the marker.
     *
     * @var LatLng
     */
    private $latLng;

    /**
     * Construct.
     *
     * @param string              $identifier The identifier.
     * @param LatLng|string|array $latLng     LatLng.
     */
    public function __construct($identifier, $latLng)
    {
        parent::__construct($identifier);

        $this->setLatLng($latLng);
    }

    /**
     * Get coordinates of the marker.
     *
     * @return LatLng
     */
    public function getLatLng()
    {
        return $this->latLng;
    }

    /**
     * Set coordinates of the marker.
     *
     * @param LatLng|array|string $latLng The new coordinates.
     *
     * @return $this
     */
    public function setLatLng($latLng)
    {
        if (!$latLng instanceof LatLng) {
            $latLng = LatLng::fromNative($latLng);
        }

        $this->latLng = $latLng;

        return $this;
    }

    /**
     * Set a custom icon.
     *
     * @param Icon $icon Custom icon.
     *
     * @return $this
     * @see    http://leafletjs.com/reference.html#marker-icon
     */
    public function setIcon(Icon $icon)
    {
        return $this->setOption('icon', $icon);
    }

    /**
     * Get custom icon. Null if no custom icon is set.
     *
     * @return Icon|null
     * @see    http://leafletjs.com/reference.html#marker-icon
     */
    public function getIcon()
    {
        return $this->getOption('icon');
    }

    /**
     * Set interactive option.
     *
     * @param bool $value Interactive value.
     *
     * @return $this
     * @see    http://leafletjs.com/reference.html#marker-interactive
     */
    public function setInteractive($value)
    {
        return $this->setOption('interactive', (bool) $value);
    }

    /**
     * Check if marker is interactive.
     *
     * @return bool
     * @see    http://leafletjs.com/reference.html#marker-interactive
     */
    public function isInteractive()
    {
        return $this->getOption('interactive', true);
    }

    /**
     * Set draggable option.
     *
     * @param bool $value Draggable value.
     *
     * @return $this
     * @see    http://leafletjs.com/reference.html#marker-draggable
     */
    public function setDraggable($value)
    {
        return $this->setOption('draggable', (bool) $value);
    }

    /**
     * Check if marker is draggable.
     *
     * @return bool
     * @see    http://leafletjs.com/reference.html#marker-draggable
     */
    public function isDraggable()
    {
        return $this->getOption('draggable', true);
    }
    
    /**
     * Set keyboard option.
     *
     * @param bool $value Keyboard value.
     *
     * @return $this
     * @see    http://leafletjs.com/reference.html#marker-keyboard
     */
    public function setKeyboard($value)
    {
        return $this->setOption('keyboard', (bool) $value);
    }

    /**
     * Check if marker is keyboard.
     *
     * @return bool
     * @see    http://leafletjs.com/reference.html#marker-keyboard
     */
    public function isKeyboard()
    {
        return $this->getOption('keyboard', true);
    }

    /**
     * Set tooltip title.
     *
     * @param string $title The tooltip title.
     *
     * @return $this
     * @see    http://leafletjs.com/reference.html#marker-title
     */
    public function setTitle($title)
    {
        return $this->setOption('title', $title);
    }

    /**
     * Get the tooltip title.
     *
     * @return string
     * @see    http://leafletjs.com/reference.html#marker-title
     */
    public function getTitle()
    {
        return $this->getOption('title', '');
    }

    /**
     * Set alt attribute of icon.
     *
     * @param string $alt The tooltip alt.
     *
     * @return $this
     * @see    http://leafletjs.com/reference.html#marker-alt
     */
    public function setAlt($alt)
    {
        return $this->setOption('alt', $alt);
    }

    /**
     * Get the alt attribute of the icon.
     *
     * @return string
     * @see    http://leafletjs.com/reference.html#marker-alt
     */
    public function getAlt()
    {
        return $this->getOption('alt', '');
    }
    
    /**
     * Set zIndex offset attribute.
     *
     * @param int $zIndexOffset The tooltip zIndex offset.
     *
     * @return $this
     * @see    http://leafletjs.com/reference.html#marker-zindexoffset
     */
    public function setZIndexOffset($zIndexOffset)
    {
        return $this->setOption('zIndexOffset', (int) $zIndexOffset);
    }

    /**
     * Get the zIndex offset.
     *
     * @return int
     * @see    http://leafletjs.com/reference.html#marker-zindexoffset
     */
    public function getZIndexOffset()
    {
        return $this->getOption('zIndexOffset', 0);
    }

    /**
     * Set the marker opacity.
     *
     * @param float $value Marker opacity.
     *
     * @return $this
     * @see    http://leafletjs.com/reference.html#marker-opacity
     */
    public function setFillOpacity($value)
    {
        return $this->setOption('fillOpacity', (float) $value);
    }

    /**
     * Get marker opacity.
     *
     * @return float
     * @see    http://leafletjs.com/reference.html#marker-opacity
     */
    public function getFillOpacity()
    {
        return $this->getOption('fillOpacity', 1.0);
    }
    
    /**
     * Set rise on hover option.
     *
     * @param bool $value Rise on hover option value.
     *
     * @return $this
     * @see    http://leafletjs.com/reference.html#marker-riseonhover
     */
    public function setRiseOnHover($value)
    {
        return $this->setOption('riseOnHover', (bool) $value);
    }

    /**
     * Check if rise on hover option is set.
     *
     * @return bool
     * @see    http://leafletjs.com/reference.html#marker-riseonhover
     */
    public function isRiseOnHover()
    {
        return $this->getOption('riseOnHover', false);
    }

    /**
     * Set rise offset option.
     *
     * @param int $value Rise on hover option value.
     *
     * @return $this
     * @see    http://leafletjs.com/reference.html#marker-riseoffset
     */
    public function setRiseOffset($value)
    {
        return $this->setOption('riseOffset', (int) $value);
    }

    /**
     * Get the rise on hover offset.
     *
     * @return int
     * @see    http://leafletjs.com/reference.html#marker-riseoffset
     */
    public function getRiseOffset()
    {
        return $this->getOption('riseOffset', 250);
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
     * Get marker as geo json feature.
     *
     * @return Feature
     */
    public function toGeoJsonFeature()
    {
        $feature = new Feature($this, $this->getId());
        $options = $this->getOptions();

        if ($this->getIcon()) {
            $feature->setProperty('icon', $this->getIcon()->getId());
            unset($options['icon']);
        }

        $feature->setProperty('options', $options);

        return $feature;
    }

    /**
     * {@inheritdoc}
     */
    public function convertsFullyToGeoJson()
    {
        return true;
    }
}
