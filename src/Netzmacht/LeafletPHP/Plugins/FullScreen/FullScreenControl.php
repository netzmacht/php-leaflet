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

namespace Netzmacht\LeafletPHP\Plugins\FullScreen;

use Netzmacht\JavascriptBuilder\Encoder;
use Netzmacht\JavascriptBuilder\Type\ConvertsToJavascript;
use Netzmacht\LeafletPHP\Definition\Control\AbstractControl;
use Netzmacht\LeafletPHP\Definition\Map;
use Netzmacht\LeafletPHP\Encoder\EncodeHelperTrait;

/**
 * Class FullScreenControl integrates the fullscreen button of https://github.com/brunob/leaflet.fullscreen.
 *
 * @package Netzmacht\LeafletPHP\Plugins\FullScreen
 */
class FullScreenControl extends AbstractControl implements ConvertsToJavascript
{
    use EncodeHelperTrait;

    const MAP_EVENT_ENTER_FULLSCREEN = 'enterFullscreen';

    const MAP_EVENT_EXIT_FULLSCREEN = 'exitFullscreen';

    /**
     * Default position.
     *
     * @var string
     */
    protected $defaultPosition = self::POSITION_TOP_LEFT;

    /**
     * {@inheritdoc}
     */
    public static function getType()
    {
        return 'Control.FullScreen';
    }

    /**
     * {@inheritdoc}
     */
    public static function getRequiredLibraries()
    {
        $libs   = parent::getRequiredLibraries();
        $libs[] = 'leaflet-fullscreen';

        return $libs;
    }

    /**
     * Set the button title.
     *
     * @param string $title The button title.
     *
     * @return $this
     */
    public function setTitle($title)
    {
        return $this->setOption('title', $title);
    }

    /**
     * Get the button title.
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->getOption('title');
    }

    /**
     * Set force separate button option.
     *
     * @param bool $force If true the control button is displayed standalone.
     *
     * @return $this
     */
    public function setForceSeparateButton($force)
    {
        return $this->setOption('forceSeparateButton', (bool) $force);
    }

    /**
     * Check if force separate button option is set.
     *
     * @return $this
     */
    public function isForceSeparateButton()
    {
        return $this->getOption('forceSeparateButton', false);
    }

    /**
     * Set force separate button option.
     *
     * @param bool $force If true the control button is displayed standalone.
     *
     * @return $this
     */
    public function setForcePseudoFullScreen($force)
    {
        return $this->setOption('forcePseudoFullscreen', (bool) $force);
    }

    /**
     * Check if force separate button option is set.
     *
     * @return $this
     */
    public function isForcePseudoFullScreen()
    {
        return $this->getOption('forcePseudoFullscreen', false);
    }

    /**
     * {@inheritdoc}
     */
    public function encode(Encoder $encoder, $flags = null)
    {
        return $this->encodeSimpleControl('control.fullscreen', $this, $encoder, $flags);
    }
}
