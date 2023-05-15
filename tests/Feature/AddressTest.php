<?php

namespace Tests\Feature;

use App\Models\Address;
use App\Models\Customer;
use Illuminate\Testing\Fluent\AssertableJson;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AddressTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     *
     * Test if customer model exists.
     *
     * @return void
     */
    public function address_model_must_exist(): void
    {
        /** @var Customer $customer */
        $customer = Customer::factory()
                            ->create();

        /** @var Address $address */
        $address = Address::factory()
                          ->create(['customerId' => $customer->id]);

        $this->assertModelExists($address);
    }

    /**
     * @test
     *
     * Test if the route to list addresses exists.
     *
     * @return void
     */
    public function route_to_list_addresses_must_exist(): void
    {
        $response = $this->get('/api/addresses');
        $response->assertStatus(200);
    }

    /**
     * @test
     *
     * Test if can get all addresses.
     *
     * @return void
     */
    public function it_should_get_all_addresses(): void
    {
        $response = $this->getJson('/api/addresses');
        $response->assertJson(fn(AssertableJson $json) => $json->has('addresses'));
    }

    /**
     * @test
     *
     * Test relationship between customers and addresses.
     *
     * @return void
     */
    public function one_or_more_addresses_must_belong_to_a_customer(): void
    {
        /** @var Customer $customer */
        $customer = Customer::factory()->create();

        /** @var Address $address */
        $addresses  = Address::factory()
                             ->for(Customer::factory()->create([
                                'cnpj'         => '98.765.432/0001-01',
                                'razaoSocial'  => 'ACME S.A.',
                                'contactName'  => 'John Doe',
                                'phoneNumber'  => '(11) 98765-4321'
                             ]))
                             ->create();

        $this->assertInstanceOf(Customer::class, $addresses->customer);
    }
}
