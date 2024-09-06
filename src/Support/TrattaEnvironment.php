<?php

namespace Mohammedmanssour\TrattaLaravelSdk\Support;

enum TrattaEnvironment: string
{
    case Sandbox = 'sandbox';
    case Production = 'production';

    public function baseUrl(string $orgId): string
    {
        return "https://{$orgId}.{$this->value}.tratta.io/api/v1";
    }
}
