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

namespace Netzmacht\LeafletPHP\Plugins\Loading;

/**
 * SpinJsLoadingControl is for the spin.js loading indicator.
 *
 * Instead of setting an option to the LoadingControl you have to use a separate class. Autoloading of spin.js library
 * causes this.
 *
 * @package Netzmacht\LeafletPHP\Plugins\Loading
 */
class SpinJsLoadingControl extends LoadingControl
{
    /**
     * {@inheritdoc}
     */
    public static function getRequiredLibraries()
    {
        $libs   = parent::getRequiredLibraries();
        $libs[] = 'spin.js';

        return $libs;
    }

    /**
     * {@inheritdoc}
     */
    public function __construct($identifier)
    {
        parent::__construct($identifier);

        $this->setOption('spinjs', true);
    }

    /**
     * Set spin.js configuration.
     *
     * @param array $spin Spin.js configuration.
     *
     * @return $this
     * @see    http://fgnass.github.io/spin.js/
     */
    public function setSpin(array $spin)
    {
        return $this->setOption('spin', $spin);
    }

    /**
     * Get spin options.
     *
     * @return array
     */
    public function getSpin()
    {
        return $this->getOption(
            'spin',
            array(
                'lines'  => 7,
                'length' => 3,
                'width'  => 3,
                'radius' => 5,
                'rotate' => 13,
                'top'    => '83%'
            )
        );
    }
}
