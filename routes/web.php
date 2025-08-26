<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\HomeController;
use App\Models\Course;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;

Route::get('/', function () {
    $courses = Course::all();
    return view('welcome', compact('courses'));
});

Route::resource('courses', CourseController::class);

// Login Routes
Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('login', [AuthenticatedSessionController::class, 'store']);
Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

// Registration Routes
Route::get('register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('register', [RegisteredUserController::class, 'store']);


Route::get('/home', [HomeController::class, 'index'])->name('home');
