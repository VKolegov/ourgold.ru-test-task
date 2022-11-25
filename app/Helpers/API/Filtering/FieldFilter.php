<?php

namespace App\Helpers\API\Filtering;

use Illuminate\Contracts\Database\Query\Builder;

interface FieldFilter
{
    public function applyToQuery(array $requestFields, Builder $query);
    public function validationRules(): array;
}
