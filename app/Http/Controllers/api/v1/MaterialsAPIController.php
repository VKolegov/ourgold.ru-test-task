<?php

namespace App\Http\Controllers\api\v1;

use App\Models\Material;

class MaterialsAPIController extends AbstractAPIController
{

    protected function getModelClass(): string
    {
        return Material::class;
    }
}
