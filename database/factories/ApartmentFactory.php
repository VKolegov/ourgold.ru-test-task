<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Apartment>
 */
class ApartmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return  [
            'number' => $this->faker->numberBetween(1, 500),
            'number_of_rooms' => $this->faker->numberBetween(1, 5),
            'address' => $this->faker->address,
        ];
    }
}
