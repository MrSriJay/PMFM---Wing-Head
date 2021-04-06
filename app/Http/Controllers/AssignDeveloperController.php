<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Projects;
use App\Models\Message;
use App\Models\Complaints;
use App\helper;
use App\Models\Complaint_developer;
use Illuminate\Support\Facades\Auth;
use App\Mail\DeveloperAssignmentMail;
use App\Mail\ComplaintStatusMail;
use App\Mail\FeedNewMail;
use Illuminate\Support\Facades\Mail;

class AssignDeveloperController extends Controller
{
      
    public function addDeveloper(Request $request){
       
        $data =Complaint_developer::where('complaint_id', $request->input('compId'))->where('developer_id',$request->input('dev_name'))->first();
        if ($data === null) {
            $complaint_developer = new Complaint_developer;
            $complaint_developer->complaint_id = $request->input('compId');
            $complaint_developer->developer_id = $request->input('dev_name');
            $complaint_developer->assigned_by = Auth::user()->user_id;
    
            $complaints = Complaints::find($request->input('compId'));
            $complaints->status =1;
    
            $complaints ->save();
            $complaint_developer->save();

            Helper::$dev_data = [
                'system_name' => Helper::getprojectName($complaints->project_id),
                'description' => $complaints->description,
                'client_id' =>$complaints->client_id,
                'client_name' =>  Helper::getClientName($complaints->client_id),
                'fault_type' => $complaints->fault_type,
                'urgency_level' => $complaints->urgency_level,
                'assigned_by' => $complaints->assigned_by
             ];
             Mail::to(Helper::getEmailfromUserID($request->input('dev_name')))->send(new DeveloperAssignmentMail());

            
             Helper::$status_message = [
                'message' =>"We have assigned an officer to look into your complaint. Please await for further details",
                'client_name' =>  Helper::getClientName($complaints->client_id)
             ];
             Mail::to(Helper::getEmailfromUserID($complaints->client_id))->send(new ComplaintStatusMail());

             //Mail::to("podilali69@gmail.com")->send(new DeveloperAssignmentMail());
             //Mail::to("podilali69@gmail.com")->send(new ComplaintStatusMail());

            return redirect()->back()->with('devstatus','Developer Assigned');
        }
        else{
            return redirect()
            ->back()
            ->with('error', 'Developer already assigned');
        }
    
    }
    
    public function deleteDeveloper(Request $request){
            $complaint_developer = Complaint_developer::where('complaint_id', $request->input('comp_id'))->where('developer_id',$request->input('dev_id'));
            $complaint_developer->delete();
            
            $data =Complaint_developer::where('complaint_id', $request->input('comp_id'))->first();
            if ($data === null) {
    
                $complaints = Complaints::find($request->input('comp_id'));
                $complaints->status =0;
                $complaints ->save();
            }
    
            return redirect()
                    ->back()
                    ->with('devstatus','Developer removed');
    }

    // Add Feedback

    public function addFeedback(Request $request){
       
       
            $message = new Message;
            $message->message = $request->input('message');
            $message->receiver = $request->input('sender_name');
            $message->sender = Auth::user()->user_id;
            $message->complaint_id = $request->input('comp_id');

            Helper::$feedback_message = [   
                'sender' => Helper::getName(Auth::user()->user_id),
                'receiver' => Helper::getName($request->input('sender_name')),
                'usertype' => Helper::getUserType(Auth::user()->user_id)
                
             ];

           // Mail::to(Helper::getEmailfromUserID($request->input('sender_name')))->send(new FeedNewMail());
            
            $message->save();
            return redirect()->back();
    }

}
