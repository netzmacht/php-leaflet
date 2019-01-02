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

namespace Netzmacht\LeafletPHP\Test\Encoder;

use Netzmacht\JavascriptBuilder\Type\AnonymousFunction;
use Netzmacht\LeafletPHP\Definition\UI\Popup;
use Netzmacht\LeafletPHP\Test\TestCase;

final class UIEncoderTest extends TestCase
{
    public function testPopupMethodsAreRendered()
    {
        $popup = new Popup('popup');
        $popup->on('add', (new AnonymousFunction())->addLine('console.log("add");'));

        $builder = $this->getBuilder();

        $this->assertSame(
            'layers.popup = L.popup([]);'
            . "\n"
            . 'layers.popup.on("add", function() { console.log("add"); });',
            $builder->encode($popup)
        );
    }
}
