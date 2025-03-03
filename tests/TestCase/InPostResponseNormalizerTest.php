<?php

namespace App\Tests\TestCase;

use App\Model\Points;
use App\Normalizer\InPostResponseNormalizer;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Serializer\Exception\ExceptionInterface;

class InPostResponseNormalizerTest extends TestCase
{
    /**
     * @test
     * @return void
     * @throws ExceptionInterface
     */
    public function shouldReturnDenormalizedPointsObject(): void
    {
        //given
        $data = [
            'count' => 13,
            'page' => 1,
            'total_pages' => 25,
            'items' => [
                ['name' => 'KZY01A', 'address' => ['line1' => 'Gajowa 27', 'line2' => '43-340 Kozy']],
            ]
        ];
        $normalizer = new InPostResponseNormalizer();

        //when
        $response = $normalizer->denormalize($data, Points::class);

        //then
        $this->assertSame(13, $response->getCount());
        $this->assertSame(1, $response->getPage());
        $this->assertSame(25, $response->getTotalPages());
        $this->assertCount(1, $response->getItems());
    }
}