<?php

namespace Mohammedmanssour\TrattaLaravelSdk\Facades;

use Illuminate\Support\Facades\Facade;
use Mohammedmanssour\TrattaLaravelSdk\Services\TrattaService;

/**
 * @method static \Illuminate\Http\Client\PendingRequest client()
 * @method static \Mohammedmanssour\TrattaLaravelSdk\Services\TrattaCustomerService customer()
 */
class Tratta extends Facade
{
    protected static function getFacadeAccessor()
    {
        return TrattaService::class;
    }
}
