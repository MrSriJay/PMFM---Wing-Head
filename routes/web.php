<?php

use Illuminate\Support\Facades\Auth;
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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

/*--------------------------------------------------------------------------------------------------------*/ 
                                            //ADMIN//
/*--------------------------------------------------------------------------------------------------------*/ 
Route::group(['middleware' => ['auth','admin']],function() {

    Route::get('/admin-dashboard', function () {
    return view('admin.dashboard');
});

Route::get('/user-register', [App\Http\Controllers\Admin\UserController::class, 'registered']);
Route::get('/user-edit/{id}', [App\Http\Controllers\Admin\UserController::class, 'registeredit']);
Route::put('/user-register-update/{id}', [App\Http\Controllers\Admin\UserController::class, 'registerupdate']);
Route::delete('/user-delete/{id}', [App\Http\Controllers\Admin\UserController::class, 'registerdelete']);
});

/*--------------------------------------------------------------------------------------------------------*/ 
                                            //WING HEAD//
/*--------------------------------------------------------------------------------------------------------*/ 
Route::group(['middleware' => ['auth','winghead']],function() {

    Route::get('/winghead-dashboard', function () {
    return view('winghead.dashboard');
});

Route::get('/project-register', [App\Http\Controllers\Winghead\ProjectController::class, 'index']);
Route::get('/project-form', [App\Http\Controllers\Winghead\ProjectController::class, 'create']);
Route::post('/project-register-save', [App\Http\Controllers\Winghead\ProjectController::class,'store']);
Route::get('/project-register-view/{id}', [App\Http\Controllers\Winghead\ProjectController::class,'index2']);
Route::get('/project-register-edit/{id}', [App\Http\Controllers\Winghead\ProjectController::class,'edit']);
Route::put('/project-register-update/{id}', [App\Http\Controllers\Winghead\ProjectController::class,'update']);
Route::delete('/project-register-delete/{id}', [App\Http\Controllers\Winghead\ProjectController::class,'delete']);

Route::get('/complaint-register', [App\Http\Controllers\Winghead\ComplaintController::class,'index']);
Route::get('/project-form', [App\Http\Controllers\Winghead\ProjectController::class, 'create']);
Route::post('/complaint-register-save', [App\Http\Controllers\Winghead\ComplaintController::class,'store']);
Route::get('/complaint-register-edit/{id}', [App\Http\Controllers\Winghead\ComplaintController::class,'edit']);
Route::put('/complaint-register-update/{id}', [App\Http\Controllers\Winghead\ComplaintController::class,'update']);
Route::delete('/complaint-register-delete/{id}', [App\Http\Controllers\Winghead\ComplaintController::class,'delete']);
});

/*--------------------------------------------------------------------------------------------------------*/ 
                                            //CLIENT//
/*--------------------------------------------------------------------------------------------------------*/ 
Route::group(['middleware' => ['auth','client']],function() {

    Route::get('/client-dashboard', function () {
    return view('client.dashboard');
});

Route::post('/save-complaint', [App\Http\Controllers\Client\ComplaintController::class,'store']);
});

/*--------------------------------------------------------------------------------------------------------*/ 
                                            //DEVELOPER//
/*--------------------------------------------------------------------------------------------------------*/
Route::resource('developer', App\Http\Controllers\Developer\DeveloperController::class);
