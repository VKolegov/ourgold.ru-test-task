<?php

namespace App\Http\Controllers\api\v1;

use App\Models\Room;

class RoomsAPIController extends AbstractAPIController
{
    protected function getModelClass(): string
    {
        return Room::class;
    }
}
