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

namespace Netzmacht\LeafletPHP\Definition\Control;

use Netzmacht\LeafletPHP\Definition\EventsTrait;
use Netzmacht\LeafletPHP\Definition\Layer;

/**
 * Layers control.
 *
 * @package Netzmacht\LeafletPHP\Definition\Control
 */
class Layers extends AbstractControl
{
    use EventsTrait;

    const EVENT_BASE_LAYER_CHANGE = 'baselayerchange';
    const EVENT_OVERLAY_ADD       = 'overlayadd';
    const EVENT_OVERLAY_REMOVE    = 'overlayremove';

    /**
     * Base layers.
     *
     * @var Layer[]
     */
    private $baseLayers = array();

    /**
     * Overlay layers.
     *
     * @var Layer[]
     */
    private $overlays = array();

    /**
     * Construct.
     *
     * @param string  $identifier The identifier.
     * @param Layer[] $baseLayers Base layers.
     * @param Layer[] $overlays   Overlay layers.
     */
    public function __construct($identifier, $baseLayers = array(), $overlays = array())
    {
        parent::__construct($identifier);

        foreach ($baseLayers as $layer) {
            $this->addBaseLayer($layer);
        }

        foreach ($overlays as $layer) {
            $this->addOverlay($layer);
        }
    }

    /**
     * {@inheritdoc}
     */
    public static function getType()
    {
        return 'Control.Layers';
    }

    /**
     * Set initial collapsed state.
     *
     * @param bool $state The collapsed state.
     *
     * @return $this
     * @see    http://leafletjs.com/reference.html#control-layers-collapsed
     */
    public function setCollapsed($state)
    {
        return $this->setOption('collapsed', (bool) $state);
    }

    /**
     * Get initial collapsed state.
     *
     * @return bool
     * @see    http://leafletjs.com/reference.html#control-layers-collapsed
     */
    public function isCollapsed()
    {
        return $this->getOption('collapsed', true);
    }

    /**
     * Set initial collapsed state.
     *
     * @param bool $state The collapsed state.
     *
     * @return $this
     * @see    http://leafletjs.com/reference.html#control-layers-autozindex
     */
    public function setAutoZIndex($state)
    {
        return $this->setOption('autoZIndex', (bool) $state);
    }

    /**
     * Get initial collapsed state.
     *
     * @return bool
     * @see    http://leafletjs.com/reference.html#control-layers-autozindex
     */
    public function isAutoZIndex()
    {
        return $this->getOption('autoZIndex', true);
    }

    /**
     * Add a base layer.
     *
     * @param Layer $layer A Layer.
     *
     * @return $this
     * @see    http://leafletjs.com/reference.html#control-layers-addbaselayer
     */
    public function addBaseLayer(Layer $layer)
    {
        $this->baseLayers[] = $layer;

        return $this;
    }

    /**
     * Get all base layers.
     *
     * @return Layer[]
     * @see    http://leafletjs.com/reference.html#control-layers-addbaselayer
     */
    public function getBaseLayers()
    {
        return $this->baseLayers;
    }

    /**
     * Add an overlay layer.
     *
     * @param Layer $layer A Layer.
     *
     * @return $this
     * @see    http://leafletjs.com/reference.html#control-layers-addoverlay
     */
    public function addOverlay(Layer $layer)
    {
        $this->overlays[] = $layer;

        return $this;
    }

    /**
     * Get all overlay layers.
     *
     * @return Layer[]
     * @see    http://leafletjs.com/reference.html#control-layers-addoverlay
     */
    public function getOverlays()
    {
        return $this->overlays;
    }

    /**
     * Remove a layer.
     *
     * @param Layer $layer Layer to be removed.
     *
     * @return $this
     */
    public function removeLayer(Layer $layer)
    {
        $key = array_search($layer, $this->baseLayers);
        if ($key !== false) {
            unset($this->baseLayers[$key]);
        }

        $key = array_search($layer, $this->overlays);
        if ($key !== false) {
            unset($this->overlays[$key]);
        }

        return $this;
    }
}
