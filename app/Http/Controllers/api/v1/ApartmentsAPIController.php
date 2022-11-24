<?php

namespace App\Http\Controllers\api\v1;

use App\Models\Apartment;

class ApartmentsAPIController extends AbstractAPIController
{
    protected function getModelClass(): string
    {
        return Apartment::class;
    }
}
