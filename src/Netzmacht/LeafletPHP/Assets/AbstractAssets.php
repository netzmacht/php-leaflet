<?php

/**
 * @package    dev
 * @author     David Molineus <david.molineus@netzmacht.de>
 * @copyright  2014 netzmacht creative David Molineus
 * @license    LGPL 3.0
 * @filesource
 *
 */

namespace Netzmacht\LeafletPHP\Assets;

use Netzmacht\LeafletPHP\Assets;

/**
 * Class AbstractAssets extends
 *
 * @package Netzmacht\LeafletPHP\Assets
 */
abstract class AbstractAssets implements Assets
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
     * @param string $separator
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
    public function getHtml()
    {
        return $this->getStylesHtml() . "\n" . $this->getScriptsHtml();
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
