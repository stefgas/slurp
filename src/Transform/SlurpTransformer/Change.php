<?php
/**
 * Author: Courtney Miles
 * Date: 13/08/18
 * Time: 11:03 PM
 */

declare(strict_types=1);

namespace MilesAsylum\Slurp\Transform\SlurpTransformer;

abstract class Change
{
    /**
     * @return string
     */
    abstract public function transformedBy(): string;
}
