<?php

namespace App\Http\Controllers\api\v1;

use App\Helpers\API\RangeFieldFilter;
use App\Models\Apartment;

class ApartmentsAPIController extends AbstractAPIController
{
    protected function getModelClass(): string
    {
        return Apartment::class;
    }

    protected function filterParams(): array
    {
        return [
            new RangeFieldFilter('number_of_rooms', 'int'),
        ];
    }
}
