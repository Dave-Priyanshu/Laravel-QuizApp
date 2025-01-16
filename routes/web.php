<?php

use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Password;
use App\Http\Controllers\admin\QuestionController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\user\UserPanelController;
use Illuminate\Support\Facades\Route;

Route::get('/home', [TestimonialController::class, 'index'])->name('landing.page');

Route::get('/about',function(){
    return view('personal.about2');
})->name('about');

Route::get('/contact',function(){
    return view('personal.contact');
})->name('contact');

Route::get('/rules',function(){
    return view('personal.rules');
})->name('rules');

// Home page route
Route::get('/', function () {
    if (!auth()->check()) {
        // Redirect unauthenticated users to the landing page
        return redirect()->route('landing.page');
    }

    // Redirect authenticated users to their respective dashboards
    return redirect()->route(auth()->user()->role === 'admin' ? 'admin.dashboard' : 'user.welcome.page');
})->name('home');

//show login form
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'login']);

//Register page route
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register')->middleware('guest');
Route::post('/register', [AuthController::class, 'register']);

// OTP Verification Routes
Route::get('/verify-otp', [AuthController::class, 'showOtpForm'])->name('verify.otp');
Route::post('/verify-otp', [AuthController::class, 'verifyOtp'])->name('verify.otp.submit');


Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

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

    // quiz time routes
    Route::get('/timed-quiz', [UserPanelController::class, 'timedQuiz'])->name('quiz.timed');
    Route::post('/timed-quiz/submit', [UserPanelController::class, 'storeTimedAnswers'])->name('quiz.timed.submit');

    // show multi select que route
    Route::get('/quiz/{type}', [QuizController::class, 'showQuestions'])->name('quiz.show');
    Route::post('/quiz/submit', [QuizController::class, 'storeQuizAnswers'])->name('quiz.submit');

    // testimonial route
    Route::get('/testimonial', [TestimonialController::class, 'index'])->name('testimonial.index');

    
});
// password reset
Route::get('password/reset', [AuthController::class, 'showForgotPasswordForm'])->name('password.request');
Route::post('password/email', [AuthController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('password/reset/{token}', [AuthController::class, 'showResetPasswordForm'])->name('password.reset');
Route::post('password/reset', [AuthController::class, 'resetPassword'])->name('password.update');

Route::post('/store-testimonial', [TestimonialController::class, 'store'])->name('testimonial.store');