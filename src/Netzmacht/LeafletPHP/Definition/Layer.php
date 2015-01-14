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

use Netzmacht\LeafletPHP\Definition;

/**
 * Interface Layer describes map layers.
 *
 * @package Netzmacht\LeafletPHP\Definition
 */
interface Layer extends Definition, HasLabel, MapObject
{
}
