<?php

declare(strict_types=1);

namespace Sergeevpasha\DebitCardsApi\Api;

use DateTime;
use Exception;
use GuzzleHttp\Client;
use Sergeevpasha\DebitCardsApi\ApiClient;
use Sergeevpasha\DebitCardsApi\Entity\CardEntity;
use Sergeevpasha\DebitCardsApi\Validators\PinValidator;

class Card
{
    private Client $client;

    public function __construct(ApiClient $client)
    {
        $this->client = $client->getInstance();
    }

    /**
     * @param int $id
     *
     * @return \Sergeevpasha\DebitCardsApi\Entity\CardEntity[]
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Spatie\DataTransferObject\Exceptions\UnknownProperties
     */
    public function get(int $id): array
    {
        $response = $this->client->request('GET', "/cards/$id");

        return array_map(fn($card) => new CardEntity($card), json_decode($response->getBody()->getContents(), true));
    }

    /**
     * @param int $id
     *
     * @return float
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function balance(int $id): float
    {
        $response = $this->client->request('GET', "/cards/$id/balance");

        return json_decode($response->getBody()->getContents(), true)["balance"];
    }

    /**
     * @param int $id
     *
     * @return float
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function pin(int $id): float
    {
        $response = $this->client->request('GET', "/cards/$id/pin");

        return json_decode($response->getBody()->getContents(), true)["pin"];
    }

    /**
     * @param int       $id
     * @param \DateTime $startDate
     * @param \DateTime $endDate
     *
     * @return float
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function history(int $id, DateTime $startDate, DateTime $endDate): float
    {
        $response = $this->client->request('GET', "/cards/$id/history", [
            'query' => [
                'start_date' => $startDate->format('Y-m-d'),
                'end_date'   => $endDate->format('Y-m-d'),
            ],
        ]);

        return json_decode($response->getBody()->getContents(), true);
    }

    /**
     * @param array $params
     *
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function create(array $params): array
    {
        $response = $this->client->request('POST', '/cards/create', $params);

        return json_decode($response->getBody()->getContents(), true);
    }

    /**
     * @param int $id
     *
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function activate(int $id): array
    {
        $response = $this->client->request('POST', "/cards/$id/activate");
        return json_decode($response->getBody()->getContents(), true)["message"];
    }


    /**
     * @param int $id
     *
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function deactivate(int $id): array
    {
        $response = $this->client->request('POST', "/cards/$id/deactivate");
        return json_decode($response->getBody()->getContents(), true)["message"];
    }

    /**
     * @param int    $id
     * @param string $pin
     *
     * @return array
     * @throws \Exception|\GuzzleHttp\Exception\GuzzleException
     */
    public function updatePin(int $id, string $pin): array
    {
        $pinValidator = new PinValidator();
        if (!$pinValidator->validate($pin)) {
            throw new Exception('Pin must be 4 digits');
        }

        $response = $this->client->request('POST', "/cards/$id/update", [
            'pin' => $pin,
        ]);

        return json_decode($response->getBody()->getContents(), true)["message"];
    }

    /**
     * @param int   $id
     * @param float $amount
     *
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function topUp(int $id, float $amount): array
    {
        $response = $this->client->request('POST', "/cards/$id/update", [
            'amount' => $amount,
        ]);

        return json_decode($response->getBody()->getContents(), true)["message"];
    }
}
