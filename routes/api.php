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
Route::group([
    'prefix' => 'v1',
], function () {
    // Store comment
    Route::post('comment', 'CommentController@store')->name('comment.store');
    // List comments
    Route::get('comment', 'CommentController@index')->name('comment.index');
});

