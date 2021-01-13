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
        $users = User::where('usertype', '!=', 'client')->get();
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
                'usertype' => $request->usertype,
                'wing_name' =>$request->wing_name,      
                'password' => Hash::make($request->password),
            ]);
            return redirect('/admin/users')->with('status', 'User Added Successfully');
           
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
        return view('admin.view-user-details')->with('user', $user);
    }


    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect('/admin/users')->with('status','User Deleted Successfully!');

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
        
        return redirect('/admin/users')->with('status','User Details Updated Successfully!');
    }
}
