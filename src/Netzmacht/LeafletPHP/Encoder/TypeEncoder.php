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
use Netzmacht\LeafletPHP\Definition\Type\AbstractIcon;
use Netzmacht\LeafletPHP\Definition\Type\DivIcon;
use Netzmacht\LeafletPHP\Definition\Type\Icon;

/**
 * Class TypeEncoder encodes type definitions.
 *
 * @package Netzmacht\LeafletPHP\Encoder
 */
class TypeEncoder extends AbstractEncoder
{
    /**
     * Set the reference reference.
     *
     * @param Definition        $definition The current definition.
     * @param GetReferenceEvent $event      The get reference event.
     *
     * @return string
     */
    public function setReference(Definition $definition, GetReferenceEvent $event)
    {
        if ($definition instanceof AbstractIcon) {
            $event->setReference('map.icons.' . $definition->getId());
        }
    }

    /**
     * Encode the icon.
     *
     * @param Icon    $icon    The icon.
     * @param Encoder $encoder The encoder.
     *
     * @return string
     */
    public function encodeIcon(Icon $icon, Encoder $encoder)
    {
        return sprintf(
            '%s = L.Icon(%s);',
            $encoder->encodeReference($icon),
            $encoder->encodeArguments($icon->getOptions())
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
            '%s = L.DivIcon(%s);',
            $encoder->encodeReference($icon),
            $encoder->encodeArguments($icon->getOptions())
        );
    }
}
