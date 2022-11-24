<?php

namespace Database\Seeders;

use App\Models\Apartment;
use App\Models\PieceOfFurnitureType;
use App\Models\Room;
use App\Models\RoomType;
use Illuminate\Database\Seeder;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Collection;

class TestDataSeeder extends Seeder
{
    use WithFaker;

    private const NUMBER_OF_APARTMENTS = 10;

    /**
     * @var \Illuminate\Support\Collection|RoomType[]
     */
    private Collection $roomTypes;

    /**
     * @var \Illuminate\Database\Eloquent\Collection|PieceOfFurnitureType[]
     */
    private \Illuminate\Database\Eloquent\Collection $furnitureTypes;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->faker = $this->makeFaker('ru_RU');
        $this->call(RoomTypesSeeder::class);
        $this->call(PieceOfFurnitureTypesSeeder::class);

        $this->roomTypes = RoomType::all();

        $this->furnitureTypes = PieceOfFurnitureType::all();


        for ($i = 0; $i < self::NUMBER_OF_APARTMENTS; $i++) {
            $apartment = Apartment::create(
                [
                    'number' => $this->faker->numberBetween(1, 500),
                    'number_of_rooms' => $this->faker->numberBetween(1, 5),
                    'address' => $this->faker->address,
                ]
            );

            $this->createRoomsForApartment($apartment);
            $this->createFurnitureForApartment($apartment);
        }
    }

    private function createRoomsForApartment(Apartment $apartment): void
    {
        $roomsData = [];

        // key = room type, value = number of rooms of that type
        $roomTypeCount = [];

        for ($i = 0; $i < $apartment->number_of_rooms; $i++) {

            /**
             * @var RoomType $roomType
             */
            $roomType = $this->roomTypes->random();
            $roomTypeCode = $roomType->code;

            if (isset($roomTypeCount[$roomTypeCode])) {
                $roomTypeCount[$roomTypeCode]++;
            } else {
                $roomTypeCount[$roomTypeCode] = 1;
            }

            $roomsData[] = [
                'type_code' => $roomTypeCode,
                'name' => "$roomType->name #$roomTypeCount[$roomTypeCode]",
                'apartment_id' => $apartment->id,
            ];
        }

        $apartment->rooms()->createMany($roomsData);
    }

    private function createFurnitureForApartment(Apartment $apartment): void
    {

        // key = furniture type, value = number of furniture of that type
        $furnitureTypeCount = [];

        foreach ($apartment->rooms as $room) {

            $furnitureData = [];
            $n = $this->faker->numberBetween(1, 4);

            for ($i = 0; $i < $n; $i++) {

                /**
                 * @var PieceOfFurnitureType $furnitureType
                 */
                $furnitureType = $this->furnitureTypes->random();
                $furnitureTypeCode = $furnitureType->code;

                if (isset($furnitureTypeCount[$furnitureTypeCode])) {
                    $furnitureTypeCount[$furnitureTypeCode]++;
                } else {
                    $furnitureTypeCount[$furnitureTypeCode] = 1;
                }

                $furnitureData[] = [
                    'type_code' => $furnitureTypeCode,
                    'name' => "$furnitureType->name #$furnitureTypeCount[$furnitureTypeCode]",
                    'apartment_id' => $apartment->id,
                    'room_id' => $room->id,
                ];
            }

            $room->furniture()->createMany($furnitureData);
        }
    }
}