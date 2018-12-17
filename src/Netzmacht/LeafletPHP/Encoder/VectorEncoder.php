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

namespace Netzmacht\LeafletPHP\Encoder;

use Netzmacht\JavascriptBuilder\Encoder;
use Netzmacht\JavascriptBuilder\Symfony\Event\EncodeReferenceEvent;
use Netzmacht\LeafletPHP\Definition;
use Netzmacht\LeafletPHP\Definition\Layer;
use Netzmacht\LeafletPHP\Definition\Vector;
use Netzmacht\LeafletPHP\Definition\Vector\Circle;
use Netzmacht\LeafletPHP\Definition\Vector\CircleMarker;
use Netzmacht\LeafletPHP\Definition\Vector\Polygon;
use Netzmacht\LeafletPHP\Definition\Vector\Polyline;
use Netzmacht\LeafletPHP\Definition\Vector\Rectangle;

/**
 * Class VectorEncoder encodes the vector elements.
 *
 * @package Netzmacht\LeafletPHP\Encoder
 */
class VectorEncoder extends AbstractEncoder
{
    /**
     * {@inheritdoc}
     */
    public function setReference(Definition $definition, EncodeReferenceEvent $event)
    {
        if ($definition instanceof Vector) {
            $event->setReference('layers.vector_' . $definition->getId());
        }
    }

    /**
     * Compile a polyline.
     *
     * @param Polyline $polyline The polyline.
     * @param Encoder  $builder  The builder.
     *
     * @return string
     */
    public function encodePolyline(Polyline $polyline, Encoder $builder)
    {
        return $this->doVectorEncode('polyline', $polyline, $builder);
    }

    /**
     * Compile a polygon.
     *
     * @param Polygon $polygon The polygon.
     * @param Encoder $builder The builder.
     *
     * @return string
     */
    public function encodePolygon(Polygon $polygon, Encoder $builder)
    {
        return $this->doVectorEncode('polygon', $polygon, $builder);
    }

    /**
     * Compile a rectangle.
     *
     * @param Rectangle $rectangle The rectangle.
     * @param Encoder   $builder   The builder.
     *
     * @return string
     */
    public function encodeRectangle(Rectangle $rectangle, Encoder $builder)
    {
        return $this->doVectorEncode('rectangle', $rectangle, $builder);
    }

    /**
     * Compile a circle.
     *
     * @param Circle  $circle  The circle.
     * @param Encoder $builder The builder.
     *
     * @return string
     */
    public function encodeCircle(Circle $circle, Encoder $builder)
    {
        return $this->doCircleEncode('circle', $circle, $builder);
    }

    /**
     * Compile a circle marker.
     *
     * @param CircleMarker $circle  The circle marker.
     * @param Encoder      $builder The builder.
     *
     * @return string
     */
    public function encodeCircleMarker(CircleMarker $circle, Encoder $builder)
    {
        return $this->doCircleEncode('circleMarker', $circle, $builder);
    }

    /**
     * Encode a vector.
     *
     * @param string  $type    The type name.
     * @param Vector  $vector  The vector.
     * @param Encoder $builder The builder.
     *
     * @return string
     */
    private function doVectorEncode($type, Vector $vector, Encoder $builder)
    {
        return sprintf(
            '%s = L.%s(%s, %s);',
            $builder->encodeReference($vector),
            $type,
            $builder->encodeArray($vector->getLatLngs()),
            $builder->encodeValue($vector->getOptions())
        );
    }

    /**
     * Encode a circle.
     *
     * @param string       $type    The circle type.
     * @param CircleMarker $circle  The circle object.
     * @param Encoder      $builder The builder.
     *
     * @return array
     */
    private function doCircleEncode($type, CircleMarker $circle, Encoder $builder)
    {
        return sprintf(
            '%s = L.%s(%s);',
            $builder->encodeReference($circle),
            $type,
            $builder->encodeArguments(array($circle->getLatLng(), $circle, $circle->getOptions()))
        );
    }
}
