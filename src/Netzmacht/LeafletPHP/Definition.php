<?php

/**
 * @package    dev
 * @author     David Molineus <david.molineus@netzmacht.de>
 * @copyright  2014 netzmacht creative David Molineus
 * @license    LGPL 3.0
 * @filesource
 *
 */

namespace Netzmacht\LeafletPHP;


interface Definition
{
    /**
     * Get the type of the definition.
     *
     * @return mixed
     */
    public static function getType();

    public static function getCompileAfter();

    public static function getCompileBefore();

    public static function getRequiredLibraries();

    /**
     * Get the name.
     *
     * @return string
     */
    public function getName();
}
