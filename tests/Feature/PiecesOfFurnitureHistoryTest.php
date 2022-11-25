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
        /** @var Apartment $apartment */
        $apartment = Apartment::factory()->create();

        Room::factory()->count($apartment->number_of_rooms)->create([
            'apartment_id' => $apartment->id,
        ]);

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
}
