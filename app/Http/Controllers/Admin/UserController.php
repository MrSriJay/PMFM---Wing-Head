<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function registered()
    {
        $users = User::all();
        return view('admin.registered-users')->with('users',$users);
    }
     
    public function registeredit(Request $request, $id)
    {
        $users = User::findOrFail($id);
        return view('admin.edit-user')->with('users',$users);
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
