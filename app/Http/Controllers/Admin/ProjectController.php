<?php

namespace App\Http\Controllers\Admin;

use App\Models\Projects;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;


class ProjectController extends Controller
{
    public function create()
    {
        $project = Projects::all();
        return view('admin.add-project');
    }
    public function index()
    {
        $project = Projects::all();
        return view('admin.registered-projects')->with('project', $project);
    }

    public function store(Request $request)
    {        
       
        $this->validate($request, [
            'title' => 'required',
            'summary-ckeditor' => 'required',
            'developers' => 'required',
            'clients' => 'required',
            'startdate' => 'required',
            'enddate' => 'required',

        ]);

        $project = new Projects;

        $project->title = $request->input('title');
        $project->description = $request->input('summary-ckeditor');
        if($request->hasFile('files'))
        {
            foreach($request->file as $file)
            {
                $filename = file->getClientOriginalName();
                $filesize = $file->getClientSize();
                $file->storeAs('public/upload',$filename);
                $fileModel = new File;
                $fileModel->name = $filename;
                $fileModel->size = $filesize;
                $fileModel->save();
            }
        
        }
        //$project->files = $request->file('files');
        
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
        return view('admin.edit-registered-projects')->with('project',$project);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'email' => 'required|email',
            'contactno' => 'required|digits:10'
        ]);
        
        $project = Projects::findOrFail($id);

        $project->title = $request->input('title');
        $project->description = $request->input('description');
        $project->files = $request->input('files');
        $project->developers = $request->input('developers');
        $project->clients = $request->input('clients');
        $project->startdate = $request->input('startdate');
        $project->enddate = $request->input('enddate');

        $project->update();

        //Session::flash('statuscode','error');
        return redirect('/project-register')->with('status','Project Updated Successfully!');

    }

    public function delete($id)
    {
        $project = Projects::findOrFail($id);
        $project->delete();

        return redirect('/project-register')->with('status','Project Deleted Successfully!');
    }

}
