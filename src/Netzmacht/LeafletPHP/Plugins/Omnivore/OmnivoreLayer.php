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

namespace Netzmacht\LeafletPHP\Plugins\Omnivore;

use Netzmacht\JavascriptBuilder\Encoder;
use Netzmacht\JavascriptBuilder\Type\Call\MethodCall;
use Netzmacht\JavascriptBuilder\Type\ConvertsToJavascript;
use Netzmacht\LeafletPHP\Assert\Assertion;
use Netzmacht\LeafletPHP\Definition\AbstractLayer;
use Netzmacht\LeafletPHP\Definition\EventsTrait;
use Netzmacht\LeafletPHP\Definition\HasEvents;
use Netzmacht\LeafletPHP\Definition\Layer;
use Netzmacht\LeafletPHP\Definition\OptionsTrait;
use Netzmacht\LeafletPHP\Encoder\EncodeHelperTrait;

/**
 * Class OmnivoreLayer is the base omnivore layer providing support for a custom layer and options.
 *
 * @package Netzmacht\LeafletPHP\Plugins\Omnivore
 */
abstract class OmnivoreLayer extends AbstractLayer implements ConvertsToJavascript, HasEvents
{
    use OptionsTrait;
    use EventsTrait;
    use EncodeHelperTrait;

    /**
     * {@inheritdoc}
     */
    public static function getRequiredLibraries()
    {
        $libs   = parent::getRequiredLibraries();
        $libs[] = 'leaflet-omnivore';

        return $libs;
    }

    /**
     * The url being loaded.
     *
     * @var string
     */
    private $url;

    /**
     * Custom layer.
     *
     * @var Layer
     */
    private $customLayer;

    /**
     * Construct.
     *
     * @param string $identifier    The element id.
     * @param string $url           The url being loaded.
     * @param array  $parserOptions Parser options.
     * @param Layer  $customLayer   Optional custom layer.
     */
    public function __construct($identifier, $url, array $parserOptions = array(), Layer $customLayer = null)
    {
        parent::__construct($identifier);

        $this->customLayer = $customLayer;
        $this->url         = $url;

        $this->setOptions($parserOptions);
    }

    /**
     * Get the url.
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set the url.
     *
     * @param string $url The url being loaded.
     *
     * @return $this
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get the custom layer.
     *
     * @return Layer|null
     */
    public function getCustomLayer()
    {
        return $this->customLayer;
    }

    /**
     * Set the custom layer.
     *
     * @param Layer $customLayer The custom layer.
     *
     * @return $this
     */
    public function setCustomLayer(Layer $customLayer)
    {
        Assertion::count($this->getMethodCalls(), 0, 'Setting custom layer has to be done before any method call.');

        $this->customLayer = $customLayer;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    protected function addMethod($name, array $arguments = array())
    {
        if ($this->getCustomLayer()) {
            $this->methods[] = new MethodCall($this->getCustomLayer(), $name, $arguments);
        } else {
            parent::addMethod($name, $arguments);
        }

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function encode(Encoder $encoder, $flags = null)
    {
        $template = '%s(%s, %s, %s)%s';
        $buffer   = '';

        if ($this->getCustomLayer()) {
            $ref = $encoder->encodeReference($this->getCustomLayer());
        } else {
            $template = $encoder->encodeReference($this) . ' = ' . $template;
            $ref      = 'null';
        }

        $buffer .= sprintf(
            $template,
            strtolower(static::getType()),
            $encoder->encodeValue($this->getUrl()),
            $encoder->encodeArray($this->getOptions(), JSON_FORCE_OBJECT),
            $ref,
            $encoder->close($flags)
        );

        $buffer .= $this->encodeMethodCalls($this->getMethodCalls(), $encoder, $flags);

        return $buffer;
    }
}
