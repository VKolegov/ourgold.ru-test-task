<?php

namespace App\Http\Controllers\api\v1;

use App\Models\PieceOfFurnitureType;

class FurnitureTypesAPIController extends AbstractAPIController
{
    protected function getModelClass(): string
    {
        return PieceOfFurnitureType::class;
    }
}
