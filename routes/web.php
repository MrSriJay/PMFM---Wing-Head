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
    return redirect('/login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

/*--------------------------------------------------------------------------------------------------------*/ 
                                            //ADMIN//
/*--------------------------------------------------------------------------------------------------------*/ 
Route::group(['middleware' => ['auth','admin']],function() {

    Route::get('/admin', function () { return view('admin.dashboard');
    });

Route::resource('admin/users', App\Http\Controllers\admin\UserController::class);
Route::resource('admin/wings', App\Http\Controllers\admin\WingsController::class);
Route::resource('admin/projects', App\Http\Controllers\admin\ProjectController::class);
Route::resource('admin/clients', App\Http\Controllers\admin\ClientController::class);

});

/*--------------------------------------------------------------------------------------------------------*/ 
                                            //WING HEAD//
/*--------------------------------------------------------------------------------------------------------*/ 
Route::group(['middleware' => ['auth','winghead']],function() {

    Route::get('/winghead-dashboard', function () {
    return view('winghead.dashboard');
});

Route::get('/files/{id}', [App\Http\Controllers\Winghead\ProjectController::class, 'ViewFiles']);
Route::get('/file-download/{file}', [App\Http\Controllers\Winghead\ProjectController::class, 'DownloadFiles']);

Route::get('/project-register', [App\Http\Controllers\Winghead\ProjectController::class, 'ViewProjects']);
Route::get('/project-form', [App\Http\Controllers\Winghead\ProjectController::class, 'create']);
Route::post('/project-register-save', [App\Http\Controllers\Winghead\ProjectController::class,'store']);
Route::get('/project-register-view/{id}', [App\Http\Controllers\Winghead\ProjectController::class,'ViewProjectDetails']);
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

    Route::get('/client', function () { return view('client.dashboard');
    });
    
Route::resource('client/complaint', App\Http\Controllers\client\ComplaintController::class);
Route::resource('client/purchasedsystems', App\Http\Controllers\client\PurchasedSystemsController::class);

});

/*--------------------------------------------------------------------------------------------------------*/ 
                                            //DEVELOPER//
/*--------------------------------------------------------------------------------------------------------*/
Route::resource('developer', App\Http\Controllers\Developer\DeveloperController::class);


/*--------------------------------------------------------------------------------------------------------*/ 
                                            //Auto Complete Projects//
/*--------------------------------------------------------------------------------------------------------*/

Route::get('/autocomplete', [App\Http\Controllers\client\AutocompleteprojectController::class,'index']);
Route::get('/projects-search', [App\Http\Controllers\client\AutocompleteprojectController::class, 'selectSearch']);
Route::get('/wings-search', [App\Http\Controllers\client\AutocompleteprojectController::class, 'selectSearchWings']);
Route::get('/supervisor-search', [App\Http\Controllers\client\AutocompleteprojectController::class, 'selectSearchSupervisor']);
Route::get('/client-search', [App\Http\Controllers\client\AutocompleteprojectController::class, 'selectSearchClients']);
Route::post('/dev-search', [App\Http\Controllers\client\AutocompleteprojectController::class, 'selectSearchDevelopers']);
