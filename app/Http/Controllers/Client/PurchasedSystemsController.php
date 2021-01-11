<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PurchasedSystemsController extends Controller
{
    public function index()
    {
       return view('client.view-complaints');
    }
}
