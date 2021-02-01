<?php

namespace App\Http\Controllers\Developer;

use App\Models\Projects;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use League\Flysystem\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use SebastianBergmann\CodeCoverage\Report\Xml\Project;
use Illuminate\Support\Facades\Auth;

class ProjectsController extends Controller
{
    public function index()
    {
        $project = Projects::all();
        return view('developer.view-projects')->with('project', $project);
    }
}
