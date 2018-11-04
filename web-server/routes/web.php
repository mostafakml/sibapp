<?php

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

Auth::routes();


Route::namespace('Dashboard')->group(function () {

    Route::group(['prefix' => 'dashboard', 'middleware' => ['role:admin|writer']], function () {
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

Route::namespace('Admin')->group(function () {

    Route::group(['prefix' => 'admin', 'middleware' => ['role:admin']], function () {
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


Route::get('/home', 'HomeController@index')->name('home');


