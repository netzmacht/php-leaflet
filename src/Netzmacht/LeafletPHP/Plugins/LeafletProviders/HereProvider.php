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
 * Provider plugin for the HERE provider.
 *
 * @package Netzmacht\LeafletPHP\Plugins\LeafletProviders
 */
class HereProvider extends Provider implements HasOptions
{
    use OptionsTrait;
    use EncodeHelperTrait;

    /**
     * Set the app id.
     *
     * @param string $appId The app id.
     *
     * @return $this
     */
    public function setAppId($appId)
    {
        return $this->setOption('app_id', $appId);
    }

    /**
     * Get the app id.
     *
     * @return string
     */
    public function getAppId()
    {
        return $this->getOption('app_id');
    }

    /**
     * Set the app code.
     *
     * @param string $code The app code.
     *
     * @return $this
     */
    public function setAppCode($code)
    {
        return $this->setOption('app_code', $code);
    }

    /**
     * Get the app code.
     *
     * @return string
     */
    public function getAppCode()
    {
        return $this->getOption('app_code');
    }
}
