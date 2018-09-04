<?php
/**
 * Author: Courtney Miles
 * Date: 22/08/18
 * Time: 10:07 PM
 */

namespace MilesAsylum\Slurp\Stage;

use MilesAsylum\Slurp\SlurpPayload;
use MilesAsylum\Slurp\Validate\ValidatorInterface;

class ValidationStage implements StageInterface
{
    /**
     * @var ValidatorInterface
     */
    private $validator;

    public function __construct(ValidatorInterface $validator)
    {
        $this->validator = $validator;
    }

    public function __invoke(SlurpPayload $payload): SlurpPayload
    {
        $payload->addViolations($this->validator->validateRecord($payload->getRowId(), $payload->getValues()));

        return $payload;
    }
}