<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Projects;
use App\Models\Wing;
use App\Models\User;
use App\Models\Client;
use App\Models\Complaint_Developer;

use Illuminate\Support\Facades\Auth;
class AutocompleteprojectController extends Controller
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
      ->where('wing_name',Auth::user()->wing_name)

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
    }

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
      }
  

     // Add Project Developers -- Complain Insert ADMIN
     function selectSearchDevAdmin(Request $request)
     {
    	$data = [];

        if($request->has('q')){
            $search = $request->q;
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
        }
        return response()->json($data);

    }

     // Add Project Developers -- Complain Insert 
     function selectSearchDev(Request $request)
     {

      $data = [];
      
      if($request->has('q')){
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
       ->where('wing_name',Auth::user()->wing_name)
       ->get();
    }
      return response()->json($data);
     }

    //project search Clients
    public function selectSearchAssignedDevs(Request $request)
    {
    	$data = [];

        if($request->has('q')){
            $search = $request->q;
            $data =Complaint_Developer::select("developer_id", "complaint_developers")
                ->where('title', 'LIKE', "%$search%")
                ->where('clientid',Auth::user()->user_id)
            		->get();
        }
        return response()->json($data);

    }

    
  
}
