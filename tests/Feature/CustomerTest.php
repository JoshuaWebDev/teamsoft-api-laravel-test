<?php

namespace Tests\Feature;

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
        $customer = Customer::factory()->create();
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
}
