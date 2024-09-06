<?php

namespace Mohammedmanssour\TrattaLaravelSdk\Tests;

use Mohammedmanssour\TrattaLaravelSdk\Providers\TrattaServiceProvider;
use Orchestra\Testbench\TestCase as BaseTestCase;

class TestCase extends BaseTestCase
{
    protected function getPackageProviders($app)
    {
        return [
            TrattaServiceProvider::class,
        ];
    }
}
