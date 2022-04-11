<?php

use Illuminate\Support\Facades\Route;

Route::prefix('accounts')
    ->as('accounts.')
    ->namespace('Accounts\Http\Controllers')
    ->group(base_path('modules/Accounts/routes.php'));

Route::prefix('contacts')
    ->as('contacts.')
    ->namespace('Contacts\Http\Controllers')
    ->group(base_path('modules/Contacts/routes.php'));
