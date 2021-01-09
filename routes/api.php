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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::namespace('App\\Http\\Controllers\\API')->group(function () {
    Route::middleware('auth:api')->group(function () {
        Route::get('todolist', 'ToDoController@index');
        Route::post('todos', 'ToDoController@store');
        Route::post('todoUpdate/{id}', 'ToDoController@update');
        Route::get('todoEdit/{id}', 'ToDoController@show');
        Route::delete('todoDelete/{id}', 'ToDoController@delete');
        Route::post('todoComplete/{id}', 'ToDoController@updateCompleted');
        Route::get('tododashboard', 'ToDoController@dashboard');
        
        Route::apiResources([
            'todo' => 'ToDoController',
        ]);
    });
});
