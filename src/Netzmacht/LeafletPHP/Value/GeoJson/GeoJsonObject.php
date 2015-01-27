<?php

/**
 * @package    dev
 * @author     David Molineus <david.molineus@netzmacht.de>
 * @copyright  2015 netzmacht creative David Molineus
 * @license    LGPL 3.0
 * @filesource
 *
 */

namespace Netzmacht\LeafletPHP\Value\GeoJson;

/**
 * Interface GeoJsonObject is a marker for objects which a full geo json object representations.
 *
 * The difference between ConvertsToGeoJson and this interface is that ConvertsToGeoJson can also contain content
 * which is not convertable to the GeoJson format.
 *
 * @package Netzmacht\LeafletPHP\Definition\GeoJson
 */
interface GeoJsonObject extends \JsonSerializable
{
}
