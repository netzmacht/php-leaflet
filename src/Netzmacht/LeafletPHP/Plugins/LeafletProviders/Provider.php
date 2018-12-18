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
use Netzmacht\JavascriptBuilder\Type\ConvertsToJavascript;
use Netzmacht\LeafletPHP\Definition\AbstractLayer;
use Netzmacht\LeafletPHP\Encoder\EncodeHelperTrait;
use const JSON_FORCE_OBJECT;

/**
 * Class Provider provides the L.tileLayer.provider plugin.
 *
 * @package Netzmacht\LeafletPHP\Plugins\LeafletProviders
 */
class Provider extends AbstractLayer implements ConvertsToJavascript
{
    use EncodeHelperTrait;

    /**
     * {@inheritdoc}
     */
    public static function getRequiredLibraries()
    {
        $libs   = parent::getRequiredLibraries();
        $libs[] = 'leaflet-providers';

        return $libs;
    }

    /**
     * Get the type of the definition.
     *
     * @return string
     */
    public static function getType()
    {
        return 'TileLayer.provider';
    }

    /**
     * Provider name.
     *
     * @var string
     */
    private $provider;

    /**
     * Variant name.
     *
     * @var string
     */
    private $variant;

    /**
     * Construct.
     *
     * @param string $identifier Element identifier.
     * @param string $provider   Provider name.
     * @param string $variant    Map variant.
     */
    public function __construct($identifier, $provider, $variant = null)
    {
        parent::__construct($identifier);

        $this->provider = $provider;
        $this->variant  = $variant;
    }

    /**
     * Get the provider.
     *
     * @return string
     */
    public function getProvider()
    {
        return $this->provider;
    }

    /**
     * Get the variant.
     *
     * @return string
     */
    public function getVariant()
    {
        return $this->variant;
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
            $encoder->encodeArray($this->getOptions(), JSON_FORCE_OBJECT)
        );

        $buffer .= $this->encodeMethodCalls($this->getMethodCalls(), $encoder, $flags);

        return $buffer;
    }

    /**
     * Encode provider name.
     *
     * @return string
     */
    protected function encodeName()
    {
        $name = $this->getProvider();

        if ($this->getVariant()) {
            $name .= '.' . $this->getVariant();

            return $name;
        }

        return $name;
    }
}
