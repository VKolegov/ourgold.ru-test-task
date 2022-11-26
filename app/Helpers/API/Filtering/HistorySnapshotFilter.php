<?php

namespace App\Helpers\API\Filtering;

use Illuminate\Contracts\Database\Query\Builder;

class HistorySnapshotFilter implements FieldFilter
{

    private string $fieldName;
    private string $minDateField;
    private string $maxDateField;

    public function __construct(string $fieldName, string $minDateField, string $maxDateField)
    {
        $this->fieldName = $fieldName;
        $this->minDateField = $minDateField;
        $this->maxDateField = $maxDateField;
    }

    public function applyToQuery(array $requestFields, Builder $query)
    {
        if (!isset($requestFields[$this->fieldName])) {
            return;
        }

        $val = $requestFields[$this->fieldName];

        $query->where($this->minDateField, '<=', $val);
        $query->where(function (Builder $q) use ($val) {
            $q->whereNull($this->maxDateField);
            $q->orWhere($this->maxDateField, '>=', $val);
        });
    }

    public function validationRules(): array
    {
        return [
            $this->fieldName => ['date']
        ];
    }
}
