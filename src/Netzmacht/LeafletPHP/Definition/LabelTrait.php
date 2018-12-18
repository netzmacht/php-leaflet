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
