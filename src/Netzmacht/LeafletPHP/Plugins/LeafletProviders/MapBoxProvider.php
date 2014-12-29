<?php

/**
 * @package    dev
 * @author     David Molineus <david.molineus@netzmacht.de>
 * @copyright  2014 netzmacht creative David Molineus
 * @license    LGPL 3.0
 * @filesource
 *
 */

namespace Netzmacht\LeafletPHP\Plugins\LeafletProviders;

use Netzmacht\Javascript\Encoder;

/**
 * Provider plugin for the MaxBox.
 *
 * @package Netzmacht\LeafletPHP\Plugins\LeafletProviders
 */
class MapBoxProvider extends Provider
{
    /**
     * Application key.
     *
     * @var string
     */
    private $key;

    /**
     * Get the key.
     *
     * @return string
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * Set the key.
     *
     * @param string $key
     *
     * @return $this
     */
    public function setKey($key)
    {
        $this->key = $key;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function encode(Encoder $encoder, $finish = true)
    {
        $name = $this->getProvider();

        if ($this->getVariant()) {
            $name .= '.' . $this->getVariant();
        }

        $name .= '.' . $this->getKey();

        return sprintf(
            '%s = L.tileLayer.provider(\'' . $name . '\')' . ($finish ? ';' : ''),
            $encoder->encodeReference($this)
        );
    }
}
