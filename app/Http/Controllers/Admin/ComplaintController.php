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
use App\Helper;
use App\Models\Complaint_developer;
use App\Models\Message;
use App\Mail\ComplaintAddedNotifaction;
use Illuminate\Support\Facades\Mail;

class ComplaintController extends Controller
{

    public function index()
    {

       $complaints = Complaints::orderBy('updated_at', 'DESC')->get();
       return view('admin.view-complaints')->with('complaints',$complaints);
       
    }

    public function create()
    {
       return view('admin.add-complaint');
    }


    public function show($id)
    {
        $message = Message::where('complaint_id',$id)->orderBy('updated_at', 'DESC') -> get();
        $complaint_developer = Complaint_developer::where('complaint_id',$id)->get();
        $complaints = complaints::findOrFail($id);
        return view('admin.view-complaints-details')->with('complaints', $complaints)->with('complaint_developer',$complaint_developer)->with('message',$message);
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

      Helper::$complaint_data = [
         'system_name' => Helper::getprojectName($request->input('title')),
         'description' => $request->input('summary-ckeditor'),
         'client_id' => Auth::user()->user_id,
         'client_name' =>  Helper::getClientName(Auth::user()->user_id),
         'wing_id' =>  Helper::getWingId($request->input('title')),
         'fault_type' => $request->input('fault_type'),
         'urgency_level' =>$request->input('urgency')
      ];

    /*  Mail::to(Helper::getEmailfromUsertype("winghead",Helper::getWingId($request->input('title'))))->send(new ComplaintAddedNotifaction());
      Mail::to(Helper::getEmailfromUsertype("dg","0"))->send(new ComplaintAddedNotifaction());
      Mail::to(Helper::getEmailfromUsertype("s01","0"))->send(new ComplaintAddedNotifaction());
      Mail::to(Helper::getEmailfromUsertype("c-controller","0"))->send(new ComplaintAddedNotifaction());
*/
      return redirect('admin/complaints')->with('status','Complaint Submitted Successfully!');
   }


   public function add($id)
   {
      $data =Projects::select("id","title")->where("id",$id)
        ->first();

        $idOpt="";    
        $titleOpt="";    

        if($data != null){
           
         $idOpt = $data->id;
         $titleOpt = $data->title;
           
        }
        

      return view('admin.add-project-complaint')->with('id',$idOpt)->with('title',$titleOpt);
   }
   

 
}
