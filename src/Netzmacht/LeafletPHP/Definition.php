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

namespace Netzmacht\LeafletPHP;

use Netzmacht\JavascriptBuilder\Type\Call\MethodCall;

/**
 * Interface Definition is the base interface for leaflet map definitions.
 *
 * @package Netzmacht\LeafletPHP
 */
interface Definition
{
    /**
     * Get the type of the definition.
     *
     * @return string
     */
    public static function getType();

    /**
     * Get all required javascript libraries.
     *
     * @return array
     */
    public static function getRequiredLibraries();

    /**
     * Get the identifier.
     *
     * @return string
     */
    public function getId();

    /**
     * Get all method calls.
     *
     * @return MethodCall[]
     */
    public function getMethodCalls();

    /**
     * Allow dynamic method calls.
     *
     * As Javascript is a prototype based language and methods can be plugged in, support it by the magic call method.
     *
     * @param string $name      The method name.
     * @param array  $arguments List of arguments.
     *
     * @return $this
     */
    public function __call($name, array $arguments);
}
