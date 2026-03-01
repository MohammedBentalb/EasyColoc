<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ColocationController;
use App\Http\Controllers\DepenseController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;

Route::get('/', function () { return view('landing'); })->name('home');

Route::middleware('guest')->group(function(){
    Route::get('/login', [AuthController::class, 'loginView'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'registerView'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::middleware('auth')->group(function() {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/colocations', [ColocationController::class, 'home'])->name('colocations.home');
    Route::get('/profile', [UserController::class, 'profile'])->name('profile');
    
    Route::middleware('hasNoColocation')->group(function(){
        Route::get('/colocations/create', [ColocationController::class, 'create'])->name('colocations.create');
        Route::post('/colocations/create', [ColocationController::class, 'store'])->name('colocations.store');
    });

    Route::middleware('hasColocation')->group(function(){    
        Route::post('/colocations', [ColocationController::class, 'store'])->name('colocations.store');
        Route::get('/colocations/{colocation}', [ColocationController::class, 'index'])->name('colocations.index');
        Route::post('/colocations/{colocation}/invite', [ColocationController::class, 'invite'])->name('colocations.invite');
        Route::patch('/colocations/quite/{colocation}/', [ColocationController::class, 'quite'])->name('colocation.quite');
        Route::patch('/colocations/cancel/{colocation}/', [ColocationController::class, 'cancel'])->name('colocation.cancel');
        Route::delete('/colocations/{colocation}/fire/{user}', [UserController::class, 'fireRoommate'])->name('colocation.fire');
        
        Route::get('/categories/{colocation}', [CategoryController::class, 'index'])->name('categories');
        Route::post('/categories/{colocation}', [CategoryController::class, 'store'])->name('categories.create');
        Route::delete('/categories/{colocation}/{category}', [CategoryController::class, 'delete'])->name('categories.delete');

        Route::get('/colocations/{colocation}/expenses', [DepenseController::class, 'index'])->name('expenses.index');
        Route::get('/colocations/{colocation}/expenses/create', [DepenseController::class, 'create'])->name('expenses.create');
        Route::post('/colocations/{colocation}/expenses', [DepenseController::class, 'store'])->name('expenses.store');
        Route::get('/expenses/{depense}', [DepenseController::class, 'show'])->name('expenses.show');
        Route::post('/expenses/{depense}', [DepenseController::class, 'pay'])->name('expenses.pay');
    });
    
    Route::get('/colocations/{colocation}/add', [ColocationController::class, 'add'])->name('colocations.invite');

    Route::middleware('admin')->group(function(){
        Route::get('/users', [UserController::class, 'index'])->name('users.index');
        Route::patch('/users/{user}/ban', [UserController::class, 'banUser'])->name('users.ban');
        Route::patch('/users/{user}/unban', [UserController::class, 'unbanUser'])->name('users.unban');
    });
});