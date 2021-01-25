<?php

namespace App\Http\Controllers\winghead;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Complaints;
use Illuminate\Support\Facades\Auth;
use App\helper;
use App\Models\Projects;
use App\Models\Complaint_Developer;
use App\Models\Message;

class UserComplaintController extends Controller
{
    public function index()
    {
       $complaints = Complaints::where('wing_id',Auth::user()->wing_name)->get();
       return view('winghead.view-complaints')->with('complaints',$complaints);
    }
    public function create()
    {
       return view('winghead.add-complaint');
    }

    public function store(Request $request)
    {
      $validate = \Validator::make($request->all(), [
         'title' => ['required', 'string', 'max:255'],
         'summary-ckeditor' => 'required',
         'fault_type' => ['required'],
         'urgency' => ['required']
         
     ]);

     if( $validate->fails()){
         return redirect()
         ->back()
         ->withErrors($validate)
         ->withInput();
     }
    
     $complaints = new Complaints;

     $complaints->system_name = Helper::getprojectName($request->input('title'));
     $complaints->description = $request->input('summary-ckeditor');
     $ranstring = rand(10,50);

     // Upload Complaint Files
     if($request->hasFile('file')){
         foreach($request->file as $file){
         $file_name = $file->getClientOriginalName();
         $path_name='complaint_files/'. $request->input('title').'-'.$ranstring.'/';
         $file->storeAs('public/complaint_files/'. $request->input('title').'-'.$ranstring.'/',$file_name);
         $complaints->files=$path_name;
         }
      }
      $complaints->client_id = Helper::getProjectClientId($request->input('title'));
      $complaints->wing_id = Helper::getWingId($request->input('title'));
      $complaints->project_id = $request->input('title');
      $complaints->fault_type = $request->input('fault_type');
      $complaints->urgency_level = $request->input('urgency');

      //
      $complaints->save();

      $project = Projects::find( $request->input('title'));
      $project->status =0;
      $project->save();

      return redirect('winghead/wings-complaints')->with('status','Complaint Submitted Successfully!');
   }

   public function show($id)
   {
       $complaint_developer = Complaint_Developer::where('complaint_id',$id)->get();
       $message = Message::where('complaint_id',$id)->get();
       $complaints = complaints::findOrFail($id);
       return view('winghead.view-complaints-details')->with('complaints', $complaints)->with('complaint_developer',$complaint_developer)->with('message',$message);
   }
}
