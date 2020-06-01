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

Route::get('/elearning', function () {
    return view('elearning');
});

Route::get('/opinion', function () {
    return view('opinion');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::namespace('Admin')->prefix('admin')->name('admin.')->middleware('can:manage-users')->group(function(){
    Route::resource('/users', 'UsersController', ['expect'=>['show', 'create','store']]);
    Route::resource('/teachers', 'TeachersController', ['expect'=>['show', 'create','store', 'destroy']]);
    Route::resource('/students', 'StudentsController', ['expect'=>['show', 'create','store', 'destroy']]);
    Route::resource('/classes', 'ClassesController', ['expect'=>['show']]);
    Route::resource('/subjects', 'SubjectsController', ['expect'=>['show']]);
    Route::resource('/marks', 'MarksController', ['expect'=>['show']]);
});

Route::namespace('Admin')->prefix('admin')->name('admin.')->middleware('can:manage-marks')->group(function(){
    Route::resource('/marks', 'MarksController', ['expect'=>['show']]);
});
