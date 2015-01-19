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

use Netzmacht\JavascriptBuilder\Encoder;
use Netzmacht\JavascriptBuilder\Output;
use Netzmacht\JavascriptBuilder\Util\Flags;

/**
 * Provider plugin for the MaxBox.
 *
 * @package Netzmacht\LeafletPHP\Plugins\LeafletProviders
 */
class MapBoxProvider extends Provider
{
    /**
     * Mapbox user.
     *
     * @var string
     */
    private $user;

    /**
     * Mapbox map name.
     *
     * @var string
     */
    private $mapName;

    /**
     * Get the key.
     *
     * @return string
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set the mapbox user..
     *
     * @param string $user Mapbox username.
     *
     * @return $this
     */
    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }
    
    /**
     * Get the map name.
     *
     * @return string
     */
    public function getMapName()
    {
        return $this->mapName;
    }

    /**
     * Set the map name.
     *
     * @param string $mapName Mapbox map name.
     *
     * @return $this
     */
    public function setMapName($mapName)
    {
        $this->mapName = $mapName;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function encode(Encoder $encoder, $flags = null)
    {
        $name = $this->getProvider();

        if ($this->getVariant()) {
            $name .= '.' . $this->getVariant();
        }

        $name .= '.' . $this->getUser();
        $name .= '.' . $this->getMapName();

        $buffer = sprintf(
            '%s = L.tileLayer.provider(\'' . $name . '\')' . $encoder->close($flags),
            $encoder->encodeReference($this)
        );

        $flags = Flags::add(Encoder::CLOSE_STATEMENT, $flags);

        foreach ($this->getMethodCalls() as $method) {
            $buffer .= "\n" . $method->encode($encoder, $flags);
        }

        return $buffer;
    }
}
