<?php

namespace App\Http\Controllers\admin;

use App\Models\Projects;
use League\Flysystem\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use SebastianBergmann\CodeCoverage\Report\Xml\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;




class ProjectController extends Controller
{
    public function index()
    {
        $project = Projects::all();
        return view('admin.view-projects')->with('project', $project);
    }

    public function show($id)
    {
        $project = Projects::findOrFail($id);
        return view('admin.view-project-details')->with('project', $project);
    }

    public function create()
    {
        return view('admin.add-projects');
    }

    public function store(Request $request)
    {        
       
        $this->validate($request, [
            'title' => 'required',
            'projecticon' => 'image|nullable|max:1999',
            'summary-ckeditor' => 'required',
            'startdate' => 'required',
            'enddate' => 'required',
        ]);
        

        $project = new Projects;
        $project->title = $request->input('title');
        // Upload Project Icon
        if($request->hasFile('projecticon')){
            $icon_name = $request->projecticon->getClientOriginalName();
            $request->projecticon->storeAs('public/project_icons/',$icon_name);
            $project->project_icon = $icon_name;
        }
        else
        {
            $project->project_icon = 'noimage.jpg';
        }
        //
        $project->description = $request->input('summary-ckeditor');
        $project->clientid = $request->input('clientid');
        $project->startdate = $request->input('startdate');
        $project->enddate = $request->input('enddate');
        $project->projectInchargeId = $request->input('supervisor');
        $project->wingid  = $request->input('wing_name');
        // Upload Project Files
        if($request->hasFile('file')){
            foreach($request->file as $file){
            $file_name = $file->getClientOriginalName();
            $path_name='project_files/'. $request->input('title').'/';
            $file->storeAs('public/project_files/'. $request->input('title').'/',$file_name);
            $project->files=$path_name;
            }
        }
        $project->addedBy = Auth::user()->user_id;
        //
        $project->save();
        return redirect('admin/projects')->with('status','Project Added Successfully!');

    }

    

}
