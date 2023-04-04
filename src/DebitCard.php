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

    public function __construct(string $key)
    {
        $this->apiClient = new ApiClient($key);
    }

    public function __get(string $property)
    {
        $class = __NAMESPACE__ . "\\Api\\" . lcfirst($property);

        if (\class_exists($class)) {
            return new $class($this->apiClient);
        }

        throw new \InvalidArgumentException("Invalid property: $property");
    }
}