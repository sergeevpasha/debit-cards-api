<?php

declare(strict_types=1);

namespace Sergeevpasha\DebitCardsApi\Entity;

use Spatie\DataTransferObject\DataTransferObject;

class CountryEntity extends DataTransferObject
{
    public int $id;
    public string $code;
    public string $name;
}
