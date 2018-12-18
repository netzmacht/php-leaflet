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

namespace Netzmacht\LeafletPHP\Definition\UI;

use Netzmacht\LeafletPHP\Definition\AbstractLayer;
use Netzmacht\LeafletPHP\Definition\HasOptions;
use Netzmacht\LeafletPHP\Definition\Layer;
use Netzmacht\LeafletPHP\Definition\Map;
use Netzmacht\LeafletPHP\Definition\OptionsTrait;
use Netzmacht\LeafletPHP\Value\LatLng;

/**
 * Popup object.
 *
 * @package Netzmacht\LeafletPHP\Definition\UI
 */
class Popup extends AbstractLayer implements HasOptions
{
    use OptionsTrait;

    /**
     * The source layer.
     *
     * @var Layer
     */
    private $source;

    /**
     * The geographical point where the popup will open.
     *
     * @var LatLng
     */
    private $latLng;

    /**
     * The popup html content.
     *
     * @var string
     */
    private $content;

    /**
     * {@inheritdoc}
     */
    public static function getType()
    {
        return 'Popup';
    }

    /**
     * Construct.
     *
     * @param string $identifier The identifier.
     * @param Layer  $source     The source reference.
     */
    public function __construct($identifier, Layer $source = null)
    {
        parent::__construct($identifier);

        $this->source = $source;
    }

    /**
     * Set source.
     *
     * @param Layer $source Source.
     *
     * @return $this
     * @see    http://leafletjs.com/reference.html#popup-l.popup
     */
    public function setSource($source)
    {
        $this->source = $source;

        return $this;
    }

    /**
     * Get source.
     *
     * @return Layer
     * @see    http://leafletjs.com/reference.html#popup-l.popup
     */
    public function getSource()
    {
        return $this->source;
    }

    /**
     * Set the max width option.
     *
     * @param int $width The max width.
     *
     * @return $this
     * @see    http://leafletjs.com/reference.html#popup-maxwidth
     */
    public function setMaxWidth($width)
    {
        return $this->setOption('maxWidth', (int) $width);
    }

    /**
     * Get max width option.
     *
     * @return int
     * @see    http://leafletjs.com/reference.html#popup-maxwidth
     */
    public function getMaxWidth()
    {
        return $this->getOption('maxWidth', 300);
    }

    /**
     * Set the min width option.
     *
     * @param int $width The max width.
     *
     * @return $this
     * @see    http://leafletjs.com/reference.html#popup-minwidth
     */
    public function setMinWidth($width)
    {
        return $this->setOption('minWidth', (int) $width);
    }

    /**
     * Get min width option.
     *
     * @return int
     * @see    http://leafletjs.com/reference.html#popup-minwidth
     */
    public function getMinWidth()
    {
        return $this->getOption('minWidth', 50);
    }

    /**
     * Set the max height option.
     *
     * @param int $height The max height.
     *
     * @return $this
     * @see    http://leafletjs.com/reference.html#popup-maxheight
     */
    public function setMaxHeight($height)
    {
        return $this->setOption('maxHeight', (int) $height);
    }

    /**
     * Get max height option.
     *
     * @return int
     * @see    http://leafletjs.com/reference.html#popup-maxheight
     */
    public function getMaxHeight()
    {
        return $this->getOption('maxHeight');
    }

    /**
     * Set the auto pan option.
     *
     * @param bool $value The auto pan.
     *
     * @return $this
     * @see    http://leafletjs.com/reference.html#popup-autopan
     */
    public function setAutoPan($value)
    {
        return $this->setOption('autoPan', (bool) $value);
    }

    /**
     * Get auto pan option.
     *
     * @return bool
     * @see    http://leafletjs.com/reference.html#popup-autopan
     */
    public function isAutoPan()
    {
        return $this->getOption('autoPan', true);
    }

    /**
     * Set the keep in view option.
     *
     * @param bool $value If true the popup is kept in view.
     *
     * @return $this
     * @see    http://leafletjs.com/reference.html#popup-keepinview
     */
    public function setKeepInView($value)
    {
        return $this->setOption('keepInView', (bool) $value);
    }

    /**
     * Get keep in view option.
     *
     * @return bool
     * @see    http://leafletjs.com/reference.html#popup-keepinview
     */
    public function isKeepInView()
    {
        return $this->getOption('keepInView', false);
    }

    /**
     * Set the close button option.
     *
     * @param bool $value If true a close button is shown.
     *
     * @return $this
     * @see    http://leafletjs.com/reference.html#popup-closebutton
     */
    public function setCloseButton($value)
    {
        return $this->setOption('closeButton', (bool) $value);
    }

    /**
     * Get auto pan option.
     *
     * @return bool
     * @see    http://leafletjs.com/reference.html#popup-closebutton
     */
    public function hasCloseButton()
    {
        return $this->getOption('closeButton', true);
    }

    /**
     * Set the offset option.
     *
     * @param array $value The offset as point.
     *
     * @return $this
     * @see    http://leafletjs.com/reference.html#popup-offset
     */
    public function setOffset(array $value)
    {
        return $this->setOption('offset', $value);
    }

    /**
     * Get the offset option.
     *
     * @return int
     * @see    http://leafletjs.com/reference.html#popup-offset
     */
    public function getOffset()
    {
        return $this->getOption('offset', array(0, 6));
    }

    /**
     * Set the autoPanPaddingTopLeft option.
     *
     * @param array $value The autoPanPaddingTopLeft as point.
     *
     * @return $this
     * @see    http://leafletjs.com/reference.html#popup-autopanpaddingtopleft
     */
    public function setAutoPanPaddingTopLeft(array $value)
    {
        return $this->setOption('autoPanPaddingTopLeft', $value);
    }

    /**
     * Get the autoPanPaddingTopLeft option.
     *
     * @return int
     * @see    http://leafletjs.com/reference.html#popup-autopanpaddingtopleft
     */
    public function getAutoPanPaddingTopLeft()
    {
        return $this->getOption('autoPanPaddingTopLeft');
    }

    /**
     * Set the autoPanPaddingBottomRight option.
     *
     * @param array $value The autoPanPaddingBottomRight as point.
     *
     * @return $this
     * @see    http://leafletjs.com/reference.html#popup-autopanpaddingbottomright
     */
    public function setAutoPanPaddingBottomRight(array $value)
    {
        return $this->setOption('autoPanPaddingBottomRight', $value);
    }

    /**
     * Get the autoPanPaddingBottomRight option.
     *
     * @return int
     * @see    http://leafletjs.com/reference.html#popup-autopanpaddingbottomright
     */
    public function getAutoPanPaddingBottomRight()
    {
        return $this->getOption('autoPanPaddingBottomRight');
    }

    /**
     * Set the autoPanPadding option.
     *
     * @param array $value The autoPanPadding as point.
     *
     * @return $this
     * @see    http://leafletjs.com/reference.html#popup-autopanpadding
     */
    public function setAutoPanPadding(array $value)
    {
        return $this->setOption('autoPanPadding', $value);
    }

    /**
     * Get the autoPanPadding option.
     *
     * @return int
     * @see    http://leafletjs.com/reference.html#popup-autopanpadding
     */
    public function getAutoPanPadding()
    {
        return $this->getOption('autoPanPadding', array(5, 5));
    }

    /**
     * Set the zoom animation option.
     *
     * @param bool $value The zoom animation.
     *
     * @return $this
     * @see    http://leafletjs.com/reference.html#popup-zoomanimation
     */
    public function setZoomAnimation($value)
    {
        return $this->setOption('zoomAnimation', (bool) $value);
    }

    /**
     * Get zoom animation option.
     *
     * @return bool
     * @see    http://leafletjs.com/reference.html#popup-zoomanimation
     */
    public function isZoomAnimation()
    {
        return $this->getOption('zoomAnimation', true);
    }

    /**
     * Set the closeOnClick option.
     *
     * @param bool $value The closeOnClick option value.
     *
     * @return $this
     * @see    http://leafletjs.com/reference.html#popup-closeonclick
     */
    public function setCloseOnClick($value)
    {
        return $this->setOption('closeOnClick', (bool) $value);
    }

    /**
     * Get closeOnClick option.
     *
     * @return bool
     * @see    http://leafletjs.com/reference.html#popup-closeonclick
     */
    public function isCloseOnClick()
    {
        return $this->getOption('closeOnClick');
    }

    /**
     * Set a custom class name to assign to the icon.
     *
     * @param string $className The custom class name.
     *
     * @return $this
     * @see    http://leafletjs.com/reference.html#popup-classname
     */
    public function setClassName($className)
    {
        return $this->setOption('className', $className);
    }

    /**
     * Get the class name.
     *
     * @return string
     */
    public function getClassName()
    {
        return $this->getOption('className', '');
    }

    /**
     * Set auto close option.
     *
     * @param bool $autoClose Autoclose option.
     *
     * @return $this
     */
    public function setAutoClose($autoClose)
    {
        return $this->setOption('autoClose', (bool) $autoClose);
    }

    /**
     * Get auto close option.
     *
     * @return bool
     */
    public function isAutoClose()
    {
        return $this->getOption('autoClose', true);
    }

    /**
     * Create openOn map method.
     *
     * @param Map $map The map.
     *
     * @return $this
     */
    public function openOn(Map $map)
    {
        $this->map = $map;
        $map->addLayer($this);

        return $this->addMethod('openOn', array($map));
    }

    /**
     * Sets the geographical point where the popup will open.
     *
     * It creates the method call and sets internal the latLng property.
     *
     * @param LatLng $latLng The geographical point where the popup will open.
     *
     * @return $this
     * @see    http://leafletjs.com/reference.html#popup-setlatlng
     */
    public function setLatLng(LatLng $latLng)
    {
        $this->latLng = $latLng;
        $this->addMethod('setLatLng', array($latLng));

        return $this;
    }

    /**
     * Get the geographical point where the popup will open.
     *
     * @return LatLng
     * @see    http://leafletjs.com/reference.html#popup-getlatlng
     */
    public function getLatLng()
    {
        return $this->latLng;
    }

    /**
     * Set content.
     *
     * @param string $content The html content.
     *
     * @return $this
     * @see    http://leafletjs.com/reference.html#popup-setcontent
     */
    public function setContent($content)
    {
        $this->content = $content;
        $this->addMethod('setContent', array($content));

        return $this;
    }

    /**
     * Get content.
     *
     * @return string
     * @see    http://leafletjs.com/reference.html#popup-getcontent
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Create update method call.
     *
     * @return $this
     * @see    http://leafletjs.com/reference.html#popup-update
     */
    public function update()
    {
        return $this->addMethod('update');
    }
}
