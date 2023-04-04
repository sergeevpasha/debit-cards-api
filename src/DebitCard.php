<?php

declare(strict_types=1);

namespace Sergeevpasha\DebitCardsApi;

use Sergeevpasha\DebitCardsApi\Api\Card;
use Sergeevpasha\DebitCardsApi\Api\Country;

class DebitCard
{
    private ApiClient $apiClient;

    public function __construct(string $key)
    {
        $this->apiClient = new ApiClient($key);
    }

    public function country(): Country
    {
        return new Country($this->apiClient);
    }

    public function card(): Card
    {
        return new Card($this->apiClient);
    }
}