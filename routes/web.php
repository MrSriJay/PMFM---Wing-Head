<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\WingsController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\ComplaintController;

use App\Http\Controllers\Winghead\WingProjectController;
use App\Http\Controllers\Winghead\WingUserController;
use App\Http\Controllers\Winghead\UserComplaintController;

use App\Http\Controllers\client\PurchasedSystemsController;
use App\Http\Controllers\client\ClientComplaintController;

use App\Http\Controllers\Developer\DeveloperComplaintController;

use App\Http\Controllers\client\AutocompleteprojectController;

use App\Http\Controllers\AssignDeveloperController;

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

Route::resource('admin/users', UserController::class);
Route::resource('admin/wings', WingsController::class);
Route::resource('admin/projects', ProjectController::class);
Route::resource('admin/clients', ClientController::class);
Route::resource('admin/complaints',ComplaintController::class);


Route::get('admin/projects-history/{id}', [ProjectController::class, 'showCompalintHistory']);



});

/*--------------------------------------------------------------------------------------------------------*/ 
                                            //WING HEAD//
/*--------------------------------------------------------------------------------------------------------*/ 
Route::group(['middleware' => ['auth','winghead']],function() {

    Route::get('/winghead', function () {
    return view('winghead.dashboard');
});

Route::resource('winghead/wings-projects', WingProjectController::class);
Route::resource('winghead/wings-users', WingUserController::class);
Route::resource('winghead/wings-complaints', UserComplaintController::class);

Route::get('winghead/wings-projects-history/{id}', [WingProjectController::class, 'showCompalintHistory']);

});

/*--------------------------------------------------------------------------------------------------------*/ 
                                            //CLIENT//
/*--------------------------------------------------------------------------------------------------------*/ 
Route::group(['middleware' => ['auth','client']],function() {

    Route::get('/client', function () { return view('client.dashboard');
    });
    
Route::resource('client/purchased-systems', PurchasedSystemsController::class);
Route::resource('client/clients-complaints', ClientComplaintController::class);

Route::post('developer/clients-solved',[ClientComplaintController::class, 'solutionOk']);
Route::post('developer/clients-not-solved',[ClientComplaintController::class, 'solutionFalse']);


});

/*--------------------------------------------------------------------------------------------------------*/ 
                                            //DEVELOPER//
/*--------------------------------------------------------------------------------------------------------*/
Route::group(['middleware' => ['auth','developer']],function() {

    Route::get('/developer', function () { return view('developer.dashboard');
    });
   // Route::resource('develoiper/developer-projects', App\Http\Controllers\Developer\ProjectController::class);
    Route::resource('developer/developer-complaints', DeveloperComplaintController::class);
    Route::post('developer/developer-complaint-seen',[DeveloperComplaintController::class, 'seenComplaint']);
    Route::post('developer/developer-complaint-solved',[DeveloperComplaintController::class, 'solutionGiven']);



});
/*--------------------------------------------------------------------------------------------------------*/ 
                                            //Auto Complete Projects//
/*--------------------------------------------------------------------------------------------------------*/

Route::get('/autocomplete', [AutocompleteprojectController::class,'index']);
Route::get('/projects-search', [AutocompleteprojectController::class, 'selectSearch']);
Route::get('/projects-search-admin', [AutocompleteprojectController::class, 'selectSearchAdmin']);
Route::get('/projects-search-client', [AutocompleteprojectController::class, 'selectSearchProjectClient']);
Route::get('/wings-search', [AutocompleteprojectController::class, 'selectSearchWings']);
Route::get('/supervisor-search', [AutocompleteprojectController::class, 'selectSearchSupervisor']);
Route::get('/admin-supervisor-search', [AutocompleteprojectController::class, 'selectAdminSearchSupervisor']);
Route::get('/client-search', [AutocompleteprojectController::class, 'selectSearchClients']);
Route::post('/dev-search', [AutocompleteprojectController::class, 'selectSearchDevelopers']);
Route::post('/dev-search-admin', [AutocompleteprojectController::class, 'selectSearchDevelopersAdmin']);

Route::get('/com-dev-admin', [AutocompleteprojectController::class, 'selectSearchDevAdmin']);
Route::get('/com-dev', [AutocompleteprojectController::class, 'selectSearchDev']);


/*--------------------------------------------------------------------------------------------------------*/ 
                                            //Asign Developers//
/*--------------------------------------------------------------------------------------------------------*/

Route::post('/add-developer', [AssignDeveloperController::class, 'addDeveloper']);
Route::post('/delete-developer', [AssignDeveloperController::class, 'deleteDeveloper']);
Route::post('/send-messages', [AssignDeveloperController::class, 'addFeedback']);