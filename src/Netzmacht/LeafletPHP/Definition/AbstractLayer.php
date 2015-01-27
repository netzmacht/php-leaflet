<?php

/**
 * @package    dev
 * @author     David Molineus <david.molineus@netzmacht.de>
 * @copyright  2015 netzmacht creative David Molineus
 * @license    LGPL 3.0
 * @filesource
 *
 */

namespace Netzmacht\LeafletPHP\Definition;

/**
 * Bas class for the layer implementation.
 *
 * @package Netzmacht\LeafletPHP\Definition
 */
abstract class AbstractLayer extends AbstractDefinition implements Layer
{
    use LabelTrait;

    /**
     * The connected map.
     *
     * @var Map
     */
    private $map;

    /**
     * Add layer to the map.
     *
     * Instead create an addTo method, it's assigned to the map.
     * This is required so that the encoder knows the relation between the map and the layer.
     *
     * @param Map $map The leaflet map.
     *
     * @return $this
     */
    public function addTo(Map $map)
    {
        $this->map = $map;
        $map->addLayer($this);

        return $this->addMethod('addTo', array($map));
    }

    /**
     * Get the map.
     *
     * @return Map|null
     */
    public function getMap()
    {
        return $this->map;
    }
}
