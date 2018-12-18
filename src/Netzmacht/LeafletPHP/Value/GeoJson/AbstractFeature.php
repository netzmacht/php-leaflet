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

namespace Netzmacht\LeafletPHP\Value\GeoJson;

use Netzmacht\LeafletPHP\Value\LatLngBounds;

/**
 * Base feature class.
 *
 * @package Netzmacht\LeafletPHP\Definition\GeoJson
 */
abstract class AbstractFeature implements GeoJsonFeature
{
    /**
     * Bounding box of the feature.
     *
     * @var LatLngBounds
     */
    private $boundingBox;

    /**
     * Get bounding box.
     *
     * @return LatLngBounds|null
     */
    public function getBoundingBox()
    {
        return $this->boundingBox;
    }

    /**
     * Set bounding box.
     *
     * @param LatLngBounds $boundingBox Bounding box.
     *
     * @return $this
     */
    public function setBoundingBox(LatLngBounds $boundingBox)
    {
        $this->boundingBox = $boundingBox;

        return $this;
    }
}
