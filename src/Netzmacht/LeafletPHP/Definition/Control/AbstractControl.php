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

use Netzmacht\LeafletPHP\Definition\AbstractDefinition;
use Netzmacht\LeafletPHP\Definition\Control;
use Netzmacht\LeafletPHP\Definition\HasOptions;
use Netzmacht\LeafletPHP\Definition\MapObject;
use Netzmacht\LeafletPHP\Definition\MapObjectTrait;
use Netzmacht\LeafletPHP\Definition\OptionsTrait;

/**
 * Basic control class.
 *
 * @package Netzmacht\LeafletPHP\Control
 */
abstract class AbstractControl extends AbstractDefinition implements Control, MapObject, HasOptions
{
    use OptionsTrait;
    use MapObjectTrait;

    const POSITION_TOP_LEFT     = 'topleft';
    const POSITION_TOP_RIGHT    = 'topright';
    const POSITION_BOTTOM_LEFT  = 'bottomleft';
    const POSITION_BOTTOM_RIGHT = 'bottomright';

    /**
     * Default position.
     *
     * @var string
     */
    protected $defaultPosition = self::POSITION_TOP_RIGHT;

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
}
