<?php

namespace App\Tests\TestCase;

use App\Api\InPostClient;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;

class InPostClientTest extends TestCase
{
    /**
     * @test
     *
     * @return void
     */
    public function shouldReturnCorrectResponse(): void
    {
        //given
        $mockClient = $this->createMock(Client::class);
        $mockClient->method('get')
                   ->willReturn(new Response(200, [], '{"count": 1, "items": []}'));

        //when
        $api = new InPostClient($mockClient);
        $result = $api->get('/points?city=Kozy');

        //then
        $this->assertSame(['count' => 1, "items" => []], $result);
    }
}
