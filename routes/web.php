<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CrudController;

Route::get('/', function () {
    return view('auth.login');
});


Route::get('/mo', function () {
    return view('mo');
});

Route::get('/login', [AuthController::class, 'getLogin'])->name('login');
Route::post('/login', [AuthController::class, 'postLogin']);
Route::get('/register', [AuthController::class, 'getRegister'])->name('register');
Route::post('/register', [AuthController::class, 'postRegister']);
Route::get('/dashboard', [AuthController::class, 'getDashboard'])->name('dashboard');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// Users records
Route::get('/record', [CrudController::class, 'getRecordForm'])->name('record');
Route::get('/create', [CrudController::class, 'getCreateForm'])->name('create');
Route::get('/edit/{id}', [CrudController::class, 'getEditForm'])->name('edit');
Route::post('/edit/{id}', [CrudController::class, 'postEditForm']);
Route::post('/create', [CrudController::class, 'postCreateForm']);
Route::get('/role', [CrudController::class, 'getRoleForm'])->name('role');
Route::delete('/{id}', [CrudController::class, 'getDelete'])->name('delete');
Route::get('/{id}/edit-role', [CrudController::class, 'getEditRole'])->name('edit-role');
Route::put('/{id}/update-role', [CrudController::class, 'updateRole'])->name('update-role');
