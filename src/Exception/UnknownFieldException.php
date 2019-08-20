<?php
/**
 * @author Courtney Miles
 *
 * @see https://github.com/courtney-miles/slurp
 *
 * @package milesasylum/slurp
 *
 * @license MIT
 */

declare(strict_types=1);

namespace MilesAsylum\Slurp\Exception;

use Throwable;

class UnknownFieldException extends \InvalidArgumentException implements ExceptionInterface
{
    /**
     * @var string
     */
    protected $field;

    public function __construct(string $field, string $message = '', int $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
        $this->field = $field;
    }

    /**
     * @return string
     */
    public function getField(): string
    {
        return $this->field;
    }
}
