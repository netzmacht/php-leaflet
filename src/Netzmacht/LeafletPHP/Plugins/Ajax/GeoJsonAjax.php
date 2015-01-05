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
use Netzmacht\Javascript\Type\ConvertsToJavascript;
use Netzmacht\LeafletPHP\Definition\AbstractDefinition;
use Netzmacht\LeafletPHP\Definition\EventsTrait;
use Netzmacht\LeafletPHP\Definition\HasEvents;
use Netzmacht\LeafletPHP\Definition\LabelTrait;
use Netzmacht\LeafletPHP\Definition\Layer;
use Netzmacht\LeafletPHP\Definition\OptionsTrait;

/**
 * Class GeoJsonAjax
 *
 * @package Netzmacht\LeafletPHP\Plugins\Ajax
 */
class GeoJsonAjax extends AbstractDefinition implements Layer, HasEvents, ConvertsToJavascript
{
    use LabelTrait;
    use EventsTrait;
    use OptionsTrait;

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
