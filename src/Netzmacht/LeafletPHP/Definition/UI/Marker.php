<?php

/**
 * @package    dev
 * @author     David Molineus <david.molineus@netzmacht.de>
 * @copyright  2015 netzmacht creative David Molineus
 * @license    LGPL 3.0
 * @filesource
 *
 */

namespace Netzmacht\LeafletPHP\Definition\UI;

use Netzmacht\LeafletPHP\Definition\AbstractDefinition;
use Netzmacht\LeafletPHP\Definition\AbstractLayer;
use Netzmacht\LeafletPHP\Definition\EventsTrait;
use Netzmacht\LeafletPHP\Definition\GeoJson\ConvertsToGeoJsonFeature;
use Netzmacht\LeafletPHP\Definition\GeoJson\Feature;
use Netzmacht\LeafletPHP\Definition\GeoJson\Geometry;
use Netzmacht\LeafletPHP\Definition\HasOptions;
use Netzmacht\LeafletPHP\Definition\LabelTrait;
use Netzmacht\LeafletPHP\Definition\Layer;
use Netzmacht\LeafletPHP\Definition\MapObject;
use Netzmacht\LeafletPHP\Definition\MapObjectTrait;
use Netzmacht\LeafletPHP\Definition\OptionsTrait;
use Netzmacht\LeafletPHP\Definition\PopupTrait;
use Netzmacht\LeafletPHP\Definition\Type\Icon;
use Netzmacht\LeafletPHP\Definition\Type\LatLng;

/**
 * Class Marker is the Marker definition for the Leaflet marker.
 * 
 * @package Netzmacht\LeafletPHP\Definition\UI
 */
class Marker extends AbstractLayer implements HasOptions, Geometry, ConvertsToGeoJsonFeature
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
     * Set clickable option.
     *
     * @param bool $value Clickable value.
     *
     * @return $this
     * @see    http://leafletjs.com/reference.html#marker-clickable
     */
    public function setClickable($value)
    {
        return $this->setOption('clickable', (bool) $value);
    }

    /**
     * Check if marker is clickable.
     * 
     * @return bool
     * @see    http://leafletjs.com/reference.html#marker-clickable
     */
    public function isClickable()
    {
        return $this->getOption('clickable', true);
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
        $feature = new Feature(
            $this,
            $this->getId()
        );

        $options = $this->getOptions();

        if ($this->getIcon()) {
            $feature->setProperty('icon', $this->getIcon()->getId());
            unset($options['icon']);
        }

        if ($this->getPopup()) {
            $feature->setProperty('popup', $this->getPopup());
        }

        if ($this->getPopupContent()) {
            $feature->setProperty('popupContent', $this->getPopupContent());
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
