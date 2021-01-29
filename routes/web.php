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
Route::resource('admin/complaints', App\Http\Controllers\admin\ComplaintController::class);


Route::get('admin/projects-history/{id}', [App\Http\Controllers\admin\ProjectController::class, 'showCompalintHistory']);



});

/*--------------------------------------------------------------------------------------------------------*/ 
                                            //WING HEAD//
/*--------------------------------------------------------------------------------------------------------*/ 
Route::group(['middleware' => ['auth','winghead']],function() {

    Route::get('/winghead', function () {
    return view('winghead.dashboard');
});

Route::resource('winghead/wings-projects', App\Http\Controllers\Winghead\ProjectController::class);
Route::resource('winghead/wings-users', App\Http\Controllers\Winghead\UserController::class);
Route::resource('winghead/wings-complaints', App\Http\Controllers\Winghead\UserComplaintController::class);

Route::get('winghead/wings-projects-history/{id}', [App\Http\Controllers\Winghead\ProjectController::class, 'showCompalintHistory']);

});

/*--------------------------------------------------------------------------------------------------------*/ 
                                            //CLIENT//
/*--------------------------------------------------------------------------------------------------------*/ 
Route::group(['middleware' => ['auth','client']],function() {

    Route::get('/client', function () { return view('client.dashboard');
    });
    
Route::resource('client/purchased-systems', App\Http\Controllers\client\PurchasedSystemsController::class);
Route::resource('client/clients-complaints', App\Http\Controllers\client\ComplaintController::class);

});

/*--------------------------------------------------------------------------------------------------------*/ 
                                            //DEVELOPER//
/*--------------------------------------------------------------------------------------------------------*/
Route::group(['middleware' => ['auth','developer']],function() {

    Route::get('/developer', function () { return view('developer.dashboard');
    });
   // Route::resource('develoiper/developer-projects', App\Http\Controllers\Developer\ProjectController::class);
    Route::resource('developer/developer-complaints', App\Http\Controllers\Developer\ComplaintController::class);
    

});
/*--------------------------------------------------------------------------------------------------------*/ 
                                            //Auto Complete Projects//
/*--------------------------------------------------------------------------------------------------------*/

Route::get('/autocomplete', [App\Http\Controllers\client\AutocompleteprojectController::class,'index']);
Route::get('/projects-search', [App\Http\Controllers\client\AutocompleteprojectController::class, 'selectSearch']);
Route::get('/projects-search-admin', [App\Http\Controllers\client\AutocompleteprojectController::class, 'selectSearchAdmin']);
Route::get('/projects-search-client', [App\Http\Controllers\client\AutocompleteprojectController::class, 'selectSearchProjectClient']);
Route::get('/wings-search', [App\Http\Controllers\client\AutocompleteprojectController::class, 'selectSearchWings']);
Route::get('/supervisor-search', [App\Http\Controllers\client\AutocompleteprojectController::class, 'selectSearchSupervisor']);
Route::get('/admin-supervisor-search', [App\Http\Controllers\client\AutocompleteprojectController::class, 'selectAdminSearchSupervisor']);
Route::get('/client-search', [App\Http\Controllers\client\AutocompleteprojectController::class, 'selectSearchClients']);
Route::post('/dev-search', [App\Http\Controllers\client\AutocompleteprojectController::class, 'selectSearchDevelopers']);
Route::post('/dev-search-admin', [App\Http\Controllers\client\AutocompleteprojectController::class, 'selectSearchDevelopersAdmin']);

Route::get('/com-dev-admin', [App\Http\Controllers\client\AutocompleteprojectController::class, 'selectSearchDevAdmin']);
Route::get('/com-dev', [App\Http\Controllers\client\AutocompleteprojectController::class, 'selectSearchDev']);


/*--------------------------------------------------------------------------------------------------------*/ 
                                            //Asign Developers//
/*--------------------------------------------------------------------------------------------------------*/

Route::post('/add-developer', [App\Http\Controllers\AssignDeveloperController::class, 'addDeveloper']);
Route::post('/delete-developer', [App\Http\Controllers\AssignDeveloperController::class, 'deleteDeveloper']);

Route::post('/send-messages', [App\Http\Controllers\AssignDeveloperController::class, 'addFeedback']);