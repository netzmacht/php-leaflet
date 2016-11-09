<?php

/**
 * @package    netzmacht
 * @author     David Molineus <david.molineus@netzmacht.de>
 * @copyright  2016 netzmacht David Molineus. All rights reserved.
 * @filesource
 *
 */

namespace Netzmacht\LeafletPHP\Plugins\OverpassLayer;

use Netzmacht\JavascriptBuilder\Encoder;
use Netzmacht\JavascriptBuilder\Type\ConvertsToJavascript;
use Netzmacht\JavascriptBuilder\Type\Expression;
use Netzmacht\LeafletPHP\Definition\AbstractLayer;

/**
 * Class OverpassLayer provides implementation of https://github.com/kartenkarsten/leaflet-layer-overpass.
 *
 * @package Netzmacht\LeafletPHP\Plugins\OverpassLayer
 */
class OverpassLayer extends AbstractLayer implements ConvertsToJavascript
{
    /**
     * Min zoom indicator options.
     *
     * @var MinZoomIndicatorOptions
     */
    private $minZoomIndicatorOptions;

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
     * @param string                       $identifier              Indicator of the layer.
     * @param array                        $options                 Options.
     * @param MinZoomIndicatorOptions|null $minZoomIndicatorOptions Min zoom indicator options.
     */
    public function __construct(
        $identifier,
        array $options = [],
        MinZoomIndicatorOptions $minZoomIndicatorOptions = null
    ) {
        parent::__construct($identifier);

        $this->setOptions($options);
        $this->minZoomIndicatorOptions = $minZoomIndicatorOptions ?: new MinZoomIndicatorOptions();
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
     * @return bool
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
     * @return bool
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
        return $this->setOption('minZoom', (int) $minZoom);
    }

    /**
     * Get minZoom.
     *
     * @return bool
     */
    public function getMinZoom()
    {
        return $this->getOption('minZoom', 15);
    }

    /**
     * Get the min zoom indicator options.
     *
     * @return MinZoomIndicatorOptions
     */
    public function getMinZoomIndicatorOptions()
    {
        return $this->minZoomIndicatorOptions;
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
        $this->minZoomIndicatorOptions = $minZoomIndicatorOptions;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function encode(Encoder $encoder, $flags = null)
    {
        return sprintf (
            '%s = new L.OverPassLayer(%s, %s)%s',
            $encoder->encodeReference($this),
            $encoder->encodeArray($this->getOptions(), JSON_FORCE_OBJECT),
            $encoder->encodeArray($this->getMinZoomIndicatorOptions()->getOptions(), JSON_FORCE_OBJECT),
            $encoder->close($flags)
        );
    }
}
