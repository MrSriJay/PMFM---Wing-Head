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

class EditprofileController extends Controller
{
    public function index($id){
        $user = User::findOrFail($id);
        return view('winghead.edit_profile')->with('user', $user);
    }

    public function update (Request $request, $id)
    {

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
        ->with('status','User Details Updated Successfully!');
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

        /*
        $userid = $request->input('user_id');
        $data =User::where('user_id', '=', $userid)
        ->where('password', '=',Hash::make($request->password))
        ->first();
        if ($data != null) {

            return redirect()
            ->back()
            ->withErrors($validator)
            ->withInput();
        }
        else{
            return redirect()
            ->back()
            ->withErrors($validator)
            ->withInput();
        }*/

    }
}
