<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CourseController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return redirect('/home');
});

Route::get('/home', [HomeController::class, 'index'])->name('home');

// Auth routes (login, register, logout, etc.)
// If you use Laravel 8+ defaults:
Auth::routes();

// Admin routes
Route::middleware(['auth', 'checkrole:admin'])->group(function () {
    Route::get('/admin/create-user', [AdminController::class, 'createUserForm'])->name('admin.createUserForm');
    Route::post('/admin/store-user', [AdminController::class, 'storeUser'])->name('admin.storeUser');
});

// Instructor routes
Route::middleware(['auth', 'checkrole:instructor'])->group(function () {
    Route::get('/courses/create', [CourseController::class, 'create'])->name('courses.create');
    Route::post('/courses/store', [CourseController::class, 'store'])->name('courses.store');
});

// Student & Instructor can see all courses, enroll, etc.
Route::middleware(['auth'])->group(function () {
    Route::get('/courses', [CourseController::class, 'index'])->name('courses.index');
    Route::get('/courses/{course}', [CourseController::class, 'show'])->name('courses.show');

    // Student enroll
    Route::get('/courses/{id}/enroll', [CourseController::class, 'enrollForm'])->name('courses.enrollForm');
    Route::post('/courses/{id}/enroll', [CourseController::class, 'enroll'])->name('courses.enroll');

    // Student can see their courses
    Route::get('/my-courses', [CourseController::class, 'myCourses'])->name('courses.myCourses');
});
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


// Route for course deletion
Route::delete('/courses/{id}', [CourseController::class, 'destroy'])->name('courses.destroy');
Route::get('/courses/{course}/delete', [CourseController::class, 'confirmDelete'])->name('courses.delete');
