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

use Netzmacht\Javascript\Encoder;

/**
 * Class Kml creates the kml file loading request.
 *
 * @package Netzmacht\LeafletPHP\Plugins\Omnivore
 */
class Kml extends OmnivoreLayer
{
    /**
     * {@inheritdoc}
     */
    public static function getType()
    {
        return 'Omnivore.Kml';
    }

    /**
     * {@inheritdoc}
     */
    public function encode(Encoder $encoder, $finish = true)
    {
        $buffer = sprintf(
            '%s = %s(%s)%s',
            $encoder->encodeReference($this),
            strtolower(static::getType()),
            $finish ? ';' : ''
        );

        foreach ($this->getMethodCalls() as $call) {
            $buffer .= "\n" . $call->encode($encoder, true);
        }

        return $buffer;
    }
}
