<?php

namespace App\Tests\TestCase;

use App\Model\Address;
use App\Model\Point;
use App\Model\Points;
use App\Service\SerializerService;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Serializer\SerializerInterface;

class SerializerServiceTest extends TestCase
{
    /**
     * @test
     *
     * @return void
     */
    public function shouldReturnSerializedPoints(): void
    {
        //given
        $expected = new Points(
            13,
            1,
            25,
            [new Point('KZY01A', new Address('Gajowa 27', '43-340 Kozy'))]
        );
        $mockJsonData = json_decode(file_get_contents(__DIR__ . '/DataSamples/response.json'), true);
        $mockSerializer = $this->createMock(SerializerInterface::class);
        $mockSerializer->expects($this->once())
                       ->method('deserialize')
                       ->with(json_encode($mockJsonData), Points::class, 'json')
                       ->willReturn($expected);
        $service = new SerializerService($mockSerializer);

        //when
        $result = $service->deserialize($mockJsonData, 'points');

        //then
        $this->assertSame($expected, $result);
    }

    /**
     * @test
     *
     * @return void
     */
    public function shouldThrowInvalidArgumentException(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Resource none is not supported');

        //given
        $mockSerializer = $this->createMock(SerializerInterface::class);
        $service = new SerializerService($mockSerializer);

        //when
        $result = $service->deserialize([], 'none');
    }
}