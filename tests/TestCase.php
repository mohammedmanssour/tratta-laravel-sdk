<?php

namespace Mohammedmanssour\TrattaLaravelSdk\Tests;

use GuzzleHttp\Promise\PromiseInterface;
use Illuminate\Support\Facades\Http;
use Mohammedmanssour\TrattaLaravelSdk\Providers\TrattaServiceProvider;
use Mohammedmanssour\TrattaLaravelSdk\Support\TrattaEnvironment;
use Orchestra\Testbench\TestCase as BaseTestCase;

class TestCase extends BaseTestCase
{
    private string $orgId = 'tratta-sdk-test';

    public function setUp(): void
    {
        parent::setUp();
        config([
            'tratta.environment' => 'sandbox',
            'tratta.org_id' => $this->orgId,
        ]);

        Http::preventStrayRequests();
    }

    public function fakeTrattaRequest(string $path, PromiseInterface $response)
    {
        $baseUrl = TrattaEnvironment::Sandbox->baseUrl($this->orgId);
        $url = implode([
            rtrim($baseUrl, '/'),
            '/',
            trim($path, '/'),
        ]);

        Http::fake([
            $url => $response,
        ]);
    }

    protected function getPackageProviders($app)
    {
        return [
            TrattaServiceProvider::class,
        ];
    }
}
