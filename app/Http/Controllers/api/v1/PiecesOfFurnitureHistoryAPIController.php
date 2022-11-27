<?php

namespace App\Http\Controllers\api\v1;

use App\Helpers\API\Filtering\MultipleMatchFieldFilter;
use App\Models\PieceOfFurnitureHistoryEntry;

class PiecesOfFurnitureHistoryAPIController extends AbstractAPIController
{

    protected function getModelClass(): string
    {
        return PieceOfFurnitureHistoryEntry::class;
    }

    protected function filterParams(): array
    {
        return [
            new MultipleMatchFieldFilter('apartment_id', 'int'),
            new MultipleMatchFieldFilter('room_id', 'int'),
        ];
    }
}
