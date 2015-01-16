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

use Netzmacht\JavascriptBuilder\Type\Call\MethodCall;
use Netzmacht\LeafletPHP\Definition;

/**
 * Class AbstractDefinition is a basic definition implementation.
 *
 * @package Netzmacht\LeafletPHP\Definition
 */
abstract class AbstractDefinition implements Definition
{
    /**
     * {@inheritdoc}
     */
    public static function getRequiredLibraries()
    {
        return array('leaflet');
    }

    /**
     * Control identifier.
     *
     * The control name is used as identifier and javascript variable suffix.
     *
     * @var string
     */
    private $identifier;

    /**
     * Method calls.
     *
     * @var MethodCall[]
     */
    private $methods = array();

    /**
     * Construct.
     *
     * @param string $identifier The element id..
     */
    public function __construct($identifier)
    {
        $this->identifier = $identifier;
    }

    /**
     * Get the name.
     *
     * @return string
     */
    public function getId()
    {
        return $this->identifier;
    }

    /**
     * Add a method call.
     *
     * @param string $name      Method name.
     * @param array  $arguments Method arguments.
     *
     * @return $this
     */
    protected function addMethod($name, array $arguments = array())
    {
        $this->methods[] = new MethodCall($this, $name, $arguments);

        return $this;
    }

    /**
     * Get all method calls.
     *
     * @return MethodCall[]
     */
    public function getMethodCalls()
    {
        return $this->methods;
    }
}
