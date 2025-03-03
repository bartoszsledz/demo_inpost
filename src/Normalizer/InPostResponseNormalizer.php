<?php

namespace App\Normalizer;

use App\Model\Points;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

class InPostResponseNormalizer implements DenormalizerInterface
{
    public function supportsDenormalization($data, string $type, ?string $format = null, array $context = []): bool
    {
        return $type === Points::class;
    }

    public function denormalize($data, string $type, ?string $format = null, array $context = []): Points
    {
        return new Points(
            $data['count'] ?? 0,
            $data['page'] ?? 0,
            $data['total_pages'] ?? 0,
            $data['items'] ?? []
        );
    }

    public function getSupportedTypes(?string $format): array
    {
        return [Points::class => true];
    }
}
