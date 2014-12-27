<?php

/**
 * @package    dev
 * @author     David Molineus <david.molineus@netzmacht.de>
 * @copyright  2014 netzmacht creative David Molineus
 * @license    LGPL 3.0
 * @filesource
 *
 */

namespace Netzmacht\LeafletPHP\Definition\Group;

/**
 * Class FeatureGroup map object.
 *
 * @package Netzmacht\LeafletPHP\Definition\Group
 */
class FeatureGroup extends LayerGroup
{
    /**
     * {@inheritdoc}
     */
    public static function getType()
    {
        return 'FeatureGroup';
    }
}
