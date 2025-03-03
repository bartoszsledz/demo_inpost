<?php

namespace App\Api;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use RuntimeException;

class InPostClient implements ApiClientInterface
{
    public function __construct(private readonly Client $client)
    {
    }

    public function get(string $url): array
    {
        $options = [
            'headers' => [
                'Accept' => 'application/json',
            ],
        ];
        try {
            $response = $this->client->get(getenv('INPOST_URL') . $url, $options);
        } catch (ClientException $exception) {
            throw new RuntimeException(
                sprintf(
                    'Request failed with status code %s',
                    $exception->getResponse()->getStatusCode()
                )
            );
        }

        return json_decode($response->getBody()->getContents(), true);
    }
}
