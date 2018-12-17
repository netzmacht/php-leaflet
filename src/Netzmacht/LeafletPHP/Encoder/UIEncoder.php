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
use Netzmacht\LeafletPHP\Definition\UI\Marker;
use Netzmacht\LeafletPHP\Definition\UI\Popup;

/**
 * Class UIEncoder encodes ui elements.
 *
 * @package Netzmacht\LeafletPHP\Encoder
 */
class UIEncoder extends AbstractEncoder
{
    use EncodeHelperTrait;

    /**
     *  {@inheritdoc}
     */
    public function setReference(Definition $definition, EncodeReferenceEvent $event)
    {
        if ($definition instanceof Marker) {
            $event->setReference('layers.' . $definition->getId());
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

    /**
     * Encode a marker.
     *
     * @param Popup   $popup   The popup.
     * @param Encoder $encoder The encoder.
     *
     * @return bool
     */
    public function encodePopup(Popup $popup, Encoder $encoder)
    {
        $source = $popup->getSource();
        $buffer = sprintf(
            '%s = L.popup(%s%s);',
            $encoder->encodeReference($popup),
            $encoder->encodeArray($popup->getOptions()),
            $source ? (', ' . $encoder->encodeReference($source)) : ''
        );

        $buffer .= $this->encodeMethodCalls($popup->getMethodCalls(), $encoder);

        return $buffer;
    }
}
