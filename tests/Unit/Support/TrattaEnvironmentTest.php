<?php

namespace Mohammedmanssour\TrattaLaravelSdk\Tests\Unit\Support;

use Mohammedmanssour\TrattaLaravelSdk\Support\TrattaEnvironment;
use Mohammedmanssour\TrattaLaravelSdk\Tests\TestCase;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;

class TrattaEnvironmentTest extends TestCase
{
    #[Test]
    #[DataProvider('environmentDataProvider')]
    public function it_generates_the_right_environment_base_url(TrattaEnvironment $env, $baseUrl)
    {
        $this->assertEquals($baseUrl, $env->baseUrl('org123'));
    }

    public static function environmentDataProvider()
    {
        return [
            'sandbox' => [
                'env' => TrattaEnvironment::Sandbox,
                'baseUrl' => 'https://org123.sandbox.tratta.io/api/v1',
            ],
            'production' => [
                'env' => TrattaEnvironment::Production,
                'baseUrl' => 'https://org123.production.tratta.io/api/v1',
            ],
        ];
    }
}
