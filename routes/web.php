<?php

use App\Http\Controllers\ChangePasswordController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Auth::routes(['verify' => true]);

Route::get('home', 'HomeController@index')->name('home'); // done
Route::get('/', 'HomeController@welcome')->name('welcome');
Route::get('terms', 'HomeController@tos')->name('terms');
Route::get('help', 'HomeController@help')->name('help');

Route::get('notifications', 'NotificationsController@index')->name('notifications');

Route::get('users', 'UsersController@index')->name('users.index');
Route::get('users/{user}', 'UsersController@show')->name('users.show'); // done
Route::patch('users/{user}', 'UsersController@update')->name('users.update'); // done
Route::get('users/{user}/edit', 'UsersController@edit')->name('users.edit'); // done

Route::get('password/change', 'ChangePasswordController@change')->name('password.change');
Route::post('password/change', 'ChangePasswordController@new')->name('password.new');

Route::get('email/change', 'EmailChangeController@verify')->name('email.change'); // done

Route::get('plans', 'PlansController@index')->name('plans.index');
Route::get('plans/{plan}', 'PlansController@show')->name('plans.show');

Route::get('assignments', 'AssignmentsController@index')->name('assignments.index'); // done
Route::post('assignments', 'AssignmentsController@store')->name('assignments.store'); // done
Route::get('assignments/create', 'AssignmentsController@create')->name('assignments.create'); // done
Route::get('assignments/{assignment}', 'AssignmentsController@show')->name('assignments.show'); // done
Route::patch('assignments/{assignment}', 'AssignmentsController@update')->name('assignments.update'); // done
Route::delete('assignments/{assignment}', 'AssignmentsController@destroy')->name('assignments.destroy'); // done
Route::get('assignments/{assignment}/edit', 'AssignmentsController@edit')->name('assignments.edit'); // done
Route::get('assignments/{assignment}/delete', 'AssignmentsController@delete')->name('assignments.delete'); // done
Route::post('assignments/{assignment}/imageUpload', 'AssignmentsController@uploadStore')->name('assignments.imageUploadStore'); // done
Route::delete('assignments/{assignment}/imageUpload', 'AssignmentsController@uploadDestroy')->name('assignments.imageUploadDestroy'); // done

Route::get('requests', 'RequestController@index')->name('requests.index');
Route::get('assignments/{assignment}/request/create', 'RequestController@create')->name('requests.create'); // done
Route::post('assignments/{assignment}/request', 'RequestController@store')->name('requests.store'); // done
Route::get('requests/{request}/edit', 'RequestController@edit')->name('requests.edit');
Route::patch('requests/{request}', 'RequestController@update')->name('requests.update');
Route::get('requests/{request}/accept', 'RequestController@accept')->name('requests.accept');
Route::post('requests/{request}/accept', 'RequestController@answer')->name('requests.answer');
Route::post('requests/{request}/reject', 'RequestController@reject')->name('requests.reject');
Route::get('requests/{request}/delete', 'RequestController@delete')->name('requests.delete');
Route::delete('requests/{request}', 'RequestController@destroy')->name('requests.destroy');

Route::post('requests/{request}/offer/accept', 'RequestController@acceptOffer')->name('requests.accept_offer');
Route::post('requests/{request}/offer/reject', 'RequestController@rejectOffer')->name('requests.reject_offer');
Route::post('requests/{request}/offer/pay_test', 'RequestController@payTest')->name('requests.test_pay');

Route::get('answers', 'AnswersController@index')->name('answers.index'); // done
Route::get('assignments/{assignment}/answer', 'AnswersController@create')->name('answers.create'); // done
Route::post('assignments/{assignment}/answer', 'AnswersController@store')->name('answers.store'); // done
Route::get('answers/{answer}', 'AnswersController@show')->name('answers.show'); // done
Route::patch('answers/{answer}', 'AnswersController@update')->name('answers.update'); // done
Route::delete('answers/{answer}', 'AnswersController@destroy')->name('answers.destroy'); // done
Route::get('answers/{answer}/edit', 'AnswersController@edit')->name('answers.edit'); // done
Route::get('answers/{answer}/delete', 'AnswersController@delete')->name('answers.delete'); // done
Route::post('answers/{answer}/imageUpload', 'AnswersController@uploadStore')->name('answers.imageUploadStore'); // done
Route::delete('answers/{answer}/imageUpload', 'AnswersController@uploadDestroy')->name('answers.imageUploadDestroy'); // done

Route::get('answers/{answer}/accept', 'AnswersController@approve')->name('answers.approve');
Route::post('answers/{answer}', 'AnswersController@accept')->name('answers.accept');

Route::post('imageUpload', 'AttachmentUploadController@store')->name('imageUpload.store'); // done
Route::delete('imageUpload', 'AttachmentUploadController@destroy')->name('imageUpload.destroy'); // done