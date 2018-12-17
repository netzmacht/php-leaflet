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
use Netzmacht\LeafletPHP\Definition\EventsTrait;
use Netzmacht\LeafletPHP\Definition\HasEvents;
use Netzmacht\LeafletPHP\Definition\HasOptions;
use Netzmacht\LeafletPHP\Definition\LabelTrait;
use Netzmacht\LeafletPHP\Definition\OptionsTrait;

/**
 * Class TileLayer.
 *
 * @package Netzmacht\LeafletPHP\Definition\Raster
 *
 * @SuppressWarnings(PHPMD.ExcessivePublicCount)
 */
class TileLayer extends AbstractLayer implements HasEvents, HasOptions
{
    use LabelTrait;
    use OptionsTrait;
    use EventsTrait;

    /**
     * The loading event.
     *
     * @see http://leafletjs.com/reference.html#tilelayer-loading
     */
    const EVENT_LOADING = 'loading';

    /**
     * The load event.
     *
     * @see http://leafletjs.com/reference.html#tilelayer-load
     */
    const EVENT_LOAD = 'load';

    /**
     * The tileloadstart event.
     *
     * @see http://leafletjs.com/reference.html#tilelayer-tileloadstart
     */
    const EVENT_TILE_LOAD_START = 'tileloadstart';

    /**
     * The tileload event.
     *
     * @see http://leafletjs.com/reference.html#tilelayer-tileload
     */
    const EVENT_TILE_LOAD = 'tileload';

    /**
     * The tileunload event.
     *
     * @see http://leafletjs.com/reference.html#tilelayer-tileunload
     */
    const EVENT_TILE_UNLOAD = 'tileunload';

    /**
     * Tile url template.
     *
     * @var string
     */
    private $url;

    /**
     * Construct.
     *
     * @param string $identifier The unique identifier.
     * @param string $url        Tile url template.
     */
    public function __construct($identifier, $url)
    {
        parent::__construct($identifier);

        $this->url = $url;
    }

    /**
     * Get the type of the definition.
     *
     * @return mixed
     */
    public static function getType()
    {
        return 'TileLayer';
    }

    /**
     * Set the tile url template.
     *
     * @param string $url Tile url template.
     *
     * @return $this
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get the tile url template.
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set the min zoom.
     *
     * @param int $zoom The zoom level.
     *
     * @return $this
     */
    public function setMinZoom($zoom)
    {
        return $this->setOption('minZoom', (int) $zoom);
    }

    /**
     * Get the min zoom level.
     *
     * @return int
     */
    public function getMinZoom()
    {
        return $this->getOption('minZoom', 18);
    }

    /**
     * Set the max zoom.
     *
     * @param int $zoom The zoom level.
     *
     * @return $this
     * @see    http://leafletjs.com/reference.html#tilelayer-minzoom
     */
    public function setMaxZoom($zoom)
    {
        return $this->setOption('maxZoom', (int) $zoom);
    }

    /**
     * Get the max zoom level.
     *
     * @return int
     * @see    http://leafletjs.com/reference.html#tilelayer-maxzoom
     */
    public function getMaxZoom()
    {
        return $this->getOption('maxZoom', 18);
    }

    /**
     * Set the max native zoom.
     *
     * @param int $zoom The zoom level.
     *
     * @return $this
     * @see    http://leafletjs.com/reference.html#tilelayer-maxnativezoom
     */
    public function setMaxNativeZoom($zoom)
    {
        return $this->setOption('maxNativeZoom', (int) $zoom);
    }

    /**
     * Get the max zoom level.
     *
     * @return int
     */
    public function getMaxNativeZoom()
    {
        return $this->getOption('maxNativeZoom', 18);
    }

    /**
     * Set the tile size.
     *
     * @param int $size The tile size in pixel.
     *
     * @return $this
     * @see    http://leafletjs.com/reference.html#tilelayer-tilesize
     */
    public function setTileSize($size)
    {
        return $this->setOption('tileSize', (int) $size);
    }

    /**
     * Get the tile size.
     *
     * @return int
     */
    public function getTileSize()
    {
        return $this->getOption('tileSize', 256);
    }
    
    /**
     * Set the tile size.
     *
     * @param string|array $subdomains Subdomains of the tile layer.
     *
     * @return $this
     * @see    http://leafletjs.com/reference.html#tilelayer-sudomains
     */
    public function setSudomains($subdomains)
    {
        return $this->setOption('sudomains', $subdomains);
    }

    /**
     * Get the subdomains.
     *
     * @return array|string
     * @see    http://leafletjs.com/reference.html#tilelayer-sudomains
     */
    public function getSudomains()
    {
        return $this->getOption('sudomains', 'abc');
    }

    /**
     * Set the tile size.
     *
     * @param string $errorTileUrl Url to the image in place of the tile that failed to load.
     *
     * @return $this
     * @see    http://leafletjs.com/reference.html#tilelayer-errortileurl
     */
    public function setErrorTileUrl($errorTileUrl)
    {
        return $this->setOption('errorTileUrl', $errorTileUrl);
    }

    /**
     * Get the error tile url.
     *
     * @return string
     * @see    http://leafletjs.com/reference.html#tilelayer-errortileurl
     */
    public function getErrorTileUrl()
    {
        return $this->getOption('errorTileUrl', '');
    }

    /**
     * Set the attribution.
     *
     * @param string $attribution Attribution string which is added to the attribution control.
     *
     * @return $this
     * @see    http://leafletjs.com/reference.html#tilelayer-attribution
     */
    public function setAttribution($attribution)
    {
        return $this->setOption('attribution', $attribution);
    }

    /**
     * Get the attribution.
     *
     * @return string
     * @see    http://leafletjs.com/reference.html#tilelayer-attribution
     */
    public function getAttribution()
    {
        return $this->getOption('attribution', '');
    }

    /**
     * Set the tms.
     *
     * @param bool $tms Inverse the y axis for TMS services.
     *
     * @return $this
     * @see    http://leafletjs.com/reference.html#tilelayer-tms
     */
    public function setTms($tms)
    {
        return $this->setOption('tms', (bool) $tms);
    }

    /**
     * Get the tms.
     *
     * @return bool
     * @see    http://leafletjs.com/reference.html#tilelayer-tms
     */
    public function isTms()
    {
        return $this->getOption('tms', false);
    }

    /**
     * Set the continuous world.
     *
     * @param bool $continuousWorld If truw the coordinates won't be wrapped by world width.
     *
     * @return $this
     * @see    http://leafletjs.com/reference.html#tilelayer-continuousworld
     */
    public function setContinuousWorld($continuousWorld)
    {
        return $this->setOption('continuousWorld', (bool) $continuousWorld);
    }

    /**
     * Get the continuous world.
     *
     * @return bool
     * @see    http://leafletjs.com/reference.html#tilelayer-continuousworld
     */
    public function isContinuousWorld()
    {
        return $this->getOption('continuousWorld', false);
    }

    /**
     * Set the no wrap option.
     *
     * @param bool $noWrap If true no tiles outside of the world are loaded.
     *
     * @return $this
     * @see    http://leafletjs.com/reference.html#tilelayer-nowrap
     */
    public function setNoWrap($noWrap)
    {
        return $this->setOption('noWrap', (bool) $noWrap);
    }

    /**
     * Check if no wrap is enabled.
     *
     * @return bool
     * @see    http://leafletjs.com/reference.html#tilelayer-nowrap
     */
    public function isNoWrap()
    {
        return $this->getOption('noWrap', false);
    }

    /**
     * Set the zoom offset.
     *
     * @param int $zoom The zoom offset.
     *
     * @return $this
     * @see    http://leafletjs.com/reference.html#tilelayer-zoomoffset
     */
    public function setZoomOffset($zoom)
    {
        return $this->setOption('zoomOffset', (int) $zoom);
    }

    /**
     * Get the zoom offset.
     *
     * @return int
     */
    public function getZoomOffset()
    {
        return $this->getOption('zoomOffset', 0);
    }

    /**
     * Set the zoom reverse.
     *
     * @param bool $value The zoom reverse.
     *
     * @return $this
     * @see    http://leafletjs.com/reference.html#tilelayer-zoomreverse
     */
    public function setZoomReverse($value)
    {
        return $this->setOption('zoomReverse', (bool) $value);
    }

    /**
     * Get the zoom reverse.
     *
     * @return bool
     */
    public function isZoomReverse()
    {
        return $this->getOption('zoomReverse', false);
    }

    /**
     * Set the opacity.
     *
     * @param float $value The opacity.
     *
     * @return $this
     * @see    http://leafletjs.com/reference.html#tilelayer-opacity
     */
    public function setOpacity($value)
    {
        return $this->setOption('opacity', (float) $value);
    }

    /**
     * Get opacity.
     *
     * @return float
     * @see    http://leafletjs.com/reference.html#tilelayer-opacity
     */
    public function getOpacity()
    {
        return $this->getOption('opacity', 1.0);
    }

    /**
     * Set the zIndex.
     *
     * @param float $value The zIndex.
     *
     * @return $this
     * @see    http://leafletjs.com/reference.html#tilelayer-zindex
     */
    public function setZIndex($value)
    {
        return $this->setOption('zindex', (float) $value);
    }

    /**
     * Get the zindex.
     *
     * @return float
     * @see    http://leafletjs.com/reference.html#tilelayer-zindex
     */
    public function getZIndex()
    {
        return $this->getOption('zindex', 1.0);
    }

    /**
     * Set the unload visible tiles.
     *
     * @param bool $value Unload visible tiles.
     *
     * @return $this
     * @see    http://leafletjs.com/reference.html#tilelayer-unloadvisibletiles
     */
    public function setUnloadvisibleTiles($value)
    {
        return $this->setOption('unloadvisibletiles', (bool) $value);
    }

    /**
     * Get the unloadvisibletiles.
     *
     * @return bool
     * @see    http://leafletjs.com/reference.html#tilelayer-unloadvisibletiles
     */
    public function isUnloadvisibleTiles()
    {
        return $this->getOption('unloadvisibletiles', false);
    }

    /**
     * Set the unload visible tiles.
     *
     * @param bool $value Unload visible tiles.
     *
     * @return $this
     * @see    http://leafletjs.com/reference.html#tilelayer-updatewhenidle
     */
    public function setUpdateWhenIdle($value)
    {
        return $this->setOption('updateWhenIdle', (bool) $value);
    }

    /**
     * Get the updatewhenidle.
     *
     * @return bool
     * @see    http://leafletjs.com/reference.html#tilelayer-updatewhenidle
     */
    public function isUpdateWhenIdle()
    {
        return $this->getOption('updateWhenIdle', false);
    }

    /**
     * Set the retina detection.
     *
     * @param bool $value Enable or disable detection.
     *
     * @return $this
     * @see    http://leafletjs.com/reference.html#tilelayer-detectretina
     */
    public function setDetectRetina($value)
    {
        return $this->setOption('detectRetina', (bool) $value);
    }

    /**
     * Get the retina detection.
     *
     * @return bool
     * @see    http://leafletjs.com/reference.html#tilelayer-detectretina
     */
    public function isDetectRetina()
    {
        return $this->getOption('detectRetina', false);
    }

    /**
     * Reuse tiles..
     *
     * @param float $value Enable or disable detection.
     *
     * @return $this
     * @see    http://leafletjs.com/reference.html#tilelayer-reusetiles
     */
    public function setReuseTiles($value)
    {
        return $this->setOption('reuseTiles', (bool) $value);
    }

    /**
     * Get the retina detection.
     *
     * @return float
     * @see    http://leafletjs.com/reference.html#tilelayer-reusetiles
     */
    public function isReuseTiles()
    {
        return $this->getOption('reuseTiles', false);
    }

    /**
     * Set bound of the tile layer.
     *
     * @param array $value Load The tile layer is only for the given bounds.
     *
     * @return $this
     * @see    http://leafletjs.com/reference.html#tilelayer-bounds
     */
    public function setBounds($value)
    {
        return $this->setOption('bounds', $value);
    }

    /**
     * Get the bounds.
     *
     * @return array|null
     * @see    http://leafletjs.com/reference.html#tilelayer-bounds
     */
    public function getBounds()
    {
        return $this->getOption('bounds', null);
    }

    /**
     * Forces the generated Javascript tile object to redraw all tiles.
     *
     * @return $this
     * @see    http://leafletjs.com/reference.html#tilelayer-redraw
     */
    public function redraw()
    {
        return $this->addMethod('redraw');
    }
}
