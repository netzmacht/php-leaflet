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

namespace Netzmacht\LeafletPHP;

use Netzmacht\JavascriptBuilder\Builder;
use Netzmacht\JavascriptBuilder\Encoder;
use Netzmacht\LeafletPHP\Assets\Collector;
use Netzmacht\LeafletPHP\Definition\Map;
use Symfony\Component\EventDispatcher\EventDispatcherInterface as EventDispatcherInter;

/**
 * Class Leaflet provides a simple interface for building javascript from a map.
 *
 * @package Netzmacht\LeafletPHP
 */
class Leaflet
{
    /**
     * The javascript builder.
     *
     * @var Builder
     */
    private $javascriptBuilder;

    /**
     * Libraries stylesheets.
     *
     * @var array
     */
    private $stylesheets = array();

    /**
     * Libraries javascripts.
     *
     * @var array
     */
    private $javascripts = array();

    /**
     * Flags for built in json_encode.
     *
     * @var null
     */
    private $jsonEncodeFlags;

    /**
     * The event dispatcher used by the javascript builder.
     *
     * @var EventDispatcherInter The event dispatcher
     */
    private $eventDispatcher;

    /**
     * Construct.
     *
     * @param Builder              $javascriptBuilder The javascript builder.
     * @param EventDispatcherInter $eventDispatcher   The event dispatcher.
     * @param array                $libraries         Registered libraries.
     * @param null                 $jsonEncodeFlags   Flags for built in json_encode.
     */
    public function __construct(
        Builder $javascriptBuilder,
        EventDispatcherInter $eventDispatcher,
        array $libraries = array(),
        $jsonEncodeFlags = null
    ) {
        $this->javascriptBuilder = $javascriptBuilder;
        $this->stylesheets       = $libraries;
        $this->jsonEncodeFlags   = $jsonEncodeFlags;
        $this->eventDispatcher   = $eventDispatcher;
    }

    /**
     * Register a stylesheet for the library.
     *
     * @param string $name   Library name.
     * @param string $source The stylesheet source.
     * @param string $type   Resource type.
     *
     * @return $this
     */
    public function registerStylesheet($name, $source, $type = Assets::TYPE_FILE)
    {
        $this->stylesheets[$name][] = array($source, $type);

        return $this;
    }

    /**
     * Register a javascript for the library.
     *
     * @param string $name   Library name.
     * @param string $source The javascript source.
     * @param string $type   Resource type.
     *
     * @return $this
     */
    public function registerJavascript($name, $source, $type = Assets::TYPE_FILE)
    {
        $this->javascripts[$name][] = array($source, $type);

        return $this;
    }

    /**
     * Get all registered stylesheets.
     *
     * @return array
     */
    public function getStylesheets()
    {
        return $this->stylesheets;
    }

    /**
     * Get all registered javscripts.
     *
     * @return array
     */
    public function getJavascripts()
    {
        return $this->javascripts;
    }

    /**
     * Get the javascript encoder.
     *
     * @return Encoder
     */
    public function getJavascriptBuilder()
    {
        return $this->javascriptBuilder;
    }

    /**
     * Build map as a javascript resource.
     *
     * It always return the generated map no matter if an assets object is given or not. If you want to get the
     * combined generated assets, just use $assets->getHtml().
     *
     * @param Map    $map    The map being created.
     * @param Assets $assets Optional pass an assets instance which collects all required assets.
     *
     * @return string
     */
    public function build(Map $map, Assets $assets = null)
    {
        $prefix = 'var map, layers = {}, controls = {}, icons = {};' . "\n";

        if (!$assets) {
            return $prefix . $this->javascriptBuilder->encode($map, $this->jsonEncodeFlags);
        }

        $collector = new Collector($assets, $this->javascripts, $this->stylesheets);
        $this->eventDispatcher->addSubscriber($collector);

        $assets->setMap($prefix . $this->javascriptBuilder->encode($map, $this->jsonEncodeFlags));

        $this->eventDispatcher->removeSubscriber($collector);

        return $assets->getMap();
    }
}
