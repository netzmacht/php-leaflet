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

/**
 * Class OptionsTrait implements the HasOptions interface as a trait.
 *
 * @package Netzmacht\LeafletPHP\Definition
 */
trait OptionsTrait
{
    /**
     * Options of the control.
     *
     * @var array
     */
    private $options = array();

    /**
     * Get all defined options. It does not contain default values which were not set.
     *
     * @return array
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * Set options by calling options methods.
     *
     * If a set<OptionName> method does not exists it ignores the option.
     * The setter method should handle the converting from native value to expected value.
     *
     * @param array $options Options being added.
     *
     * @return $this
     */
    public function setOptions(array $options)
    {
        foreach ($options as $name => $value) {
            $method = 'set' . ucfirst($name);

            if (method_exists($this, $method)) {
                $this->$method($value);
            } else {
                $this->options[$name] = $value;
            }
        }

        return $this;
    }

    /**
     * Set an option.
     *
     * @param string $name  Name of the option.
     * @param mixed  $value Value of the option.
     *
     * @return $this
     */
    public function setOption($name, $value)
    {
        $this->options[$name] = $value;

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
    public function getOption($name, $default = null)
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
    public function removeOption($name)
    {
        unset($this->options[$name]);

        return $this;
    }
}
