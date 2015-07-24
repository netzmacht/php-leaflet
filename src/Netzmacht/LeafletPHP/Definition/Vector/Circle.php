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

use Netzmacht\LeafletPHP\Value\GeoJson\FeatureTrait;

/**
 * Class Circle represents a circle object on the map.
 *
 * @package Netzmacht\LeafletPHP\Definition\Vector
 */
class Circle extends CircleMarker
{
    use FeatureTrait;

    /**
     * {@inheritdoc}
     */
    public static function getType()
    {
        return 'Circle';
    }
}
