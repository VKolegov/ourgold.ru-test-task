<?php

namespace App\Http\Controllers\api\v1;

use App\Helpers\API\Filtering\MultipleMatchFieldFilter;
use App\Models\PieceOfFurniture;

class PiecesOfFurnitureAPIController extends AbstractAPIController
{
    protected function getModelClass(): string
    {
        return PieceOfFurniture::class;
    }

    protected function filterParams(): array
    {
        return [
            new MultipleMatchFieldFilter('type_code', 'string'),
            new MultipleMatchFieldFilter('apartment_id', 'int'),
            new MultipleMatchFieldFilter('room_id', 'int'),
        ];
    }
}
