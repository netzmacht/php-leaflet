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

namespace Netzmacht\LeafletPHP\Test;

use Netzmacht\JavascriptBuilder\Builder;
use Netzmacht\JavascriptBuilder\Encoder\ChainEncoder;
use Netzmacht\JavascriptBuilder\Encoder\JavascriptEncoder;
use Netzmacht\JavascriptBuilder\Encoder\MultipleObjectsEncoder;
use Netzmacht\JavascriptBuilder\Output;
use Netzmacht\JavascriptBuilder\Symfony\EventDispatchingEncoder;
use Netzmacht\LeafletPHP\Encoder\ControlEncoder;
use Netzmacht\LeafletPHP\Encoder\GroupEncoder;
use Netzmacht\LeafletPHP\Encoder\MapEncoder;
use Netzmacht\LeafletPHP\Encoder\RasterEncoder;
use Netzmacht\LeafletPHP\Encoder\TypeEncoder;
use Netzmacht\LeafletPHP\Encoder\UIEncoder;
use Netzmacht\LeafletPHP\Encoder\VectorEncoder;
use PHPUnit\Framework\TestCase as PHPUnitTestCase;
use Symfony\Component\EventDispatcher\EventDispatcher;
use const JSON_UNESCAPED_SLASHES;

class TestCase extends PHPUnitTestCase
{
    protected function getBuilder()
    {
        $dispatcher = new EventDispatcher();

        $dispatcher->addSubscriber(new ControlEncoder());
        $dispatcher->addSubscriber(new GroupEncoder());
        $dispatcher->addSubscriber(new MapEncoder());
        $dispatcher->addSubscriber(new RasterEncoder());
        $dispatcher->addSubscriber(new TypeEncoder());
        $dispatcher->addSubscriber(new UIEncoder());
        $dispatcher->addSubscriber(new VectorEncoder());

        $factory = function (Output $output) use ($dispatcher) {
            $encoder = new ChainEncoder();

            $encoder->register(new MultipleObjectsEncoder());
            $encoder->register(new EventDispatchingEncoder($dispatcher));
            $encoder->register(new JavascriptEncoder($output, JSON_UNESCAPED_SLASHES));

            return $encoder;
        };

        return new Builder($factory);
    }
}
