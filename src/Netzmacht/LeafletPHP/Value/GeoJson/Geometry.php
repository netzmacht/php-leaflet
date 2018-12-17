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

/**
 * Interface Geometry is used to mark an object as a geometry feature. It extends the \JsonSerializable Interface.
 *
 * @package Netzmacht\LeafletPHP\Definition\GeoJson
 * @see     http://geojson.org/geojson-spec.html#geometry-objects
 */
interface Geometry extends GeoJsonObject
{
}
