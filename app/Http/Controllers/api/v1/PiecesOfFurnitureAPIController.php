<?php

namespace App\Http\Controllers\api\v1;

use App\Helpers\API\Filtering\HistorySnapshotFilter;
use App\Helpers\API\Filtering\MultipleMatchFieldFilter;
use App\Helpers\API\Filtering\RelationshipCompositeFilter;
use App\Models\PieceOfFurniture;
use Illuminate\Http\Request;

class PiecesOfFurnitureAPIController extends AbstractAPIController
{
    protected function getModelClass(): string
    {
        return PieceOfFurniture::class;
    }

    public function index(Request $r): \Illuminate\Http\JsonResponse
    {
        $this->responseBuilder->setEntitiesMappingFunction(
            function (PieceOfFurniture $pieceOfFurniture) use ($r) {
                $serialized = $pieceOfFurniture->toArray();

                if ($r->has('date')) {
                    $date = $r->date('date');
                    $serialized['current_history_state'] = $pieceOfFurniture->historyStateAt($date);
                } else {
                    $serialized['current_history_state'] = $serialized['history'][0];
                }
                return $serialized;
            });

        return parent::index($r);
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
