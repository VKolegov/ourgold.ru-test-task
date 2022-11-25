<?php

namespace App\Helpers\API;

use Illuminate\Contracts\Database\Query\Builder;

class ExactMatchFieldFilter extends AbstractFieldFilter
{
    public function applyToQuery(array $requestFields, Builder $query)
    {
        if (!isset($requestFields[$this->field])) {
            return;
        }
        $query->where($this->field, '=', $requestFields[$this->field]);
    }

    public function validationRules(): array
    {
        return [
            $this->field => [$this->fieldType]
        ];
    }
}
