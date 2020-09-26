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

Route::get('test', function () {
    return view('sidebartest');
});

Auth::routes(['verify' => true]);

Route::get('home', 'HomeController@index')->name('home');

Route::get('user/{user}', 'UsersController@index')->name('users.index');
Route::get('user/{user}/edit', 'UsersController@edit')->name('users.edit');

Route::get('assignments', 'AssignmentsController@index')->name('assignments.index'); // done
Route::post('assignments', 'AssignmentsController@store')->name('assignments.store'); // done
Route::get('assignments/create', 'AssignmentsController@create')->name('assignments.create'); //done
Route::get('assignments/{assignment}', 'AssignmentsController@show')->name('assignments.show'); //done
Route::patch('assignments/{assignment}', 'AssignmentsController@update')->name('assignments.update');
Route::delete('assignments/{assignment}', 'AssignmentsController@destroy')->name('assignments.destroy');
Route::get('assignments/{assignment}/edit', 'AssignmentsController@edit')->name('assignments.edit'); //done
Route::get('assignments/{assignment}/delete', 'AssignmentsController@delete')->name('assignments.delete');
Route::post('assignments/{assignment}/imageUpload', 'AssignmentsController@imageUploadStore')->name('assignments.imageUploadStore');
Route::delete('assignments/{assignment}/imageUpload', 'AssignmentsController@imageUploadDestroy')->name('assignments.imageUploadDestroy');

Route::get('assignments/{assignment}/answer', 'AnswersController@create')->name('answers.create'); // done
Route::post('assignments/{assignment}/answer', 'AnswersController@store')->name('answers.store'); // done
Route::patch('answer/{answer}', 'AnswerController@update')->name('answers.update');
Route::get('answer/{answer}/edit', 'AnswersController@edit')->name('answers.edit');

Route::post('imageUpload', 'ImageUploadController@store')->name('imageUpload.store'); // done
Route::delete('imageUpload', 'ImageUploadController@destroy')->name('imageUpload.destroy'); // done

