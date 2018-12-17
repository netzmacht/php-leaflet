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

namespace Netzmacht\LeafletPHP\Encoder;

use Netzmacht\JavascriptBuilder\Encoder;
use Netzmacht\JavascriptBuilder\Symfony\Event\EncodeReferenceEvent;
use Netzmacht\LeafletPHP\Definition;
use Netzmacht\LeafletPHP\Definition\Layer;
use Netzmacht\LeafletPHP\Definition\Raster\TileLayer;

/**
 * Class RasterEncoder encodes raster layers.
 *
 * @package Netzmacht\LeafletPHP\Encoder
 */
class RasterEncoder extends AbstractEncoder
{
    /**
     * {@inheritdoc}
     */
    public function setReference(Definition $definition, EncodeReferenceEvent $event)
    {
        if ($definition instanceof Layer) {
            $event->setReference('layers.' . $definition->getId());
        }
    }

    /**
     * Encode a tile layer.
     *
     * @param TileLayer $layer   The layer.
     * @param Encoder   $builder The builder.
     *
     * @return bool
     */
    public function encodeTileLayer(TileLayer $layer, Encoder $builder)
    {
        return sprintf(
            '%s = L.tileLayer(%s);',
            $builder->encodeReference($layer),
            $builder->encodeArguments(array($layer->getUrl(), $layer->getOptions()))
        );
    }
}
