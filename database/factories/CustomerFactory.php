<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'cnpj' => fake()->cnpj(),
            'razao_social' => fake()->company(),
            'contact_name' => fake()->name(),
            'telephone' => fake()->phoneNumber()
        ];
    }
}
