<?php

declare(strict_types=1);

namespace Sergeevpasha\DebitCardsApi;

use Sergeevpasha\DebitCardsApi\Api\Card;
use Sergeevpasha\DebitCardsApi\Api\Country;
use stdClass;

/**
 * @property Country $country
 * @property Card    $card
 */
class DebitCard
{
    private ApiClient $apiClient;
    private stdClass $api;

    public function __construct(string $key)
    {
        $this->apiClient    = new ApiClient($key);
        $this->api          = new stdClass();
        $this->api->country = new Country($this->apiClient);
        $this->api->card    = new Card($this->apiClient);
    }

    public function __get(string $property)
    {
        if (isset($this->api->{$property})) {
            return $this->api->{$property};
        }

        throw new \InvalidArgumentException("Invalid property: $property");
    }
}
