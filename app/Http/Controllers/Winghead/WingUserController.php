<?php

namespace App\Http\Controllers\Winghead;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Mail\AccountCreationMail;
use Illuminate\Support\Facades\Mail;
use App\helper;

class WingUserController extends Controller
{
    public function index()
    {
        $users = User::where('wing_name',Auth::user()->wing_name)->orderBy('updated_at', 'DESC')->get();
        return view('winghead.view-users')->with('users',$users);
    }
    public function create()
    {
       return view('winghead.add-users');
    }

    public function store(Request $request)
    {
        $userid = $request->input('userid');
        $data =User::where('user_id', '=', $userid)->first();
        if ($data === null) {

            $validate = \Validator::make($request->all(), [
                'userid' => ['required', 'string', 'max:255'],
                'rank' => ['required', 'string', 'max:255'],
                'first_name' => ['required', 'string', 'max:255'],
                'last_name' => ['required', 'string', 'max:255'],
                'usertype' => ['required', 'string', 'max:255'],
                'wing_name' => ['required', 'string', 'max:255'],
                'telephone' => ['required', 'string', 'max:10', 'min:10'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ]);

            if( $validate->fails()){
                return redirect()
                ->back()
                ->withErrors($validate)
                ->withInput();
            }
    
            $user_create = User::create([
    
                'user_id' => $request->userid,
                'rank' => $request->rank,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'telephone' => $request->telephone,
                'email' => $request->email,
                'usertype' => $request->usertype,
                'wing_name' =>$request->wing_name,      
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
            return redirect('/winghead/wings-users')->with('status', 'User Added Successfully');
           
        }
        else{
            return redirect()
            ->back()
            ->with('error', 'User Already Exits')
            ->withInput();
        }

       
    }

    public function show($id){

        $user = User::findOrFail($id);
        return view('winghead.view-user-details')->with('user', $user);
    }


    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect('/winghead/wings-users')->with('status','User Deleted Successfully!');

    }

    public function update (Request $request, $id)
    {

        $validate = \Validator::make($request->all(), [
            'rank' => ['required', 'string', 'max:255'],
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'usertype' => ['required', 'string', 'max:255'],
            'wing_name' => ['required', 'string', 'max:255'],
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

}
