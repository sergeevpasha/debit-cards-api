<?php

declare(strict_types=1);

namespace Sergeevpasha\DebitCardsApi;

use GuzzleHttp\Client;

final class ApiClient
{
    const API_URL = 'https://debitcard.com'; // Non-existed URL to API
    private Client $instance;

    public function __construct(string $key)
    {
        $this->instance = new Client([
            'base_uri' => self::API_URL,
            'headers'  => [
                'AUTH-KEY' => $key,
            ],
        ]);
    }

    public function getInstance(): Client
    {
        return $this->instance;
    }
}