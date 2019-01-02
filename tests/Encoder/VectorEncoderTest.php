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

use Netzmacht\LeafletPHP\Definition\Vector\Circle;
use Netzmacht\LeafletPHP\Test\TestCase;
use Netzmacht\LeafletPHP\Value\LatLng;

final class VectorEncoderTest extends TestCase
{
    public function testCircleIsEncoded()
    {
        $circle = new Circle('circle');
        $circle->setLatLng(new LatLng(50.2, 21.0));
        $circle->setRadius(500);
        $circle->setFillRule('evenodd');

        $builder = $this->getBuilder();

        $this->assertSame(
            'layers.circle = L.circle([50.2,21], 500, {fillRule: "evenodd"});',
            $builder->encode($circle)
        );
    }
}
