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

namespace Netzmacht\LeafletPHP\Plugins\OverpassLayer;

use Netzmacht\JavascriptBuilder\Encoder;
use Netzmacht\JavascriptBuilder\Type\ConvertsToJavascript;
use Netzmacht\JavascriptBuilder\Type\Expression;
use Netzmacht\LeafletPHP\Definition\AbstractLayer;
use Netzmacht\LeafletPHP\Encoder\EncodeHelperTrait;

/**
 * Class OverpassLayer provides implementation of https://github.com/kartenkarsten/leaflet-layer-overpass.
 *
 * @package Netzmacht\LeafletPHP\Plugins\OverpassLayer
 */
class OverpassLayer extends AbstractLayer implements ConvertsToJavascript
{
    use EncodeHelperTrait;

    /**
     * {@inheritdoc}
     */
    public static function getType()
    {
        return 'OverpassLayer';
    }

    /**
     * {@inheritdoc}
     */
    public static function getRequiredLibraries()
    {
        $libs   = parent::getRequiredLibraries();
        $libs[] = 'leaflet-layer-overpass';

        return $libs;
    }

    /**
     * OverpassLayer constructor.
     *
     * @param string $identifier Indicator of the layer.
     * @param array  $options    Options.
     */
    public function __construct($identifier, array $options = [])
    {
        parent::__construct($identifier);

        $this->setOptions($options);
    }

    /**
     * Set the debug mode.
     *
     * @param bool $debug Debug mode.
     *
     * @return $this
     */
    public function setDebug($debug)
    {
        return $this->setOption('debug', (bool) $debug);
    }

    /**
     * Get debug mode.
     *
     * @return bool
     *
     * @SuppressWarnings(BooleanGetMethodName)
     */
    public function getDebug()
    {
        return $this->getOption('debug', false);
    }

    /**
     * Set the query.
     *
     * @param string $query Query.
     *
     * @return $this
     */
    public function setQuery($query)
    {
        return $this->setOption('query', $query);
    }

    /**
     * Get query.
     *
     * @return string
     */
    public function getQuery()
    {
        return $this->getOption('query', '(node(BBOX)[organic];node(BBOX)[second_hand];);out qt;');
    }

    /**
     * Set the endpoint.
     *
     * @param string $endpoint Endpoint.
     *
     * @return $this
     */
    public function setEndpoint($endpoint)
    {
        return $this->setOption('endpoint', $endpoint);
    }

    /**
     * Get endpoint.
     *
     * @return string
     */
    public function getEndpoint()
    {
        return $this->getOption('endpoint', '//overpass-api.de/api/');
    }

    /**
     * Set the callback.
     *
     * @param Expression $callback Callback.
     *
     * @return $this
     */
    public function setCallback(Expression $callback)
    {
        return $this->setOption('callback', $callback);
    }

    /**
     * Get callback.
     *
     * @return Expression|null
     */
    public function getCallback()
    {
        return $this->getOption('callback', null);
    }

    /**
     * Set the minZoom.
     *
     * @param int $minZoom MinZoom.
     *
     * @return $this
     */
    public function setMinZoom($minZoom)
    {
        return $this->setOption('minzoom', (int) $minZoom);
    }

    /**
     * Get minZoom.
     *
     * @return int
     */
    public function getMinZoom()
    {
        return $this->getOption('minzoom', 15);
    }

    /**
     * Get the min zoom indicator options.
     *
     * @return MinZoomIndicatorOptions
     */
    public function getMinZoomIndicatorOptions()
    {
        if (!$this->getOption('minZoomindicatorOptions')) {
            $this->setMinZoomIndicatorOptions(new MinZoomIndicatorOptions());
        }

        return $this->getOption('minZoomIndicatorOptions');
    }

    /**
     * Set the min zoom indicator options.
     *
     * @param MinZoomIndicatorOptions $minZoomIndicatorOptions Options.
     *
     * @return $this
     */
    public function setMinZoomIndicatorOptions(MinZoomIndicatorOptions $minZoomIndicatorOptions)
    {
        return $this->setOption('minZoomIndicatorOptions', $minZoomIndicatorOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function encode(Encoder $encoder, $flags = null)
    {
        $buffer = sprintf(
            '%s = new L.OverPassLayer(%s, %s)%s',
            $encoder->encodeReference($this),
            $encoder->encodeArray($this->getOptions(), JSON_FORCE_OBJECT),
            $encoder->encodeArray($this->getMinZoomIndicatorOptions()->getOptions(), JSON_FORCE_OBJECT),
            $encoder->close($flags)
        );

        $buffer .= $this->encodeMethodCalls($this->getMethodCalls(), $encoder, $flags);

        return $buffer;
    }
}
