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
 * Class LabelTrait is a trait implementation of the HasLabel interface.
 *
 * @package Netzmacht\LeafletPHP\Definition
 */
trait LabelTrait
{
    /**
     * The label.
     *
     * @var string
     */
    private $label;

    /**
     * Set the label.
     *
     * @param string $label The new label.
     *
     * @return $this
     */
    public function setLabel($label)
    {
        $this->label = $label;

        return $this;
    }

    /**
     * Get elements label.
     *
     * @return string
     */
    public function getLabel()
    {
        return $this->label ?: $this->getId();
    }
}
