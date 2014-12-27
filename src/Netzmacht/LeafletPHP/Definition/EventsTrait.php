<?php

/**
 * @package    dev
 * @author     David Molineus <david.molineus@netzmacht.de>
 * @copyright  2014 netzmacht creative David Molineus
 * @license    LGPL 3.0
 * @filesource
 *
 */

namespace Netzmacht\LeafletPHP\Definition;

use Netzmacht\Javascript\Type\Call\AnonymousFunction;

/**
 * Class EventsTrait can be added to definitions which supports the addMethod function.
 *
 * @package Netzmacht\LeafletPHP\Definition
 */
trait EventsTrait
{
    /**
     * Add an event listener.
     *
     * @param string            $event   The event name.
     * @param AnonymousFunction $closure The callback.
     *
     * @return $this
     *
     * @SuppressWarnings(PHPMD.ShortMethodName)
     */
    public function on($event, AnonymousFunction $closure)
    {
        return $this->addMethod('on', array($event, $closure));
    }
}
