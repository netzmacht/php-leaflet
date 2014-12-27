<?php

/**
 * @package    dev
 * @author     David Molineus <david.molineus@netzmacht.de>
 * @copyright  2014 netzmacht creative David Molineus
 * @license    LGPL 3.0
 * @filesource
 *
 */

namespace Netzmacht\LeafletPHP;

use Netzmacht\Javascript\Event\EncodeValueEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Class LibrariesCollector is used to collect all required libraries of the compiled map.
 *
 * @package Netzmacht\LeafletPHP
 */
class LibrariesCollector implements EventSubscriberInterface
{
    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return array(
            EncodeValueEvent::NAME => 'collect'
        );
    }

    /**
     * Names of libraries.
     *
     * @var array
     */
    private $libraries = array();

    /**
     * Collect all libraries.
     *
     * @param EncodeValueEvent $event The subscribed event.
     *
     * @return void
     */
    public function collect(EncodeValueEvent $event)
    {
        $value = $event->getValue();

        if ($value instanceof Definition) {
            $this->libraries = array_merge($this->libraries, (array) $value->getRequiredLibraries());
        }
    }

    /**
     * Get all collected libraries.
     *
     * @return array
     */
    public function getLibraries()
    {
        return array_unique($this->libraries);
    }
}
