<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Mail\AccountCreationMail;
use Illuminate\Support\Facades\Mail;
use App\helper;
use Auth;
use App\Models\User;
use App\Models\Client;

class EditprofileController extends Controller
{
    public function index($id){

        $user = User::findOrFail($id);
      
        if(Auth::user()->usertype=="winghead"){
            return view('winghead.edit_profile')->with('user', $user);
        }
        else if(Auth::user()->usertype=="developer" || Auth::user()->usertype=="officer" ){
            return view('developer.edit_profile')->with('user', $user);
        }
        else if(Auth::user()->usertype=="client"){
            $client = Client::findOrFail($id);
            return view('client.edit_profile')->with('clients', $client);
        }
        else{
            return view('admin.edit_profile')->with('user', $user);
        }
    }

    public function update (Request $request, $id)
    {
        if(Auth::user()->usertype=="client"){
            
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

            return redirect()
            ->back()
            ->with('status','Details Updated Successfully!');
        }
        else{
            
            $validate = \Validator::make($request->all(), [
                'rank' => ['required', 'string', 'max:255'],
                'first_name' => ['required', 'string', 'max:255'],
                'last_name' => ['required', 'string', 'max:255'],
                'telephone' => ['required', 'string', 'max:10', 'min:10'],
                'email' => ['required', 'string', 'email', 'max:255'],
            ]);

            if( $validate->fails()){
                return redirect()
                ->back()
                ->withErrors($validate)
                ->withInput();
            }

            $user = User::findOrFail($id);
            $input = $request->all();
            $user->fill($input)->save();

            
            return redirect()
            ->back()
            ->with('status','Details Updated Successfully!');
        }
    }

    public function editPassword (Request $request,$id){


    $validator = \Validator::make($request->all(),[
            'current_password' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed']
        ]);

        if( $validator->fails()){
            return redirect()
            ->back()
            ->withErrors($validator)
            ->withInput();
        }

        $isCorrect = Hash::check($request->current_password, Auth::user()->password, []);
        if ($isCorrect) {

            $user = User::find($id);
            $user->password = Hash::make(($request->password));
            $user-> save();
            return redirect()
            ->back()
            ->with('status','Password Updated Successfully!');
        }   
        else{
            return redirect()
            ->back()
            ->with('errorStatus','Current password is incorrect does not match the existing password');
        }

     
    
    }
}
