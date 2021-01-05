<?php

namespace App\Http\Controllers\Winghead;

use App\Models\Projects;
use League\Flysystem\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use SebastianBergmann\CodeCoverage\Report\Xml\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProjectController extends Controller
{
    public function create()
    {
        $project = Projects::all();
        $areaList = Projects::select('id','name')->get();
        return view('winghead.add-projects',compact('areaList'));
    }

    public function ViewProjects()
    {
        $project = Projects::all();
        return view('winghead.view-projects')->with('project', $project);
    }

    public function ViewProjectDetails($id)
    {
        $project = Projects::findOrFail($id);
        return view('winghead.view-project-details')->with('project', $project);
    }

    public function index()
    {
       
    }
    public function store(Request $request)
    {        
       
        $this->validate($request, [
            'title' => 'required',
            'projecticon' => 'image|nullable|max:1999',
            'summary-ckeditor' => 'required',
            'developers' => 'required',
            'clients' => 'required',
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
        $project->developers = $request->input('developers');
        $project->clients = $request->input('clients');
        $project->startdate = $request->input('startdate');
        $project->enddate = $request->input('enddate');
        // Upload Project Files
        if($request->hasFile('file')){
            foreach($request->file as $file){
            $file_name = $file->getClientOriginalName();
            $file->storeAs('public/project_files',$file_name);
            $project->files = $file_name;
            }
        }
       
        //
        $project->save();
        return redirect('/project-register')->with('status','Project Added Successfully!');

    }

    public function edit($id)
    {
        $project = Projects::findOrFail($id);
        return view('winghead.edit-project-details')->with('project',$project);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required',
            'projecticon' => 'image|nullable|max:1999',
            'summary-ckeditor' => 'required',
            'developers' => 'required',
            'clients' => 'required',
            'startdate' => 'required',
            'enddate' => 'required',
        ]);

        $project = Projects::findOrFail($id);
        $project->title = $request->input('title');
        $project->description = $request->input('summary-ckeditor');
        $project->developers = $request->input('developers');
        $project->clients = $request->input('clients');
        $project->startdate = $request->input('startdate');
        $project->enddate = $request->input('enddate');
        $project->update();
        return redirect('/project-register')->with('status','Project Updated Successfully!');

    }

    public function delete($id)
    {
        $project = Projects::findOrFail($id);
        $project->delete();

        return redirect('/project-register')->with('status','Project Deleted Successfully!');
    }

}
