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

/**
 * Interface HasLabel describes the label feature.
 *
 * @package Netzmacht\LeafletPHP\Definition
 */
interface HasLabel
{
    /**
     * Set the label.
     *
     * @param string $label The new label.
     *
     * @return $this
     */
    public function setLabel($label);

    /**
     * Get elements label.
     *
     * @return string
     */
    public function getLabel();
}
