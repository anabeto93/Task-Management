<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['prefix' => 'v1'], function () {
    Route::post('projects', 'CreateProjectController')->name('projects.create');

    Route::post('tasks', 'CreateTaskController')->name('tasks.create');
    Route::delete('tasks/{id}', 'DeleteTaskController')->name('tasks.delete');
    Route::put('tasks/{id}', 'UpdateTaskController')->name('tasks.update');
});
