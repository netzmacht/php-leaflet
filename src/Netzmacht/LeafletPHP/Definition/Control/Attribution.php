<?php

/**
 * @package    dev
 * @author     David Molineus <david.molineus@netzmacht.de>
 * @copyright  2014 netzmacht creative David Molineus
 * @license    LGPL 3.0
 * @filesource
 *
 */

namespace Netzmacht\LeafletPHP\Definition\Control;


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
     * @see http://leafletjs.com/reference.html#control-attribution-prefix
     *
     * @param string $prefix The attribution prefix.
     *
     * @return $this
     */
    public function setPrefix($prefix)
    {
        return $this->setOption('prefix', $prefix);
    }

    /**
     * Get the prefix.
     *
     * @see http://leafletjs.com/reference.html#control-attribution-prefix
     *
     * @return string
     */
    public function getPrefix()
    {
        return $this->getOption('prefix', 'Leaflet');
    }

    /**
     * Add a attribution.
     *
     * @see http://leafletjs.com/reference.html#control-attribution-addattribution
     *
     * @param string $attribution Attribution text. Can contain html.
     *
     * @return $this
     */
    public function addAttribution($attribution)
    {
        $this->attributions[] = $attribution;

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
