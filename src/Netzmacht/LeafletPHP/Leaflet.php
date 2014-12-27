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
     * Javascript libraries.
     *
     * @var array
     */
    private $libraries = array();

    /**
     * Construct.
     *
     * @param Builder $builder   The javascript builder.
     * @param array   $libraries Registered libraries.
     */
    public function __construct(Builder $builder, array $libraries = array())
    {
        $this->builder   = $builder;
        $this->libraries = $libraries;
    }

    /**
     * Register a library.
     *
     * @param string $name Library name.
     * @param string $path Library path.
     *
     * @return $this
     */
    public function register($name, $path)
    {
        $this->libraries[$name] = $path;
        return $this;
    }

    /**
     * Get all registered libraries.
     *
     * @return array
     */
    public function getLibraries()
    {
        return $this->libraries;
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
     * @param Map  $map       The map being created.
     * @param bool $libraries Also include libraries.
     *
     * @return string
     *
     * @throws \RuntimeException If library is not registered or file not found.
     */
    public function build(Map $map, $libraries = false)
    {
        if (!$libraries) {
            return $this->builder->build($map);
        }

        $collector = new LibrariesCollector();
        $this->builder->getDispatcher()->addSubscriber($collector);

        $buffer = $this->builder->build($map);

        return $this->combineLibraries($collector->getLibraries()) . "\n" . $buffer;
    }

    /**
     * Combine all libraries.
     *
     * @param array $libraries Collected library names.
     *
     * @return string
     *
     * @throws \RuntimeException If library is not registered or file not found.
     */
    private function combineLibraries(array $libraries)
    {
        $buffer = '';

        foreach ($libraries as $library) {
            if (!isset($this->libraries[$library])) {
                throw new \RuntimeException(sprintf('Library "%s" not found.', $library));
            }

            if (!file_exists($this->libraries[$library])) {
                throw new \RuntimeException(
                    sprintf(
                        'Library "%s" file location "%s" not exists.',
                        $library,
                        $this->libraries[$library]
                    )
                );
            }

            $buffer .= file_get_contents($this->libraries[$library]);
        }

        return $buffer;
    }
}
