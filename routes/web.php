<!--

    Don't forget to run
    "create database todolist"
    and 
    "php artisan migrate"
    before opening site
    to create the db and table.

-->

<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'App\Http\Controllers\TaskController@index');
Route::post('/save', 'App\Http\Controllers\TaskController@save');
Route::post('/changestatus/{id}', 'App\Http\Controllers\TaskController@changestatus');
Route::post('/editname/{id}', 'App\Http\Controllers\TaskController@editname');
Route::delete('/delete/{id}', 'App\Http\Controllers\TaskController@delete');