<?php

namespace Tests\Feature;

use App\Models\Address;
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
        $address = Address::factory()->create();
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
}
