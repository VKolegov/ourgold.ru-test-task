<?php

namespace App\Helpers\API;

use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use JetBrains\PhpStorm\ArrayShape;

class APIResponseBuilder
{
    private string $modelClass;
    /**
     * @var \Illuminate\Contracts\Database\Query\Builder
     */
    private Builder $queryBuilder;

    private int $page = 1;
    private int $perPage = 20;

    /**
     * @var \App\Helpers\API\Filtering\FieldFilter[]
     */
    private array $filterParams = [];

    /**
     * @var callable|null
     */
    private $entityMappingFunction = null;
    /**
     * @var callable|null
     */
    private $entitiesMappingFunction = null;

    public function __construct(string $modelClass)
    {
        if (!is_a($modelClass, Model::class, true)) {
            throw new \InvalidArgumentException("$modelClass is not Model");
        }

        $this->queryBuilder = $modelClass::query();
        $this->modelClass = $modelClass;
    }

    /**
     * @param int $perPage
     * @return static
     */
    public function setPerPage(int $perPage): static
    {
        if ($perPage < 0) {
            throw new \InvalidArgumentException("\$perPage can't be less than 0");
        }

        $this->perPage = $perPage;
        return $this;
    }

    /**
     * SETTERS
     */

    /**
     * @param int $page
     * @return static
     */
    public function setPage(int $page): static
    {
        if ($page < 0) {
            throw new \InvalidArgumentException("\$page can't be less than 0");
        }
        $this->page = $page;
        return $this;
    }

    public function setPageParamsFromRequest(Request $r) {
        $params = $r->all(['page', 'perPage']);

        $this->setPage($params['page'] ?? $this->page);
        $this->setPerPage($params['perPage'] ?? $this->perPage);
    }

    public function setQueryBuilder(Builder $queryBuilder): static
    {
        $this->queryBuilder = $queryBuilder;
        return $this;
    }

    /**
     * @param callable|null $entityMappingFunction
     * @return static
     */
    public function setEntityMappingFunction(?callable $entityMappingFunction): static
    {
        $this->entityMappingFunction = $entityMappingFunction;
        return $this;
    }

    /**
     * @param callable|null $entitiesMappingFunction
     * @return static
     */
    public function setEntitiesMappingFunction(?callable $entitiesMappingFunction): static
    {
        $this->entitiesMappingFunction = $entitiesMappingFunction;
        return $this;
    }

    /**
     * @param \App\Helpers\API\Filtering\FieldFilter[] $filterParams
     * @return static
     */
    public function setFilterParams(array $filterParams): static
    {
        $this->filterParams = $filterParams;

        return $this;
    }

    /**
     * END SETTERS
     */

    public function applyFilterToQuery(Request $r) {
        foreach ($this->filterParams as $filterParam) {
            $params = $r->validate($filterParam->validationRules());

            $filterParam->applyToQuery($params, $this->queryBuilder);
        }
    }


    /**
     * GETTERS
     */

    /**
     * @return \Illuminate\Contracts\Database\Query\Builder
     */
    public function getQueryBuilder(): Builder
    {
        return $this->queryBuilder;
    }

    /**
     * RESPONSES
     */

    public function singleEntityResponse($id, string $idColumn = 'id'): JsonResponse
    {
        $model = ($this->modelClass)::query()->where($idColumn, $id)->first();

        if (!$model) {
            return $this->errorResponse("not found", 404);
        }

        $serialized = $this->entityMappingFunction ? ($this->entityMappingFunction)($model) : $model->toArray();

        return new JsonResponse(
            $serialized,
        );
    }

    public function entitiesResponse(): JsonResponse
    {
        $query = $this->queryBuilder->clone();
        $totalCount = $query->count();

        if ($this->perPage > 0) {
            $offset = $this->perPage * ($this->page - 1);
            $query->take($this->perPage)->offset($offset);
        }

        $entities = $query->get()->toArray();

        return new JsonResponse(
            $this->entitiesResponseArray($entities, $totalCount)
        );
    }

    #[ArrayShape(['total_count' => "int", 'entities' => "array"])]
    public function entitiesResponseArray(array $entities, int $totalCount): array
    {
        if ($this->entitiesMappingFunction) {
            $entities = array_map($this->entitiesMappingFunction, $entities);
        }

        return [
            'total_count' => $totalCount,
            'entities' => $entities,
        ];
    }

    public function errorResponse(string $message, int $code = 500) : JsonResponse
    {
        return new JsonResponse(
            [
                'message' => $message,
            ],
            $code
        );
    }
}
