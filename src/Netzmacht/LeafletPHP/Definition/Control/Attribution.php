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

namespace Netzmacht\LeafletPHP\Definition\Control;

/**
 * Attribution control.
 *
 * @package Netzmacht\LeafletPHP\Definition\Control
 */
class Attribution extends AbstractControl
{
    /**
     * Attributions.
     *
     * @var array
     */
    private $attributions = array();

    /**
     * {@inheritdoc}
     */
    public static function getType()
    {
        return 'Control.Attribution';
    }

    /**
     * Set the prefix.
     *
     * @param string $prefix The attribution prefix.
     *
     * @return $this
     * @see    http://leafletjs.com/reference.html#control-attribution-prefix
     */
    public function setPrefix($prefix)
    {
        return $this->setOption('prefix', $prefix);
    }

    /**
     * Get the prefix.
     *
     * @return string
     * @see    http://leafletjs.com/reference.html#control-attribution-prefix
     */
    public function getPrefix()
    {
        return $this->getOption('prefix', 'Leaflet');
    }

    /**
     * Add a attribution.
     *
     * @param string $attribution Attribution text. Can contain html.
     *
     * @return $this
     * @see    http://leafletjs.com/reference.html#control-attribution-addattribution
     */
    public function addAttribution($attribution)
    {
        $this->attributions[] = $attribution;

        return $this;
    }

    /**
     * Remove attribution.
     *
     * @param string $attribution The attribution.
     *
     * @return $this
     */
    public function removeAttribution($attribution)
    {
        $key = array_search($attribution, $this->attributions);

        if ($key !== false) {
            unset($this->attributions[$key]);
        } else {
            $this->addMethod('removeAttribution', array($attribution));
        }

        return $this;
    }

    /**
     * Get all attributions.
     *
     * @return array
     */
    public function getAttributions()
    {
        return $this->attributions;
    }
}
