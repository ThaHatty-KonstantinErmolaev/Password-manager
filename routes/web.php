<?php

use App\Http\Controllers\PasswordCategory\PasswordCategoryController;
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

Route::middleware('prevent_multi_authorization')->group(function () {
    Route::get('/register', [UserController::class,'create'])
        ->name('register');
// путь на страницу регистрации
    Route::get('/login', [UserController::class,'authorization'])
        ->name('login');
// путь на страницу авторизации
});


Route::post('/validate', [UserController::class,'userValidate'])
    ->name('userValidate');
// путь для валидации данных при регистрации
Route::post('/validate/login', [UserController::class,'loginValidate'])
    ->name('loginValidate');
// путь для валидации данных при авторизации


Route::middleware('check_authorization')->group(function () {

    Route::post('/validate/exit', [UserController::class,'exit'])
        ->name('exit');
// путь для выхода из учётной записи


    Route::get('/passwords', [PasswordController::class, 'index'])
        ->name('user_passwords');
    Route::get('/password/create', [PasswordController::class,'create'])
        ->name('new_password');
    Route::get('/password/edit/{id}', [PasswordController::class, 'edit'])
        ->name('edit_password');
// путь на страницу создания пароля
    Route::get('/password/validate', [PasswordController::class,'store'])
        ->name('validate_password');
// путь для валидации
    Route::post('/password/delete{id}', [PasswordController::class,'delete'])
        ->name('delete_password');
// удаление пароля


    Route::get('/password/category/create',[PasswordCategoryController::class, 'create'])
        ->name('new_category');
// создание категории
    Route::get('/password/category/validate',[PasswordCategoryController::class, 'validate']);
// валидация запроса создания категории
    Route::get('/password/category', [PasswordCategoryController::class, 'index'])
        ->name('password_category');
// все категории
    Route::get('/password/category/edit/{id}', [PasswordCategoryController::class, 'edit']);
// редактировать категорию
    Route::get('/password/category/edit/validate/{id}', [PasswordCategoryController::class, 'update']);
// обновить категорию
    Route::get('/password/category/delete/{id}', [PasswordCategoryController::class, 'destroy'])
        ->name('delete_password_category');
// удалить категорию


    Route::get('/profile/delete',[UserController::class,'delete']);
// удаления пользователя
    Route::get('/{user_id}',[UserController::class,'show'])
        ->name('user');
// путь для личного кабинета
    Route::get('/{id}/edit',[UserController::class,'edit']);
// страница редактирования личного кабинета
    Route::post('/profile/validate',[UserController::class,'update']);
});

// путь для валидации и обновления данных учётной записи в бд



