<?php

namespace Tests\Feature;

use App\Models\Address;
use App\Models\Customer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\Fluent\AssertableJson;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CustomerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     *
     * Test if customer model exists.
     *
     * @return void
     */
    public function customer_model_must_exist(): void
    {
        /** @var Customer $customer */
        $customer = Customer::factory()
                            ->create();

        $this->assertModelExists($customer);
    }

    /**
     * @test
     *
     * Test if the route to list customers exists.
     *
     * @return void
     */
    public function route_to_list_customers_must_exist(): void
    {
        $response = $this->get('/api/customers');
        $response->assertStatus(200);
    }

    /**
     * @test
     *
     * Test if can get all customers.
     *
     * @return void
     */
    public function it_should_get_all_customers(): void
    {
        $response = $this->getJson('/api/customers');
        $response->assertJson(fn(AssertableJson $json) => $json->has('customers'));
    }

    /**
     * @test
     *
     * Test if can get a customers.
     *
     * @return void
     */
    public function it_should_get_a_customer(): void
    {
        /** @var Customer $customer */
        $customer = Customer::create([
            'cnpj'         => '98.765.432/0001-01',
            'razaoSocial'  => 'ACME S.A.',
            'contactName'  => 'John Doe',
            'phoneNumber'  => '(11) 98765-4321'
        ]);

        $response = $this->getJson('/api/customers/' . $customer->id);

        $response->assertJson(fn(AssertableJson $json) =>
            $json->where('cnpj', '98.765.432/0001-01')
                 ->where('razaoSocial', 'ACME S.A.')
                 ->where('contactName', 'John Doe')
                 ->where('phoneNumber', '(11) 98765-4321')
                 ->etc()
        );
    }

    /**
     * @test
     *
     * Test relationship between customers and addresses.
     *
     * @return void
     */
    public function a_customer_can_have_several_addresses(): void
    {
        /** @var Customer $customer */
        $customer  = Customer::factory()
                             ->has(Address::factory()->count(2))
                             ->create();

        $this->assertEquals(2, $customer->addresses->count());
    }
}
