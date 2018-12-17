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
 * Provider plguin for the HERE provider.
 *
 * @package Netzmacht\LeafletPHP\Plugins\LeafletProviders
 */
class ThunderforestProvider extends Provider implements HasOptions
{
    use OptionsTrait;
    use EncodeHelperTrait;

    /**
     * Set the app key.
     *
     * @param string $appId The app key.
     *
     * @return $this
     */
    public function setAppKey($appId)
    {
        return $this->setOption('apikey', $appId);
    }

    /**
     * Get the app key.
     *
     * @return string
     */
    public function getAppKey()
    {
        return $this->getOption('apikey');
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
                    'apikey'   => $this->getAppKey(),
                )
            )
        );

        $buffer .= $this->encodeMethodCalls($this->getMethodCalls(), $encoder, $flags);

        return $buffer;
    }
}
