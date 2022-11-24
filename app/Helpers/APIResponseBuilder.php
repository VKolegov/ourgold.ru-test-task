<?php

namespace App\Helpers;

use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;
use JetBrains\PhpStorm\ArrayShape;

class APIResponseBuilder
{
    private string $modelClass;
    /**
     * @var \Illuminate\Contracts\Database\Query\Builder
     */
    private Builder $query;

    private int $page = 1;
    private int $perPage = 20;
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

        $this->query = $modelClass::query();
        $this->modelClass = $modelClass;
    }

    /**
     * @param int $perPage
     * @return APIResponseBuilder
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
     * @return APIResponseBuilder
     */
    public function setPage(int $page): static
    {
        if ($page < 0) {
            throw new \InvalidArgumentException("\$page can't be less than 0");
        }
        $this->page = $page;
        return $this;
    }

    public function setQuery(Builder $query): static
    {
        $this->query = $query;
        return $this;
    }

    /**
     * @param callable|null $entityMappingFunction
     * @return APIResponseBuilder
     */
    public function setEntityMappingFunction(?callable $entityMappingFunction): static
    {
        $this->entityMappingFunction = $entityMappingFunction;
        return $this;
    }

    /**
     * @param callable|null $entitiesMappingFunction
     * @return APIResponseBuilder
     */
    public function setEntitiesMappingFunction(?callable $entitiesMappingFunction): static
    {
        $this->entitiesMappingFunction = $entitiesMappingFunction;
        return $this;
    }

    /**
     * END SETTERS
     */

    /**
     * RESPONSES
     */

    public function singleEntityResponse($id, string $idColumn = 'id'): JsonResponse
    {
        $model = ($this->modelClass)::query()->where($idColumn, $id)->first();

        $serialized = $this->entityMappingFunction ? ($this->entityMappingFunction)($model) : $model->toArray();

        return new JsonResponse(
            $serialized,
        );
    }

    public function entitiesResponse(): JsonResponse
    {
        $query = $this->query->clone();

        if ($this->perPage > 0) {
            $offset = $this->perPage * ($this->page - 1);
            $query->take($this->perPage)->offset($offset);
        }

        $entities = $query->get()->toArray();

        return new JsonResponse(
            $this->entitiesResponseArray($entities)
        );
    }

    #[ArrayShape(['count' => "int", 'entities' => "array"])]
    public function entitiesResponseArray(array $entities): array
    {
        if ($this->entitiesMappingFunction) {
            $entities = array_map($this->entitiesMappingFunction, $entities);
        }
        return [
            'count' => count($entities),
            'entities' => $entities,
        ];
    }
}
