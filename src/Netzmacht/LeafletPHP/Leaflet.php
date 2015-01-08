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

use Netzmacht\Javascript\Builder;
use Netzmacht\LeafletPHP\Assets\Collector;
use Netzmacht\LeafletPHP\Definition\Map;

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
    private $builder;

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
     * Construct.
     *
     * @param Builder $builder   The javascript builder.
     * @param array   $libraries Registered libraries.
     */
    public function __construct(Builder $builder, array $libraries = array())
    {
        $this->builder   = $builder;
        $this->stylesheets = $libraries;
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
     * Get the javascript builder.
     *
     * @return Builder
     */
    public function getBuilder()
    {
        return $this->builder;
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
        if (!$assets) {
            return $this->builder->build($map);
        }

        $dispatcher = $this->builder->getDispatcher();
        $collector  = new Collector($assets, $this->javascripts, $this->stylesheets);
        $dispatcher->addSubscriber($collector);

        $assets->setMap($this->builder->build($map));

        $dispatcher->removeSubscriber($collector);

        return $assets->getMap();
    }
}
