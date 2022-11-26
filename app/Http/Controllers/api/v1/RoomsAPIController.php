<?php

namespace App\Http\Controllers\api\v1;

use App\Helpers\API\Filtering\MultipleMatchFieldFilter;
use App\Models\Room;

class RoomsAPIController extends AbstractAPIController
{
    protected function getModelClass(): string
    {
        return Room::class;
    }

    protected function filterParams(): array
    {
        return [
            new MultipleMatchFieldFilter('apartment_id', 'int'),
            new MultipleMatchFieldFilter('type_code', 'string'),
        ];
    }

    protected function relationshipsToEagerLoad(): array
    {
        return ['type'];
    }
}
