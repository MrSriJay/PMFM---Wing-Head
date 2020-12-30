<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Projects;

class AutocompleteprojectController extends Controller
{
    function index()
    {
     return view('autocomplete');
    }

    function fetch(Request $request)
    {
     if($request->get('query'))
     {
      $query = $request->get('query');
      $data = Projects::table('projects')
        ->where('title', 'LIKE', "%{$query}%")

        ->get();
      $output = '<ul class="dropdown-menu" style="display:block; position:relative">';
      foreach($data as $row)
      {
       $output .= '
       <li><a href="#">'.$row->title.'</a></li>
       ';
      }
      $output .= '</ul>';
      echo $output;
     }
    }
}
