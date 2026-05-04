<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Crypt;

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
    private $creditCardVendors = ['Visa', 'Discover', 'MasterCard', 'American Express', 'JCB'];

    public function definition(): array
    {
        return [
            'vendor' => fake()->randomElement($this->creditCardVendors),
            'expiration_Date' => fake()->creditCardExpirationDate(),
            'cardNumber' => fake()->numberBetween(1000000000000000, 9999999999999999),
            'billingAddress' => fake()->address()
        ];
    }
}
