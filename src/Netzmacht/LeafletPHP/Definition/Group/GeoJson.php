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

use Netzmacht\LeafletPHP\Definition\HasOptions;
use Netzmacht\LeafletPHP\Definition\OptionsTrait;
use Netzmacht\LeafletPHP\Definition\Vector\PathOptionsTrait;

/**
 * Class GeoJSON representation.
 *
 * @package Netzmacht\LeafletPHP\Definition\Group
 */
class GeoJson extends FeatureGroup implements HasOptions
{
    use PathOptionsTrait;
    use OptionsTrait;

    /**
     * {@inheritdoc}
     */
    public static function getType()
    {
        return 'GeoJSON';
    }

    public function setPointToLayer($function)
    {
        return $this->setOption('pointToLayer', $function);
    }

    public function setOnEachFeature($function)
    {
        return $this->setOption('onEachFeature', $function);
    }
}
