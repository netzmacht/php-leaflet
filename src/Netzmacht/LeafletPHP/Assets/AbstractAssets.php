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

namespace Netzmacht\LeafletPHP\Assets;

use Netzmacht\LeafletPHP\Assets;

/**
 * Class AbstractAssets is a base implementation of the assets interface. It also implements the GeneratesHtml
 * interface.
 *
 * @package Netzmacht\LeafletPHP\Assets
 */
abstract class AbstractAssets implements Assets, GeneratesHtml
{
    /**
     * The stylesheets.
     *
     * @var string
     */
    private $stylesheets = '';

    /**
     * The java scripts.
     *
     * @var string
     */
    private $javaScripts = '';

    /**
     * Line separator.
     *
     * @var string
     */
    private $separator = "\n";

    /**
     * Map javascript.
     *
     * @var string
     */
    private $map;

    /**
     * Get the separator.
     *
     * @return string
     */
    public function getSeparator()
    {
        return $this->separator;
    }

    /**
     * Set the separator.
     *
     * @param string $separator The line separator.
     *
     * @return $this
     */
    public function setSeparator($separator)
    {
        $this->separator = $separator;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function setMap($map)
    {
        $this->map = $map;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getMap()
    {
        return $this->map;
    }

    /**
     * {@inheritdoc}
     */
    public function getMapHtml()
    {
        return sprintf('<script>%s</script>', $this->getMap());
    }

    /**
     * {@inheritdoc}
     */
    public function getScriptsHtml()
    {
        return $this->javaScripts;
    }

    /**
     * {@inheritdoc}
     */
    public function getStylesHtml()
    {
        return $this->stylesheets;
    }

    /**
     * {@inheritdoc}
     */
    public function getHtml($includeMap = true)
    {
        return $this->getStylesHtml()
            . $this->separator
            . $this->getScriptsHtml()
            . ($includeMap ? ($this->separator . $this->getMapHtml()) : '');
    }

    /**
     * Append style.
     *
     * @param string $style The style to be appended.
     *
     * @return $this
     */
    protected function appendStyle($style)
    {
        $this->stylesheets .= $style;

        return $this;
    }

    /**
     * Append script.
     *
     * @param string $script The script to be added.
     *
     * @return $this
     */
    protected function appendScript($script)
    {
        $this->javaScripts .= $script;

        return $this;
    }
}
