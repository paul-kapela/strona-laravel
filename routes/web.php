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

Auth::routes(['verify' => true]);

Route::get('home', 'HomeController@index')->name('home');

Route::get('users', 'UsersController@index')->name('users.index');
Route::get('users/{user}', 'UsersController@show')->name('users.show');
Route::get('users/{user}/edit', 'UsersController@edit')->name('users.edit');

Route::get('plans', 'PlanController@index')->name('plans.index');

Route::get('assignments', 'AssignmentsController@index')->name('assignments.index'); // done
Route::post('assignments', 'AssignmentsController@store')->name('assignments.store'); // done
Route::get('assignments/create', 'AssignmentsController@create')->name('assignments.create'); // done
Route::get('assignments/{assignment}', 'AssignmentsController@show')->name('assignments.show'); // done
Route::patch('assignments/{assignment}', 'AssignmentsController@update')->name('assignments.update'); // done
Route::delete('assignments/{assignment}', 'AssignmentsController@destroy')->name('assignments.destroy'); // done
Route::get('assignments/{assignment}/edit', 'AssignmentsController@edit')->name('assignments.edit'); // done
Route::get('assignments/{assignment}/delete', 'AssignmentsController@delete')->name('assignments.delete'); // done
Route::post('assignments/{assignment}/imageUpload', 'AssignmentsController@imageUploadStore')->name('assignments.imageUploadStore'); // done
Route::delete('assignments/{assignment}/imageUpload', 'AssignmentsController@imageUploadDestroy')->name('assignments.imageUploadDestroy'); // done

Route::get('answers', 'AnswersController@index')->name('answers.index'); // done
Route::get('assignments/{assignment}/answer', 'AnswersController@create')->name('answers.create'); // done
Route::post('assignments/{assignment}/answer', 'AnswersController@store')->name('answers.store'); // done
Route::get('answer/{answer}', 'AnswersController@show')->name('answers.show'); // done
Route::patch('answer/{answer}', 'AnswersController@update')->name('answers.update'); // done
Route::delete('answer/{answer}', 'AnswersController@destroy')->name('answers.destroy'); // done
Route::get('answer/{answer}/edit', 'AnswersController@edit')->name('answers.edit'); // done
Route::get('answer/{answer}/delete', 'AnswersController@delete')->name('answers.delete'); // done
Route::post('answers/{answer}/imageUpload', 'AnswersController@imageUploadStore')->name('answers.imageUploadStore'); // done
Route::delete('answers/{answer}/imageUpload', 'AnswersController@imageUploadDestroy')->name('answers.imageUploadDestroy'); // done

Route::post('imageUpload', 'ImageUploadController@store')->name('imageUpload.store'); // done
Route::delete('imageUpload', 'ImageUploadController@destroy')->name('imageUpload.destroy'); // done
