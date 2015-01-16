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

use Netzmacht\JavascriptBuilder\Type\AnonymousFunction;

/**
 * Interface HasEvents describes elements which have events which can be subscribed.
 *
 * @package Netzmacht\LeafletPHP\Definition
 */
interface HasEvents
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
    public function on($event, AnonymousFunction $closure);
}
