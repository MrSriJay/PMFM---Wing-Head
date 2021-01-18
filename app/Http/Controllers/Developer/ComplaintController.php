<?php

namespace App\Http\Controllers\Developer;

use App\Models\Complaints;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class ComplaintController extends Controller
{
    public function index()
    {
        $complaints = Complaints::all();
        return view('winghead.posted-complaints')->with('complaints',$complaints);
    }
}
