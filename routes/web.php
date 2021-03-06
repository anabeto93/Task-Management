<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['verify' => false]);

Route::get('/home', 'HomeController@index')->name('home');
Route::get('projects/{id}', 'TaskController@show')->name('tasks.view');
Route::post('tasks/sort', 'SortTasksController')->name('tasks.sort');

