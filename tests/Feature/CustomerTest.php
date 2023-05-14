<?php

namespace Tests\Feature;

use App\Models\Customer;
use Illuminate\Foundation\Testing\RefreshDatabase;
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
}
