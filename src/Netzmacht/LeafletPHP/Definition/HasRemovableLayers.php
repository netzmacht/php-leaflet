<?php

/**
 * @package    php-leaflet
 * @author     David Molineus <david.molineus@netzmacht.de>
 * @copyright  2015 netzmacht creative David Molineus
 * @license    LGPL 3.0
 * @filesource
 *
 */

namespace Netzmacht\LeafletPHP\Definition;

/**
 * Interface HasRemovableLayers describes definitions which contain layers which can be removed.
 *
 * @package Netzmacht\LeafletPHP\Definition
 */
interface HasRemovableLayers
{
    /**
     * Remove a layer.
     *
     * @param Layer $layer The layer being removed.
     *
     * @return $this
     */
    public function removeLayer(Layer $layer);
}
