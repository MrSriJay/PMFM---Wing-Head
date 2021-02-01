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


class ComplaintController extends Controller
{
    public function index()
    {
       $Complaint_Developer = [];
       $complaints = [];
       $Complaint_Developer = Complaint_Developer::
                where('developer_id',Auth::user()->user_id)->orderBy('updated_at', 'DESC')->get();


        foreach($Complaint_Developer as $row)
        {
            $output = $row->complaint_id;
            $complaints = Complaints::
                where('id',$output)->orderBy('updated_at', 'DESC')->get();

        }
        

       return view('developer.view-complaints')->with('complaints',$complaints)->with('Complaint_Developer',$Complaint_Developer);
    }
}
