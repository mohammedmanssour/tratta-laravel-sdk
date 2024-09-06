<?php

namespace Mohammedmanssour\TrattaLaravelSdk\Tests\Unit\Services;

use Illuminate\Http\Client\Response;
use Mockery\MockInterface;
use Mohammedmanssour\TrattaLaravelSdk\Exceptions\ApiRequestException;
use Mohammedmanssour\TrattaLaravelSdk\Facades\Tratta;
use Mohammedmanssour\TrattaLaravelSdk\Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;

class TrattaServiceTest extends TestCase
{
    #[Test]
    public function it_handles_request_failure()
    {
        $response = $this->mock(Response::class, function (MockInterface $mock) {
            $mock->shouldReceive('successful')->once()->andReturn(false);
            $mock->shouldReceive('json')->with('error')->once()->andReturn('error message');
            $mock->shouldReceive('json')->with('errorCode')->once()->andReturn('some123');
        });

        $this->expectException(ApiRequestException::class);
        $this->expectExceptionMessage('API Request "create context" has failed with error "error message" and errorCode "some123"');
        Tratta::handleRequestFailure($response, 'create context');
    }
}
