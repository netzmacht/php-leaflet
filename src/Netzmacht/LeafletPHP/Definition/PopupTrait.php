<?php

/**
 * @package    dev
 * @author     David Molineus <david.molineus@netzmacht.de>
 * @copyright  2015 netzmacht creative David Molineus
 * @license    LGPL 3.0
 * @filesource
 *
 */

namespace Netzmacht\LeafletPHP\Definition;

use Netzmacht\LeafletPHP\Definition\UI\Popup;

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
     * @param Popup|string $popup The popup.
     *
     * @return $this
     */
    public function bindPopup($popup)
    {
        $this->popup = $popup;

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
     * Unbind a popup.
     *
     * @return $this
     */
    public function unbindPopup()
    {
        $this->popup = null;

        return $this->addMethod('unbindPopup');
    }
}
