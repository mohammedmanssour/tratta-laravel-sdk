<?php

namespace Mohammedmanssour\TrattaLaravelSdk\DataTransferObjects\Customer;

use MohammedManssour\DTO\Concerns\AsDTO;

class CustomerAddressData
{
    use AsDTO;

    public ?string $name = null;

    public ?string $line1 = null;

    public ?string $line2 = null;

    public ?string $city = null;

    public ?string $postal_code = null;

    public ?string $state = null;

    public ?string $country = null;

    public ?bool $is_primary = null;
}
