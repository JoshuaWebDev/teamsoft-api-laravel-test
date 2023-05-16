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
        $response = $this->get(route('addresses.index'));
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
        $response = $this->getJson(route('addresses.index'));
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
                             ->for($customer)
                             ->create();

        $this->assertInstanceOf(Customer::class, $addresses->customer);
    }

    /**
     * @test
     *
     * checks if can create a address.
     *
     * @return void
     */
    public function it_should_possible_create_a_address(): void
    {
        $customer = Customer::factory()->create();

        $address = [
            'streetName'       => 'Avenida Tiradentes',
            'buildingNumber'   => '957',
            'secondaryAddress' => '2º Andar',
            'neighborhood'     => 'Centro',
            'city'             => 'Rolândia',
            'state'            => 'Paraná',
            'postcode'         => '86600-059',
            'latitude'         => '-51.3713301',
            'longitude'        => '-23.3130829',
            'customerId'       => $customer->first()->id
        ];

        $request = $this->post(route('addresses.store'), $address);

        $request->assertRedirect(route('addresses.index'));

        $this->assertDatabaseHas('addresses', [
            'streetName'       => 'Avenida Tiradentes',
            'buildingNumber'   => '957',
            'secondaryAddress' => '2º Andar',
            'neighborhood'     => 'Centro',
            'city'             => 'Rolândia',
            'state'            => 'Paraná',
            'postcode'         => '86600-059',
            'latitude'         => '-51.3713301',
            'longitude'        => '-23.3130829'
        ]);
    }
}
