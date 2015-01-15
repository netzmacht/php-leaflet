<?php

/**
 * @package    dev
 * @author     David Molineus <david.molineus@netzmacht.de>
 * @copyright  2014 netzmacht creative David Molineus
 * @license    LGPL 3.0
 * @filesource
 *
 */

namespace Netzmacht\LeafletPHP\Encoder;

use Netzmacht\Javascript\Encoder;
use Netzmacht\Javascript\Event\GetReferenceEvent;
use Netzmacht\Javascript\Exception\GetReferenceFailed;
use Netzmacht\LeafletPHP\Definition;
use Netzmacht\LeafletPHP\Definition\Map;

/**
 * Class MapEncoder encodes the map.
 *
 * @package Netzmacht\LeafletPHP\Encoder
 */
class MapEncoder extends AbstractEncoder
{
    /**
     * Compile a map.
     *
     * @param Map     $map     The map.
     * @param Encoder $encoder The builder.
     *
     * @return void
     *
     * @throws GetReferenceFailed If a reference could not be created.
     */
    public function encodeMap(Map $map, Encoder $encoder)
    {
        $output = $encoder->getOutput();

        $output->append(
            sprintf(
                '%s = L.map(%s);',
                $encoder->encodeReference($map),
                $encoder->encodeArguments(array($map->getElementId(), $map->getOptions()))
            )
        );

        foreach ($map->getControls() as $control) {
            $output->append(
                sprintf(
                    '%s.addTo(%s);',
                    $encoder->encodeReference($control),
                    $encoder->encodeReference($map)
                )
            );
        }

        foreach ($map->getLayers() as $layer) {
            $output->append(
                sprintf(
                    '%s.addTo(%s);',
                    $encoder->encodeReference($layer),
                    $encoder->encodeReference($map)
                )
            );
        }
    }

    /**
     * {@inheritdoc}
     */
    public function setReference(Definition $definition, GetReferenceEvent $event)
    {
        if ($definition instanceof Map) {
            $event->setReference('map');
        }
    }
}
