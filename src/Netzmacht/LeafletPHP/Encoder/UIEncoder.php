<?php

/**
 * @package    dev
 * @author     David Molineus <david.molineus@netzmacht.de>
 * @copyright  2015 netzmacht creative David Molineus
 * @license    LGPL 3.0
 * @filesource
 *
 */

namespace Netzmacht\LeafletPHP\Encoder;


use Netzmacht\Javascript\Encoder;
use Netzmacht\Javascript\Event\GetReferenceEvent;
use Netzmacht\LeafletPHP\Definition;
use Netzmacht\LeafletPHP\Definition\UI\Marker;

/**
 * Class UIEncoder encodes ui elements.
 *
 * @package Netzmacht\LeafletPHP\Encoder
 */
class UIEncoder extends AbstractEncoder
{
    /**
     *  {@inheritdoc}
     */
    public function setReference(Definition $definition, GetReferenceEvent $event)
    {
        if ($definition instanceof Marker) {
            $event->setReference('map.layers.' . $definition->getId());
        }
    }

    /**
     * Encode a marker.
     *
     * @param Marker  $marker  The marker.
     * @param Encoder $encoder The encoder.
     *
     * @return bool
     */
    public function encodeMarker(Marker $marker, Encoder $encoder)
    {
        return sprintf(
            '%s = L.marker(%s);',
            $encoder->encodeReference($marker),
            $encoder->encodeArguments(
                array(
                    $marker->getLatLng(),
                    $marker->getOptions()
                )
            )
        );
    }
}
