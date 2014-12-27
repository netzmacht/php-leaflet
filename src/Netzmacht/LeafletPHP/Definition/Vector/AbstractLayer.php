<?php

/**
 * @package    dev
 * @author     David Molineus <david.molineus@netzmacht.de>
 * @copyright  2014 netzmacht creative David Molineus
 * @license    LGPL 3.0
 * @filesource
 *
 */

namespace Netzmacht\LeafletPHP\Definition\Vector;

use Netzmacht\LeafletPHP\Definition\AbstractDefinition;
use Netzmacht\LeafletPHP\Definition\HasLabel;
use Netzmacht\LeafletPHP\Definition\HasOptions;
use Netzmacht\LeafletPHP\Definition\LabelTrait;
use Netzmacht\LeafletPHP\Definition\Layer;
use Netzmacht\LeafletPHP\Definition\OptionsTrait;

/**
 * Class AbstractLayer provides functions for a vector layer.
 *
 * @package Netzmacht\LeafletPHP\Definition\Vector
 */
abstract class AbstractLayer extends AbstractDefinition implements Layer, HasOptions
{
    use LabelTrait;
    use OptionsTrait;
}
