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

namespace Netzmacht\LeafletPHP\Plugins\MarkerCluster;

use Netzmacht\JavascriptBuilder\Encoder;
use Netzmacht\JavascriptBuilder\Type\AnonymousFunction;
use Netzmacht\JavascriptBuilder\Type\ConvertsToJavascript;
use Netzmacht\JavascriptBuilder\Type\Expression;
use Netzmacht\LeafletPHP\Definition\Group\FeatureGroup;
use Netzmacht\LeafletPHP\Definition\HasOptions;
use Netzmacht\LeafletPHP\Definition\OptionsTrait;
use Netzmacht\LeafletPHP\Encoder\EncodeHelperTrait;

/**
 * Class MarkerClusterGroup is the PHP abstraction for the class of https://github.com/Leaflet/Leaflet.markercluster.
 *
 * @package Netzmacht\LeafletPHP\Plugins\MarkerCluster
 */
class MarkerClusterGroup extends FeatureGroup implements ConvertsToJavascript, HasOptions
{
    use OptionsTrait;
    use EncodeHelperTrait;

    /**
     * {@inheritdoc}
     */
    public static function getRequiredLibraries()
    {
        $libs   = parent::getRequiredLibraries();
        $libs[] = 'leaflet-markercluster';

        return $libs;
    }

    /**
     * {@inheritdoc}
     */
    public static function getType()
    {
        return 'MarkerCluster';
    }

    /**
     * Set showCoverageOnHover option.
     *
     * @param bool $value The showCoverageOnHover value.
     *
     * @return $this
     * @see    https://github.com/Leaflet/Leaflet.markercluster#all-options
     */
    public function setShowCoverageOnHover($value)
    {
        return $this->setOption('showCoverageOnHover', (bool) $value);
    }

    /**
     * Get the showCoverageOnHover option.
     *
     * @return bool
     * @see    https://github.com/Leaflet/Leaflet.markercluster#all-options
     */
    public function isShowCoverageOnHover()
    {
        return $this->getOption('showCoverageOnHover', true);
    }

    /**
     * Set zoomToBoundsOnClick option.
     *
     * @param bool $value The zoomToBoundsOnClick value.
     *
     * @return $this
     * @see    https://github.com/Leaflet/Leaflet.markercluster#all-options
     */
    public function setZoomToBoundsOnClick($value)
    {
        return $this->setOption('zoomToBoundsOnClick', (bool) $value);
    }

    /**
     * Get the zoomToBoundsOnClick option.
     *
     * @return bool
     * @see    https://github.com/Leaflet/Leaflet.markercluster#all-options
     */
    public function isZoomToBoundsOnClick()
    {
        return $this->getOption('zoomToBoundsOnClick', true);
    }

    /**
     * Set spiderfyOnMaxZoom option.
     *
     * @param bool $value The spiderfyOnMaxZoom value.
     *
     * @return $this
     * @see    https://github.com/Leaflet/Leaflet.markercluster#all-options
     */
    public function setSpiderfyOnMaxZoom($value)
    {
        return $this->setOption('spiderfyOnMaxZoom', (bool) $value);
    }

    /**
     * Get the spiderfyOnMaxZoom option.
     *
     * @return bool
     * @see    https://github.com/Leaflet/Leaflet.markercluster#all-options
     */
    public function isSpiderfyOnMaxZoom()
    {
        return $this->getOption('spiderfyOnMaxZoom', true);
    }

    /**
     * Set removeOutsideVisibleBounds option.
     *
     * @param bool $value The removeOutsideVisibleBounds value.
     *
     * @return $this
     * @see    https://github.com/Leaflet/Leaflet.markercluster#all-options
     */
    public function setRemoveOutsideVisibleBounds($value)
    {
        return $this->setOption('removeOutsideVisibleBounds', (bool) $value);
    }

    /**
     * Get the removeOutsideVisibleBounds option.
     *
     * @return bool
     * @see    https://github.com/Leaflet/Leaflet.markercluster#all-options
     */
    public function isRemoveOutsideVisibleBounds()
    {
        return $this->getOption('removeOutsideVisibleBounds', true);
    }

    /**
     * Set animateAddingMarkers option.
     *
     * @param bool $value The animateAddingMarkers value.
     *
     * @return $this
     * @see    https://github.com/Leaflet/Leaflet.markercluster#all-options
     */
    public function setAnimateAddingMarkers($value)
    {
        return $this->setOption('animateAddingMarkers', (bool) $value);
    }

    /**
     * Get the animateAddingMarkers option.
     *
     * @return bool
     * @see    https://github.com/Leaflet/Leaflet.markercluster#all-options
     */
    public function isAnimateAddingMarkers()
    {
        return $this->getOption('animateAddingMarkers', true);
    }

    /**
     * Set disableClusteringAtZoom option.
     *
     * @param int $value The disableClusteringAtZoom value.
     *
     * @return $this
     * @see    https://github.com/Leaflet/Leaflet.markercluster#all-options
     */
    public function setDisableClusteringAtZoom($value)
    {
        return $this->setOption('disableClusteringAtZoom', (int) $value);
    }

    /**
     * Get the disableClusteringAtZoom option.
     *
     * @return bool
     * @see    https://github.com/Leaflet/Leaflet.markercluster#all-options
     */
    public function isDisableClusteringAtZoom()
    {
        return $this->getOption('disableClusteringAtZoom', true);
    }

    /**
     * Set singleMarkerMode option.
     *
     * @param bool $value The singleMarkerMode value.
     *
     * @return $this
     * @see    https://github.com/Leaflet/Leaflet.markercluster#all-options
     */
    public function setSingleMarkerMode($value)
    {
        return $this->setOption('singleMarkerMode', (bool) $value);
    }

    /**
     * Get the setSingleMarkerMode option.
     *
     * @return bool
     * @see    https://github.com/Leaflet/Leaflet.markercluster#all-options
     */
    public function isSingleMarkerMode()
    {
        return $this->getOption('singleMarkerMode', false);
    }

    /**
     * Set polygon options.
     *
     * @param array $value The polygon options.
     *
     * @return $this
     * @see    https://github.com/Leaflet/Leaflet.markercluster#all-options
     */
    public function setPolygonOptions(array $value)
    {
        return $this->setOption('polygonOptions', $value);
    }

    /**
     * Get the polygon options.
     *
     * @return array|null
     * @see    https://github.com/Leaflet/Leaflet.markercluster#all-options
     */
    public function getPolygonOptions()
    {
        return $this->getOption('polygonOptions', true);
    }

    /**
     * Set maxClusterRadius option.
     *
     * @param int $value The maxClusterRadius value.
     *
     * @return $this
     * @see    https://github.com/Leaflet/Leaflet.markercluster#all-options
     */
    public function setMaxClusterRadius($value)
    {
        return $this->setOption('maxClusterRadius', (int) $value);
    }

    /**
     * Get the setMaxClusterRadius option.
     *
     * @return int
     * @see    https://github.com/Leaflet/Leaflet.markercluster#all-options
     */
    public function getMaxClusterRadius()
    {
        return $this->getOption('maxClusterRadius', 80);
    }

    /**
     * Set spiderfyDistanceMultiplier option.
     *
     * @param float $value The spiderfyDistanceMultiplier value.
     *
     * @return $this
     * @see    https://github.com/Leaflet/Leaflet.markercluster#all-options
     */
    public function setSpiderfyDistanceMultiplier($value)
    {
        return $this->setOption('spiderfyDistanceMultiplier', (float) $value);
    }

    /**
     * Get the spiderfyDistanceMultiplier option.
     *
     * @return float
     * @see    https://github.com/Leaflet/Leaflet.markercluster#all-options
     */
    public function getSpiderfyDistanceMultiplier()
    {
        return $this->getOption('spiderfyDistanceMultiplier', 1);
    }

    /**
     * Set the icon create function.
     *
     * @param Expression|AnonymousFunction $value The icon create function or expression.
     *
     * @return $this
     * @see    https://github.com/Leaflet/Leaflet.markercluster#all-options
     */
    public function setIconCreateFunction($value)
    {
        return $this->setOption('iconCreateFunction', $value);
    }

    /**
     * {@inheritdoc}
     */
    public function encode(Encoder $encoder, $flags = null)
    {
        $ref    = $encoder->encodeReference($this);
        $buffer = sprintf(
            '%s = new L.MarkerClusterGroup(%s)%s',
            $ref,
            $encoder->encodeArray($this->getOptions()),
            $encoder->close($flags)
        );

        foreach ($this->getLayers() as $layer) {
            $buffer .= "\n" . sprintf(
                '%s.addLayer(%s);',
                $ref,
                $encoder->encodeReference($layer)
            );
        }

        $buffer .= $this->encodeMethodCalls($this->getMethodCalls(), $encoder, $flags);

        return $buffer;
    }
}
