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

    /**
     * @test
     *
     * Test if can get a customers.
     *
     * @return void
     */
    public function it_should_get_a_customer(): void
    {
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
    // public function it_should_get_all_addresses_from_a_customer(): void
    // {
    //     $address = Address::create([
    //         'streetName'       => 'Alameda dos Anjos',
    //         'buildingNumber'   => '123',
    //         'secondaryAddress' => 'Apto. 12',
    //         'neighborhood'     => 'Jardim Felicidade',
    //         'city'             => 'Cidade dos Anjos',
    //         'state'            => '',
    //         'postcode'         => '',
    //         'latitude'         => '',
    //         'longitude'        => ''
    //     ]);

    //     $customer = Customer::create([
    //         'cnpj'         => '98.765.432/0001-01',
    //         'razao_social' => 'ACME S.A.',
    //         'contact_name' => 'John Doe',
    //         'telephone'    => '(11) 98765-4321'
    //     ]);

    //     $response = $this->getJson('/api/customers');

    //     $response->assertJson(fn(AssertableJson $json) =>
    //         $json->where('cnpj', '98.765.432/0001-01')
    //              ->where('razao_social', 'ACME S.A.')
    //              ->where('contact_name', 'John Doe')
    //              ->where('telephone', '(11) 98765-4321')
    //              ->etc()
    //     );
    // }
}
