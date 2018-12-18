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

namespace Netzmacht\LeafletPHP\Definition\Type;

/**
 * Class Icon describes an leaflet icon.
 *
 * @package Netzmacht\LeafletPHP\Definition\Type
 */
class ImageIcon extends AbstractIcon
{
    /**
     * {@inheritdoc}
     */
    public static function getType()
    {
        return 'Icon';
    }

    /**
     * Construct.
     *
     * @param string $identifier Icon identifier.
     * @param string $iconUrl    Icon url.
     */
    public function __construct($identifier, $iconUrl)
    {
        parent::__construct($identifier);

        $this->setIconUrl($iconUrl);
    }

    /**
     * Set the icon url.
     *
     * @param string $url The icon url.
     *
     * @return $this
     * @see    http://leafletjs.com/reference.html#icon-iconurl
     */
    public function setIconUrl($url)
    {
        return $this->setOption('iconUrl', $url);
    }

    /**
     * Get the icon url.
     *
     * @return string
     * @see    http://leafletjs.com/reference.html#icon-iconurl
     */
    public function getIconUrl()
    {
        return $this->getOption('iconUrl');
    }

    /**
     * Set the icon retina url.
     *
     * @param string $url The icon url.
     *
     * @return $this
     * @see    http://leafletjs.com/reference.html#icon-iconretinaurl
     */
    public function setIconRetinaUrl($url)
    {
        return $this->setOption('iconRetinaUrl', $url);
    }

    /**
     * Get the icon retina url.
     *
     * @return string
     * @see    http://leafletjs.com/reference.html#icon-iconretinaurl
     */
    public function getIconRetinaUrl()
    {
        return $this->getOption('iconRetinaUrl');
    }
    
    /**
     * Set the shadow url.
     *
     * @param string $url The shadow url.
     *
     * @return $this
     * @see    http://leafletjs.com/reference.html#shadow-shadowurl
     */
    public function setShadowUrl($url)
    {
        return $this->setOption('shadowUrl', $url);
    }

    /**
     * Get the shadow url.
     *
     * @return string
     * @see    http://leafletjs.com/reference.html#shadow-shadowurl
     */
    public function getShadowUrl()
    {
        return $this->getOption('shadowUrl');
    }

    /**
     * Set the shadow retina url.
     *
     * @param string $url The shadow url.
     *
     * @return $this
     * @see    http://leafletjs.com/reference.html#shadow-shadowretinaurl
     */
    public function setShadowRetinaUrl($url)
    {
        return $this->setOption('shadowRetinaUrl', $url);
    }

    /**
     * Get the shadow retina url.
     *
     * @return string
     * @see    http://leafletjs.com/reference.html#shadow-shadowretinaurl
     */
    public function getShadowRetinaUrl()
    {
        return $this->getOption('shadowRetinaUrl');
    }

    /**
     * The shadow size as point.
     *
     * @param array $size The shadow size as point.
     *
     * @return $this
     * @see    http://leafletjs.com/reference.html#divshadow-shadowsize
     */
    public function setShadowSize($size)
    {
        return $this->setOption('shadowSize', $size);
    }

    /**
     * Get the shadow size.
     *
     * @return array|null
     * @see    http://leafletjs.com/reference.html#divshadow-shadowsize
     */
    public function getShadowSize()
    {
        return $this->getOption('shadowSize');
    }

    /**
     * The coordinates of the "tip" of the shadow (relative to its top left corner).
     *
     * @param array $point The coordinates as point.
     *
     * @return $this
     * @see    http://leafletjs.com/reference.html#divshadow-shadowanchor
     */
    public function setShadowAnchor($point)
    {
        return $this->setOption('shadowAnchor', $point);
    }

    /**
     * Get the shadow anchor.
     *
     * @return array|null
     * @see    http://leafletjs.com/reference.html#divshadow-shadowanchor
     */
    public function getShadowAnchor()
    {
        return $this->getOption('shadowAnchor');
    }
}
