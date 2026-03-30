<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\brand>
 */
class brandFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    private $brands = ['Bosch', 
                        'DeWalt', 
                        'Makita',
                        'Milwaukee',
                        'Nippon paint',
                        'Dulux',
                        'Tiga roda',
                        'Toto',
                        'American standard',
                        'Semen padang',
                        'Mohawk',
                        'CORETec',
                        'Armstrong',
                        'Rucika',
                        'Onda'];

    public function definition(): array
    {
        return [
            'name' => fake()->unique()->randomElement($this->brands)
        ];
    }
}
