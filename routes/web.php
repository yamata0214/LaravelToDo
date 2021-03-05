<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\ToDoMiddleware;
use App\Http\Controllers\MailController;

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

Route::get('ToDo', 'ToDoController@index');
Route::post('task', 'ToDoController@post');

Route::get('registration','ToDoController@registration');

Route::get('passForgot','ToDoController@passForgot');
Route::post('passSend','ToDoController@passSend');

Route::post('add','ToDoController@create');

Route::post('newTask','ToDoController@newTask');

Route::post('taskcUpDel','ToDoController@updateOrDelete');

Route::post('update','ToDoController@newTask');

Route::get('logout','ToDoController@logout');
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
