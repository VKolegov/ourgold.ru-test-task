<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PieceOfFurniture>
 */
class PieceOfFurnitureFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->company,
            'type_code' => $this->faker->randomElement(['chair', 'table']),
            'apartment_id' => null,
            'room_id' => null,
        ];
    }
}
