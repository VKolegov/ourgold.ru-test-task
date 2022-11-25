<?php

namespace App\Helpers\API;

use Illuminate\Contracts\Database\Query\Builder;

class RangeFieldFilter extends AbstractFieldFilter
{
    private string $minField;
    private string $maxField;

    public function __construct(string $field, string $fieldType)
    {
        parent::__construct($field, $fieldType);

        $this->minField = "{$field}_min";
        $this->maxField = "{$field}_max";
    }

    public function applyToQuery(array $requestFields, Builder $query)
    {
        if ($this->fieldType == 'string') {
            return;
        }

        if (isset($requestFields[$this->minField])) {
            $query->where($this->field, '>=', $requestFields[$this->minField]);
        }

        if (isset($requestFields[$this->maxField])) {
            $query->where($this->field, '<=', $requestFields[$this->maxField]);
        }
    }

    public function validationRules(): array
    {
        return [
            $this->minField => [
                $this->fieldType,
            ],
            $this->maxField => [
                $this->fieldType,
            ],
        ];
    }
}
