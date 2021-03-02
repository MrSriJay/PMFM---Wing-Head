<?php

namespace App\Http\Controllers\client;

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
use App\Models\Complaint_Developer;
use App\Models\Message;
use App\Mail\ComplaintAddedNotifaction;
use Illuminate\Support\Facades\Mail;


class ClientComplaintController extends Controller
{

    public function index()
    {
       $complaints = Complaints::where('client_id',Auth::user()->user_id)
       ->where('status',"!=","5")
       ->orderBy('updated_at', 'DESC')->get();
       return view('client.view-complaints')->with('complaints',$complaints);
    }

    public function create()
    {
       return view('client.add-complaint');
    }

    public function show($id)
    {
        $message = Message::where('complaint_id',$id)->orderBy('updated_at', 'DESC') -> get();
        $complaint_developer = Complaint_Developer::where('complaint_id',$id)->get();
        $complaints = complaints::findOrFail($id);
        return view('client.view-complaints-details')->with('complaints', $complaints)->with('complaint_developer',$complaint_developer)->with('message',$message);
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


    //Mail::to("podilali69@gmail.com")->send(new ComplaintAddedNotifaction());

     Mail::to(Helper::getEmailfromUserID(Auth::user()->user_id))->send(new ComplaintAddedNotifaction());
     Mail::to(Helper::getEmailfromUsertype("winghead",Helper::getWingId($request->input('title'))))->send(new ComplaintAddedNotifaction());
     Mail::to(Helper::getEmailfromUsertype("dg","99"))->send(new ComplaintAddedNotifaction());
     Mail::to(Helper::getEmailfromUsertype("s01","99"))->send(new ComplaintAddedNotifaction());
     Mail::to(Helper::getEmailfromUsertype("c-controller","99"))->send(new ComplaintAddedNotifaction());
      

      return redirect('client/clients-complaints')->with('status','Complaint Submitted Successfully!');

   }


   public function solutionOk(Request $request){

      $complaints = Complaints::find($request->input('comp_id'));
      $complaints->status =5;
    

      $project = Projects::find( $request->input('proj_id'));
      $project->status =1;

      $project->save();
      $complaints ->save();

      return redirect('client/clients-complaints')->with('status','Complaint Fixed!, Please wait for client\'s feedback about the solution.');

  }

  public function solutionFalse(Request $request){

   $complaints = Complaints::find($request->input('comp_id'));
   $complaints->status =4;
   $complaints ->save();

   return redirect()->back()->with('status','Solution Rejected!, Developer will be notified');

}


}
