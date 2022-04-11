<?php

use Illuminate\Support\Facades\Route;

Route::name('index')->get('/', 'AccountsController@handle');
Route::name('find')->get('{id}', 'FindAccountController@handle');
Route::name('create')->post('/', 'CreateAccountController@handle');
Route::name('edit')->put('{id}', 'EditAccountController@handle');

Route::name('users')->get('{id}/users', 'UsersController@handle');
Route::name('organizations')->get('{id}/organizations', 'OrganizationsController@handle');
