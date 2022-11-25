<?php

namespace Tests\Feature;

use App\Models\Apartment;
use App\Models\PieceOfFurniture;
use App\Models\PieceOfFurnitureHistoryEntry;
use App\Models\Room;
use Database\Seeders\PieceOfFurnitureTypesSeeder;
use Database\Seeders\RoomTypesSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PiecesOfFurnitureHistoryTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed(RoomTypesSeeder::class);
        $this->seed(PieceOfFurnitureTypesSeeder::class);
    }

    public function test_that_history_entry_created_on_creation()
    {
        $apartment = $this->create_apartment_with_rooms();

        $c = 3;
        foreach ($apartment->rooms as $room) {
            $piecesOfFurniture = PieceOfFurniture::factory()->count($c)->create([
                'apartment_id' => $apartment->id,
                'room_id' => $room->id,
            ]);

            foreach ($piecesOfFurniture as $pieceOfFurniture) {
                $this->assertDatabaseHas(PieceOfFurnitureHistoryEntry::class, [
                    'piece_of_furniture_id' => $pieceOfFurniture->id,
                    'apartment_id' => $apartment->id,
                    'room_id' => $room->id,
                ]);
            }
        }

        $this->assertDatabaseCount(PieceOfFurnitureHistoryEntry::class, $c * $apartment->rooms->count());
    }

    public function test_that_history_entry_created_on_update()
    {
        $apartment = $this->create_apartment_with_rooms();

        $c = 3;
        foreach ($apartment->rooms as $room) {
            PieceOfFurniture::factory()->count($c)->create([
                'apartment_id' => $apartment->id,
                'room_id' => $room->id,
            ]);
        }

        // move between rooms
        $room1 = $apartment->rooms[0];
        $room2 = $apartment->rooms[1];
        $pieceOfFurniture = $room1->furniture[0];

        $this->assertDatabaseHas(PieceOfFurnitureHistoryEntry::class, [
           'piece_of_furniture_id' => $pieceOfFurniture->id,
           'room_id' => $room1->id,
           'apartment_id' => $apartment->id,
        ]);
        $this->assertDatabaseMissing(PieceOfFurnitureHistoryEntry::class, [
            'piece_of_furniture_id' => $pieceOfFurniture->id,
            'room_id' => $room2->id,
            'apartment_id' => $apartment->id,
        ]);

        $pieceOfFurniture->room_id = $room2->id;
        $pieceOfFurniture->save();

        $this->assertDatabaseHas(PieceOfFurnitureHistoryEntry::class, [
            'piece_of_furniture_id' => $pieceOfFurniture->id,
            'room_id' => $room2->id,
            'apartment_id' => $apartment->id,
        ]);
    }

    private function create_apartment_with_rooms(int $numberOfRooms = 3): Apartment
    {
        /** @var Apartment $apartment */
        $apartment = Apartment::factory()->create([
            'number_of_rooms' => $numberOfRooms,
        ]);

        Room::factory()->count($numberOfRooms)->create([
            'apartment_id' => $apartment->id,
        ]);

        return $apartment;
    }
}
