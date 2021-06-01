<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Projects;
use App\Models\Wing;
use App\Models\User;
use App\Models\Client;
<<<<<<< HEAD:app/Http/Controllers/Client/AutocompleteController.php
use App\Models\Complaint_developer;
=======
use App\Models\Complaint_Developer;
>>>>>>> 311dc482ed3416e2a621ea3bd4c0d3610de5f727:app/Http/Controllers/Client/AutocompleteprojectController.php

use Illuminate\Support\Facades\Auth;
class AutocompleteController extends Controller
{
  function index()
  {
   return view('autocomplete');
  }

  //project search wings/developers/officers
  public function selectSearch(Request $request)
    {
    	$data = [];

        if($request->has('q')){
            $search = $request->q;
            $data =Projects::select("id", "title")
                ->where('title', 'LIKE', "%$search%")
                ->where('wingid', Auth::user()->wing_name)
            		->get();
        }
        return response()->json($data);

    }


    public function selectSearchAdmin(Request $request)
    {
    	$data = [];

        if($request->has('q')){
            $search = $request->q;
            $data =Projects::select("id", "title")
                ->where('title', 'LIKE', "%$search%")
            		->get();
        }
        return response()->json($data);

    }

    //project search Clients
    public function selectSearchProjectClient(Request $request)
    {
    	$data = [];

        if($request->has('q')){
            $search = $request->q;
            $data =Projects::select("id", "title")
                ->where('title', 'LIKE', "%$search%")
                ->where('clientid',Auth::user()->user_id)
            		->get();
        }
        return response()->json($data);

    }

  // Get Wing Name from ID
  public function selectSearchWings(Request $request)
    {
    	$data = [];

        if($request->has('q')){
            $search = $request->q;
            $data =Wing::select("id", "wing_name")
                ->where('wing_name', 'LIKE', "%$search%")
            		->get();
        }
        return response()->json($data);

    }


    // Get supervisors List wingHead -- Project Insert
    public function selectSearchSupervisor(Request $request)
    {
    	$data = [];

        if($request->has('q')){
            $search = $request->q;
            $data =User::select("user_id","rank", "first_name", "last_name")
              ->Where(function ($query) use ($search) {
                $query->where('first_name', 'LIKE', "%$search%") 
                ->orWhere('last_name', 'LIKE', "%$search%") ;
              })
              ->Where(function ($query){
                $query->where('usertype', 'developer')
                ->orWhere('usertype', 'officer')
                ->orWhere('usertype', 'winghead');
              })
              ->where('wing_name',Auth::user()->wing_name)

              ->get();
        }
        return response()->json($data);

    }


     // Get supervisors List Admin -- Project Insert
    public function selectAdminSearchSupervisor(Request $request)
    {
    	$data = [];

        if($request->has('q')){
            $search = $request->q;
            $data =User::select("user_id", "rank", "first_name", "last_name")
              ->Where(function ($query) use ($search) {
                $query->where('first_name', 'LIKE', "%$search%") 
                ->orWhere('last_name', 'LIKE', "%$search%") ;
              })
              ->Where(function ($query){
                $query->where('usertype', 'developer')
                ->orWhere('usertype', 'officer')
                ->orWhere('usertype', 'winghead');
              })

              ->get();
        }
        return response()->json($data);

    }


    // Get Clients -- Project Insert
    public function selectSearchClients(Request $request)
    {
      $data = [];
      
      if($request->has('q')){
        $search = $request->q;
        $data =Client::select("id", "organization_name")
          ->where('organization_name', 'LIKE', "%$search%")
          ->get();
    }
    return response()->json($data);

    }


    // Get Project Developers -- Project Insert
    function selectSearchDevelopers(Request $request)
    {
     if($request->get('query'))
     {
      $search = $request->get('query');
      $data =User::select("user_id", "rank","first_name", "last_name")
      ->Where(function ($query) use ($search) {
        $query->where('first_name', 'LIKE', "%$search%") 
        ->orWhere('last_name', 'LIKE', "%$search%") ;
      })
      ->Where(function ($query){
        $query->where('usertype', 'developer')
        ->orWhere('usertype', 'officer')
        ->orWhere('usertype', 'winghead');
      })
      ->where('wing_name',Auth::user()->wing_name)

      ->get();

     
      $output = '<ul class="text-primary" style="display:block; position:relative; color:black; list-style-type: none;">';
      foreach($data as $row)
      {
        $user_rank="";
        $rank=$row->rank;
        if($rank=="Civil Personnel"){
          $user_rank="";
        }
        else{
          $user_rank=$row->rank.". ";
        }
       $output .= '
       <li class="border border-light bg-light"  style="list-style-type: none; padding:10px; margin:5px; cursor:pointer"><a>'.$user_rank.''.$row->first_name.' '.$row->last_name.'</a></li>
       ';
      }
      $output .= '</ul>';
      echo $output;
     }
    }

<<<<<<< HEAD:app/Http/Controllers/Client/AutocompleteController.php
      // Get Project Developers -- Project Insert
      function selectSearchDevelopersAdmin(Request $request)
      {
        if($request->get('query'))
        {
         $search = $request->get('query');
         $data =User::select("user_id", "rank", "first_name", "last_name")
         ->Where(function ($query) use ($search) {
           $query->where('first_name', 'LIKE', "%$search%") 
           ->orWhere('last_name', 'LIKE', "%$search%") ;
         })
         ->Where(function ($query){
           $query->where('usertype', 'developer')
           ->orWhere('usertype', 'officer')
           ->orWhere('usertype', 'winghead');
         })
      
         ->get();

        

         $output = '<ul class="text-primary" style="display:block; position:relative; color:black; list-style-type: none;">';
         foreach($data as $row)
         {
          $user_rank="";
          $rank=$row->rank;
          if($rank=="Civil Personnel"){
           $user_rank="";
          }
          else{
           $user_rank=$row->rank.". ";
          }

          $output .= '
          <li class="border border-light bg-light"  style="list-style-type: none; padding:10px; margin:5px; cursor:pointer"><a>'.$user_rank.''.$row->first_name.' '.$row->last_name.'</a></li>
          ';
         }
         $output .= '</ul>';
         echo $output;
        }
       
=======
<<<<<<< Updated upstream
=======
      // Get Project Developers -- Project Insert
      function selectSearchDevelopersAdmin(Request $request)
      {
       if($request->get('query'))
       {
        $search = $request->get('query');
        $data =User::select("user_id", "first_name", "last_name")
        ->Where(function ($query) use ($search) {
          $query->where('first_name', 'LIKE', "%$search%") 
          ->orWhere('last_name', 'LIKE', "%$search%") ;
        })
        ->Where(function ($query){
          $query->where('usertype', 'developer')
          ->orWhere('usertype', 'officer')
          ->orWhere('usertype', 'winghead');
        })
  
        ->get();
        $output = '<ul class="text-primary" style="display:block; position:relative; color:black; list-style-type: none;">';
        foreach($data as $row)
        {
         $output .= '
         <li class="border border-light bg-light"  style="list-style-type: none; padding:10px; margin:5px; cursor:pointer"><a>'.$row->first_name.' '.$row->last_name.'</a></li>
         ';
        }
        $output .= '</ul>';
        echo $output;
       }
>>>>>>> 311dc482ed3416e2a621ea3bd4c0d3610de5f727:app/Http/Controllers/Client/AutocompleteprojectController.php
      }
  

     // Add Project Developers -- Complain Insert ADMIN
     function selectSearchDevAdmin(Request $request)
     {
    	$data = [];

        if($request->has('q')){
            $search = $request->q;
<<<<<<< HEAD:app/Http/Controllers/Client/AutocompleteController.php
            $data =User::select("user_id", "rank", "first_name", "last_name")
=======
            $data =User::select("user_id", "first_name", "last_name")
>>>>>>> 311dc482ed3416e2a621ea3bd4c0d3610de5f727:app/Http/Controllers/Client/AutocompleteprojectController.php
            ->Where(function ($query) use ($search) {
              $query->where('first_name', 'LIKE', "%$search%") 
              ->orWhere('last_name', 'LIKE', "%$search%") ;
            })
            ->Where(function ($query){
              $query->where('usertype', 'developer')
              ->orWhere('usertype', 'officer')
              ->orWhere('usertype', 'winghead');
            })
      
            ->get();
        }
        return response()->json($data);

    }

     // Add Project Developers -- Complain Insert 
     function selectSearchDev(Request $request)
     {

      $data = [];
      
      if($request->has('q')){
        $search = $request->get('query');
<<<<<<< HEAD:app/Http/Controllers/Client/AutocompleteController.php
       $data =User::select("user_id", "rank", "first_name", "last_name")
=======
       $data =User::select("user_id", "first_name", "last_name")
>>>>>>> 311dc482ed3416e2a621ea3bd4c0d3610de5f727:app/Http/Controllers/Client/AutocompleteprojectController.php
       ->Where(function ($query) use ($search) {
         $query->where('first_name', 'LIKE', "%$search%") 
         ->orWhere('last_name', 'LIKE', "%$search%") ;
       })
       ->Where(function ($query){
         $query->where('usertype', 'developer')
         ->orWhere('usertype', 'officer')
         ->orWhere('usertype', 'winghead');
       })
       ->where('wing_name',Auth::user()->wing_name)
       ->get();
    }
      return response()->json($data);
     }

<<<<<<< HEAD:app/Http/Controllers/Client/AutocompleteController.php
    //project search Clients
=======
     //project search Clients
>>>>>>> 311dc482ed3416e2a621ea3bd4c0d3610de5f727:app/Http/Controllers/Client/AutocompleteprojectController.php
    public function selectSearchAssignedDevs(Request $request)
    {
    	$data = [];

        if($request->has('q')){
            $search = $request->q;
<<<<<<< HEAD:app/Http/Controllers/Client/AutocompleteController.php
            $data =Complaint_developer::select("developer_id", "complaint_developers")
=======
            $data =Complaint_Developer::select("developer_id", "complaint_developers")
>>>>>>> 311dc482ed3416e2a621ea3bd4c0d3610de5f727:app/Http/Controllers/Client/AutocompleteprojectController.php
                ->where('title', 'LIKE', "%$search%")
                ->where('clientid',Auth::user()->user_id)
            		->get();
        }
        return response()->json($data);

    }

<<<<<<< HEAD:app/Http/Controllers/Client/AutocompleteController.php
=======
>>>>>>> Stashed changes
>>>>>>> 311dc482ed3416e2a621ea3bd4c0d3610de5f727:app/Http/Controllers/Client/AutocompleteprojectController.php
    
  
}
