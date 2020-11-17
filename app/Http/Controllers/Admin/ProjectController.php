<?php

namespace App\Http\Controllers\Admin;

use App\Models\Projects;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class ProjectController extends Controller
{
    public function index()
    {
        $project = Projects::all();
        return view('admin.registered-projects')->with('project', $project);
    }

    public function store(Request $request)
    {
        $project = new Projects;

        $project->title = $request->input('projecttitle');
        $project->description = $request->input('description');
        $project->client = $request->input('client');
        $project->developer = $request->input('developer');

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
        $project = Projects::findOrFail($id);

        $project->title = $request->input('projecttitle');
        $project->description = $request->input('description');
        $project->client = $request->input('client');
        $project->developer = $request->input('developer');

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
