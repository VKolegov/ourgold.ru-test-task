<?php

namespace App\Helpers\API\Filtering;

use Illuminate\Contracts\Database\Query\Builder;

class HistorySnapshotFilter implements FieldFilter
{

    private string $fieldName;
    private string $minDateColumn;
    private string $maxDateColumn;

    public function __construct(string $fieldName, string $minDateColumn, string $maxDateColumn)
    {
        $this->fieldName = $fieldName;
        $this->minDateColumn = $minDateColumn;
        $this->maxDateColumn = $maxDateColumn;
    }

    public function applyToQuery(array $requestFields, Builder $query)
    {
        $val = $requestFields[$this->fieldName] ?? now();

        $query->where($this->minDateColumn, '<=', $val);
        $query->where(function (Builder $q) use ($val) {
            $q->whereNull($this->maxDateColumn);
            $q->orWhere($this->maxDateColumn, '>=', $val);
        });
    }

    public function validationRules(): array
    {
        return [
            $this->fieldName => ['date']
        ];
    }
}
