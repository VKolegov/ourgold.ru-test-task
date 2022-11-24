<?php

namespace App\Http\Controllers\api\v1;

use App\Helpers\APIResponseBuilder;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

abstract class AbstractAPIController extends Controller
{
    /**
     * @var \App\Helpers\APIResponseBuilder
     */
    private APIResponseBuilder $responseBuilder;

    abstract protected function getModelClass() : string;

    public function __construct()
    {
        $this->responseBuilder = new APIResponseBuilder(
            $this->getModelClass()
        );
    }

    public function index(Request $r): \Illuminate\Http\JsonResponse
    {
        $this->responseBuilder->setPageParamsFromRequest($r);
        return $this->responseBuilder->entitiesResponse();
    }

    public function show(int $id, Request $r): \Illuminate\Http\JsonResponse
    {
        return $this->responseBuilder->singleEntityResponse($id);
    }
}
