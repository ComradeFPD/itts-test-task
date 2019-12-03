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

Route::group(['prefix' => 'students'], function(){
    Route::get('/', 'StudentsController@index')->name('students.view');
    Route::get('/create', 'StudentsController@getCreate')->name('students.create');
    Route::post('/create', 'StudentsController@postCreate')->name('students.create-post');
    Route::get('/update/{id}', 'StudentsController@getUpdate')->name('students.update');
    Route::post('/update', 'StudentsController@postUpdate')->name('students.update-post');
    Route::get('/delete/{id}', 'StudentsController@getDelete')->name('students.delete');
    Route::post('/search', 'StudentsController@postAjaxSearch');
});

Route::group(['prefix' => 'marks'], function (){
    Route::get('/view/{id}', 'MarksController@index')->name('marks.view');
    Route::get('/create', 'MarksController@getCreate')->name('marks.create');
    Route::post('/create', 'MarksController@postCreate')->name('marks.create-post');
    Route::get('/update/{id}', 'MarksController@getUpdate')->name('marks.update');
    Route::post('/update', 'MarksController@postUpdate')->name('marks.update-post');
    Route::get('/delete/{id}', 'MarksController@getDelete')->name('marks.delete');
    Route::post('/search', 'MarksController@postAjaxSearch');
});
