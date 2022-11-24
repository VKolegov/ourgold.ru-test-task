<?php

namespace Database\Seeders;

use App\Models\RoomType;
use Illuminate\Database\Seeder;

class RoomTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        RoomType::insert([
            [
                'code' => 'kitchen',
                'name' => 'Кухня',
            ],
            [
                'code' => 'bedroom',
                'name' => 'Спальня',
            ],
            [
                'code' => 'living-room',
                'name' => 'Гостиная',
            ],
            [
                'code' => 'bathroom',
                'name' => 'Ванная',
            ],
            [
                'code' => 'bathroom',
                'name' => 'Ванная',
            ],
            [
                'code' => 'hallway',
                'name' => 'Прихожая',
            ],
        ]);
    }
}
