<?php

namespace App\Helpers\API\Filtering;

use Illuminate\Contracts\Database\Query\Builder;

class RelationshipFilter extends AbstractFieldFilter
{

    /**
     * @var \App\Helpers\API\Filtering\FieldFilter[] $filters
     */
    private array $filters = [];

    public function setFilters(array $filters): static
    {
        $this->filters = $filters;
        return $this;
    }

    public function applyToQuery(array $requestFields, Builder $query)
    {
        if (!empty($this->filters)) {
            $filters = $this->filters;
            $query->whereHas($this->field, function ($q) use ($requestFields, $filters) {
                foreach ($filters as $filter) {
                    $filter->applyToQuery($requestFields, $q);
                }
            });
        }

        $query->with([$this->field]); // TODO: optional
    }

    public function validationRules(): array
    {
        $subFiltersValidationRules = [];
        foreach ($this->filters as $filter) {
            $subFiltersValidationRules = array_merge($subFiltersValidationRules, $filter->validationRules());
        }
        return $subFiltersValidationRules;
    }
}
