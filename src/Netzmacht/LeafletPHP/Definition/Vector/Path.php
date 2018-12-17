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

namespace Netzmacht\LeafletPHP\Definition\Vector;

use Netzmacht\LeafletPHP\Definition\AbstractLayer;
use Netzmacht\LeafletPHP\Value\GeoJson\ConvertsToGeoJsonFeature;
use Netzmacht\LeafletPHP\Value\GeoJson\FeatureTrait;
use Netzmacht\LeafletPHP\Definition\HasEvents;
use Netzmacht\LeafletPHP\Definition\EventsTrait;
use Netzmacht\LeafletPHP\Definition\HasOptions;
use Netzmacht\LeafletPHP\Definition\HasPopup;
use Netzmacht\LeafletPHP\Definition\OptionsTrait;
use Netzmacht\LeafletPHP\Definition\PopupTrait;
use Netzmacht\LeafletPHP\Definition\Vector;

/**
 * Abstract class Path for path based elements.
 *
 * @package Netzmacht\LeafletPHP\Definition\Vector
 */
abstract class Path extends AbstractLayer implements HasEvents, HasPopup, ConvertsToGeoJsonFeature
{
    use OptionsTrait;
    use EventsTrait;
    use PathOptionsTrait;
    use FeatureTrait;

    /**
     * The click event.
     *
     * @see http://leafletjs.com/reference.html#path-click
     */
    const EVENT_CLICK = 'click';

    /**
     * The dblclick event.
     *
     * @see http://leafletjs.com/reference.html#path-dblclick
     */
    const EVENT_DOUBLE_CLICK = 'dblclick';

    /**
     * The mousedown event.
     *
     * @see http://leafletjs.com/reference.html#path-mousedown
     */
    const EVENT_MOUSE_DOWM = 'mousedown';

    /**
     * The mouseover event.
     *
     * @see http://leafletjs.com/reference.html#path-mouseover
     */
    const EVENT_MOUSE_OVER = 'mouseover';

    /**
     * The mouseout event.
     *
     * @see http://leafletjs.com/reference.html#path-mouseout
     */
    const EVENT_MOUSE_OUT = 'mouseout';

    /**
     * The contextmenu event.
     *
     * @see http://leafletjs.com/reference.html#path-contextmenu
     */
    const EVENT_CONTEXT_MENU = 'contextmenu';

    /**
     * The add event.
     *
     * @see http://leafletjs.com/reference.html#path-add
     */
    const EVENT_ADD = 'add';

    /**
     * The remove event.
     *
     * @see http://leafletjs.com/reference.html#path-remove
     */
    const EVENT_REMOVE = 'remove';

    /**
     * The popupopen event.
     *
     * @see http://leafletjs.com/reference.html#path-popupopen
     */
    const EVENT_POPUP_OPEN = 'popupopen';

    /**
     * The popupclose event.
     *
     * @see http://leafletjs.com/reference.html#path-popupclose
     */
    const EVENT_POPUP_CLOSE = 'popupclose';

    /**
     * Get the type of the definition.
     *
     * @return string
     */
    public static function getType()
    {
        return 'Path';
    }

    /**
     * Set the fil rule.
     *
     * @param string $rule Fill rule value. Supported are evenodd and nonzero.
     *
     * @return $this
     */
    public function setFillRule($rule)
    {
        return $this->setOption('fillRule', $rule);
    }

    /**
     * Get the fill rule.
     *
     * @return string
     */
    public function getFillRule()
    {
        return $this->getOption('fillRule', 'evenodd');
    }

    /**
     * Bring path to the front.
     *
     * @return $this
     * @see    http://leafletjs.com/reference.html#path-bringtofront
     */
    public function bringToFront()
    {
        return $this->addMethod('bringToFront');
    }

    /**
     * Bring path to the back.
     *
     * @return $this
     * @see    http://leafletjs.com/reference.html#path-bringtoback
     */
    public function bringToBack()
    {
        return $this->addMethod('bringToBack');
    }

    /**
     * Redraw the path.
     *
     * @return $this
     * @see    http://leafletjs.com/reference.html#path-redraw
     */
    public function redraw()
    {
        return $this->addMethod('redraw');
    }

    /**
     * {@inheritdoc}
     */
    public function convertsFullyToGeoJson()
    {
        return true;
    }
}
