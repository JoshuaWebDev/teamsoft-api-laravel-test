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
            'postcode'         => '86600059',
            'latitude'         => '-51.3713301',
            'longitude'        => '-23.3130829',
            'customerId'       => $customer->first()->id
        ];

        $this->post(route('addresses.store'), $address);

        $this->assertDatabaseHas('addresses', [
            'streetName'       => 'Avenida Tiradentes',
            'buildingNumber'   => '957',
            'secondaryAddress' => '2º Andar',
            'neighborhood'     => 'Centro',
            'city'             => 'Rolândia',
            'state'            => 'Paraná',
            'postcode'         => '86600059',
            'latitude'         => '-51.3713301',
            'longitude'        => '-23.3130829'
        ]);
    }

    /**
     * @test
     *
     * Checks if can update a address.
     *
     * @return void
     */
    public function it_should_update_a_address(): void
    {
        /** @var Customer $customer */
        $customer = Customer::factory()->create();

        /** @var Address $address */
        $oldAddress = Address::create([
            'streetName'       => 'Avenida Tiradentes',
            'buildingNumber'   => '957',
            'neighborhood'     => 'Centro',
            'city'             => 'Rolândia',
            'state'            => 'Paraná',
            'postcode'         => '86600059',
            'customerId'       => $customer->id
        ]);

        $newAddress = [
            'streetName'       => 'Rua da Acácias',
            'buildingNumber'   => '987',
            'neighborhood'     => 'Centro',
            'city'             => 'Rolândia',
            'state'            => 'Paraná',
            'postcode'         => '86500590',
            'customerId'       => $customer->id
        ];

        $this->putJson(route('addresses.update', ['address' => $oldAddress->id]), $newAddress);

        $this->assertDatabaseHas('addresses', [
            'streetName'       => 'Rua da Acácias',
            'buildingNumber'   => '987',
            'neighborhood'     => 'Centro',
            'city'             => 'Rolândia',
            'state'            => 'Paraná',
            'postcode'         => '86500590',
            'customerId'       => $customer->id
        ]);
    }

    /**
     * @test
     *
     * checks if can delete a address.
     *
     * @return void
     */
    public function it_should_possible_delete_a_address(): void
    {
        /** @var Customer $customer */
        $customer = Customer::factory()->create();

        /** @var Address $address */
        $address = Address::create([
            'streetName'       => 'Avenida Tiradentes',
            'buildingNumber'   => '957',
            'secondaryAddress' => '2º Andar',
            'neighborhood'     => 'Centro',
            'city'             => 'Rolândia',
            'state'            => 'Paraná',
            'postcode'         => '86600059',
            'customerId'       => $customer->first()->id
        ]);

        $this->deleteJson(route('addresses.destroy', ['address' => $address->id]));

        $this->assertSoftDeleted($address);
    }

    /**
     * @test
     *
     * checks if return a error message if validation fails.
     *
     * @return void
     */
    public function it_should_return_a_error_message_if_validation_fails(): void
    {
        $address = [
            'streetName'       => '',
            'buildingNumber'   => '',
            'neighborhood'     => '',
            'city'             => '',
            'state'            => '',
            'postcode'         => '',
            'customerId'         => 1
        ];

        $response = $this->post(route('addresses.store'), $address);

        $response->assertJsonFragment(['message' => 'Can not is possible save the address']);
    }
}
