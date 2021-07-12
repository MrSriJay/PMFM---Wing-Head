<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Complaints;
use App\Models\Wing;
use App\Models\Projects;
use League\Flysystem\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use SebastianBergmann\CodeCoverage\Report\Xml\Project;
use Illuminate\Support\Facades\Auth;
use App\Helper;

class PurchasedSystemsController extends Controller
{
    public function index()
    {
       $project =  Projects::where('clientid',Auth::user()->user_id)->orderBy('updated_at', 'DESC')->get();
       $wing = Wing::orderBy('wing_name', 'ASC')->get();
       return view('client.purchased-systems')->with('project',$project)->with('wing', $wing);
    }

    public function show($id)
    {
        $project = Projects::findOrFail($id);
        $complaints = complaints::where('project_id',$id)->orderBy('updated_at', 'DESC')->get();
        return view('client.view-systems')->with('project', $project)->with('complaints', $complaints);
    }

    public function showCompalintHistory($id)
    {
        $complaints = complaints::where('project_id',$id)->orderBy('updated_at', 'DESC')->get();
        $proid= $id;
        return view('client.view-complaint-history')->with('complaints', $complaints)->with('proid', $proid);
    }  

}