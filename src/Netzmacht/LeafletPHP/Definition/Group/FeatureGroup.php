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

namespace Netzmacht\LeafletPHP\Definition\Group;

use Netzmacht\LeafletPHP\Definition\EventsTrait;
use Netzmacht\LeafletPHP\Definition\HasEvents;

/**
 * Class FeatureGroup map object.
 *
 * @package Netzmacht\LeafletPHP\Definition\Group
 */
class FeatureGroup extends LayerGroup implements HasEvents
{
    use EventsTrait;

    /**
     * {@inheritdoc}
     */
    public static function getType()
    {
        return 'FeatureGroup';
    }
}
