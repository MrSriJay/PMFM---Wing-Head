<?php

namespace App\Http\Controllers\Developer;

use App\Models\Complaints;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\helper;
use App\Models\Projects;
use App\Models\Complaint_Developer;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;
use DB;

class ComplaintController extends Controller
{
    public function index()
    {
        $complaints =  DB::table('complaints')
            ->join('complaint_developers','complaints.id','=','complaint_developers.complaint_id')
            ->where('developer_id',Auth::user()->user_id)
            ->orderBy('complaint_developers.updated_at', 'DESC')
            ->get();

         return view('developer.view-complaints')->with('complaints',$complaints);
    }

    public function show($id)
    {
        $message = Message::where('complaint_id',$id)->get();
        $complaint_developer = Complaint_Developer::where('complaint_id',$id)->get();
        $complaints = complaints::findOrFail($id);
        return view('developer.view-complaints-details')->with('complaints', $complaints)->with('complaint_developer',$complaint_developer)->with('message',$message);
    }

    public function seenComplaint(Request $request){


        $complaints = Complaints::find($request->input('comp_id'));
        $complaints->status =2;
        
        $complaints ->save();

        $id = $request->input('comp_id');
        $message = Message::where('complaint_id',$id)->get();
        $complaint_Developer = Complaint_Developer::where('complaint_id',$id)->get();
        $complaints = complaints::findOrFail($id);

        return view('developer.view-complaints-details')->with('complaints', $complaints)->with('complaint_developer',$complaint_Developer)->with('message',$message);

    }

    

}
