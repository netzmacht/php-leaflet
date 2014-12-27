<?php

/**
 * @package    dev
 * @author     David Molineus <david.molineus@netzmacht.de>
 * @copyright  2014 netzmacht creative David Molineus
 * @license    LGPL 3.0
 * @filesource
 *
 */

namespace Netzmacht\LeafletPHP\Definition;

/**
 * Class MapObjectTrait implements MapObject interface as a trait.
 *
 * @package Netzmacht\LeafletPHP\Definition
 */
trait MapObjectTrait
{
    /**
     * Add object to the map.
     *
     * @param Map $map The leaflet map.
     *
     * @return $this
     */
    public function addTo(Map $map)
    {
        return $this->addMethod('addTo', array($map));
    }
}
