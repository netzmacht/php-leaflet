<?php

/**
 * @package    dev
 * @author     David Molineus <david.molineus@netzmacht.de>
 * @copyright  2015 netzmacht creative David Molineus
 * @license    LGPL 3.0
 * @filesource
 *
 */

namespace Netzmacht\LeafletPHP\Plugins\Ajax;

use Netzmacht\Javascript\Encoder;
use Netzmacht\Javascript\Type\Call\AnonymousFunction;
use Netzmacht\Javascript\Type\ConvertsToJavascript;
use Netzmacht\Javascript\Type\Value\Expression;
use Netzmacht\LeafletPHP\Definition\Group\FeatureGroup;
use Netzmacht\LeafletPHP\Definition\OptionsTrait;
use Netzmacht\LeafletPHP\Definition\Vector\PathOptionsTrait;

/**
 * Class GeoJsonAjax represents the Leaflet ajax pluging for geojson data.
 *
 * @package Netzmacht\LeafletPHP\Plugins\Ajax
 * @see     https://github.com/calvinmetcalf/leaflet-ajax
 */
class GeoJsonAjax extends FeatureGroup implements ConvertsToJavascript
{
    use OptionsTrait;
    use PathOptionsTrait;

    const EVENT_DATA_LOADING = 'data:loading';

    const EVENT_DATA_PROGRESS = 'data:progress';

    const EVENT_DATA_LOADED = 'data:loaded';

    /**
     * {@inheritdoc}
     */
    public static function getType()
    {
        return 'Ajax';
    }

    /**
     * Set point to layer function.
     *
     * @param Expression|AnonymousFunction $function The function callback.
     *
     * @return $this
     */
    public function setPointToLayer($function)
    {
        return $this->setOption('pointToLayer', $function);
    }

    /**
     * Set on each feature function.
     *
     * @param Expression|AnonymousFunction $function The function callback.
     *
     * @return $this
     */
    public function setOnEachFeature($function)
    {
        return $this->setOption('onEachFeature', $function);
    }

    /**
     * {@inheritdoc}
     */
    public static function getRequiredLibraries()
    {
        $libs   = parent::getRequiredLibraries();
        $libs[] = 'leaflet-ajax';

        return $libs;
    }

    /**
     * Url to load.
     *
     * @var string
     */
    private $url;

    /**
     * Get the ajax url.
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set ajax url.
     *
     * @param string $url Ajax url.
     *
     * @return $this
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Set the data type option.
     *
     * @param string $dataType The data type option.
     *
     * @return $this
     */
    public function setDataType($dataType)
    {
        return $this->setOption('dataType', $dataType);
    }

    /**
     * Get the data type option.
     *
     * @return string|null
     */
    public function getDataType()
    {
        return $this->getOption('dataType');
    }

    /**
     * {@inheritdoc}
     */
    public function encode(Encoder $encoder, $finish = true)
    {
        return sprintf(
            '%s = L.geoJson.ajax(%s)%s',
            $encoder->encodeReference($this),
            $encoder->encodeArguments(
                array(
                    $this->url,
                    $this->getOptions()
                )
            ),
            $finish ? ';' : ''
        );
    }
}
