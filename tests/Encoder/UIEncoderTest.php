<?php

namespace Netzmacht\LeafletPHP\Test\Encoder;

use Netzmacht\JavascriptBuilder\Type\AnonymousFunction;
use Netzmacht\LeafletPHP\Definition\UI\Popup;
use Netzmacht\LeafletPHP\Test\TestCase;

class UIEncoderTest extends TestCase
{
    public function testPopupMethodsAreRendered()
    {
        $leaflet = $this->getBuilder();

        $popup = new Popup('popup');
        $popup->on('add', (new AnonymousFunction())->addLine('console.log("add");'));

        $this->assertSame(
            'layers.popup = L.popup([]);'
            . "\n"
            . 'layers.popup.on("add", function() { console.log("add"); });',
            $leaflet->encode($popup)
        );
    }
}
