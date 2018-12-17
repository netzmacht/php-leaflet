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

namespace Netzmacht\LeafletPHP\Definition\Raster;

use Netzmacht\LeafletPHP\Definition\AbstractLayer;
use Netzmacht\LeafletPHP\Definition\HasOptions;
use Netzmacht\LeafletPHP\Value\LatLngBounds;

/**
 * ImageOverlay layer.
 *
 * @package Netzmacht\LeafletPHP\Definition\Raster
 */
class ImageOverlay extends AbstractLayer implements HasOptions
{
    /**
     * Image url.
     *
     * @var string
     */
    private $imageUrl;

    /**
     * Image bounds.
     *
     * @var LatLngBounds
     */
    private $imageBounds;

    /**
     * ImageOverlay constructor.
     *
     * @param string       $identifier  Layer identifier.
     * @param string       $imageUrl    Image url.
     * @param LatLngBounds $imageBounds Image bounds.
     */
    public function __construct($identifier, $imageUrl, LatLngBounds $imageBounds = null)
    {
        parent::__construct($identifier);

        $this->imageUrl    = $imageUrl;
        $this->imageBounds = $imageBounds;
    }

    /**
     * {@inheritDoc}
     */
    public static function getType()
    {
        return 'ImageOverlay';
    }

    /**
     * Get imageUrl.
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->imageUrl;
    }

    /**
     * Set imageUrl.
     *
     * @param string $imageUrl ImageUrl.
     *
     * @return $this
     */
    public function setUrl($imageUrl)
    {
        $this->imageUrl = $imageUrl;

        return $this;
    }

    /**
     * Get imageBounds.
     *
     * @return LatLngBounds
     */
    public function getBounds()
    {
        return $this->imageBounds;
    }

    /**
     * Set imageBounds.
     *
     * @param LatLngBounds $imageBounds ImageBounds.
     *
     * @return $this
     */
    public function setBounds($imageBounds)
    {
        $this->imageBounds = $imageBounds;

        return $this;
    }

    /**
     * Set the opacity of the image overlay.
     *
     * @param float $opacity Image opacity between 0 and 1.
     *
     * @return $this
     * @see    http://leafletjs.com/reference.html#imageoverlay-opacity
     */
    public function setOpacity($opacity)
    {
        return $this->setOption('opacity', (float) $opacity);
    }

    /**
     * Get the opacity of the image overlay.
     *
     * @return float
     * @see    http://leafletjs.com/reference.html#imageoverlay-opacity
     */
    public function getOpacity()
    {
        return $this->getOption('opacity', 1.0);
    }

    /**
     * Set the attribution of the image overlay.
     *
     * @param string $attribution The attribution text of the image overlay.
     *
     * @return $this
     * @see    http://leafletjs.com/reference.html#imageoverlay-attribution
     */
    public function setAttribution($attribution)
    {
        return $this->setOption('attribution', (string) $attribution);
    }

    /**
     * Get the attribution of the image overlay.
     *
     * @return string
     * @see    http://leafletjs.com/reference.html#imageoverlay-attribution
     */
    public function getAttribution()
    {
        return $this->getOption('attribution', '');
    }

    /**
     * Set the alt option.
     *
     * @param string $alt Alternate text.
     *
     * @return $this
     */
    public function setAlt($alt)
    {
        return $this->setOption('alt', (string) $alt);
    }

    /**
     * Get the alternate text.
     *
     * @return string
     */
    public function getAlt()
    {
        return $this->getOption('alt', '');
    }
}
