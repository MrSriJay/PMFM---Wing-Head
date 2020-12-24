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
        return view('winghead.add-projects');
    }
    public function index()
    {
        $project = Projects::all();;
        return view('winghead.view-projects')->with('project', $project);
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

        //Handle File Upload
        if($request->hasFile('projecticon')){
            // Get filename with extension
            $filenameWithExt = $request->file('projecticon')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('projecticon')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            // Upload Image
            $path = $request->file('projecticon')->storeAs('public/project_icons',$fileNameToStore);
        } else{
            $fileNameToStore = 'noimage.jpg';
        }
        $project = new Projects;
        $project->title = $request->input('title');
        $project->project_icon = $fileNameToStore;
        $project->description = $request->input('summary-ckeditor');
        if($request->hasFile('file')){
            foreach($request->file as $file)
            {
                $filename = $file->getClientOriginalName(); 
                $file->storeAs('public/upload',$filename);
                $project->files = $filename;   
            }
        }
        $project->developers = $request->input('developers');
        $project->clients = $request->input('clients');
        $project->startdate = $request->input('startdate');
        $project->enddate = $request->input('enddate');
        $project->save();
        return redirect('/project-register')->with('status','Project Added Successfully!');

    }

    public function edit($id)
    {
        $project = Projects::findOrFail($id);
        return view('winghead.edit-registered-projects')->with('project',$project);
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

        //Handle File Upload
        if($request->hasFile('projecticon')){
            // Get filename with extension
            $filenameWithExt = $request->file('projecticon')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('projecticon')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            // Upload Image
            $path = $request->file('projecticon')->storeAs('public/project_icons',$fileNameToStore);
        }
        $project = Projects::findOrFail($id);
        $project->title = $request->input('title');
        if($request->hasFile('projecticon')){
            $project->project_icon = $fileNameToStore;
        }
        $project->description = $request->input('summary-ckeditor');
        if($request->hasFile('file')){
            foreach($request->file as $file)
            {
                $filename = $file->getClientOriginalName(); 
                $file->storeAs('public/upload',$filename);
                $project->files = $filename;   
            }
        }
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
