<?php

/**
 * @package    dev
 * @author     David Molineus <david.molineus@netzmacht.de>
 * @copyright  2014 netzmacht creative David Molineus
 * @license    LGPL 3.0
 * @filesource
 *
 */

namespace Netzmacht\LeafletPHP\Assets;

use Netzmacht\LeafletPHP\Assets;

class SimpleAssets extends AbstractAssets
{
    /**
     * Add a javascript.
     *
     * @param string $script Javascript source.
     * @param string $type   The resource type.
     *
     * @return void
     */
    public function addJavascript($script, $type = self::TYPE_SOURCE)
    {
        switch($type) {
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
     * Add a stylesheet.
     *
     * @param string $stylesheet The stylesheet.
     * @param string $type       The resource type.
     *
     * @return void
     */
    public function addStylesheet($stylesheet, $type = self::TYPE_FILE)
    {
        switch($type) {
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
    }
}