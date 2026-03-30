<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class paymentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'vendor' => fake()->creditCardType(),
            'expiration_Date' => fake()->creditCardExpirationDate(),
            'cardNumber' => Hash::make(fake()->unique()->creditCardNumber()),
            'billingAdress' => fake()->address()
        ];
    }
}
