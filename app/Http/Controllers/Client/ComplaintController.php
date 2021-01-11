<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ComplaintController extends Controller
{

    public function index()
    {
       return view('client.view-complaints');
    }

    public function create()
    {
       return view('client.add-complaint');
    }

}
