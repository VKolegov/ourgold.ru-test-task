<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Room>
 */
class RoomFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'type_code' => $this->faker->randomElement(['bedroom', 'kitchen']),
            'name' => $this->faker->words(2, true),
            'apartment_id' => null,
        ];
    }
}
