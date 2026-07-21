<?php
use Illuminate\Support\Facades\Route;
Route::get('/', 'App\Http\Controllers\Client\ClientController@index')->name("client.index");
