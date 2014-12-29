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


interface GeneratesHtml
{
    /**
     * Get map javascript with script tags.
     *
     * @return string
     */
    public function getMapHtml();

    /**
     * Get scripts html.
     *
     * @return string
     */
    public function getScriptsHtml();

    /**
     * Get styles html.
     *
     * @return string
     */
    public function getStylesHtml();

    /**
     * Get html.
     *
     * @param bool $includeMap Also include the map.
     *
     * @return string
     */
    public function getHtml($includeMap = true);
}
