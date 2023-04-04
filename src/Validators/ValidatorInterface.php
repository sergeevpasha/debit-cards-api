<?php

declare(strict_types=1);

namespace Sergeevpasha\DebitCardsApi\Validators;

interface ValidatorInterface
{
    public function validate($data): bool;
}