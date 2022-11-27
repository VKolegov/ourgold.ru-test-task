<?php

namespace App\Http\Controllers\api\v1;

use App\Models\Color;

class ColorsAPIController extends AbstractAPIController
{

    protected function getModelClass(): string
    {
        return Color::class;
    }
}
