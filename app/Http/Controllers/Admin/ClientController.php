<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Client;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Mail\AccountCreationMail;
use Illuminate\Support\Facades\Mail;
use App\helper;

class ClientController extends Controller
{
    public function index()
    {
        $clients = Client::orderBy('updated_at', 'DESC')->get();
        return view('admin.view-clients')->with('clients',$clients);
    }

    public function create()
    {
       return view('admin.add-clients');
    }

    public function store(Request $request)
    {
        $email = $request->input('email');
        $data = User::where('email', '=', $email)->first();
        if ($data === null) 
        {
            $validate = \Validator::make($request->all(), [
                'organization_name' => ['required', 'string', 'max:255'],
                'department_name' => ['required', 'string', 'max:255'],
                'address' => ['required', 'string', 'max:255'],
                'contact_no' => ['required', 'string'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
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

            $client =Client::select("id")
            ->where('email',$request->email )
            ->get();

            $clientIDoutput="";    
            foreach($client as $row)
            {
                $clientIDoutput = $row->id;
            }

            $user_create = User::create([
    
                'user_id' => $clientIDoutput,
                'rank' => "client",
                'first_name' => $request->organization_name,
                'last_name' => $request->organization_name,
                'telephone' => $request->contact_no,
                'email' => $request->email,
                'usertype' => "client",
                'wing_name' =>"client",      
                'password' => Hash::make($request->password),
            ]);
            
            Helper::$login_data = [
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'telephone' => $request->telephone,
                'email' => $request->email,
                'usertype' => $request->usertype,
                'password' =>$request->password
             ];


            Mail::to($request->email)->send(new AccountCreationMail());
            return redirect('/admin/clients')->with('status', 'Client Added Successfully');
        }
        else
        {
            $validate = \Validator::make($request->all(), [
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            ]);
            return redirect()
            ->back()
            ->withErrors($validate)
            ->withInput();
        }

    }

    public function show($id){

        $clients = Client::findOrFail($id);
        return view('admin.view-client-details')->with('clients', $clients);
    }
    
    public function destroy($id)
    {
        $data=Client::select("email")
        ->where('id', $id)
        ->get();

        $output="";

        foreach($data as $row)
        {
            $output = $row->email;
        }

        $user = User::find($output);
        $user->delete();

        $clients = Client::find($id);
        $clients->delete();

        return redirect('/admin/clients')->with('status','User Deleted Successfully!');
    }

    public function update (Request $request, $id)
    {

        $validate = \Validator::make($request->all(), [
            'organization_name' => ['required', 'string', 'max:255'],
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

        $user = User::find($id);
        $user->first_name = $request->input('organization_name');
        $user->email = $request->input('email');
        $user ->save();

        return redirect('/admin/clients')->with('status','Client Details Updated Successfully!');
    }

    public function registerdelete($id)
    {
        $clients = Client::findOrFail($id);
        $clients->delete();

        return redirect('/user-register')->with('status','Client Deleted Successfully!');
    }
}
