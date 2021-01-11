<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Projects;
use App\Models\Wing;
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
}
