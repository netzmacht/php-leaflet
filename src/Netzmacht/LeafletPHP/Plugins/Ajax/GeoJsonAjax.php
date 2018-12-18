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

namespace Netzmacht\LeafletPHP\Plugins\Ajax;

use Netzmacht\JavascriptBuilder\Encoder;
use Netzmacht\JavascriptBuilder\Type\AnonymousFunction;
use Netzmacht\JavascriptBuilder\Type\ConvertsToJavascript;
use Netzmacht\JavascriptBuilder\Type\Expression;
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
     * Urls to load.
     *
     * @var array
     */
    private $urls = array();

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
     * Set ajax url which is used for the constructor.
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
     * Add url via call addUrl method.
     *
     * @param string $url Url being added.
     *
     * @return $this
     */
    public function addUrl($url)
    {
        $this->urls[] = $url;

        $this->addMethod('addUrl', $url);

        return $this;
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
    public function encode(Encoder $encoder, $flags = true)
    {
        $buffer = sprintf(
            '%s = L.geoJson.ajax(%s)%s',
            $encoder->encodeReference($this),
            $encoder->encodeArguments(
                array(
                    $this->url,
                    $this->getOptions()
                )
            ),
            $encoder->close($flags)
        );

        foreach ($this->getLayers() as $layer) {
            $buffer .= "\n";
            $buffer .= sprintf(
                '%s.addLayer(%s);',
                $encoder->encodeReference($this),
                $encoder->encodeReference($layer)
            );
        }

        return $buffer;
    }

    /**
     * {@inheritdoc}
     */
    public function convertsFullyToGeoJson()
    {
        return false;
    }
}
