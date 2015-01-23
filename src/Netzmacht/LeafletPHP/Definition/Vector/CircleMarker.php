<?php

/**
 * @package    dev
 * @author     David Molineus <david.molineus@netzmacht.de>
 * @copyright  2014 netzmacht creative David Molineus
 * @license    LGPL 3.0
 * @filesource
 *
 */

namespace Netzmacht\LeafletPHP\Definition\Vector;

/**
 * Class CircleMarker represents a circle marker object.
 *
 * @package Netzmacht\LeafletPHP\Definition\Vector
 */
class CircleMarker extends Circle
{
    /**
     * {@inheritdoc}
     */
    public static function getType()
    {
        return 'CircleMarker';
    }
}
