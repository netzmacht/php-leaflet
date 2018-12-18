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

namespace Netzmacht\LeafletPHP\Plugins\Omnivore;

use Netzmacht\LeafletPHP\Definition\Layer;

/**
 * Class Omnivore represents the omnivore javascript namespace to create the file loading requests.
 *
 * It's just a factory facade for the different file types.
 *
 * @package Netzmacht\LeafletPHP\Plugins\Omnivore
 */
class Omnivore
{
    /**
     * Create a csv file loading request.
     *
     * @param string $layerId       The layer id.
     * @param string $url           The file url.
     * @param array  $parserOptions Parser options.
     * @param Layer  $customLayer   Optional custom layer where the data is added.
     *
     * @return Csv
     */
    public static function csv($layerId, $url, $parserOptions = array(), Layer $customLayer = null)
    {
        return new Csv($layerId, $url, $parserOptions, $customLayer);
    }

    /**
     * Create a kml file loading request.
     *
     * @param string $layerId The layer id.
     * @param string $url     The file url.
     *
     * @return Kml
     */
    public static function kml($layerId, $url)
    {
        return new Kml($layerId, $url);
    }

    /**
     * Create a gpx file loading request.
     *
     * @param string $layerId       The layer id.
     * @param string $url           The file url.
     * @param array  $parserOptions Parser options.
     * @param Layer  $customLayer   Optional custom layer where the data is added.
     *
     * @return Gpx
     */
    public static function gpx($layerId, $url, $parserOptions = array(), Layer $customLayer = null)
    {
        return new Gpx($layerId, $url, $parserOptions, $customLayer);
    }

    /**
     * Create a geoJSON file loading request.
     *
     * @param string $layerId       The layer id.
     * @param string $url           The file url.
     * @param array  $parserOptions Parser options.
     * @param Layer  $customLayer   Optional custom layer where the data is added.
     *
     * @return GeoJson
     */
    public static function geojson($layerId, $url, $parserOptions = array(), Layer $customLayer = null)
    {
        return new GeoJson($layerId, $url, $parserOptions, $customLayer);
    }

    /**
     * Create a wkt file loading request.
     *
     * @param string $layerId       The layer id.
     * @param string $url           The file url.
     * @param array  $parserOptions Parser options.
     * @param Layer  $customLayer   Optional custom layer where the data is added.
     *
     * @return Wkt
     */
    public static function wkt($layerId, $url, $parserOptions = array(), Layer $customLayer = null)
    {
        return new Wkt($layerId, $url, $parserOptions, $customLayer);
    }

    /**
     * Create a TopoJSON file loading request.
     *
     * @param string $layerId       The layer id.
     * @param string $url           The file url.
     * @param array  $parserOptions Parser options.
     * @param Layer  $customLayer   Optional custom layer where the data is added.
     *
     * @return TopoJson
     */
    public static function topojson($layerId, $url, $parserOptions = array(), Layer $customLayer = null)
    {
        return new TopoJson($layerId, $url, $parserOptions, $customLayer);
    }

    /**
     * Create a polyline file loading request.
     *
     * @param string $layerId       The layer id.
     * @param string $url           The file url.
     * @param array  $parserOptions Parser options.
     * @param Layer  $customLayer   Optional custom layer where the data is added.
     *
     * @return Polyline
     */
    public static function polyline($layerId, $url, $parserOptions = array(), Layer $customLayer = null)
    {
        return new Polyline($layerId, $url, $parserOptions, $customLayer);
    }
}
