<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Projects;
use League\Flysystem\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use SebastianBergmann\CodeCoverage\Report\Xml\Project;
use Illuminate\Support\Facades\Auth;
use App\Models\Complaints;
use App\helper;

class ComplaintController extends Controller
{

    public function index()
    {
       $complaints = Complaints::all();
       return view('admin.view-complaints')->with('complaints',$complaints);
    }

    public function create()
    {
       return view('admin.add-complaint');
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
      $complaints->client_id = Auth::user()->user_id;
      $complaints->wing_id = Helper::getWingId($request->input('title'));
      $complaints->project_id = $request->input('title');
      $complaints->fault_type = $request->input('fault_type');
      $complaints->urgency_level = $request->input('urgency');

      //
      $complaints->save();
      return redirect('admin/complaints')->with('status','Complaint Submitted Successfully!');
   }

}
