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

/**
 * Class Gpx creates the gpx file loading request.
 *
 * @package Netzmacht\LeafletPHP\Plugins\Omnivore
 */
class Gpx extends OmnivoreLayer
{
    /**
     * {@inheritdoc}
     */
    public static function getType()
    {
        return 'Omnivore.Gpx';
    }
}
