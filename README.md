# Tratta Laravel

Unofficial Laravel client for the Tratta REST API.

This package is still WIP. DO NOT use in a production app.

## Usage

### Errors

When requests to Tratta fails. the SDK will throw an `\Mohammedmanssour\TrattaLaravelSdk\Exceptions\ApiRequestException::class` that has all the basic details you need for debugging.

### Customers

The package supports interacting with customers Endpoints.

#### Creating a customer

```php
use Mohammedmanssour\TrattaLaravelSdk\Concerns\FakesTratta;
use Mohammedmanssour\TrattaLaravelSdk\DataTransferObjects\Customer\CustomerData;
use Mohammedmanssour\TrattaLaravelSdk\DataTransferObjects\Customer\CreateCustomerData;

$customer = Tratta::customer()->create(CreateCustomerData::fromArray([]));

$this->assertInstanceOf(CustomerData::class, $customer);
```

Other endpoints will come later.

### Test Helpers

The packages comes with a neat way to help you with testing. First use `\Mohammedmanssour\TrattaLaravelSdk\Concerns\FakesTratta::class` trait in your test case.
Then instruct the package how it should receive methods and what to return.

For example, if you're testing a peice of code that's using the create customer method you can test like the following.

```php
class CreateCustomerJobTest extends TestCase {
    use FakesTratta;

    #[Test]
    public function it_attempt_to_create_a_customer() {
        $customer = $this->fakeTrattaCustomer();
        $this->trattaCustomer()->shouldReceive('create')->once()->withArgs(fn ($data) => true)->andReturn($customer);

        (new CreateCustomerJob)->handle();
    }
}
```
