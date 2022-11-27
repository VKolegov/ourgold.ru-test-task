<?php

namespace App\Http\Controllers\api\v1;

use App\Models\RoomType;

class RoomTypesAPIController extends AbstractAPIController
{
    protected function getModelClass(): string
    {
        return RoomType::class;
    }
}
