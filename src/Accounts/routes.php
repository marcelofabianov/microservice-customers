<?php

use Illuminate\Support\Facades\Route;

Route::name('index')->get('/', 'AccountsController@handle');
Route::name('find')->get('{id}', 'FindAccountController@handle');
Route::name('create')->post('/', 'CreateAccountController@handle');
Route::name('edit')->put('{id}', 'EditAccountController@handle');
Route::name('destroy')->delete('{id}', 'DestroyAccountController@handle');

Route::name('contacts')->get('{id}/contacts', 'AccountContactsController@handle');
