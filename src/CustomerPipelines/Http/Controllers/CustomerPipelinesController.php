<?php

namespace Microservice\CustomerPipelines\Http\Controllers;

use Core\Http\Controllers\BaseController;

class CustomerPipelinesController extends BaseController
{
    public function index()
    {
        return response()->json(['controller' => 'CustomerPipelinesController']);
    }
}
