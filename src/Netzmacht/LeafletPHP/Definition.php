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
}
