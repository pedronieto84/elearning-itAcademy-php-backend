<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


require __DIR__.'/auth.php';



// Course
Route::get('/getCourses', [CourseController::class, 'getCourses' ]);
Route::get('/getCourse/{id}', [CourseController::class, 'getCourse' ]);
Route::post('/createCourse', [CourseController::class, 'createCourse' ]);
Route::put('/updateCourse/{id}', [CourseController::class, 'updateCourse' ]);
Route::delete('/deleteCourse/{id}', [CourseController::class, 'deleteCourse' ]);

// Module
Route::get('/getModules', [ModuleController::class, 'getModules' ]);
Route::get('/getModule/{id}', [ModuleController::class, 'getModule' ]);
Route::post('/createModule', [ModuleController::class, 'createModule' ]);
Route::put('/updateModule/{id}', [ModuleController::class, 'updateModule' ]);
Route::delete('/deleteModule/{id}', [ModuleController::class, 'deleteModule' ]);