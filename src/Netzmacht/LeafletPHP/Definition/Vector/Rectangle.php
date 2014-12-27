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
 * Class Rectangle describes an rectangle on the map.
 *
 * @package Netzmacht\LeafletPHP\Definition\Vector
 */
class Rectangle extends Polygon
{
    /**
     * {@inheritdoc}
     */
    public static function getType()
    {
        return 'Rectangle';
    }
}
