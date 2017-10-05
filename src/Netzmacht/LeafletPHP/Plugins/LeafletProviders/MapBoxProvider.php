<?php

/**
 * PHP Leaflet library.
 *
 * @package    php-leaflet
 * @author     David Molineus <david.molineus@netzmacht.de>
 * @copyright  2014-2017 netzmacht David Molineus
 * @license    LGPL 3.0
 * @filesource
 */

namespace Netzmacht\LeafletPHP\Plugins\LeafletProviders;

use Netzmacht\JavascriptBuilder\Encoder;
use Netzmacht\LeafletPHP\Encoder\EncodeHelperTrait;

/**
 * Provider plugin for the MaxBox.
 *
 * @package Netzmacht\LeafletPHP\Plugins\LeafletProviders
 */
class MapBoxProvider extends Provider
{
    use EncodeHelperTrait;

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
    protected function encodeName()
    {
        $name = $this->getProvider();

        if ($this->getVariant()) {
            $name .= '.' . $this->getVariant();
        }

        $name .= '.' . $this->getUser();
        $name .= '.' . $this->getMapName();

        return $name;
    }
}
