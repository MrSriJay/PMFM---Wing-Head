<?php

namespace App\Http\Controllers\Winghead;

use App\Models\Projects;
use App\Models\Complaints;
use League\Flysystem\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use SebastianBergmann\CodeCoverage\Report\Xml\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class WingProjectController extends Controller
{
    public function index()
    {
        $project = Projects::where('wingid',Auth::user()->wing_name)->orderBy('updated_at', 'DESC')->get();
        return view('winghead.view-projects')->with('project', $project);
    }

    public function show($id)
    {
        $project = Projects::findOrFail($id);
        return view('winghead.view-project-details')->with('project', $project);
    }

    public function create()
    {
        return view('winghead.add-projects');
    }

    public function store(Request $request)
    {        
       
        $validate = \Validator::make($request->all(), [
            'title' => ['required', 'string', 'max:255'],
            'number' => ['required', 'string', 'max:255'],
            'projecticon' => 'image|nullable|max:1999',
            'summary-ckeditor' => 'required',
            'startdate' => ['required'],
            'wing_name' => ['required', 'string', 'max:255'],
            'clientid' => ['required', 'string', 'max:255'],
            'developers' => ['required', 'string', 'max:255'],
            'enddate' => 'required',  
        ]);

        if( $validate->fails()){
            return redirect()
            ->back()
            ->withErrors($validate)
            ->withInput();
        }


        $project = new Projects;
        $project->title = $request->input('title');
        $project->pgt_number = $request->input('number');
        $project->description = $request->input('summary-ckeditor');
        $ranstring = rand(10,50);

        // Upload Project Files
        if($request->hasFile('file')){
            foreach($request->file as $file){
            $file_name = $file->getClientOriginalName();
            $path_name='project_files/'. $request->input('title').'-'.$ranstring.'/';
            $file->storeAs('public/project_files/'. $request->input('title').'-'.$ranstring.'/',$file_name);
            $project->files=$path_name;
            }
        }
        
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
        
        $project->clientid = $request->input('clientid');
        $project->projectInchargeId = $request->input('supervisor');
        $project->wingid  = $request->input('wing_name');
        $project->startdate = $request->input('startdate');
        $project->enddate = $request->input('enddate');
        $project->developers = $request->input('developers');
        $project->addedBy = Auth::user()->user_id;
        //
        $project->save();
        return redirect('winghead/wings-projects')->with('status','Project Added Successfully!');

    }

    public function destroy($id)
    {
        $output="";
        $project = Projects::find($id);

        $data =Projects::select("files")
        ->where('id', $id)
            ->get();

        foreach($data as $row)
        {
            $output = $row->files;
        }

        Storage::deleteDirectory('public/'.$output); 

        $project->delete();
       
        return redirect('/winghead/wings-projects')->with('status','Project Deleted Successfully!');

    }

    public function update (Request $request, $id)
    {

        $validate = \Validator::make($request->all(), [
            'summary-ckeditor' => 'required',
            'startdate' => 'required',
            'enddate' => 'required',
        ]);

        if( $validate->fails()){
            return redirect()
            ->back()
            ->withErrors($validate)
            ->withInput();
        }
        $ranstring = rand(10,50);

        $project = Projects::find($id);
        $project->pgt_number = $request->input('number');
        $project->title = $request->input('title');
        $project->description = $request->input('summary-ckeditor');
        $project->clientid = $request->input('clientid');
        $project->projectInchargeId = $request->input('supervisor');
        $project->wingid  = $request->input('wing_name');
        $project->startdate = $request->input('startdate');
        $project->enddate = $request->input('enddate');
        $project->developers = $request->input('developers');
        $path =$request->input('path');

        // Upload Project Files
     
            
           

        if($path==NULL){
            if($request->hasFile('file')){
                foreach($request->file as $file){

                    $file_name = $file->getClientOriginalName();
                    $path_name='project_files/'. $request->input('title').'-'.$ranstring.'/';
                    $file->storeAs('public/project_files/'. $request->input('title').'-'.$ranstring.'/',$file_name);
                    $project->files=$path_name;
                }
            }
         }

         else{

            if($request->hasFile('file')){
                foreach($request->file as $file){
                    $file_name = $file->getClientOriginalName();
                    $file->storeAs('public/'.$path,$file_name);
                }
            }
        }
          
        
        $project->save();

        return redirect()
            ->back()
            ->with('status','Project Details Updated Successfully!');

    }

    public function showCompalintHistory($id)
    {
        $complaints = complaints::where('project_id',$id)->orderBy('updated_at', 'DESC')->get();
        $proid= $id;
        return view('winghead.view-complaint-history')->with('complaints', $complaints)->with('proid', $proid);
    }  
    

}
