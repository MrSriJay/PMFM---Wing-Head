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

Route::group(['middleware' => ['auth','admin']],function() {

    Route::get('/dashboard', function () {
        return view('admin.dashboard');
});

Route::get('/user-register', [App\Http\Controllers\Admin\UserController::class, 'registered']);
Route::get('/user-edit/{id}', [App\Http\Controllers\Admin\UserController::class, 'registeredit']);
Route::put('/user-register-update/{id}', [App\Http\Controllers\Admin\UserController::class, 'registerupdate']);
Route::delete('/user-delete/{id}', [App\Http\Controllers\Admin\UserController::class, 'registerdelete']);

Route::get('/project-form', [App\Http\Controllers\Admin\ProjectController::class, 'create']);
Route::get('/project-register', [App\Http\Controllers\Admin\ProjectController::class, 'index']);

Route::post('/save-projects', [App\Http\Controllers\Admin\ProjectController::class,'store']);
Route::get('/project-register-edit/{id}', [App\Http\Controllers\Admin\ProjectController::class,'edit']);
Route::put('/project-register-update/{id}', [App\Http\Controllers\Admin\ProjectController::class,'update']);
Route::delete('/project-register-delete/{id}', [App\Http\Controllers\Admin\ProjectController::class,'delete']);

Route::get('/complaint-register', [App\Http\Controllers\Admin\ComplaintController::class,'index']);
Route::post('/save-complaint', [App\Http\Controllers\Admin\ComplaintController::class,'store']);
Route::get('/complaint-edit/{id}', [App\Http\Controllers\Admin\ComplaintController::class,'edit']);
Route::put('/complaint-update/{id}', [App\Http\Controllers\Admin\ComplaintController::class,'update']);
Route::delete('/complaint-register-delete/{id}', [App\Http\Controllers\Admin\ComplaintController::class,'delete']);
});