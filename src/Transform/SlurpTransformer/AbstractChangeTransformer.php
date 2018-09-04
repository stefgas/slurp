<?php
/**
 * Author: Courtney Miles
 * Date: 14/08/18
 * Time: 9:39 PM
 */

namespace MilesAsylum\Slurp\Transform\SlurpTransformer;


use MilesAsylum\Slurp\Transform\ChangeTransformerInterface;

abstract class AbstractChangeTransformer implements ChangeTransformerInterface
{
    final public function __construct()
    {
    }

    public function isString($value)
    {
        return is_scalar($value) || (\is_object($value) && method_exists($value, '__toString'));
    }
}