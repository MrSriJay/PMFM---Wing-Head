<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Projects;
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
}
