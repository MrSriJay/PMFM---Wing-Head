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

use App\Http\Controllers\Client\PurchasedSystemsController;
use App\Http\Controllers\Client\ClientComplaintController;

use App\Http\Controllers\Developer\DeveloperComplaintController;

use App\Http\Controllers\Client\AutocompleteController;

use App\Http\Controllers\AssignDeveloperController;

use App\Http\Controllers\BotManController;  

use App\Http\Controllers\EditprofileController;  

use App\Http\Controllers\HelperController;  

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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index']);


Route::get('/edit_profile/{id}', [EditprofileController::class, 'index']);
Route::post('/edit_profile/{id}', [EditprofileController::class, 'update']);
Route::post('/edit_change_password/{id}', [EditprofileController::class, 'editPassword']);

/*--------------------------------------------------------------------------------------------------------*/ 
                                            //Help//
/*--------------------------------------------------------------------------------------------------------*/ 
Route::resource('help', HelperController::class);



/*--------------------------------------------------------------------------------------------------------*/ 
                                            //ADMIN//
/*--------------------------------------------------------------------------------------------------------*/ 
Route::group(['middleware' => ['auth','admin']],function() {

    Route::get('/admin', function () { return view('admin.dashboard');
    });

<<<<<<< HEAD
Route::resource('admin/users', UserController::class);
Route::resource('admin/wings', WingsController::class);
Route::resource('admin/projects', ProjectController::class);
Route::resource('admin/clients', ClientController::class);
Route::resource('admin/complaints',ComplaintController::class);

Route::get('admin/projects-history/{id}', [ProjectController::class, 'showCompalintHistory']);
Route::post('/help-reply/{id}', [HelperController::class, 'sendReply']);
=======
Route::resource('admin/users', App\Http\Controllers\admin\UserController::class);
Route::resource('admin/wings', App\Http\Controllers\admin\WingsController::class);
Route::resource('admin/projects', App\Http\Controllers\admin\ProjectController::class);
Route::resource('admin/clients', App\Http\Controllers\admin\ClientController::class);
Route::resource('admin/complaints', App\Http\Controllers\admin\ComplaintController::class);

>>>>>>> 311dc482ed3416e2a621ea3bd4c0d3610de5f727

});

/*--------------------------------------------------------------------------------------------------------*/ 
                                            //WING HEAD//
/*--------------------------------------------------------------------------------------------------------*/ 
Route::group(['middleware' => ['auth','winghead']],function() {

    Route::get('/winghead', function () {
    return view('winghead.dashboard');
});

<<<<<<< HEAD
Route::resource('winghead/wings-projects', WingProjectController::class);
Route::resource('winghead/wings-users', WingUserController::class);
Route::resource('winghead/wings-complaints', UserComplaintController::class);

Route::get('winghead/wings-projects-history/{id}', [WingProjectController::class, 'showCompalintHistory']);

=======
Route::resource('winghead/wings-projects', App\Http\Controllers\Winghead\ProjectController::class);
Route::resource('winghead/wings-users', App\Http\Controllers\Winghead\UserController::class);
Route::resource('winghead/wings-complaints', App\Http\Controllers\Winghead\UserComplaintController::class);
>>>>>>> 311dc482ed3416e2a621ea3bd4c0d3610de5f727
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
                                            //BOTMAN//
/*--------------------------------------------------------------------------------------------------------*/ 

Route::get('/iFrameUrl', function () { return view('iFrameUrl');
});

Route::match(['get', 'post'], '/botman', [BotManController::class, 'handle']);

/*--------------------------------------------------------------------------------------------------------*/ 
                                            //DEVELOPER//
/*--------------------------------------------------------------------------------------------------------*/
Route::group(['middleware' => ['auth','developer']],function() {

    Route::get('/developer', function () { return view('developer.dashboard');
    });
<<<<<<< HEAD
   // Route::resource('develoiper/developer-projects', App\Http\Controllers\Developer\ProjectController::class);
    Route::resource('developer/developer-complaints', DeveloperComplaintController::class);
    Route::post('developer/developer-complaint-seen',[DeveloperComplaintController::class, 'seenComplaint']);
    Route::post('developer/developer-complaint-solved',[DeveloperComplaintController::class, 'solutionGiven']);


=======
    Route::resource('developer/developer-projects', App\Http\Controllers\Developer\ProjectsController::class);
    Route::resource('developer/developer-complaints', App\Http\Controllers\Developer\UserController::class);
    
>>>>>>> 311dc482ed3416e2a621ea3bd4c0d3610de5f727

});
/*--------------------------------------------------------------------------------------------------------*/ 
                                            //Auto Complete Projects//
/*--------------------------------------------------------------------------------------------------------*/

<<<<<<< HEAD
Route::get('/autocomplete', [AutocompleteController::class,'index']);
Route::get('/projects-search', [AutocompleteController::class, 'selectSearch']);
Route::get('/projects-search-admin', [AutocompleteController::class, 'selectSearchAdmin']);
Route::get('/projects-search-client', [AutocompleteController::class, 'selectSearchProjectClient']);
Route::get('/wings-search', [AutocompleteController::class, 'selectSearchWings']);
Route::get('/supervisor-search', [AutocompleteController::class, 'selectSearchSupervisor']);
Route::get('/admin-supervisor-search', [AutocompleteController::class, 'selectAdminSearchSupervisor']);
Route::get('/client-search', [AutocompleteController::class, 'selectSearchClients']);
Route::post('/dev-search', [AutocompleteController::class, 'selectSearchDevelopers']);
Route::post('/dev-search-admin', [AutocompleteController::class, 'selectSearchDevelopersAdmin']);

Route::get('/com-dev-admin', [AutocompleteController::class, 'selectSearchDevAdmin']);
Route::get('/com-dev', [AutocompleteController::class, 'selectSearchDev']);
=======
Route::get('/autocomplete', [App\Http\Controllers\client\AutocompleteprojectController::class,'index']);
Route::get('/projects-search', [App\Http\Controllers\client\AutocompleteprojectController::class, 'selectSearch']);
Route::get('/projects-search-admin', [App\Http\Controllers\client\AutocompleteprojectController::class, 'selectSearchAdmin']);
Route::get('/projects-search-client', [App\Http\Controllers\client\AutocompleteprojectController::class, 'selectSearchProjectClient']);
Route::get('/wings-search', [App\Http\Controllers\client\AutocompleteprojectController::class, 'selectSearchWings']);
Route::get('/supervisor-search', [App\Http\Controllers\client\AutocompleteprojectController::class, 'selectSearchSupervisor']);
Route::get('/admin-supervisor-search', [App\Http\Controllers\client\AutocompleteprojectController::class, 'selectAdminSearchSupervisor']);
Route::get('/client-search', [App\Http\Controllers\client\AutocompleteprojectController::class, 'selectSearchClients']);
Route::post('/dev-search', [App\Http\Controllers\client\AutocompleteprojectController::class, 'selectSearchDevelopers']);
<<<<<<< Updated upstream
=======
Route::post('/dev-search-admin', [App\Http\Controllers\client\AutocompleteprojectController::class, 'selectSearchDevelopersAdmin']);

Route::get('/com-dev-admin', [App\Http\Controllers\client\AutocompleteprojectController::class, 'selectSearchDevAdmin']);
Route::get('/com-dev', [App\Http\Controllers\client\AutocompleteprojectController::class, 'selectSearchDev']);
>>>>>>> 311dc482ed3416e2a621ea3bd4c0d3610de5f727


/*--------------------------------------------------------------------------------------------------------*/ 
                                            //Asign Developers//
/*--------------------------------------------------------------------------------------------------------*/

<<<<<<< HEAD
Route::post('/add-developer', [AssignDeveloperController::class, 'addDeveloper']);
Route::post('/delete-developer', [AssignDeveloperController::class, 'deleteDeveloper']);
Route::post('/send-messages', [AssignDeveloperController::class, 'addFeedback']);
=======
Route::post('/add-developer', [App\Http\Controllers\AssignDeveloperController::class, 'addDeveloper']);
Route::post('/delete-developer', [App\Http\Controllers\AssignDeveloperController::class, 'deleteDeveloper']);

Route::post('/send-messages', [App\Http\Controllers\AssignDeveloperController::class, 'addFeedback']);
>>>>>>> Stashed changes
>>>>>>> 311dc482ed3416e2a621ea3bd4c0d3610de5f727
