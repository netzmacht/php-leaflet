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
use Netzmacht\LeafletPHP\Definition;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Class AbstractEncoder delegates the encoding events to the encoder implementation.
 *
 * Add a encode<Type> method to the encoder to encode the definition.
 * If you want to ensure that the encoding is added last you can define a postEncode<Type> method as well.
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
                array('handlePostEncode'),
            ),
            GetReferenceEvent::NAME => array('handleGetReference'),
            BuildEvent::NAME        => array('handleBuild', 100),
        );
    }

    /**
     * Reset encoded method registry when compile mehtod is called.
     *
     * @param BuildEvent $event The build event.
     *
     * @return void
     *
     * @SuppressWarnings(PHPMD.UnusedFormalParameter) - It's required so that overwrites can use it.
     */
    public function handleBuild(BuildEvent $event)
    {
        static::$encodedMethods = array();
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
        if (!$definition instanceof Definition || $event->getReferenced() > Encoder::VALUE_DEFINE) {
            return;
        }

        $type   = $definition->getType();
        $method = 'define' . $this->convertTypeToMethod($type);

        if (method_exists($this, $method)) {
            $this->$method($definition, $event->getEncoder());
        }

        $method = 'encode' . $this->convertTypeToMethod($type);

        if (method_exists($this, $method)) {
            $event->addLines((array) $this->$method($definition, $event->getEncoder()));
        }
    }

    /**
     * Handle compile event.
     *
     * @param EncodeValueEvent $event The subscribed event.
     *
     * @return void
     */
    public function handlePostEncode(EncodeValueEvent $event)
    {
        $definition = $event->getValue();
        if (!$definition instanceof Definition) {
            return;
        }

        $type   = $definition->getType();
        $method = 'postEncode' . $this->convertTypeToMethod($type);

        if (method_exists($this, $method)) {
            $event->addLines((array) $this->$method($definition, $event->getEncoder()));
        }

        $this->encodeMethodCalls($definition, $event->getEncoder(), $event);
    }

    /**
     * Handle get reference event.
     *
     * @param GetReferenceEvent $event The event.
     *
     * @return void
     */
    public function handleGetReference(GetReferenceEvent $event)
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
        $parts = explode('.', $type);
        $parts = array_map('ucfirst', $parts);

        return implode('', $parts);
    }

    /**
     * Set the reference reference.
     *
     * @param Definition        $definition The current definition.
     * @param GetReferenceEvent $event      The get reference event.
     *
     * @return string
     */
    abstract public function setReference(Definition $definition, GetReferenceEvent $event);

    /**
     * Encode method calls.
     *
     * @param Definition       $definition The current definition.
     * @param Encoder          $encoder    The encoder.
     * @param EncodeValueEvent $event      The event.
     *
     * @return void
     */
    private function encodeMethodCalls(Definition $definition, Encoder $encoder, EncodeValueEvent $event)
    {
        $hash = spl_object_hash($definition);

        if (!isset(static::$encodedMethods[$hash])) {
            static::$encodedMethods[$hash] = true;

            foreach ($definition->getMethodCalls() as $method) {
                $event->addLine($method->encode($encoder));
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
