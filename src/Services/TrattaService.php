<?php

namespace Mohammedmanssour\TrattaLaravelSdk\Services;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Mohammedmanssour\TrattaLaravelSdk\Exceptions\ApiRequestException;
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

    public function customer(): TrattaCustomerService
    {
        return new TrattaCustomerService($this);
    }

    public function handleRequestFailure(Response $res, string $context)
    {
        if ($res->successful()) {
            return;
        }

        throw new ApiRequestException($context, $res->json('error'), $res->json('errorCode'));
    }
}
