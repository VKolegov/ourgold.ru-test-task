<?php

namespace App\Http\Controllers\api\v1;

use App\Helpers\API\ExactMatchFieldFilter;
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
            new ExactMatchFieldFilter('apartment_id', 'int'),
            new ExactMatchFieldFilter('type_code', 'string'),
        ];
    }
}
