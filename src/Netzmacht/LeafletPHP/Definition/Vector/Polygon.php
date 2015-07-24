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
 * Class Polygon represents a polygon on the map.
 *
 * @package Netzmacht\LeafletPHP\Definition\Vector
 */
class Polygon extends Polyline
{
    /**
     * {@inheritdoc}
     */
    public static function getType()
    {
        return 'Polygon';
    }

    /**
     * Get all lat lngs.
     *
     * @param bool $preferFlat Argument is ignored for polygons.
     *
     * @return array
     */
    public function getLatLngs($preferFlat = true)
    {
        return parent::getLatLngs(false);
    }

    /**
     * Get the GeoJSON type.
     *
     * @return string
     */
    protected function getGeoJsonType()
    {
        return $this->isFlat() ? 'Polygon' : 'MultiPolygon';
    }
}
