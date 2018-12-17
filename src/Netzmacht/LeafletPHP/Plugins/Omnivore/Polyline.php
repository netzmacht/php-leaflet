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
 * Class Polyline creates the encoded polyline file loading request.
 *
 * @package Netzmacht\LeafletPHP\Plugins\Omnivore
 */
class Polyline extends OmnivoreLayer
{
    /**
     * {@inheritdoc}
     */
    public static function getType()
    {
        return 'Omnivore.Polyline';
    }

    /**
     * Set precision.
     *
     * @param int $precision Polyline decoding precision.
     *
     * @return $this
     */
    public function setPrecision($precision)
    {
        return $this->setOption('precision', $precision);
    }

    /**
     * Get precision.
     *
     * @return int
     */
    public function getPrecision()
    {
        return $this->getOption('precision', 1e5);
    }
}
