<?php

/**
 * @package    dev
 * @author     David Molineus <david.molineus@netzmacht.de>
 * @copyright  2014 netzmacht creative David Molineus
 * @license    LGPL 3.0
 * @filesource
 *
 */

namespace Netzmacht\LeafletPHP;

use Netzmacht\Javascript\Encoder;
use Netzmacht\Javascript\Output;
use Netzmacht\LeafletPHP\Assets\Collector;
use Netzmacht\LeafletPHP\Definition\Map;
use Symfony\Component\EventDispatcher\EventDispatcherInterface as EventDispatcher;

/**
 * Class Leaflet provides a simple interface for building javascript from a map.
 *
 * @package Netzmacht\LeafletPHP
 */
class Leaflet
{
    /**
     * The event dispatcher.
     *
     * @var EventDispatcher
     */
    private $dispatcher;

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
     * @var null
     */
    private $jsonEncodeFlags;

    /**
     * Construct.
     *
     * @param EventDispatcher $eventDispatcher The javascript encoder.
     * @param array           $libraries       Registered libraries.
     * @param null            $jsonEncodeFlags
     */
    public function __construct(EventDispatcher $eventDispatcher, array $libraries = array(), $jsonEncodeFlags = null)
    {
        $this->dispatcher      = $eventDispatcher;
        $this->stylesheets     = $libraries;
        $this->jsonEncodeFlags = $jsonEncodeFlags;
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
     * Get all registered libraries.
     *
     * @return array
     */
    public function getStylesheets()
    {
        return $this->stylesheets;
    }

    /**
     * Get the javascript encoder.
     *
     * @return Encoder
     */
    public function getDispatcher()
    {
        return $this->dispatcher;
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
        $prefix  = 'var map, layers = {}, controls = {}, icons = {};';
        $encoder = new Encoder($this->dispatcher, $this->jsonEncodeFlags);

        if (!$assets) {
            return $prefix . $encoder->encode($map);
        }

        $collector  = new Collector($assets, $this->javascripts, $this->stylesheets);
        $this->dispatcher->addSubscriber($collector);

        $assets->setMap($prefix . $encoder->encode($map));

        $this->dispatcher->removeSubscriber($collector);

        return $assets->getMap();
    }
}
