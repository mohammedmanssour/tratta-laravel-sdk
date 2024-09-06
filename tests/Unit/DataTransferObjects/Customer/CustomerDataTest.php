<?php

namespace Mohammedmanssour\TrattaLaravelSdk\Tests\Unit\DataTransferObjects\Customer;

use Illuminate\Support\Str;
use Mohammedmanssour\TrattaLaravelSdk\DataTransferObjects\Customer\CustomerData;
use Mohammedmanssour\TrattaLaravelSdk\Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;

class CustomerDataTest extends TestCase
{
    #[Test]
    public function it_converts_create_customer_response_to_customer_data()
    {
        $data = [
            'id' => Str::random(),
            'external_id' => Str::random(),
            'name' => fake()->name(),
            'email' => fake()->email(),
            'phone' => fake()->e164PhoneNumber(),
            'dob' => fake()->date(),
            'ssn' => Str::random(),
            'address' => [
                [
                    'name' => fake()->name(),
                    'city' => fake()->city(),
                    'postal_code' => fake()->postcode(),
                    'country' => 'US',
                    'line1' => fake()->streetAddress(),
                    'line2' => fake()->streetAddress(),
                    'state' => 'WA',
                    'is_primary' => true,
                ],
            ],
        ];

        $customer = CustomerData::fromArray($data);

        $this->assertEquals($data['id'], $customer->id);
        $this->assertEquals($data['external_id'], $customer->external_id);
        $this->assertEquals($data['name'], $customer->name);
        $this->assertEquals($data['email'], $customer->email);
        $this->assertEquals($data['phone'], $customer->phone);
        $this->assertEquals($data['dob'], $customer->dob->toDateString());
        $this->assertEquals($data['ssn'], $customer->ssn);
        $this->assertEquals($data['address'][0]['name'], $customer->addresses[0]->name);
        $this->assertEquals($data['address'][0]['city'], $customer->addresses[0]->city);
        $this->assertEquals($data['address'][0]['postal_code'], $customer->addresses[0]->postal_code);
        $this->assertEquals($data['address'][0]['country'], $customer->addresses[0]->country);
        $this->assertEquals($data['address'][0]['line1'], $customer->addresses[0]->line1);
        $this->assertEquals($data['address'][0]['line2'], $customer->addresses[0]->line2);
        $this->assertEquals($data['address'][0]['state'], $customer->addresses[0]->state);
        $this->assertEquals($data['address'][0]['is_primary'], $customer->addresses[0]->is_primary);
    }
}
