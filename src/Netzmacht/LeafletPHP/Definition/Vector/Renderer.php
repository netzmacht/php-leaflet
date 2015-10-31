<?php

/**
 * @package    dev
 * @author     David Molineus <david.molineus@netzmacht.de>
 * @copyright  2015 netzmacht creative David Molineus
 * @license    LGPL 3.0
 * @filesource
 *
 */

namespace Netzmacht\LeafletPHP\Definition\Vector;

use Netzmacht\LeafletPHP\Definition\AbstractLayer;
use Netzmacht\LeafletPHP\Definition\HasOptions;

class Renderer extends AbstractLayer implements HasOptions
{
    /**
     * {@inheritDoc}
     */
    public static function getType()
    {
        return 'Renderer';
    }

    /**
     * Set padding.
     *
     * @param float $padding Padding.
     *
     * @return $this
     */
    public function setPadding($padding)
    {
        return $this->setOption('padding', (float) $padding);
    }

    /**
     * Get padding.
     *
     * @return float
     */
    public function getPadding()
    {
        return $this->getOption('padding', 0.1);
    }
}
