<?php

namespace Mohammedmanssour\TrattaLaravelSdk\Services;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;
use Mohammedmanssour\TrattaLaravelSdk\Support\TrattaEnvironment;

class TrattaService
{
    public function __construct(
        private string $orgId,
        private string $apiKey,
        private TrattaEnvironment $env
    ) {}

    public function client(): PendingRequest
    {
        return Http::baseUrl($this->env->baseUrl($this->orgId))
            ->withToken($this->apiKey);
    }
}
