<?php

namespace App\Http\Controllers\Developer;

use App\Models\Projects;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProjectsController extends Controller
{
    public function index()
    {
        $project = Projects::where('wingid',Auth::user()->wing_name)->get();
        return view('winghead.view-projects')->with('project', $project);
    }
}
