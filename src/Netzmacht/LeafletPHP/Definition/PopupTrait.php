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

namespace Netzmacht\LeafletPHP\Definition;

use Netzmacht\LeafletPHP\Definition\UI\Popup;

/**
 * Class PopupTrait is an implementation of the HasPopup interface an can be used as trait.
 *
 * @package Netzmacht\LeafletPHP\Definition
 */
trait PopupTrait
{
    /**
     * The bind popup.
     *
     * @var Popup|string
     */
    private $popup;

    /**
     * Popup content.
     *
     * @var string
     */
    private $popupContent;

    /**
     * Popup options.
     *
     * @var array|null
     */
    private $popupOptions;

    /**
     * Set the popup content.
     *
     * @param string $content The popup content.
     *
     * @return $this
     */
    public function setPopupContent($content)
    {
        $this->popupContent = $content;

        return $this->addMethod('setPopupContent', array($content));
    }

    /**
     * Get the popup content.
     *
     * @return string
     */
    public function getPopupContent()
    {
        return $this->popupContent;
    }

    /**
     * Bind marker to a popup.
     *
     * @param Popup|string $popup   The popup.
     * @param array|null   $options Optional popup options.
     *
     * @return $this
     */
    public function bindPopup($popup, $options = null)
    {
        $this->popup        = $popup;
        $this->popupOptions = $options;

        if (!empty($options)) {
            return $this->addMethod('binPopup', array($popup, $options));
        }

        return $this->addMethod('bindPopup', array($popup));
    }

    /**
     * Get bound popup.
     *
     * @return Popup|string
     */
    public function getPopup()
    {
        return $this->popup;
    }

    /**
     * Get popup options.
     *
     * @return array|null
     */
    public function getPopupOptions()
    {
        return $this->popupOptions;
    }

    /**
     * Unbind a popup.
     *
     * @return $this
     */
    public function unbindPopup()
    {
        $this->popup = null;

        return $this->addMethod('unbindPopup');
    }

    /**
     * Call the isPopupOpen method.
     *
     * @return $this
     */
    public function isPopupOpen()
    {
        return $this->addMethod('isPopupOpen');
    }
}
