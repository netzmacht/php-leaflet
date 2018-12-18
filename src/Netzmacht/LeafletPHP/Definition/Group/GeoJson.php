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

use Netzmacht\JavascriptBuilder\Type\AnonymousFunction;
use Netzmacht\JavascriptBuilder\Type\Expression;
use Netzmacht\LeafletPHP\Value\GeoJson\ConvertsToGeoJsonFeature;
use Netzmacht\LeafletPHP\Value\GeoJson\FeatureCollection;
use Netzmacht\LeafletPHP\Value\GeoJson\GeoJsonFeature;
use Netzmacht\LeafletPHP\Value\GeoJson\StaticFeature;
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
     * Data being added as constructor argument.
     *
     * @var FeatureCollection
     */
    private $data;

    /**
     * {@inheritdoc}
     */
    public function __construct($identifier)
    {
        parent::__construct($identifier);

        $this->data = new FeatureCollection();
    }

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

    /**
     * Add data.
     *
     * @param GeoJsonFeature|array $feature    Add geo json data.
     * @param bool                 $asArgument If true the data is set as constructor argument instead of method call.
     *
     * @return $this
     */
    public function addData($feature, $asArgument = false)
    {
        if ($asArgument) {
            if ($feature instanceof GeoJsonFeature) {
                $this->data->addFeature($feature);
            } else {
                $this->data->addFeature(new StaticFeature($feature));
            }
        } else {
            $this->addMethod('addData', array($feature));
        }

        return $this;
    }

    /**
     * Get all data which is added by the construct argument.
     *
     * @return FeatureCollection
     */
    public function getInitializationData()
    {
        return $this->data;
    }
}
