<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\category>
 */
class categoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    private $categories = ['Plumbing',
                            'Flooring',
                            'Tools & Hardware',
                            'Cement',
                            'Sanitary and bathroom'];

    public function definition(): array
    {
        return [
            'name' => fake()->unique()->randomElement($this->categories)
        ];
    }
}
