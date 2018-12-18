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
use Netzmacht\LeafletPHP\Definition\Type\AbstractIcon;
use Netzmacht\LeafletPHP\Definition\Type\DivIcon;
use Netzmacht\LeafletPHP\Definition\Type\ImageIcon;
use Netzmacht\LeafletPHP\Plugins\ExtraMarkers\ExtraMarkersIcon;

/**
 * Class TypeEncoder encodes type definitions.
 *
 * @package Netzmacht\LeafletPHP\Encoder
 */
class TypeEncoder extends AbstractEncoder
{
    /**
     * {@inheritdoc}
     */
    public function setReference(Definition $definition, EncodeReferenceEvent $event)
    {
        if ($definition instanceof AbstractIcon) {
            $event->setReference('icons.' . $definition->getId());
        }
    }

    /**
     * Encode the icon.
     *
     * @param ImageIcon $icon    The icon.
     * @param Encoder   $encoder The encoder.
     *
     * @return string
     */
    public function encodeIcon(ImageIcon $icon, Encoder $encoder)
    {
        return sprintf(
            '%s = L.icon(%s);',
            $encoder->encodeReference($icon),
            $encoder->encodeArguments(array($icon->getOptions()))
        );
    }

    /**
     * Encode the div icon.
     *
     * @param DivIcon $icon    The div icon.
     * @param Encoder $encoder The encoder.
     *
     * @return string
     */
    public function encodeDivIcon(DivIcon $icon, Encoder $encoder)
    {
        return sprintf(
            '%s = L.divIcon(%s);',
            $encoder->encodeReference($icon),
            $encoder->encodeArguments(array($icon->getOptions()))
        );
    }
}
