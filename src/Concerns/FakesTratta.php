<?php

namespace Mohammedmanssour\TrattaLaravelSdk\Concerns;

use Illuminate\Support\Facades\Date;
use Illuminate\Support\Str;
use Mockery\MockInterface;
use Mohammedmanssour\TrattaLaravelSdk\DataTransferObjects\Customer\CustomerData;
use Mohammedmanssour\TrattaLaravelSdk\Facades\Tratta;
use Mohammedmanssour\TrattaLaravelSdk\Services\TrattaCustomerService;

trait FakesTratta
{
    public function setupFakesTratta()
    {
        Tratta::shouldReceive('customer')->andReturn($this->trattaCustomer());
    }

    private function trattaCustomer(): MockInterface|TrattaCustomerService
    {
        return once(
            fn () => $this->mock(TrattaCustomerService::class, function (MockInterface $mock) {
                $mock->makePartial();
                $mock->shouldAllowMockingProtectedMethods();
            })
        );
    }

    private function fakeTrattaCustomer($attributes = []): CustomerData
    {
        return CustomerData::fromArray(array_merge(
            [
                'id' => Str::random(),
                'external_id' => Str::random(),
                'name' => fake()->name(),
                'email' => fake()->email(),
                'phone' => fake()->e164PhoneNumber(),
                'dob' => Date::now()->subDays(fake()->numberBetween(6570, 36500)), // between 18 and 100
                'ssn' => Str::random(),
                'addresses' => [
                    [
                        'name' => fake()->name(),
                        'line1' => fake()->streetAddress(),
                        'city' => fake()->city(),
                        'state' => 'WA',
                        'postal_code' => fake()->postcode(),
                        'country' => 'US',
                        'is_primary' => true,
                    ],
                ],
            ],
            $attributes
        ));
    }
}
