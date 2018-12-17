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

/**
 * Class SimpleAssets is a simple assets implementation.
 *
 * @package Netzmacht\LeafletPHP\Assets
 */
class SimpleAssets extends AbstractAssets
{
    /**
     * {@inheritdoc}
     */
    public function addJavascript($script, $type = self::TYPE_SOURCE)
    {
        switch ($type) {
            case static::TYPE_FILE:
                $this->appendScript(sprintf('<script src="%s"></script>', $script));
                break;

            case static::TYPE_URL:
                $this->appendScript(sprintf('<script src="%s"></script>', $script));
                break;

            default:
                $this->appendScript(sprintf('<script>%s</script>', $script));
                break;
        }
    }

    /**
     * {@inheritdoc}
     */
    public function addStylesheet($stylesheet, $type = self::TYPE_FILE)
    {
        switch ($type) {
            case static::TYPE_FILE:
                $this->appendStyle(sprintf('<link rel="stylesheet" href="%s"></script>', $stylesheet));
                break;

            case static::TYPE_URL:
                $this->appendStyle(sprintf('<link rel="stylesheet" href="%s"></script>', $stylesheet));
                break;

            default:
                $this->appendStyle(sprintf('<style>%s</style>', $stylesheet));
                break;
        }

        return $this;
    }
}
