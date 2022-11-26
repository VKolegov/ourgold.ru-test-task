<?php

namespace Database\Seeders;

use App\Models\Material;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MaterialsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Material::insert([
            [
                'code' => 'aluminum',
                'name' => 'Алюминий'
            ],
            [
                'code' => 'steel',
                'name' => 'Сталь'
            ],
            [
                'code' => 'plastic',
                'name' => 'Пластик'
            ],
            [
                'code' => 'birch',
                'name' => 'Дерево (береза)'
            ],
            [
                'code' => 'oak',
                'name' => 'Дерево (дуб)'
            ],
        ]);
    }
}
