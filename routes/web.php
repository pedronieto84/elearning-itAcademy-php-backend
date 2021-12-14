<?php

use App\Http\Controllers\ChallengeController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ModuleController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\TopicController;

use App\Http\Controllers\VideoController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\TextController;
use App\Http\Controllers\ListaController;
use App\Http\Controllers\UserController;

use Inertia\Inertia;


///sdafasdfasfasdf


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

//Topic
Route::get('/getTopics', [TopicController::class, 'getTopics' ]);
Route::get('/getTopic/{id}', [TopicController::class, 'getTopic' ]);
Route::post('/createTopic', [TopicController::class, 'createTopic' ]);
Route::put('/updateTopic/{id}', [TopicController::class, 'updateTopic' ]);
Route::delete('/deleteTopic/{id}', [TopicController::class, 'deleteTopic' ]);


//Video
Route::get('/getVideos', [VideoController::class, 'getVideos' ]);
Route::get('/getVideo/{id}', [VideoController::class, 'getVideo' ]);
Route::post('/createVideo', [VideoController::class, 'createVideo' ]);
Route::put('/updateVideo/{id}', [VideoController::class, 'updateVideo' ]);
Route::delete('/deleteVideo/{id}', [VideoController::class, 'deleteVideo' ]);

//Test
Route::get('/getTests', [TestController::class, 'getTests' ]);
Route::get('/getTest/{id}', [TestController::class, 'getTest' ]);
Route::post('/createTest', [TestController::class, 'createTest' ]);
Route::put('/updateTest/{id}', [TestController::class, 'updateTest' ]);
Route::delete('/deleteTest/{id}', [TestController::class, 'deleteTest' ]);

//Text
Route::get('/getTexts', [TextController::class, 'getTexts' ]);
Route::get('/getText/{id}', [TextController::class, 'getText' ]);
Route::post('/createText', [TextController::class, 'createText' ]);
Route::put('/updateText/{id}', [TextController::class, 'updateText' ]);
Route::delete('/deleteText/{id}', [TextController::class, 'deleteText' ]);

//Lista
Route::get('/getListas', [ListaController::class, 'getListas' ]);
Route::get('/getLista/{id}', [ListaController::class, 'getLista' ]);
Route::post('/createLista', [ListaController::class, 'createLista' ]);
Route::put('/updateLista/{id}', [ListaController::class, 'updateLista' ]);
Route::delete('/deleteLista/{id}', [ListaController::class, 'deleteLista' ]);

//Registre Usuari
Route::post('/register', [UserController::class, 'register' ]);
Route::get('/getUsers', [UserController::class, 'getUsers']);

//resolveChallenge
Route::get('/getChallenge/{id}', [ChallengeController::class, 'getChallenge']);