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

use Netzmacht\LeafletPHP\Definition\GeoJson\Feature;

/**
 * Class CircleMarker represents a circle marker object.
 *
 * @package Netzmacht\LeafletPHP\Definition\Vector
 */
class CircleMarker extends Circle
{
    /**
     * {@inheritdoc}
     */
    public static function getType()
    {
        return 'CircleMarker';
    }


    /**
     * {@inheritdoc}
     */
    public function toGeoJson()
    {
        $feature = new Feature(
            $this,
            $this->getId()
        );

        $feature->setProperty('type', lcfirst(static::getType()));
        $feature->setProperty('options', $this->getOptions());
        $feature->setProperty('radius', $this->getRadius());

        if ($this->getPopup()) {
            $feature->setProperty('popup', $this->getPopup());
        }

        if ($this->getPopupContent()) {
            $feature->setProperty('popupContent', $this->getPopupContent());
        }

        return $feature;
    }
}
