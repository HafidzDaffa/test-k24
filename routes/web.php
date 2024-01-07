<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MemberController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::middleware(['guest'])->group(function () {

    Route::get('/', [AuthController::class, 'loginIndex'])->name('login.index');
    Route::post('/login', [AuthController::class, 'login'])->name('login.store');
    
    Route::get('/register', [AuthController::class, 'registerIndex'])->name('register.index');
    Route::post('/register', [AuthController::class, 'register'])->name('register.store');
});

Route::middleware(['auth'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::group(['middleware' => ['role:admin']], function() {
        Route::get('/dashboard-admin', [AdminController::class, 'index'])->name('admin.index');
        Route::get('/user-list', [AdminController::class, 'userList'])->name('user.list');
    
        Route::get('/user', [UserController::class, 'index'])->name('user.index');
        Route::get('/user/create', [UserController::class, 'create'])->name('user.create');
        Route::post('/user', [UserController::class, 'store'])->name('user.store');
        Route::delete('/user/{user}', [UserController::class, 'destroy'])->name('user.destroy');
    });

    Route::group(['middleware' => ['role:member']], function() {
        Route::get('/dashboard-member', [MemberController::class, 'index'])->name('member.index');
    });

    Route::get('/user/{user}', [UserController::class, 'show'])->name('user.show');
    Route::get('/user/{user}/edit', [UserController::class, 'edit'])->name('user.edit');
    Route::patch('/user/{user}', [UserController::class, 'update'])->name('user.update');
});
