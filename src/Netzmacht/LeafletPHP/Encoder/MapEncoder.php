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
use Netzmacht\JavascriptBuilder\Symfony\Event\GetObjectStackEvent;
use Netzmacht\LeafletPHP\Definition;
use Netzmacht\LeafletPHP\Definition\Control\Layers;
use Netzmacht\LeafletPHP\Definition\Group\LayerGroup;
use Netzmacht\LeafletPHP\Definition\Map;

/**
 * Class MapEncoder encodes the map.
 *
 * @package Netzmacht\LeafletPHP\Encoder
 */
class MapEncoder extends AbstractEncoder
{
    use EncodeHelperTrait;

    /**
     * Store initialized maps.
     *
     * @var array
     */
    private $initialized = array();

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        $events = parent::getSubscribedEvents();

        $events[GetObjectStackEvent::NAME] = 'getStack';

        return $events;
    }

    /**
     * Get object stack of the map as far as possible.
     *
     * @param GetObjectStackEvent $event The subscribed event.
     *
     * @return void
     */
    public function getStack(GetObjectStackEvent $event)
    {
        $stack = array();
        $value = $event->getValue();

        if ($value instanceof Map) {
            foreach ($value->getControls() as $control) {
                if ($control instanceof Layers) {
                    $this->addLayersToStack($control->getBaseLayers(), $stack);
                    $this->addLayersToStack($control->getOverlays(), $stack);
                }

                $stack[] = $control;
            }

            $this->addLayersToStack($value->getLayers(), $stack);

            $event->setStack($stack);
        }
    }

    /**
     * Compile a map.
     *
     * @param Map     $map     The map.
     * @param Encoder $encoder The builder.
     *
     * @return void
     */
    public function encodeMap(Map $map, Encoder $encoder)
    {
        $output = $encoder->getOutput();
        $hash   = spl_object_hash($map);

        if (!isset($this->initialized[$hash])) {
            $output->prepend(
                sprintf(
                    '%s = L.map(%s);',
                    $encoder->encodeReference($map),
                    $encoder->encodeArguments(array($map->getElementId(), $map->getOptions()))
                )
            );

            $this->initialized[$hash] = true;
        } else {
            foreach ($map->getControls() as $control) {
                $encoder->encodeReference($control);
            }

            foreach ($map->getLayers() as $layer) {
                $encoder->encodeReference($layer);
            }

            $output->append($this->encodeMethodCalls($map->getMethodCalls(), $encoder));
        }
    }

    /**
     * {@inheritdoc}
     */
    public function setReference(Definition $definition, EncodeReferenceEvent $event)
    {
        if ($definition instanceof Map) {
            $event->setReference('map');
        }
    }

    /**
     * Add layers to to the stack.
     *
     * @param array $layers The layers to be added.
     * @param array $stack  The object stack being built.
     *
     * @return void
     */
    private function addLayersToStack($layers, &$stack)
    {
        foreach ($layers as $layer) {
            if ($layer instanceof LayerGroup) {
                $this->addLayersToStack($layer->getLayers(), $stack);
            }

            $stack[] = $layer;
        }
    }
}
