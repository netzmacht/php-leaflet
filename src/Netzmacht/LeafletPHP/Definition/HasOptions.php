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
}
