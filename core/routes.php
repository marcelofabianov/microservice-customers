<?php

use Illuminate\Support\Facades\Route;

// CustomerPipelines
Route::prefix('customer_pipelines')
    ->as('customer_pipelines.')
    ->namespace('CustomerPipelines\Http\Controllers')
    ->group(base_path('src/CustomerPipelines/routes.php'));
