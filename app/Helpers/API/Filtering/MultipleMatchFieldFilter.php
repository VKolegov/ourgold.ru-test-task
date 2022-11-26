<?php

namespace App\Helpers\API\Filtering;

use Illuminate\Contracts\Database\Query\Builder;

class MultipleMatchFieldFilter extends AbstractFieldFilter
{

    private int $maxCases = 10;

    /**
     * @param int $maxCases
     * @return static
     */
    public function setMaxCases(int $maxCases): static
    {
        $this->maxCases = $maxCases;
        return $this;
    }

    public function applyToQuery(array $requestFields, Builder $query)
    {
        if (
            !isset($requestFields[$this->field])
            || !is_array($requestFields[$this->field])
        ) {
            return;
        }

        $query->whereIn($this->column, $requestFields[$this->field]);
    }

    public function validationRules(): array
    {
        return [
            $this->field => ['array', "max:$this->maxCases"],
            "$this->field.*" => [$this->fieldType],
        ];
    }
}
