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
 * Provider plugin for the Thunderforest provider.
 *
 * @package Netzmacht\LeafletPHP\Plugins\LeafletProviders
 */
class ThunderforestProvider extends Provider implements HasOptions
{
    use OptionsTrait;
    use EncodeHelperTrait;

    /**
     * Set the api key.
     *
     * @param string $appId The api key.
     *
     * @return $this
     */
    public function setApiKey($appId)
    {
        return $this->setOption('apikey', $appId);
    }

    /**
     * Get the api key.
     *
     * @return string
     */
    public function getApiKey()
    {
        return $this->getOption('apikey');
    }
}
