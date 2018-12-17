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

namespace Netzmacht\LeafletPHP\Assets;

use Netzmacht\JavascriptBuilder\Symfony\Event\EncodeValueEvent;
use Netzmacht\LeafletPHP\Assets;
use Netzmacht\LeafletPHP\Definition;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Class LibrariesCollector is used to collect all required libraries of the compiled map.
 *
 * @package Netzmacht\LeafletPHP
 */
class Collector implements EventSubscriberInterface
{
    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return array(
            EncodeValueEvent::NAME => 'collect'
        );
    }

    /**
     * Assets instance.
     *
     * @var Assets
     */
    private $assets;

    /**
     * Library stylesheets.
     *
     * @var array
     */
    private $stylesheets = array();

    /**
     * Library javascripts.
     *
     * @var array
     */
    private $javascripts = array();

    /**
     * Already added libraries.
     *
     * @var array
     */
    private $libraries = array();

    /**
     * Construct.
     *
     * @param Assets $assets      The assets instance.
     * @param array  $javascripts Registered javascripts.
     * @param array  $stylesheets Registered stylesheets.
     */
    public function __construct(Assets $assets, array $javascripts, array $stylesheets)
    {
        $this->assets      = $assets;
        $this->javascripts = $javascripts;
        $this->stylesheets = $stylesheets;
    }

    /**
     * Collect all libraries.
     *
     * @param EncodeValueEvent $event The subscribed event.
     *
     * @return void
     */
    public function collect(EncodeValueEvent $event)
    {
        $value = $event->getValue();

        if ($value instanceof Definition) {
            foreach ($value->getRequiredLibraries() as $library) {
                if (isset($this->libraries[$library])) {
                    continue;
                }

                if (isset($this->stylesheets[$library])) {
                    foreach ($this->stylesheets[$library] as $asset) {
                        $this->assets->addStylesheet($asset[0], $asset[1]);
                    }
                }

                if (isset($this->javascripts[$library])) {
                    foreach ($this->javascripts[$library] as $asset) {
                        $this->assets->addJavascript($asset[0], $asset[1]);
                    }
                }

                $this->libraries[$library] = true;
            }
        }
    }
}
