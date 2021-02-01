<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Projects;
use App\Models\Message;
use App\Models\Complaints;
use App\helper;
use App\Models\Complaint_Developer;
use Illuminate\Support\Facades\Auth;

class AssignDeveloperController extends Controller
{
      
    public function addDeveloper(Request $request){
       
        $data =Complaint_Developer::where('complaint_id', $request->input('compId'))->where('developer_id',$request->input('dev_name'))->first();
        if ($data === null) {
            $complaint_developer = new Complaint_Developer;
            $complaint_developer->complaint_id = $request->input('compId');
            $complaint_developer->developer_id = $request->input('dev_name');
            $complaint_developer->assigned_by = Auth::user()->user_id;
    
            $complaints = Complaints::find($request->input('compId'));
            $complaints->status =1;
    
            $complaints ->save();
            $complaint_developer->save();
    
            return redirect()->back()->with('devstatus','Developer Assigned');
        }
        else{
            return redirect()
            ->back()
            ->with('error', 'Developer already assigned');
        }
    
    }
    
    public function deleteDeveloper(Request $request){
            $complaint_developer = complaint_developer::where('complaint_id', $request->input('comp_id'))->where('developer_id',$request->input('dev_id'));
            $complaint_developer->delete();
            
            $data =complaint_developer::where('complaint_id', $request->input('comp_id'))->first();
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
            
            $message->save();
            return redirect()->back();

    }
}
