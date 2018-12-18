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
use Netzmacht\JavascriptBuilder\Type\Expression;

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
     * @param string                       $event   The event name.
     * @param AnonymousFunction|Expression $closure The callback.
     *
     * @return $this
     *
     * @SuppressWarnings(PHPMD.ShortMethodName)
     */
    public function on($event, $closure)
    {
        return $this->addMethod('on', array($event, $closure));
    }
}
