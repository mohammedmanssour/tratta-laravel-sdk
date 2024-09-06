<?php

namespace Mohammedmanssour\TrattaLaravelSdk\DataTransferObjects\Customer;

use MohammedManssour\DTO\Concerns\AsDTO;

class CreateCustomerData
{
    use AsDTO;

    public string $name;

    public string $email;

    public ?string $external_id;

    public ?string $phone;

    public ?string $date_of_birth;

    public ?string $ssn_last4;

    public ?CustomerAddressData $address;

    // setter
    public function address($value)
    {
        $this->address = $value instanceof CustomerAddressData ? $value : CustomerAddressData::fromArray($value);
    }
}
