<?php

namespace App\Tests\TestCase;

use App\Api\InPostClient;
use App\Service\PointsService;
use PHPUnit\Framework\TestCase;

class PointsServiceTest extends TestCase
{
    /**
     * @test
     *
     * @return void
     */
    public function shouldReturnPoints(): void
    {
        //given
        $expected = ['count' => 13, 'page' => 1, 'total_pages' => 25, 'points' => []];
        $mockClient = $this->createMock(InPostClient::class);
        $mockClient->expects($this->once())
                   ->method('get')
                   ->with('/points?city=Kozy')
                   ->willReturn(['count' => 13, 'page' => 1, 'total_pages' => 25, 'points' => []]);
        $service = new PointsService($mockClient);

        //when
        $result = $service->fetchData('Kozy');

        //then
        $this->assertSame($expected, $result);
    }
}
