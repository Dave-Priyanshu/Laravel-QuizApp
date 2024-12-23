<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

//Home page Route
// Route::get('/', function () {return view('index');})->name('home')->middleware('auth');


//show login form
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

//Register page route
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);


Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Categories Route
Route::middleware(['auth','admin'])->group(function(){
    Route::get('/',function(){return view('admin.dashboard');})->name('admin.dashboard');
    Route::get('/categories',[CategoryController::class,'index'])->name('admin.categories.index');
    Route::get('/categories/create',[CategoryController::class,'create'])->name('admin.categories.create');
    Route::post('/categories/store',[CategoryController::class,'store'])->name('admin.categories.store');
    Route::get('/categories/edit/{id}',[CategoryController::class,'edit'])->name('admin.categories.edit');  
    Route::post('/categories/update/{id}',[CategoryController::class,'update'])->name('admin.categories.update');
    Route::delete('/categories/destroy/{id}',[CategoryController::class,'destroy'])->name('admin.categories.destroy');

});
