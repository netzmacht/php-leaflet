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

use Netzmacht\Javascript\Type\Call\AnonymousFunction;
use Netzmacht\Javascript\Type\Value\Expression;
use Netzmacht\LeafletPHP\Definition\GeoJson\ConvertsToGeoJsonFeature;
use Netzmacht\LeafletPHP\Definition\HasOptions;
use Netzmacht\LeafletPHP\Definition\OptionsTrait;
use Netzmacht\LeafletPHP\Definition\Vector\PathOptionsTrait;

/**
 * Class GeoJSON representation.
 *
 * @package Netzmacht\LeafletPHP\Definition\Group
 */
class GeoJson extends FeatureGroup implements HasOptions, ConvertsToGeoJsonFeature
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

    /**
     * Set point to layer function.
     *
     * @param Expression|AnonymousFunction $function The function callback.
     *
     * @return $this
     */
    public function setPointToLayer($function)
    {
        return $this->setOption('pointToLayer', $function);
    }

    /**
     * Set on each feature function.
     *
     * @param Expression|AnonymousFunction $function The function callback.
     *
     * @return $this
     */
    public function setOnEachFeature($function)
    {
        return $this->setOption('onEachFeature', $function);
    }
}
