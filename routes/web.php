<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DestinationController;
use App\Http\Controllers\CommentController;

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

Route::get('/home/login', [UserController::class, 'index'])->name('login');
Route::post('/home/user-login', [UserController::class, 'userLogin'])->name('userLogin');
Route::get('/home/registration', [UserController::class, 'registration'])->name('registration');
Route::post('/home/user-registration', [UserController::class, 'userRegistration'])->name('userRegistration');
Route::get('/home/user-signout', [UserController::class, 'signout'])->name('signout');


Route::resource('/home', DestinationController::class)->middleware('auth');

Route::resource('/home/comments', CommentController::class)->middleware('auth');

