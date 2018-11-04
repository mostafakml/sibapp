<?php

use Illuminate\Http\Request;

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

Route::namespace('Api\Dashboard')->group(function () {

    Route::group(['prefix' => 'dashboard'], function () {
        Route::resource('question', 'QuestionController', [
            'names' => [
                'index' => 'dashboard.question.index',
                'store' => 'dashboard.question.store',
                'create' => 'dashboard.question.create',
                'destroy' => 'dashboard.question.destroy',
                'update' => 'dashboard.question.update',
                'edit' => 'dashboard.question.edit',
                'show' => 'dashboard.question.show',
            ]
        ]);
        Route::resource('question.answer', 'AnswerController',
            [
                'names' => [
                    'index' => 'dashboard.question.answer.index',
                    'show' => 'dashboard.question.answer.show',
                ]
            ]);



    });
});

Route::namespace('Api\Admin')->group(function () {

    Route::group(['prefix' => 'admin'], function () {
        Route::resource('question', 'QuestionController',
            [
                'names' => [
                    'index' => 'admin.question.index',
                    'store' => 'admin.question.store',
                    'create' => 'admin.question.create',
                    'destroy' => 'admin.question.destroy',
                    'update' => 'admin.question.update',
                    'edit' => 'admin.question.edit',
                    'show' => 'admin.question.show',
                ]
            ]);
        Route::resource('question.answer', 'AnswerController',
            [
                'names' => [
                    'store' => 'admin.question.answer.store',
                    'create' => 'admin.question.answer.create',
                ]
            ]);



    });


});
