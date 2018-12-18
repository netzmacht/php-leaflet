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
    public function on($event, $closure);
}
