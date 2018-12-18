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
use Netzmacht\JavascriptBuilder\Flags;
use Netzmacht\JavascriptBuilder\Symfony\Event\EncodeValueEvent;
use Netzmacht\JavascriptBuilder\Symfony\Event\EncodeReferenceEvent;
use Netzmacht\LeafletPHP\Definition;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Class AbstractEncoder delegates the encoding events to the encoder implementation.
 *
 * Add a encode<Type> method to the encoder to encode the definition.
 *
 * @package Netzmacht\LeafletPHP\Encoder
 */
abstract class AbstractEncoder implements EventSubscriberInterface
{
    /**
     * Encoded method reference.
     *
     * Used to ensure that methods are only encoded once.
     *
     * @var array
     */
    protected static $encodedMethods = array();

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return array(
            EncodeValueEvent::NAME  => array(
                array('handleEncode', 100),
            ),
            EncodeReferenceEvent::NAME => array(
                'handleGetReference'
            ),
        );
    }

    /**
     * Handle compile event.
     *
     * @param EncodeValueEvent $event The subscribed event.
     *
     * @return void
     */
    public function handleEncode(EncodeValueEvent $event)
    {
        $definition = $event->getValue();
        if (!$definition instanceof Definition) {
            return;
        }

        $type   = $definition->getType();
        $method = 'encode' . $this->convertTypeToMethod($type);

        if (method_exists($this, $method)) {
            $buffer = $this->$method($definition, $event->getEncoder(), $event->getJsonFlags());

            if ($buffer) {
                $event->addLine($buffer);
                $this->handleMethodCalls($definition, $event->getEncoder(), $event);
            }

            $event->setSuccessful();
        }
    }

    /**
     * Handle get reference event.
     *
     * @param EncodeReferenceEvent $event The event.
     *
     * @return void
     */
    public function handleGetReference(EncodeReferenceEvent $event)
    {
        $definition = $event->getObject();

        if ($definition instanceof Definition) {
            $this->setReference($definition, $event);
        }
    }

    /**
     * Convert definition type to method name.
     *
     * @param string $type The type as string.
     *
     * @return string
     */
    private function convertTypeToMethod($type)
    {
        $parts = explode('.', str_replace(['-', '_'], '.', $type));
        $parts = array_map('ucfirst', $parts);

        return implode('', $parts);
    }

    /**
     * Set the reference reference.
     *
     * @param Definition           $definition The current definition.
     * @param EncodeReferenceEvent $event      The get reference event.
     *
     * @return string
     */
    abstract public function setReference(Definition $definition, EncodeReferenceEvent $event);

    /**
     * Encode method calls.
     *
     * @param Definition       $definition The current definition.
     * @param Encoder          $encoder    The encoder.
     * @param EncodeValueEvent $event      The event.
     *
     * @return void
     */
    private function handleMethodCalls(Definition $definition, Encoder $encoder, EncodeValueEvent $event)
    {
        $hash = spl_object_hash($definition);

        if (!isset(static::$encodedMethods[$hash])) {
            static::$encodedMethods[$hash] = true;

            foreach ($definition->getMethodCalls() as $method) {
                $event->addLine($method->encode($encoder, Flags::CLOSE_STATEMENT));
            }
        }
    }

    /**
     * Get references of given values.
     *
     * @param array   $values  Set of values.
     * @param Encoder $encoder The encoder.
     *
     * @return array
     */
    protected function getReferences(array $values, Encoder $encoder)
    {
        return array_map(
            function ($value) use ($encoder) {
                return $encoder->encodeReference($value);
            },
            $values
        );
    }
}
