<?php

use Illuminate\Support\Facades\Route;
use Microservice\CustomerPipelines\Http\Controllers\CustomerPipelinesListController;

Route::name('list')->get('/', [CustomerPipelinesListController::class]);
