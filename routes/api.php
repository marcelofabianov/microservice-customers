<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['auth:api', 'scopes:accounts'])
    ->prefix('accounts')
    ->as('accounts.')
    ->namespace('Accounts\Http\Controllers')
    ->group(base_path('modules/Accounts/routes.php'));

Route::middleware(['auth:api', 'scopes:contacts'])
    ->prefix('contacts')
    ->as('contacts.')
    ->namespace('Contacts\Http\Controllers')
    ->group(base_path('modules/Contacts/routes.php'));
