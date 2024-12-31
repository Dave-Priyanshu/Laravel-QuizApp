<?php

use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\Auth\AuthController;

use App\Http\Controllers\admin\QuestionController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\user\UserPanelController;
use Illuminate\Support\Facades\Route;

// Home page route
Route::get('/', function () {
    if (auth()->check()) {
        // Redirect authenticated users to their respective dashboards
        return redirect()->route(auth()->user()->is_admin ? 'admin.dashboard' : 'users.panel.home');
    }

    // Return the landing page if the user is not authenticated
    return view('users.login');
})->name('home');



//show login form
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

//Register page route
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);


Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Categories Route
Route::middleware(['auth','admin'])->prefix('admin')->group(function(){
    Route::get('/',function(){return view('admin.dashboard');})->name('admin.dashboard');
    Route::get('/categories',[CategoryController::class,'index'])->name('admin.categories.index');
    Route::get('/categories/create',[CategoryController::class,'create'])->name('admin.categories.create');
    Route::post('/categories/store',[CategoryController::class,'store'])->name('admin.categories.store');
    Route::get('/categories/edit/{id}',[CategoryController::class,'edit'])->name('admin.categories.edit');  
    Route::post('/categories/update/{id}',[CategoryController::class,'update'])->name('admin.categories.update');
    Route::delete('/categories/destroy/{id}',[CategoryController::class,'destroy'])->name('admin.categories.destroy');


    // Users Related Route
    // show all the users
    Route::get('/admin/users',[UserController::class,'index'])->name('admin.users.index');

    //edit a specific user
    Route::get('/admin/users/{user}/edit',[UserController::class,'edit'])->name('admin.users.edit');

    // update a specific user
    Route::put('/admin/users/{user}',[UserController::class,'update'])->name('admin.users.update');

    // delete a specifc user
    Route::delete('/admin/users/{user}',[UserController::class,'destroy'])->name('admin.users.destroy');

    // Toggle admin
    Route::patch('/admin/users/{user}/toggle', [UserController::class, 'toggleAdmin'])->name('admin.toggleAdmin');


    // Questions related routes
    Route::get('/admin/questions', [QuestionController::class, 'index'])->name('admin.questions.index');
    
    // Create a new question
    Route::get('/admin/questions/create', [QuestionController::class, 'create'])->name('admin.questions.create');
    Route::post('/admin/questions/store', [QuestionController::class, 'store'])->name('admin.questions.store');
    
    // Edit a specific question
    Route::get('/admin/questions/{question}/edit', [QuestionController::class, 'edit'])->name('admin.questions.edit');
    Route::put('/admin/questions/{question}', [QuestionController::class, 'update'])->name('admin.questions.update');
    
    // Delete a specific question
    Route::delete('/admin/questions/{question}', [QuestionController::class, 'destroy'])->name('admin.questions.destroy');

    // update admin profile
    Route::get('/admin-profile', [AuthController::class, 'editProfile'])->name('admin.panel.profile.edit');
    Route::post('/admin-profile', [AuthController::class, 'updateProfile'])->name('admin.panel.profile.update');
    
});

// Frontend related routes for user
Route::middleware(['auth'])->prefix('users')->group(function(){
    // display all the categories
    Route::get('/',function(){ return view('users.welcome');})->name('user.welcome.page');
    Route::get('/quiz',[UserPanelController::class,'index'])->name('users.panel.quiz');

    // show que for sepcific category
    Route::get('category/{category}',[UserPanelController::class,'showQuestions'])->name('users.panel.questions');

    Route::post('/submit-quiz/{categoryId}',[UserPanelController::class,'storeAnswers'])->name('users.panel.storeAnswers');

    Route::get('/analytics', [UserPanelController::class, 'analytics'])->name('users.panel.analytics');

    // update user profile
    Route::get('/profile', [UserPanelController::class, 'editProfile'])->name('users.panel.profile.edit');
    Route::post('/profile', [UserPanelController::class, 'updateProfile'])->name('users.panel.profile.update');
    // Route::post('/profile/remove-picture', [UserController::class, 'removeProfilePicture'])->name('users.panel.profile.removePicture');

    // Route::get('/welcomePage',function(){
    //     return view('users.welcome');
    // })->name('user.welcome.page');

});


