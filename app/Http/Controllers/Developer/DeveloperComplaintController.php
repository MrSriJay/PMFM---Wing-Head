<?php

namespace App\Http\Controllers\Developer;

use App\Models\Complaints;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helper;
use App\Models\Projects;
use App\Models\Complaint_developer;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;
use DB;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Mail;
use App\Mail\ComplaintStatusMail;

class DeveloperComplaintController extends Controller
{
    public function index()
    {
        $complaints =  DB::table('complaints')
            ->join('complaint_developers','complaints.id','=','complaint_developers.complaint_id')
            ->where('developer_id',Auth::user()->user_id)
            ->where('status',"!=","5")
            ->orderBy('complaint_developers.updated_at', 'DESC')
            ->get();
         return view('developer.view-complaints')->with('complaints',$complaints);
    }

    public function show($id)
    {
        $message = Message::where('complaint_id',$id)-> orderBy('updated_at', 'DESC') -> get();
        $complaint_developer = Complaint_developer::where('complaint_id',$id)->get();
        $complaints = complaints::join('projects', 'complaints.project_id', '=', 'projects.id')
        ->select('complaints.id','complaints.system_name','complaints.description','complaints.status','complaints.files','complaints.client_id','projects.wingid','complaints.fault_type','urgency_level','complaints.created_at','complaints.updated_at','complaints.project_id')
        ->where('complaints.id',$id)
        ->first();
       
        return view('developer.view-complaints-details')->with('complaints', $complaints)->with('complaint_developer',$complaint_developer)->with('message',$message);
    }

    public function seenComplaint(Request $request){

        $id = $request->input('comp_id');
        $complaints = Complaints::find($id);
        $complaints->status =2;
        
        Helper::$status_message = [
            'message' =>"The assigned developer/officer has viewed the complaint and currently working to resolve the issue with the application. Please await for further details",
            'client_name' =>  Helper::getClientName($complaints->client_id)
         ];
        Mail::to(Helper::getEmailfromUserID($complaints->client_id))->send(new ComplaintStatusMail());


        $complaints ->save();

        return redirect('/developer/developer-complaints/'.$id);

    }

    public function solutionGiven(Request $request){

        $complaints = Complaints::find($request->input('comp_id'));
        $complaints->status =3;
        $complaints ->save();
        
     Helper::$status_message = [
            'message' =>"Your compalaint has been successfully fixed! Please vist the PMFM site to give a feedback.",
            'client_name' =>  Helper::getClientName($complaints->client_id)
         ];
         
        Mail::to(Helper::getEmailfromUserID($complaints->client_id))->send(new ComplaintStatusMail());

        return redirect()->back()->with('status','Complaint Fixed!, Please wait for client\'s feedback about the solution.');

    }

    

}
