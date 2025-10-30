<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;

Route::middleware('isGuest')->group(function () {
    Route::get('/', [TodoController::class, 'login'])->name('login.index');
    Route::post('/login', [TodoController::class, 'auth'])->name('login.auth');
    Route::get('/register', [TodoController::class, 'register'])->name('register');
    Route::post('/register', [TodoController::class, 'registerAccount'])->name('register.createAccount');
});

Route::get('/logout', [TodoController::class, 'logout'])->name('logout');

Route::middleware('isLogin')->prefix('/todo')->name('todo.')->group(function () {
    Route::get('/', [TodoController::class, 'index'])->name('index');
    Route::get('/create', [TodoController::class, 'create'])->name('create');
    Route::post('/store', [TodoController::class, 'store'])->name('store');

    Route::get('/edit/{id}', [TodoController::class, 'edit'])->name('edit');
    Route::patch('/update/{id}', [TodoController::class, 'update'])->name('update');
    Route::delete('/destroy/{id}', [TodoController::class, 'destroy'])->name('destroy');
    Route::patch('/completed/{id}', [TodoController::class, 'updatetoCompleted'])->name('update-completed');
});
