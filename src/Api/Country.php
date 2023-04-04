<?php

declare(strict_types=1);

namespace Sergeevpasha\DebitCardsApi\Api;

use Sergeevpasha\DebitCardsApi\ApiClient;
use Sergeevpasha\DebitCardsApi\Entity\CountryEntity;
use GuzzleHttp\Client;

class Country
{
    private Client $client;

    public function __construct(ApiClient $client)
    {
        $this->client = $client->getInstance();
    }

    /**
     * @return \Sergeevpasha\DebitCardsApi\Entity\CountryEntity[]
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Spatie\DataTransferObject\Exceptions\UnknownProperties
     */
    public function getAll(): array
    {
        $response = $this->client->request('GET', "/countries");

        return array_map(fn($card) => new CountryEntity($card), json_decode($response->getBody()->getContents(), true));
    }

    /**
     * @param int $id
     *
     * @return float
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function get(int $id): float
    {
        $response = $this->client->request('GET', "/countries/$id");

        return json_decode($response->getBody()->getContents(), true);
    }
}
