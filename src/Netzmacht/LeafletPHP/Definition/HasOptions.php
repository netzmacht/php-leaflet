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

/**
 * Interface HasOptions describes elements which have options.
 *
 * @package Netzmacht\LeafletPHP\Definition
 */
interface HasOptions
{
    /**
     * Get all defined options. It does not contain default values which were not set.
     *
     * @return array
     */
    public function getOptions();

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
    public function setOptions(array $options);

    /**
     * Set an option.
     *
     * @param string $name  Name of the option.
     * @param mixed  $value Value of the option.
     *
     * @return $this
     */
    public function setOption($name, $value);

    /**
     * Get an option.
     *
     * @param string $name    Name of the option.
     * @param mixed  $default Default value if no option is set.
     *
     * @return null
     */
    public function getOption($name, $default = null);

    /**
     * Remove an option.
     *
     * @param string $name Name of the option.
     *
     * @return $this
     */
    public function removeOption($name);
}
