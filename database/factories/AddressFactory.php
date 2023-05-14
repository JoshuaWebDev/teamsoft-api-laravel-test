<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Address>
 */
class AddressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // $latitude  = fake()->numberBetween(1, 90);
        // $longitude = fake()->numberBetween(1, 180);

        return [
            'streetName'       => fake()->streetName(),
            'buildingNumber'   => fake()->buildingNumber(),
            'secondaryAddress' => fake()->secondaryAddress(),
            'neighborhood'     => fake()->streetName(),
            'city'             => fake()->city(),
            'state'            => fake()->state(),
            'postcode'         => fake()->postcode(),
            'latitude'         => fake()->latitude($min = -90, $max = 90),
            'longitude'        => fake()->longitude($min = -180, $max = 180)
        ];
    }
}
