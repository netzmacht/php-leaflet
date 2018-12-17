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

namespace Netzmacht\LeafletPHP\Plugins\LeafletProviders;

use Netzmacht\JavascriptBuilder\Encoder;
use Netzmacht\LeafletPHP\Definition\HasOptions;
use Netzmacht\LeafletPHP\Definition\OptionsTrait;
use Netzmacht\LeafletPHP\Encoder\EncodeHelperTrait;

/**
 * Provider plugin for the MaxBox.
 *
 * @package Netzmacht\LeafletPHP\Plugins\LeafletProviders
 */
class MapBoxProvider extends Provider implements HasOptions
{
    use OptionsTrait;
    use EncodeHelperTrait;

    /**
     * Get the key.
     *
     * @return string
     */
    public function getUser()
    {
        // @codingStandardsIgnoreStart
        @trigger_error(
            'MapBoxProvider::getUser is deprecated and has no affect. Will be removed in 2.0.'
        );
        // @codingStandardsIgnoreEnd

        return '';
    }

    /**
     * Set the mapbox user..
     *
     * @param string $user Mapbox username.
     *
     * @return $this
     *
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function setUser($user)
    {
        // @codingStandardsIgnoreStart
        @trigger_error(
            'MapBoxProvider::setUser is deprecated and has no affect. Will be removed in 2.0.'
        );
        // @codingStandardsIgnoreEnd

        return $this;
    }

    /**
     * Get the map name.
     *
     * @return string
     */
    public function getMapName()
    {
        // @codingStandardsIgnoreStart
        @trigger_error(
            'MapBoxProvider::getMapName is deprecated and has no affect. Will be removed in 2.0.'
        );
        // @codingStandardsIgnoreEnd

        return '';
    }

    /**
     * Set the map name.
     *
     * @param string $mapName Mapbox map name.
     *
     * @return $this
     *
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function setMapName($mapName)
    {
        // @codingStandardsIgnoreStart
        @trigger_error(
            'MapBoxProvider::setMapName is deprecated and has no affect. Will be removed in 2.0.'
        );
        // @codingStandardsIgnoreEnd

        return $this;
    }

    /**
     * Get access roken.
     *
     * @return string|null
     */
    public function getAccessToken()
    {
        return $this->getOption('accessToken');
    }

    /**
     * Set access token.
     *
     * @param string $accessToken AccessToken.
     *
     * @return $this
     */
    public function setAccessToken($accessToken)
    {
        return $this->setOption('accessToken', $accessToken);
    }

    /**
     * {@inheritdoc}
     */
    public function encode(Encoder $encoder, $flags = null)
    {
        $name   = $this->encodeName();
        $buffer = sprintf(
            '%s = L.tileLayer.provider(\'' . $name . '\', %s)' . $encoder->close($flags),
            $encoder->encodeReference($this),
            $encoder->encodeValue(
                array(
                    'accessToken'   => $this->getAccessToken(),
                )
            )
        );

        $buffer .= $this->encodeMethodCalls($this->getMethodCalls(), $encoder, $flags);

        return $buffer;
    }
}
