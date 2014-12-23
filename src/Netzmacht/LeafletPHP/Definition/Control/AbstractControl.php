<?php

/**
 * @package    dev
 * @author     David Molineus <david.molineus@netzmacht.de>
 * @copyright  2014 netzmacht creative David Molineus
 * @license    LGPL 3.0
 * @filesource
 *
 */

namespace Netzmacht\LeafletPHP\Definition\Control;

use Netzmacht\LeafletPHP\Definition\Control;

/**
 * Basic control class.
 *
 * @package Netzmacht\LeafletPHP\Control
 */
abstract class AbstractControl implements Control
{
    const POSITION_TOP_LEFT     = 'topleft';
    const POSITION_TOP_RIGHT    = 'topright';
    const POSITION_BOTTOM_LEFT  = 'bottomleft';
    const POSITION_BOTTOM_RIGHT = 'bottomright';

    /**
     * {@inheritdoc}
     */
    public static function getCompileAfter()
    {
        return array();
    }

    /**
     * {@inheritdoc}
     */
    public static function getCompileBefore()
    {
        return array();
    }

    /**
     * {@inheritdoc}
     */
    public static function getRequiredLibraries()
    {
        return array('leaflet');
    }

    /**
     * Control name.
     *
     * The control name is used as identifier and javascript variable suffix.
     *
     * @var string
     */
    private $name;

    /**
     * Options of the control.
     *
     * @var array
     */
    private $options = array();

    /**
     * Default position.
     *
     * @var string
     */
    protected $defaultPosition = self::POSITION_TOP_RIGHT;

    /**
     * Construct.
     *
     * @param string $name The name.
     */
    public function __construct($name)
    {
        $this->name = $name;
    }

    /**
     * Get the name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set position.
     *
     * @param string $position Position.
     *
     * @return $this
     */
    public function setPosition($position)
    {
        return $this->setOption('position', $position);
    }

    /**
     * Get the position.
     *
     * @return string
     */
    public function getPosition()
    {
        return $this->getOption('position', $this->defaultPosition);
    }

    /**
     * Get all defined options. It does not contain default values which were not set.
     *
     * @return array
     */
    public function getOptions()
    {
        return $this->getOptions();
    }

    /**
     * Set an option.
     *
     * @param string $name  Name of the option.
     * @param mixed  $value Value of the option.
     *
     * @return $this
     */
    protected function setOption($name, $value)
    {
        $this->setOption($name, $value);

        return $this;
    }

    /**
     * Get an option.
     *
     * @param string $name    Name of the option.
     * @param mixed  $default Default value if no option is set.
     *
     * @return null
     */
    protected function getOption($name, $default = null)
    {
        if (isset($this->options[$name])) {
            return $this->options[$name];
        }

        return $default;
    }

    /**
     * Remove an option.
     *
     * @param string $name Name of the option.
     *
     * @return $this
     */
    protected function removeOption($name)
    {
        unset($this->options[$name]);

        return $this;
    }
}
