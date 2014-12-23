<?php

/**
 * @package    dev
 * @author     David Molineus <david.molineus@netzmacht.de>
 * @copyright  2014 netzmacht creative David Molineus
 * @license    LGPL 3.0
 * @filesource
 *
 */

namespace Netzmacht\LeafletPHP\Definition\Control;

use Netzmacht\LeafletPHP\Definition\Layer;

class Layers extends AbstractControl
{
    /**
     * @var Layer[]
     */
    private $baseLayers = array();

    /**
     * Get the type of the definition.
     *
     * @return mixed
     */
    public static function getType()
    {
        return 'Control.Layers';
    }

    /**
     * Set initial collapsed state.
     *
     * @see http://leafletjs.com/reference.html#control-layers-collapsed
     *
     * @param bool $state The collapsed state.
     *
     * @return $this
     */
    public function setCollapsed($state)
    {
        return $this->setOption('collapsed', (bool) $state);
    }

    /**
     * Get initial collapsed state.
     *
     * @see http://leafletjs.com/reference.html#control-layers-collapsed
     *
     * @return bool
     */
    public function isCollapsed()
    {
        return $this->getOption('collapsed', true);
    }

    /**
     * Set initial collapsed state.
     *
     * @see http://leafletjs.com/reference.html#control-layers-autozindex
     *
     * @param bool $state The collapsed state.
     *
     * @return $this
     */
    public function setAutoZIndex($state)
    {
        return $this->setOption('autoZIndex', (bool) $state);
    }

    /**
     * Get initial collapsed state.
     *
     * @see http://leafletjs.com/reference.html#control-layers-autozindex
     *
     * @return bool
     */
    public function isAutoZIndex()
    {
        return $this->getOption('autoZIndex', true);
    }

    /**
     * Add a base layer.
     *
     * @see http://leafletjs.com/reference.html#control-layers-addbaselayer
     *
     * @param Layer $layer A Layer.
     *
     * @return $this
     */
    public function addBaseLayer(Layer $layer)
    {
        $this->baseLayers[] = $layer;

        return $this;
    }

    /**
     * Get all base layers.
     *
     * @see http://leafletjs.com/reference.html#control-layers-addbaselayer
     *
     * @return Layer[]
     */
    public function getBaseLayers()
    {
        return $this->baseLayers;
    }

    /**
     * Add an overlay layer.
     *
     * @see http://leafletjs.com/reference.html#control-layers-addoverlay
     *
     * @param Layer $layer A Layer.
     *
     * @return $this
     */
    public function addOverlay(Layer $layer)
    {
        $this->baseLayers[] = $layer;

        return $this;
    }

    /**
     * Get all overlay layers.
     *
     * @see http://leafletjs.com/reference.html#control-layers-addoverlay
     *
     * @return Layer[]
     */
    public function getOverlays()
    {
        return $this->baseLayers;
    }
}
