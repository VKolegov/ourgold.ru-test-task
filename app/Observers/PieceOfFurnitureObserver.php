<?php

namespace App\Observers;

use App\Models\PieceOfFurniture;
use App\Models\PieceOfFurnitureHistoryEntry;

class PieceOfFurnitureObserver
{
    public function created(PieceOfFurniture $pieceOfFurniture) {
        $this->updateHistory($pieceOfFurniture);
    }

    public function updated(PieceOfFurniture $pieceOfFurniture) {
        if (
            $pieceOfFurniture->wasChanged('apartment_id')
            || $pieceOfFurniture->wasChanged('room_id')
        ) {
            $this->updateHistory($pieceOfFurniture);
        }
    }

    private function updateHistory(PieceOfFurniture $pieceOfFurniture) {
        $pieceOfFurniture->history()->create([
            'date' => now(),
            'apartment_id' => $pieceOfFurniture->apartment_id,
            'room_id' => $pieceOfFurniture->room_id,
        ]);
    }
}
