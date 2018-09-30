<?php
/**
 * Author: Courtney Miles
 * Date: 26/09/18
 * Time: 7:07 AM
 */

namespace MilesAsylum\Slurp\Validate;

class RecordViolation implements ViolationInterface
{
    /**
     * @var int
     */
    private $recordId;

    /**
     * @var string
     */
    private $message;

    public function __construct(int $recordId, string $message)
    {
        $this->recordId = $recordId;
        $this->message = $message;
    }

    public function getRecordId(): int
    {
        return $this->recordId;
    }

    public function getMessage(): string
    {
        return $this->message;
    }
}