<?php

declare(strict_types=1);

namespace Sergeevpasha\DebitCardsApi\Entity;

use Spatie\DataTransferObject\DataTransferObject;

class CardEntity extends DataTransferObject
{
    public int $id;
    public string $firstName;
    public string $lastName;
    public string $address;
    public string $city;
    public int $countryId;
    public string $phone;
    public string $currency;
    public float $balance;
    public ?string $pin;
    public string $status;
}
