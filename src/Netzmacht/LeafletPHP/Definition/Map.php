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

namespace Netzmacht\LeafletPHP\Definition;

use Netzmacht\LeafletPHP\Assert\Assertion;
use Netzmacht\LeafletPHP\Assert\InvalidArgumentException;
use Netzmacht\LeafletPHP\Value\LatLng;
use Netzmacht\LeafletPHP\Value\LatLngBounds;

/**
 * Map object represents a leaflet map.
 *
 * @package Netzmacht\LeafletPHP\Definition
 *
 * @SuppressWarnings(PHPMD.ExcessivePublicCount)
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 * @SuppressWarnings(PHPMD.ExcessiveClassLength)
 * @SuppressWarnings(PHPMD.ExcessiveClassComplexity)
 */
class Map extends AbstractDefinition implements HasEvents, HasOptions, HasRemovableLayers
{
    use OptionsTrait;
    use EventsTrait;

    /**
     * The click event.
     *
     * @see http://leafletjs.com/reference.html#map-click
     */
    const EVENT_CLICK = 'click';

    /**
     * The dblclick event.
     *
     * @see http://leafletjs.com/reference.html#map-dblclick
     */
    const EVENT_DOUBLE_CLICK = 'dblclick';

    /**
     * The mousedown event.
     *
     * @see http://leafletjs.com/reference.html#map-mousedown
     */
    const EVENT_MOUSE_DOWN = 'mousedown';

    /**
     * The mouseover event.
     *
     * @see http://leafletjs.com/reference.html#map-mouseover
     */
    const EVENT_MOUSE_OVER = 'mouseover';

    /**
     * The mouseout event.
     *
     * @see http://leafletjs.com/reference.html#map-mouseout
     */
    const EVENT_MOUSE_OUT = 'mouseout';

    /**
     * The mousemove event.
     *
     * @see http://leafletjs.com/reference.html#map-mousemove
     */
    const EVENT_MOUSE_MOVE = 'mousemove';

    /**
     * The contextmenu event.
     *
     * @see http://leafletjs.com/reference.html#map-contextmenu
     */
    const EVENT_CONTEXT_MENU = 'contextmenu';

    /**
     * The focus event.
     *
     * @see http://leafletjs.com/reference.html#map-focus
     */
    const EVENT_FOCUS = 'focus';

    /**
     * The blur event.
     *
     * @see http://leafletjs.com/reference.html#map-blur
     */
    const EVENT_BLUR = 'blur';

    /**
     * The preclick event.
     *
     * @see http://leafletjs.com/reference.html#map-preclick
     */
    const EVENT_PRE_CLICK = 'preclick';

    /**
     * The load event.
     *
     * @see http://leafletjs.com/reference.html#map-load
     */
    const EVENT_LOAD = 'load';

    /**
     * The unload event.
     *
     * @see http://leafletjs.com/reference.html#map-unload
     */
    const EVENT_UNLOAD = 'unload';

    /**
     * The move event.
     *
     * @see http://leafletjs.com/reference.html#map-move
     */
    const EVENT_MOVE = 'move';

    /**
     * The movestart event.
     *
     * @see http://leafletjs.com/reference.html#map-movestart
     */
    const EVENT_MOVE_START = 'movestart';

    /**
     * The moveend event.
     *
     * @see http://leafletjs.com/reference.html#map-moveend
     */
    const EVENT_MOVE_END = 'moveend';

    /**
     * The drag event.
     *
     * @see http://leafletjs.com/reference.html#map-drag
     */
    const EVENT_DRAG = 'drag';

    /**
     * The dragstart event.
     *
     * @see http://leafletjs.com/reference.html#map-dragstart
     */
    const EVENT_DRAG_START = 'dragstart';

    /**
     * The dragend event.
     *
     * @see http://leafletjs.com/reference.html#map-dragend
     */
    const EVENT_DRAG_END = 'dragend';

    /**
     * The zoomstart event.
     *
     * @see http://leafletjs.com/reference.html#map-zoomstart
     */
    const EVENT_ZOOM_START = 'zoomstart';

    /**
     * The zoomend event.
     *
     * @see http://leafletjs.com/reference.html#map-zoomend
     */
    const EVENT_ZOOM_END = 'zoomend';

    /**
     * The zoomlevelschange event.
     *
     * @see http://leafletjs.com/reference.html#map-zoomlevelschange
     */
    const EVENT_ZOOMLEVELS_CHANGE = 'zoomlevelschange';
    
    /**
     * The resize event.
     *
     * @see http://leafletjs.com/reference.html#map-resize
     */
    const EVENT_RESIZE = 'resize';

    /**
     * The autopanstart event.
     *
     * @see http://leafletjs.com/reference.html#map-autopanstart
     */
    const EVENT_AUTO_PAN_START = 'autopanstart';

    /**
     * The layeradd event.
     *
     * @see http://leafletjs.com/reference.html#map-layeradd
     */
    const EVENT_LAYER_ADD = 'layeradd';
    
    /**
     * The layerremove event.
     *
     * @see http://leafletjs.com/reference.html#map-layerremove
     */
    const EVENT_LAYER_REMOVE = 'layerremove';

    /**
     * The baselayerchange event.
     *
     * @see http://leafletjs.com/reference.html#map-baselayerchange
     */
    const EVENT_BASE_LAYER_CHANGE = 'baselayerchange';

    /**
     * The overlayadd event.
     *
     * @see http://leafletjs.com/reference.html#map-overlayadd
     */
    const EVENT_OVERLAY_ADD = 'overlayadd';

    /**
     * The overlayremove event.
     *
     * @see http://leafletjs.com/reference.html#map-overlayremove
     */
    const EVENT_OVERLAY_REMOVE = 'overlayremove';

    /**
     * The locationfound event.
     *
     * @see http://leafletjs.com/reference.html#map-locationfound
     */
    const EVENT_LOCATION_FOUND = 'locationfound';

    /**
     * The locationerror event.
     *
     * @see http://leafletjs.com/reference.html#map-locationerror
     */
    const EVENT_LOCATION_ERROR = 'locationerror';

    /**
     * The popupopen event.
     *
     * @see http://leafletjs.com/reference.html#map-popupopen
     */
    const EVENT_POPUP_OPEN = 'popupopen';

    /**
     * The popupclose event.
     *
     * @see http://leafletjs.com/reference.html#map-popupclose
     */
    const EVENT_POPUP_CLOSE = 'popupclose';

    /**
     * Map layers.
     *
     * @var Layer[]
     */
    private $layers = array();

    /**
     * Map controls.
     *
     * @var Control[]
     */
    private $controls = array();

    /**
     * Get the type of the definition.
     *
     * @return mixed
     */
    public static function getType()
    {
        return 'Map';
    }

    /**
     * Element html id.
     *
     * @var string
     */
    private $elementId;

    /**
     * Construct.
     *
     * @param string $elementId  The html element id.
     * @param string $identifier The javascript reference identifier.
     */
    public function __construct($elementId, $identifier)
    {
        parent::__construct($identifier);

        $this->elementId = $elementId;
    }

    /**
     * Get the element id.
     *
     * @return string
     */
    public function getElementId()
    {
        return $this->elementId;
    }
    
    /**
     * Set the zoom.
     *
     * @param float $zoom The zoom level.
     *
     * @return $this
     * @see    http://leafletjs.com/reference.html#map-zoom
     */
    public function setZoom($zoom)
    {
        return $this->setOption('zoom', (float) $zoom);
    }

    /**
     * Get the initial zoom level.
     *
     * @return float
     * @see    http://leafletjs.com/reference.html#map-zoom
     */
    public function getZoom()
    {
        return $this->getOption('zoom', null);
    }

    /**
     * Set preferCanvas option.
     *
     * @param bool $preferCanvas Prefer canvas option.
     *
     * @return $this
     */
    public function setPreferCanvas($preferCanvas)
    {
        return $this->setOption('preferCanvas', (bool) $preferCanvas);
    }

    /**
     * Get prefer canvas option.
     *
     * @return bool
     */
    public function isPreferCanvas()
    {
        return $this->getOption('preferCanvas', false);
    }

    /**
     * Set the center.
     *
     * @param LatLng|array $center The map center.
     *
     * @return $this
     * @see    http://leafletjs.com/reference.html#map-center
     */
    public function setCenter($center)
    {
        if (!$center instanceof LatLng) {
            $center = LatLng::fromNative($center);
        }

        Assertion::isInstanceOf($center, 'Netzmacht\LeafletPHP\Value\LatLng');

        return $this->setOption('center', $center);
    }

    /**
     * Get the center.
     *
     * @return LatLng|null
     * @see    http://leafletjs.com/reference.html#map-center
     */
    public function getCenter()
    {
        return $this->getOption('center', null);
    }

    /**
     * Add a layer.
     *
     * @param Layer $layer Map layer.
     *
     * @return $this
     */
    public function addLayer(Layer $layer)
    {
        $this->layers[] = $layer;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function removeLayer(Layer $layer)
    {
        $position = array_search($layer, $this->layers);

        if ($position !== false) {
            unset($this->layers[$position]);
        }

        return $this;
    }

    /**
     * Check if the map has the layer.
     *
     * @param Layer $layer The layer.
     *
     * @return bool
     */
    public function hasLayer(Layer $layer)
    {
        return in_array($layer, $this->layers);
    }

    /**
     * Get the layers.
     *
     * @return Layer[]
     */
    public function getLayers()
    {
        return $this->layers;
    }

    /**
     * Add control to the map.
     *
     * @param Control $control Control being added.
     *
     * @return $this
     */
    public function addControl(Control $control)
    {
        $this->controls[] = $control;

        return $this;
    }

    /**
     * Remove a control from the map.
     *
     * @param Control $control Control being removed.
     *
     * @return $this
     */
    public function removeControl(Control $control)
    {
        $key = array_search($control, $this->controls);

        if ($key !== false) {
            unset($this->controls[$key]);
        }

        return $this;
    }

    /**
     * Get controls.
     *
     * @return Control[]
     */
    public function getControls()
    {
        return $this->controls;
    }

    /**
     * Set the min zoom.
     *
     * @param float $zoom The zoom level.
     *
     * @return $this
     * @see    http://leafletjs.com/reference.html#map-minzoom
     */
    public function setMinZoom($zoom)
    {
        return $this->setOption('minZoom', (float) $zoom);
    }

    /**
     * Get the min zoom level.
     *
     * @return float
     * @see    http://leafletjs.com/reference.html#map-minzoom
     */
    public function getMinZoom()
    {
        return $this->getOption('minZoom', 18);
    }

    /**
     * Set the max zoom.
     *
     * @param float $zoom The zoom level.
     *
     * @return $this
     * @see    http://leafletjs.com/reference.html#map-maxzoom
     */
    public function setMaxZoom($zoom)
    {
        return $this->setOption('maxZoom', (float) $zoom);
    }

    /**
     * Get the max zoom level.
     *
     * @return float
     * @see    http://leafletjs.com/reference.html#map-maxzoom
     */
    public function getMaxZoom()
    {
        return $this->getOption('maxZoom', null);
    }

    /**
     * Set the zoom delta.
     *
     * @param float $zoom The zoom delta.
     *
     * @return $this
     * @see    http://leafletjs.com/reference-1.0.0.html#map-zoomdelta
     */
    public function setZoomDelta($zoom)
    {
        return $this->setOption('zoomDelta', (float) $zoom);
    }

    /**
     * Get the zoom delta.
     *
     * @return float
     * @see    http://leafletjs.com/reference-1.0.0.html#map-zoomdelta
     */
    public function getZoomDelta()
    {
        return $this->getOption('zoomDelta', 1);
    }

    /**
     * Set the zoom snap.
     *
     * @param float $zoom The zoom snap.
     *
     * @return $this
     * @see    http://leafletjs.com/reference-1.0.0.html#map-zoomsnap
     */
    public function setZoomSnap($zoom)
    {
        return $this->setOption('zoomSnap', (float) $zoom);
    }

    /**
     * Get the zoom snap.
     *
     * @return float
     * @see    http://leafletjs.com/reference-1.0.0.html#map-zoomsnap
     */
    public function getZoomSnap()
    {
        return $this->getOption('zoomSnap', 1);
    }

    /**
     * Set max bounds option.
     *
     * @param LatLngBounds|array $bounds Max bounds.
     *
     * @return $this
     * @see    http://leafletjs.com/reference.html#map-maxbounds
     *
     * @throws InvalidArgumentException If invalid bounds given.
     */
    public function setMaxBounds($bounds)
    {
        if (is_array($bounds)) {
            $bounds = LatLngBounds::fromArray($bounds);
        }

        Assertion::isInstanceOf($bounds, 'Netzmacht/LeafletPHP/Type/LatLngBounds');

        return $this->setOption('maxBounds', $bounds);
    }

    /**
     * Get max bounds.
     *
     * @return LatLngBounds|null
     * @see    http://leafletjs.com/reference.html#map-maxbounds
     */
    public function getMaxBounds()
    {
        return $this->getOption('maxBounds');
    }

    /**
     * Enable or disable dragging.
     *
     * @param bool $value Enable dragging.
     *
     * @return $this
     * @see    http://leafletjs.com/reference.html#map-dragging
     */
    public function setDragging($value)
    {
        return $this->setOption('dragging', (bool) $value);
    }

    /**
     * Check if dragging is enabled.
     *
     * @return bool
     * @see    http://leafletjs.com/reference.html#map-dragging
     */
    public function isDragging()
    {
        return $this->getOption('dragging', true);
    }

    /**
     * Enable or disable touch zoom.
     *
     * @param bool|string $value Enable touch zoom.
     *
     * @return $this
     * @see    http://leafletjs.com/reference.html#map-touchzoom
     */
    public function setTouchZoom($value)
    {
        if ($value !== 'center') {
            $value = (bool) $value;
        }

        return $this->setOption('touchZoom', $value);
    }

    /**
     * Get touch zoom option.
     *
     * @return string|bool
     * @see    http://leafletjs.com/reference.html#map-touchzoom
     */
    public function getTouchZoom()
    {
        return $this->getOption('touchZoom', true);
    }

    /**
     * Enable or disable scroll whee zoom.
     *
     * @param bool|string $value Enable scroll wheel zoom.
     *
     * @return $this
     * @see    http://leafletjs.com/reference.html#map-scrollwheelzoom
     */
    public function setScrollWheelZoom($value)
    {
        if ($value !== 'center') {
            $value = (bool) $value;
        }

        return $this->setOption('scrollWheelZoom', $value);
    }

    /**
     * Check if scroll wheel zoom is enabled.
     *
     * @return bool|string
     * @see    http://leafletjs.com/reference.html#map-scrollwheelzoom
     */
    public function isScrollWheelZoom()
    {
        return $this->getOption('scrollWheelZoom', true);
    }

    /**
     * Set wheel debounce time option.
     *
     * @param int $debounceTime Wheel debounce time in milliseconds.
     *
     * @return $this
     */
    public function setWheelDebounceTime($debounceTime)
    {
        return $this->setOption('wheelDebounceTime', (int) $debounceTime);
    }

    /**
     * Get wheel debounce time option.
     *
     * @return int
     */
    public function getWheelDebounceTime()
    {
        return $this->getOption('wheelDebounceTime', 40);
    }

    /**
     * Set max bounds viscosity option.
     *
     * @param float $boundsViscosity Max bounds viscosity.
     *
     * @return $this
     */
    public function setMaxBoundsViscosity($boundsViscosity)
    {
        return $this->setOption('maxBoundsViscosity', (float) $boundsViscosity);
    }

    /**
     * Get max bounds viscosity option.
     *
     * @return float
     */
    public function getMaxBoundsViscosity()
    {
        return $this->getOption('maxBoundsViscosity', 0.0);
    }

    /**
     * Enable or disable double click zoom.
     *
     * @param bool $value Enable double click zoom.
     *
     * @return $this
     * @see    http://leafletjs.com/reference.html#map-doubleclickzoom
     */
    public function setDoubleClickZoom($value)
    {
        if ($value !== 'center') {
            $value = (bool) $value;
        }

        return $this->setOption('doubleClickZoom', $value);
    }

    /**
     * Check if double click zoom is enabled.
     *
     * @return bool
     * @see    http://leafletjs.com/reference.html#map-doubleclickzoom
     */
    public function isDoubleClickZoom()
    {
        return $this->getOption('doubleClickZoom', true);
    }

    /**
     * Enable or disable box zoom.
     *
     * @param bool $value Enable box zoom.
     *
     * @return $this
     * @see    http://leafletjs.com/reference.html#map-boxzoom
     */
    public function setBoxZoom($value)
    {
        return $this->setOption('boxZoom', (bool) $value);
    }

    /**
     * Check if box zoom is enabled.
     *
     * @return bool
     * @see    http://leafletjs.com/reference.html#map-boxzoom
     */
    public function isBoxZoom()
    {
        return $this->getOption('boxZoom', true);
    }

    /**
     * Enable or instant tap hacks.
     *
     * @param bool $value Enable tap hacks.
     *
     * @return $this
     * @see    http://leafletjs.com/reference.html#map-tap
     */
    public function setTap($value)
    {
        return $this->setOption('tap', (bool) $value);
    }

    /**
     * Check if tap hacks are enabled.
     *
     * @return bool
     * @see    http://leafletjs.com/reference.html#map-tap
     */
    public function isTap()
    {
        return $this->getOption('tap', true);
    }

    /**
     * Set the tap tolerance.
     *
     * @param int $tolerance The tap tolerance in pixels.
     *
     * @return $this
     * @see    http://leafletjs.com/reference.html#map-taptolerance
     */
    public function setTapTolerance($tolerance)
    {
        return $this->setOption('tapTolerance', (int) $tolerance);
    }

    /**
     * Get the max zoom level.
     *
     * @return int
     * @see    http://leafletjs.com/reference.html#map-taptolerance
     */
    public function getTapTolerance()
    {
        return $this->getOption('tapTolerance', 15);
    }

    /**
     * Enable or window resize tracking.
     *
     * @param bool $value Enable resize tracking.
     *
     * @return $this
     * @see    http://leafletjs.com/reference.html#map-trackresize
     */
    public function setTrackResize($value)
    {
        return $this->setOption('trackResize', (bool) $value);
    }

    /**
     * Check if track resize is enabled.
     *
     * @return bool
     * @see    http://leafletjs.com/reference.html#map-trackresize
     */
    public function isTrackResize()
    {
        return $this->getOption('trackResize', true);
    }

    /**
     * Enable or disable word copy jump.
     *
     * @param bool $value Enable or disable world copy jump.
     *
     * @return $this
     * @see    http://leafletjs.com/reference.html#map-worldcopyjump
     */
    public function setWorldCopyJump($value)
    {
        return $this->setOption('worldCopyJump', (bool) $value);
    }

    /**
     * Check if world copy jump is enabled.
     *
     * @return bool
     * @see    http://leafletjs.com/reference.html#map-worldcopyjump
     */
    public function isWorldCopyJump()
    {
        return $this->getOption('worldCopyJump', false);
    }

    /**
     * Enable or popup closing then clicking on the map.
     *
     * @param bool $value Enable popup close on click.
     *
     * @return $this
     * @see    http://leafletjs.com/reference.html#map-closepopuponclick
     */
    public function setCloseOnClick($value)
    {
        return $this->setOption('closeOnClick', (bool) $value);
    }

    /**
     * Check if popup closing on map click is enabled.
     *
     * @return bool
     * @see    http://leafletjs.com/reference.html#map-closepopuponclick
     */
    public function isCloseOnClick()
    {
        return $this->getOption('closeOnClick', true);
    }

    /**
     * Enable or bouncing on zoom limits.
     *
     * @param bool $value Enable bounce at zoom.
     *
     * @return $this
     * @see    http://leafletjs.com/reference.html#map-bounceatzoomlimits
     */
    public function setBounceAtZoomLimits($value)
    {
        return $this->setOption('bounceAtZoomLimits', (bool) $value);
    }

    /**
     * Check if bounce at zoom limits is enableds.
     *
     * @return bool
     * @see    http://leafletjs.com/reference.html#map-bounceatzoomlimits
     */
    public function isBounceAtZoomLimits()
    {
        return $this->getOption('bounceAtZoomLimits', true);
    }

    /**
     * Enable or disable keayboard navigation.
     *
     * @param bool $value Enable keyboard navigation.
     *
     * @return $this
     * @see    http://leafletjs.com/reference.html#map-keyboard
     */
    public function setKeyboard($value)
    {
        return $this->setOption('keyboard', (bool) $value);
    }

    /**
     * Check if keyboard navigation is enabled.
     *
     * @return bool
     * @see    http://leafletjs.com/reference.html#map-keyboard
     */
    public function isKeyboard()
    {
        return $this->getOption('keyboard', true);
    }

    /**
     * Set keyboard pan offset.
     *
     * @param int $value Keyboard pan offset value.
     *
     * @return $this
     * @see    http://leafletjs.com/reference.html#map-keyboardpanoffset
     */
    public function setKeyboardPanOffset($value)
    {
        return $this->setOption('keyboardPanOffset', (int) $value);
    }

    /**
     * Get keyboard pan offset.
     *
     * @return int
     * @see    http://leafletjs.com/reference.html#map-keyboardpanoffset
     */
    public function isKeyboardPanOffset()
    {
        return $this->getOption('keyboardPanOffset', 80);
    }

    /**
     * Set keyboard zoom offset.
     *
     * @param int $value Keyboard zoom offset value.
     *
     * @return $this
     * @see    http://leafletjs.com/reference.html#map-keyboardzoomoffset
     */
    public function setKeyboardZoomOffset($value)
    {
        return $this->setOption('keyboardZoomOffset', (int) $value);
    }

    /**
     * Get keyboard zoom offset.
     *
     * @return int
     * @see    http://leafletjs.com/reference.html#map-keyboardzoomoffset
     */
    public function isKeyboardZoomOffset()
    {
        return $this->getOption('keyboardZoomOffset', 1);
    }

    /**
     * Enable or disable zoom control.
     *
     * @param bool $control Enable or disable the control.
     *
     * @return $this
     * @see    zoomIn
     */
    public function setZoomControl($control)
    {
        return $this->setOption('zoomControl', $control);
    }

    /**
     * Check if zoom control is enabled.
     *
     * @return bool
     */
    public function isZoomControl()
    {
        return $this->getOption('zoomControl', true);
    }

    /**
     * Enable or disable attribution control.
     *
     * @param bool $control Enable or disable the control.
     *
     * @return $this
     * @see    Attribution
     */
    public function setAttributionControl($control)
    {
        return $this->setOption('attributionControl', $control);
    }

    /**
     * Check if attribution control is enabled.
     *
     * @return bool
     */
    public function isAttributionControl()
    {
        return $this->getOption('attributionControl', true);
    }

    /**
     * Zoom in.
     *
     * @param int   $delta   Zoom delta.
     * @param array $options Zoom options.
     *
     * @return $this
     * @see    http://leafletjs.com/reference.html#map-zoomin
     */
    public function zoomIn($delta = 1, array $options = array())
    {
        return $this->addMethod('zoomIn', array($delta, $options));
    }

    /**
     * Zoom out.
     *
     * @param int   $delta   Zoom delta.
     * @param array $options Zoom options.
     *
     * @return $this
     * @see    http://leafletjs.com/reference.html#map-zoomin
     */
    public function zoomOut($delta = 1, array $options = array())
    {
        return $this->addMethod('zoomOut', array($delta, $options));
    }

    /**
     * Fit bounds.
     *
     * @param LatLngBounds $bounds  The bounds.
     * @param array        $options The options.
     *
     * @return $this
     */
    public function fitBounds(LatLngBounds $bounds, array $options = array())
    {
        return $this->addMethod('fitBounds', array($bounds, $options));
    }

    /**
     * Fit the world.
     *
     * @param array $options Options.
     *
     * @return $this
     */
    public function fitWorld(array $options = array())
    {
        return $this->addMethod('fitWorld', array($options));
    }

    /**
     * Pan to coordinates.
     *
     * @param LatLng $latLng  New map center.
     * @param array  $options Pan options.
     *
     * @return $this
     */
    public function panTo(LatLng $latLng, array $options = array())
    {
        return $this->addMethod('panTo', array($latLng, $options));
    }

    /**
     * Create user locate call.
     *
     * @param array $options Location options.
     *
     * @return $this
     * @see    http://leafletjs.com/reference.html#map-locate
     */
    public function locate(array $options = null)
    {
        $arguments = $options ? array($options) : array();

        return $this->addMethod('locate', $arguments);
    }

    /**
     * Stop watching location.
     *
     * @return $this
     */
    public function stopLocate()
    {
        return $this->addMethod('stopLocate');
    }

    /**
     * Make getRenderer method call.
     *
     * @param Layer $layer The layer.
     *
     * @return $this
     */
    public function getRenderer(Layer $layer)
    {
        return $this->addMethod('getRenderer', [$layer]);
    }

    /**
     * Create pane method call.
     *
     * @param string $name      Pane name.
     * @param null   $container Optional container.
     *
     * @return $this
     */
    public function createPane($name, $container = null)
    {
        return $this->addMethod('createPane', [$name, $container]);
    }

    /**
     * Create get pane method call.
     *
     * @return $this
     */
    public function getPane()
    {
        return $this->addMethod('getPane');
    }

    /**
     * Create get panes method call.
     *
     * @return $this
     */
    public function getPanes()
    {
        return $this->addMethod('getPanes');
    }
}
