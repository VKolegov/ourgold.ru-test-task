<?php

namespace App\Http\Controllers\api\v1;

use App\Helpers\API\Filtering\HistorySnapshotFilter;
use App\Helpers\API\Filtering\MultipleMatchFieldFilter;
use App\Helpers\API\Filtering\RelationshipCompositeFilter;
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
            new MultipleMatchFieldFilter('material_code', 'string'),
            new MultipleMatchFieldFilter('color_code', 'string'),

            (new RelationshipCompositeFilter('history', 'string'))->setFilters([
                new HistorySnapshotFilter('date', 'placed_at', 'removed_at'),
                new MultipleMatchFieldFilter('apartment_id', 'int'),
                new MultipleMatchFieldFilter('room_id', 'int'),
            ]),
        ];
    }

    protected function relationshipsToEagerLoad(): array
    {
        return ['type', 'material', 'color'];
    }
}
