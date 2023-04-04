<?php

declare(strict_types=1);

namespace Sergeevpasha\DebitCardsApi\Validators;

class PinValidator implements ValidatorInterface
{
    public function validate($data): bool
    {
        return is_numeric($data) && strlen($data) === 4;
    }
}