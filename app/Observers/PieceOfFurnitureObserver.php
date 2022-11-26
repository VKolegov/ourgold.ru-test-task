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
        $date = now();
        $pieceOfFurniture->history()->whereNull('removed_at')->update(
            [
                'removed_at' => $date,
            ]
        );
        $pieceOfFurniture->history()->create([
            'placed_at' => $date,
            'apartment_id' => $pieceOfFurniture->apartment_id,
            'room_id' => $pieceOfFurniture->room_id,
        ]);
    }
}
