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
use Netzmacht\JavascriptBuilder\Type\Call\MethodCall;
use Netzmacht\JavascriptBuilder\Flags;
use Netzmacht\LeafletPHP\Definition\Control\AbstractControl;

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
        $flags  = Flags::add(Flags::CLOSE_STATEMENT, $flags);

        foreach ($methodCalls as $call) {
            $buffer .= "\n" . $call->encode($encoder, $flags);
        }

        return $buffer;
    }

    /**
     * Encode an control.
     *
     * @param string          $name    Control name.
     * @param AbstractControl $control The control object.
     * @param Encoder         $encoder Javascript encoder.
     * @param null            $flags   Encoder flags.
     *
     * @return string
     */
    protected function encodeSimpleControl($name, AbstractControl $control, Encoder $encoder, $flags = null)
    {
        $buffer = sprintf(
            '%s = L.%s(%s)%s',
            $encoder->encodeReference($control),
            $name,
            $encoder->encodeValue($control->getOptions()),
            $encoder->close($flags)
        );

        $buffer .= $this->encodeMethodCalls($control->getMethodCalls(), $encoder, $flags);

        return $buffer;
    }
}
