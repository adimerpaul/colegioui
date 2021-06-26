<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route::group(['middleware'=>'auth'],function(){
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::apiResource('/teacher',\App\Http\Controllers\TeacherController::class);
    Route::apiResource('/curso',\App\Http\Controllers\CursoController::class);
    Route::apiResource('/student',\App\Http\Controllers\StudentController::class);
    Route::post('/upload',[\App\Http\Controllers\StudentController::class,'upload']);
});

