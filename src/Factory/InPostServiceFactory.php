<?php

namespace App\Factory;

use App\Api\ApiClientInterface;
use App\Enum\Resource;
use App\Service\InPostServiceInterface;
use App\Service\PointsService;
use InvalidArgumentException;

class InPostServiceFactory
{
    public function __construct(private readonly ApiClientInterface $inPostApiClient)
    {
    }

    public function create(Resource $resource): InPostServiceInterface
    {
        return match ($resource) {
            Resource::Points => new PointsService($this->inPostApiClient),
            default => throw new InvalidArgumentException(sprintf('Resource %s is not supported.', Resource::Points->value)),
        };
    }
}
