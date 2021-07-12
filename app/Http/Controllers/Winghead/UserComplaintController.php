<?php

namespace App\Http\Controllers\winghead;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Complaints;
use Illuminate\Support\Facades\Auth;
use App\Helper;
use App\Models\Projects;
use App\Models\Complaint_developer;
use App\Models\Message;
use DB;
use App\Mail\ComplaintAddedNotifaction;
use Illuminate\Support\Facades\Mail;


class UserComplaintController extends Controller
{
    public function index()
    {
   /*   $complaints =  DB::table('complaints')
            ->join('projects','complaints.project_id','=','projects.id')
            ->where('wingid',Auth::user()->wing_name)
            ->orderBy('complaints.updated_at', 'DESC')
            ->get();*/

       $complaints = Complaints::join('projects', 'complaints.project_id', '=', 'projects.id')
       ->select('complaints.id','complaints.system_name','complaints.description','complaints.status','complaints.files','complaints.client_id','complaints.wing_id','complaints.fault_type','urgency_level','complaints.created_at','complaints.updated_at','complaints.project_id')
       ->where('projects.wingid',Auth::user()->wing_name)
       ->where('complaints.status',"!=","5")

       ->orderBy('complaints.updated_at', 'DESC')->get();
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

      Helper::$complaint_data = [
        'system_name' => Helper::getprojectName($request->input('title')),
        'description' => $request->input('summary-ckeditor'),
        'client_id' => Auth::user()->user_id,
        'client_name' =>  Helper::getClientName(Auth::user()->user_id),
        'wing_id' =>  Helper::getWingId($request->input('title')),
        'fault_type' => $request->input('fault_type'),
        'urgency_level' =>$request->input('urgency')
       ];
/*
        Mail::to(Helper::getEmailfromUsertype("winghead",Helper::getWingId($request->input('title'))))->send(new ComplaintAddedNotifaction());
        Mail::to(Helper::getEmailfromUsertype("dg","0"))->send(new ComplaintAddedNotifaction());
        Mail::to(Helper::getEmailfromUsertype("s01","0"))->send(new ComplaintAddedNotifaction());
        Mail::to(Helper::getEmailfromUsertype("c-controller","0"))->send(new ComplaintAddedNotifaction());
*/
     
      return redirect('winghead/wings-complaints')->with('status','Complaint Submitted Successfully!');
   }

   public function show($id)
   {
       $complaint_developer = Complaint_developer::where('complaint_id',$id)->get();
       $message = Message::where('complaint_id',$id)->orderBy('updated_at', 'DESC') -> get();
       $complaints = complaints::findOrFail($id);
       return view('winghead.view-complaints-details')->with('complaints', $complaints)->with('complaint_developer',$complaint_developer)->with('message',$message);
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
        

      return view('winghead.add-project-complaint')->with('id',$idOpt)->with('title',$titleOpt);
   }


}
