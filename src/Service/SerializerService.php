<?php

namespace App\Service;

use App\Model\Points;
use InvalidArgumentException;
use Symfony\Component\Serializer\SerializerInterface;

class SerializerService
{
    public function __construct(private readonly SerializerInterface $serializer)
    {
    }

    public function deserialize(array $data, string $resource): object
    {
        $classMap = [
            'points' => Points::class,
        ];

        if (!isset($classMap[$resource])) {
            throw new InvalidArgumentException(sprintf('Resource %s is not supported', $resource));
        }

        return $this->serializer->deserialize(json_encode($data), $classMap[$resource], 'json');
    }
}
