<?php

/**
 * @package    dev
 * @author     David Molineus <david.molineus@netzmacht.de>
 * @copyright  2015 netzmacht creative David Molineus
 * @license    LGPL 3.0
 * @filesource
 *
 */

namespace Netzmacht\LeafletPHP\Plugins\Omnivore;

use Netzmacht\Javascript\Type\ConvertsToJavascript;
use Netzmacht\LeafletPHP\Definition\AbstractDefinition;
use Netzmacht\LeafletPHP\Definition\EventsTrait;
use Netzmacht\LeafletPHP\Definition\HasEvents;
use Netzmacht\LeafletPHP\Definition\LabelTrait;
use Netzmacht\LeafletPHP\Definition\Layer;

/**
 * Class OmnivoreLayer is the base layer class for the omnivore layers.
 *
 * @package Netzmacht\LeafletPHP\Plugins\Omnivore
 */
abstract class OmnivoreLayer extends AbstractDefinition implements Layer, ConvertsToJavascript, HasEvents
{
    use LabelTrait;
    use EventsTrait;

    /**
     * The url being loaded.
     *
     * @var string
     */
    private $url;

    /**
     * Construct.
     *
     * @param string $identifier The element id.
     * @param string $url        The url being loaded.
     */
    public function __construct($identifier, $url)
    {
        parent::__construct($identifier);

        $this->url = $url;
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
}
