<?php

namespace Mohammedmanssour\TrattaLaravelSdk\Tests\Unit\Services;

use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Mohammedmanssour\TrattaLaravelSdk\DataTransferObjects\Customer\CreateCustomerData;
use Mohammedmanssour\TrattaLaravelSdk\DataTransferObjects\Customer\CustomerData;
use Mohammedmanssour\TrattaLaravelSdk\Facades\Tratta;
use Mohammedmanssour\TrattaLaravelSdk\Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;

class TrattaCustomerServiceTest extends TestCase
{
    #[Test]
    public function it_creates_customer()
    {
        $this->fakeTrattaRequest('/customers', Http::response(status: 200, body: [
            'data' => $data = [
                'name' => fake()->name(),
                'email' => fake()->email(),
            ],
        ]));

        $customer = Tratta::customer()->create(
            $requestData = CreateCustomerData::fromArray([
                'name' => fake()->name(),
                'email' => fake()->email(),
                'external_id' => Str::random(),
                'phone' => fake()->e164PhoneNumber(),
                'date_of_birth' => Date::now()->subDay(fake()->randomNumber())->toDateString(),
                'ssn_last4' => fake()->numberBetween(1111, 9999),
            ])
        );

        $this->assertInstanceOf(CustomerData::class, $customer);
        $this->assertEquals($data['name'], $customer->name);
        $this->assertEquals($data['email'], $customer->email);
        $this->assertEmpty($customer->addresses); // empty because the address was not set in the request body

        Http::assertSent(
            fn (Request $request) => $request->method() == 'POST' &&
                str_contains($request->url(), 'customers') &&
                $request->data() == $requestData->toArray()
        );
    }
}
