<?php

namespace App\Service;

use App\Api\ApiClientInterface;

class PointsService implements InPostServiceInterface
{
    public function __construct(private readonly ApiClientInterface $inPostApiClient)
    {
    }

    public function fetchData(string $city): array
    {
        return $this->inPostApiClient->get(sprintf('/points?city=%s', $city));
    }
}
