<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
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
                'department_name' => ['required', 'string', 'max:255'],
                'address' => ['required', 'string', 'max:255'],
                'contact_no' => ['required', 'string'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:clients'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ]);

            if( $validate->fails()){
                return redirect()
                ->back()
                ->withErrors($validate)
                ->withInput();
            }
    
            $client_create = Client::create([
    
                'organization_name' => $request->organization_name,
                'department_name' => $request->department_name,
                'address' => $request->address,
                'contact_no' => $request->contact_no,
                'email' => $request->email,
                'usertype'=>"client",   
                'password' => Hash::make($request->password),
            ]);

            $user_create = User::create([
    
                'user_id' => $request->email,
                'rank' => "client",
                'first_name' => $request->organization_name,
                'last_name' => $request->organization_name,
                'telephone' => $request->contact_no,
                'email' => $request->email,
                'usertype' => "client",
                'wing_name' =>"client",      
                'password' => Hash::make($request->password),
            ]);

            return redirect('/admin/clients')->with('status', 'Client Added Successfully');

    }

    public function show($id){

        $clients = Client::findOrFail($id);
        return view('admin.view-client-details')->with('clients', $clients);
    }
    
    public function destroy($id)
    {
        $clients = Client::find($id);
        $clients->delete();
        return redirect('/admin/clients')->with('status','User Deleted Successfully!');

    }

    public function update (Request $request, $id)
    {

        $validate = \Validator::make($request->all(), [
            'department_name' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'contact_no' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
        ]);

        if( $validate->fails()){
            return redirect()
            ->back()
            ->withErrors($validate)
            ->withInput();
        }

        $clients = Client::findOrFail($id);
        $input = $request->all();
        $clients->fill($input)->save();
        
        return redirect('/admin/clients')->with('status','Client Details Updated Successfully!');
    }

    public function registerdelete($id)
    {
        $clients = Client::findOrFail($id);
        $clients->delete();

        return redirect('/user-register')->with('status','Client Deleted Successfully!');
    }
}
