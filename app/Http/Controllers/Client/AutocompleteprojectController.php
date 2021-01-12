<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Projects;
use App\Models\Wing;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
class AutocompleteprojectController extends Controller
{
  function index()
  {
   return view('autocomplete');
  }

  public function selectSearch(Request $request)
    {
    	$data = [];

        if($request->has('q')){
            $search = $request->q;
            $data =Projects::select("id", "title")
                ->where('title', 'LIKE', "%$search%")
                ->where('clients', Auth::user()->id)
            		->get();
        }
        return response()->json($data);

    }

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

              ->get();
        }
        return response()->json($data);

    }

    public function selectSearchClients(Request $request)
    {
      $data = [];
      
      if($request->has('q')){
        $search = $request->q;
        $data =User::select("user_id", "first_name", "last_name")
          ->Where(function ($query) use ($search) {
            $query->where('first_name', 'LIKE', "%$search%") 
            ->orWhere('last_name', 'LIKE', "%$search%") ;
          })
          ->where('usertype', 'client')
          ->get();
    }
    return response()->json($data);

    }

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

    
  
}
