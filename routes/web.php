<?php

use App\Http\Controllers\PasswordController;
use App\Http\Controllers\UserController;
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
    return view('home');
})->name('home');


Route::post('/validate', [UserController::class,'userValidate'])->name('userValidate');
// путь для валидации данных при регистрации
Route::post('/validate/login', [UserController::class,'loginValidate'])->name('loginValidate');
// путь для валидации данных при авторизации
Route::post('/validate/exit', [UserController::class,'exit'])->name('exit');
// путь для выхода из учётной записи


Route::get('/register', [UserController::class,'create'])->name('register');
// путь на страницу регистрации
Route::get('/login', [UserController::class,'authorisation'])->name('login');
// путь на страницу авторизации


Route::get('/{user_id}',[UserController::class,'show'])->name('user');
// путь для личного кабинета
Route::get('/{id}/edit',[UserController::class,'edit']);
// страница редактирования личного кабинета
Route::get('/profile/validate',[UserController::class,'update']);
// путь для валидации и обновления данных учётной записи в бд


Route::get('/password/create', [PasswordController::class,'create'])->name('new_password');

