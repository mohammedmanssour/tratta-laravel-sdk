<?php

namespace Mohammedmanssour\TrattaLaravelSdk\Services;

use Mohammedmanssour\TrattaLaravelSdk\DataTransferObjects\Customer\CreateCustomerData;
use Mohammedmanssour\TrattaLaravelSdk\DataTransferObjects\Customer\CustomerData;

class TrattaCustomerService
{
    public function __construct(public TrattaService $service) {}

    public function create(CreateCustomerData $data): CustomerData
    {
        $res = $this->service->client()->post('customers', $data->toArray());

        $this->service->handleRequestFailure($res, 'create customer');

        return CustomerData::fromArray($res->json('data'));
    }
}
