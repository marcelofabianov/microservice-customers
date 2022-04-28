<?php

namespace Microservice\CustomerPipelines\Http\Controllers;

use Core\Http\Controllers\BaseController;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CustomerPipelinesListController extends BaseController
{
    public function __invoke(Request $request): JsonResponse
    {
        return response()->json(['controller' => $request->all()]);
    }
}
