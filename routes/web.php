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

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/weather', 'WeatherController@index')->name('weather');

Route::post('save_student', 'StudentController@save_student')->name('save.student');
Route::get('all_students', 'StudentController@all_students')->name('show.students');
Route::get('edit_student/{id}', 'StudentController@edit_student')->name('edit.students');
Route::put('updateStudent/{id}', 'StudentController@updateStudent')->name('update.student');
Route::delete('deleteStudent/{id}', 'StudentController@deleteStudent')->name('delete.student');
