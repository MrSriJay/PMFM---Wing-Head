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
use App\Http\Controllers\Winghead\WingClientController;

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

Route::resource('admin/users', UserController::class);
Route::resource('admin/wings', WingsController::class);
Route::resource('admin/wing-details', WingsController::class);
Route::resource('admin/projects', ProjectController::class);
Route::resource('admin/clients', ClientController::class);
Route::resource('admin/complaints',ComplaintController::class);

Route::get('admin/projects-history/{id}', [ProjectController::class, 'showCompalintHistory']);
Route::post('/help-reply/{id}', [HelperController::class, 'sendReply']);

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
Route::resource('winghead/clients', WingClientController::class);

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
   // Route::resource('develoiper/developer-projects', App\Http\Controllers\Developer\ProjectController::class);
    Route::resource('developer/developer-complaints', DeveloperComplaintController::class);
    Route::post('developer/developer-complaint-seen',[DeveloperComplaintController::class, 'seenComplaint']);
    Route::post('developer/developer-complaint-solved',[DeveloperComplaintController::class, 'solutionGiven']);



});
/*--------------------------------------------------------------------------------------------------------*/ 
                                            //Auto Complete Projects//
/*--------------------------------------------------------------------------------------------------------*/

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


/*--------------------------------------------------------------------------------------------------------*/ 
                                            //Asign Developers//
/*--------------------------------------------------------------------------------------------------------*/

Route::post('/add-developer', [AssignDeveloperController::class, 'addDeveloper']);
Route::post('/delete-developer', [AssignDeveloperController::class, 'deleteDeveloper']);
Route::post('/send-messages', [AssignDeveloperController::class, 'addFeedback']);