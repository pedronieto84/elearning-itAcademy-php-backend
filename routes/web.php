<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ModuleController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\TopicController;
use App\Http\Controllers\CardController;

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
    return view('welcome');
});


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

//Topic
Route::get('/getTopics', [TopicController::class, 'getTopics' ]);
Route::get('/getTopic/{id}', [TopicController::class, 'getTopic' ]);
Route::post('/createTopic', [TopicController::class, 'createTopic' ]);
Route::put('/updateTopic/{id}', [TopicController::class, 'updateTopic' ]);
Route::delete('/deleteTopic/{id}', [TopicController::class, 'deleteTopic' ]);

//Card
Route::get('/getCards', [CardController::class, 'getCards' ]);
Route::get('/getCard/{id}', [CardController::class, 'getCard' ]);
Route::post('/createCard', [CardController::class, 'createCard' ]);
Route::put('/updateCard/{id}', [CardController::class, 'updateCard' ]);
Route::delete('/deleteCard/{id}', [CardController::class, 'deleteCard' ]);