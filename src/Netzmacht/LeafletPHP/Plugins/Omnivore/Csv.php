<?php

/**
 * @package    dev
 * @author     David Molineus <david.molineus@netzmacht.de>
 * @copyright  2015 netzmacht creative David Molineus
 * @license    LGPL 3.0
 * @filesource
 *
 */

namespace Netzmacht\LeafletPHP\Plugins\Omnivore;

/**
 * Class Csv creates the csv file loading request.
 *
 * @package Netzmacht\LeafletPHP\Plugins\Omnivore
 */
class Csv extends OptionsLayer
{
    /**
     * {@inheritdoc}
     */
    public static function getType()
    {
        return 'Omnivore.Csv';
    }

    /**
     * Set the latfield option.
     *
     * @param string $field The csv field name.
     *
     * @return $this
     * @see    https://github.com/mapbox/csv2geojson#api
     */
    public function setLatField($field)
    {
        return $this->setOption('latfield', $field);
    }

    /**
     * Get the latfield option.
     *
     * @return $this
     * @see    https://github.com/mapbox/csv2geojson#api
     */
    public function getLatField()
    {
        return $this->getOption('latfield');
    }

    /**
     * Set the longfield option.
     *
     * @param string $field The csv field name.
     *
     * @return $this
     * @see    https://github.com/mapbox/csv2geojson#api
     */
    public function setLongField($field)
    {
        return $this->setOption('longfield', $field);
    }

    /**
     * Get the longfield option.
     *
     * @return string|null
     * @see    https://github.com/mapbox/csv2geojson#api
     */
    public function getLongField()
    {
        return $this->getOption('longfield');
    }

    /**
     * Set the csv delimiter option.
     *
     * @param string $field The csv field name.
     *
     * @return string|null
     * @see    https://github.com/mapbox/csv2geojson#api
     */
    public function setDelimiterField($field)
    {
        return $this->setOption('delimiter', $field);
    }

    /**
     * Get the csv delimiter option.
     *
     * @return string|null
     * @see    https://github.com/mapbox/csv2geojson#api
     */
    public function getDelimiterField()
    {
        return $this->getOption('delimiter');
    }
}
