<?php

namespace App\Http\Controllers\Admin;

use App\Models\Client;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ClientController extends Controller
{
    public function index()
    {
        $clients = Client::all();
        return view('admin.view-clients')->with('clients',$clients);
    }

    public function create()
    {
       return view('admin.add-clients');
    }

    public function store(Request $request)
    {
      
            $validate = \Validator::make($request->all(), [
                'organization_name' => ['required', 'string', 'max:255'],
                'dep_name' => ['required', 'string', 'max:255'],
                'address' => ['required', 'string', 'max:255'],
                'telephone' => ['required', 'string'],
                'email' => ['required', 'string', 'email', 'max:255'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ]);

            if( $validate->fails()){
                return redirect()
                ->back()
                ->withErrors($validate)
                ->withInput();
            }
    
            $user_create = Client::create([
    
                'organization_name' => $request->organization_name,
                'department_name' => $request->dep_name,
                'address' => $request->address,
                'telephone' => $request->telephone,
                'email' => $request->email,   
                'usertype' => "client",   
                'password' => Hash::make($request->password),
            ]);
            return redirect('/admin/clients')->with('status', 'Client Added Successfully');
           
     
            return redirect()
            ->back()
            ->with('error', 'User Already Exits')
            ->withInput();
        

       
    }
}
