<?php

namespace Database\Seeders;

use App\Models\PieceOfFurnitureType;
use Illuminate\Database\Seeder;

class PieceOfFurnitureTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PieceOfFurnitureType::insert([
            [
                'code' => 'chair',
                'name' => 'Cтул',
            ],
            [
                'code' => 'table',
                'name' => 'Cтол',
            ],
            [
                'code' => 'couch',
                'name' => 'Диван',
            ],
            [
                'code' => 'bed',
                'name' => 'Кровать',
            ],
            [
                'code' => 'armchair',
                'name' => 'Кресло',
            ],
            [
                'code' => 'cabinet',
                'name' => 'Шкаф',
            ],
            [
                'code' => 'dresser',
                'name' => 'Комод',
            ],
        ]);
    }
}
