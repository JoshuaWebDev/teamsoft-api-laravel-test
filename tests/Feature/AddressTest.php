<?php

namespace Tests\Feature;

use App\Models\Address;
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
}
