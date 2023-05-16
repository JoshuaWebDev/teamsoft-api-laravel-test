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
     * Checks if customer model exists.
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
     * Checks if the route to list customers exists.
     *
     * @return void
     */
    public function route_to_list_customers_must_exist(): void
    {
        $response = $this->get(route('customers.index'));
        $response->assertStatus(200);
    }

    /**
     * @test
     *
     * Checks if can get all customers.
     *
     * @return void
     */
    public function it_should_get_all_customers(): void
    {
        $response = $this->getJson(route('customers.index'));
        $response->assertJson(fn(AssertableJson $json) => $json->has('customers'));
    }

    /**
     * @test
     *
     * Checks if can get a customer.
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

        $response = $this->getJson(route('customers.show', ['customer' => $customer->id]));

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
     * Checks if relationship between customers and addresses exist.
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

    /**
     * @test
     *
     * checks if can create a customer.
     *
     * @return void
     */
    public function it_should_possible_create_a_customer(): void
    {
        $customer = [
            'cnpj'         => '98.765.432/0001-01',
            'razaoSocial'  => 'ACME S.A.',
            'contactName'  => 'John Doe',
            'phoneNumber'  => '(11) 98765-4321'
        ];

        $request = $this->post(route('customers.store'), $customer);

        $request->assertRedirect(route('customers.index'));

        $this->assertDatabaseHas('customers', [
            'cnpj'         => '98.765.432/0001-01',
            'razaoSocial'  => 'ACME S.A.',
            'contactName'  => 'John Doe',
            'phoneNumber'  => '(11) 98765-4321'
        ]);
    }
}
