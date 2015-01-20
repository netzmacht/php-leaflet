<?php

/**
 * @package    dev
 * @author     David Molineus <david.molineus@netzmacht.de>
 * @copyright  2015 netzmacht creative David Molineus
 * @license    LGPL 3.0
 * @filesource
 *
 */

namespace Netzmacht\LeafletPHP\Encoder;

use Netzmacht\JavascriptBuilder\Encoder;
use Netzmacht\JavascriptBuilder\Type\Call\MethodCall;
use Netzmacht\JavascriptBuilder\Util\Flags;

/**
 * Class EncoderHelperTrait provides helper to encode an definition.
 *
 * @package Netzmacht\LeafletPHP\Encoder
 */
trait EncodeHelperTrait
{
    /**
     * Encode method calls.
     *
     * @param MethodCall[] $methodCalls Method calls.
     * @param Encoder      $encoder     Javascript encoder.
     * @param null         $flags       Encoder flags.
     *
     * @return string
     */
    protected function encodeMethodCalls($methodCalls, Encoder $encoder, $flags = null)
    {
        $buffer = '';
        $flags  = Flags::add(Encoder::CLOSE_STATEMENT, $flags);

        foreach ($methodCalls as $call) {
            $buffer .=  "\n" . $call->encode($encoder, $flags);
        }

        return $buffer;
    }
}
