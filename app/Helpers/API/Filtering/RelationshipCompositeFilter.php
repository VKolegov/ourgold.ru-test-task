<?php

namespace App\Helpers\API\Filtering;

use Illuminate\Contracts\Database\Query\Builder;

class RelationshipCompositeFilter extends AbstractFieldFilter
{

    /**
     * @var \App\Helpers\API\Filtering\FieldFilter[] $filters
     */
    private array $filters = [];
    private bool $loadRelationship = true;
    private bool $filterRelationship = false;

    public function setFilters(array $filters): static
    {
        $this->filters = $filters;
        return $this;
    }

    /**
     * @param bool $loadRelationship
     * @return static
     */
    public function setLoadRelationship(bool $loadRelationship): static
    {
        $this->loadRelationship = $loadRelationship;
        return $this;
    }

    /**
     * @param bool $filterRelationship
     * @return static
     */
    public function setFilterRelationship(bool $filterRelationship): static
    {
        $this->filterRelationship = $filterRelationship;
        return $this;
    }

    public function applyToQuery(array $requestFields, Builder $query)
    {
        if (empty($this->filters)) {
            return;
        }

        $filters = $this->filters;
        $query->whereHas($this->field, function ($q) use ($requestFields, $filters) {
            foreach ($filters as $filter) {
                $filter->applyToQuery($requestFields, $q);
            }
        });

        if ($this->loadRelationship) {

            if ($this->filterRelationship) {
                $query->with([$this->field]);
            } else {
                $query->with([
                    $this->field => function ($q) use ($requestFields, $filters) {
                        foreach ($filters as $filter) { $filter->applyToQuery($requestFields, $q); }
                    },
                ]);
            }
        }
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
