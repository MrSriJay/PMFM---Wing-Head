<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.view-users')->with('users',$users);
    }
    public function create()
    {
       return view('admin.add-users');
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
                'phone' =>$request->phone,
                'usertype' => $request->usertype,
                'wing_name' =>$request->wing_name,      
                'password' => Hash::make($request->password),
            ]);
            return redirect('/admin/users')->with('status', 'User Added Successfully');
           
        }
        else{
            return redirect()
            ->back()
            ->with('erroruser', 'User ALready Exits')
            ->withInput();
        }

       
    }

    public function registerupdate(Request $request, $id)
    {
        $users = User::find($id);
        $users->name = $request->input('name');
        $users->phone = $request->input('phone');
        $users->email = $request->input('email');
        $users->usertype = $request->input('usertype');
        $users->update();

        return redirect('/user-register')->with('status','Changes Saved Successfully!');
    }

    public function registerdelete($id)
    {
        $users = User::findOrFail($id);
        $users->delete();

        return redirect('/user-register')->with('status','User Deleted Successfully!');
    }
}
