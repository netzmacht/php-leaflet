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
use Netzmacht\Javascript\Output;
use Netzmacht\LeafletPHP\Definition\HasOptions;
use Netzmacht\LeafletPHP\Definition\OptionsTrait;

/**
 * Provider plguin for the HERE provider.
 *
 * @package Netzmacht\LeafletPHP\Plugins\LeafletProviders
 */
class HereProvider extends Provider implements HasOptions
{
    use OptionsTrait;

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

    /**
     * {@inheritdoc}
     */
    public function encode(Encoder $encoder, Output $output, $finish = true)
    {
        $name = $this->getProvider();

        if ($this->getVariant()) {
            $name .= '.' . $this->getVariant();
        }

        return sprintf(
            '%s = L.tileLayer.provider(\'' . $name . '\', %s)' . ($finish ? ';' : ''),
            $encoder->encodeReference($this),
            $encoder->encodeValue(
                array(
                    'app_id'   => $this->getAppId(),
                    'app_code' => $this->getAppCode()
                )
            )
        );
    }
}
