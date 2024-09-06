<?php

namespace Mohammedmanssour\TrattaLaravelSdk\DataTransferObjects\Customer;

use Carbon\CarbonInterface;
use Illuminate\Support\Facades\Date;
use MohammedManssour\DTO\Concerns\AsDTO;

/** @todo handle metadata */
class CustomerData
{
    use AsDTO;

    public string $id;

    public ?string $external_id = null;

    public string $name;

    public string $email;

    public ?string $phone = null;

    public ?CarbonInterface $dob = null;

    public ?string $ssn = null;

    /** @var CustomerAddressData[] */
    public array $addresses = [];

    // setter
    public function dob($value)
    {
        $this->dob = Date::parse($value);
    }

    // setter
    public function addresses($value)
    {
        $this->addresses = collect($value)->map(fn ($item) => CustomerAddressData::fromArray($item))->all();
    }

    // setter from create/update customer data
    public function address($value)
    {
        $this->addresses = collect($value)->map(fn ($item) => CustomerAddressData::fromArray($item))->all();
    }
}
