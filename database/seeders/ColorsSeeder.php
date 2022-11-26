<?php

namespace Database\Seeders;

use App\Models\Color;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ColorsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Color::insert([
            [
                'code' => 'black',
                'name' => "Черный",
            ],
            [
                'code' => 'white',
                'name' => "Серый",
            ],
            [
                'code' => 'red',
                'name' => "Красный",
            ],
            [
                'code' => 'green',
                'name' => "Зеленый",
            ],
            [
                'code' => 'blue',
                'name' => "Синий",
            ],
        ]);
    }
}
