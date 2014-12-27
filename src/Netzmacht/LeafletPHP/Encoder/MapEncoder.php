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
use Netzmacht\Javascript\Event\BuildEvent;
use Netzmacht\Javascript\Event\EncodeValueEvent;
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
     * @return string
     *
     * @throws GetReferenceFailed If a reference could not be created.
     */
    public function encodeMap(Map $map, Encoder $encoder)
    {
        return array(
            sprintf(
                '%s = L.map(%s);',
                $encoder->encodeReference($map),
                $encoder->encodeArguments(array($map->getElementId(), $map->getOptions()))
            )
        );
    }

    /**
     * Reset encoded method registry when compile method is called.
     *
     * @param BuildEvent $event The build event.
     *
     * @return void
     */
    public function handleBuild(BuildEvent $event)
    {
        parent::handleBuild($event);

        $event->getOutput()
            ->addLine('var layers = {}; var controls = {}; var map = null;');
    }

    /**
     * Post encode the map.
     *
     * Layers and controls are generated.
     *
     * @param Map     $map     The map being encoded.
     * @param Encoder $encoder The encoder.
     *
     * @return array
     *
     * @throws GetReferenceFailed If any reference could not be built.
     */
    public function postEncodeMap(Map $map, Encoder $encoder)
    {
        $result = array();

        foreach ($map->getLayers() as $layer) {
            $result[] = sprintf(
                '%s.addLayer(%s);',
                $encoder->encodeReference($map),
                $encoder->encodeReference($layer)
            );
        }

        foreach ($map->getControls() as $control) {
            $result[] = sprintf(
                '%s.addControl(%s);',
                $encoder->encodeReference($map),
                $encoder->encodeReference($control)
            );
        }

        return $result;
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
