<?php

use Illuminate\Support\Facades\Route;

Route::name('index')->get('/', 'ContactsController@handle');
Route::name('find')->get('{id}', 'FindContactController@handle');
Route::name('create')->post('/', 'CreateContactController@handle');
Route::name('edit')->put('{id}', 'EditContactController@handle');
Route::name('destroy')->delete('{id}', 'DestroyContactController@handle');
