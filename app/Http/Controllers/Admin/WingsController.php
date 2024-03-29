<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Wing;


class WingsController extends Controller
{
    public function index()
    {
       $wing = Wing::All();
       return view('admin.view-wings')->with('wing',$wing);
    }

    public function show($id)
    {
        $wing = Wing::orderBy('wing_name', 'ASC')->findOrFail($id);
        return view('admin.view-wing-details')->with('wing', $wing);
    }

    public function store(Request $request)
    {
    
        $wing_name = $request->input('name');
        $data =Wing::where('wing_name', '=', $wing_name)->first();

        if ($data === null) {

            $wing = new Wing; 
            $wing->wing_name = $request->input('name');

            $wing->save();
            return redirect('/admin/wings')->with('status','Wing Added Successfully!');

        }
        else{

            return redirect()->back()->with('error','Wing Already Exists');
        }
       
    }

    public function update (Request $request, $id)
    {

        $wing = Wing::findOrFail($id);
        $wing->wing_name = $request->input('wing_name');

        $wing->save();

        return redirect('/admin/wings')->with('status','Wing Updated Successfully!');

    }

    public function destroy($id)
    {
        
        $wing = Wing::find($id);
        $wing->delete();
        return redirect('/admin/wings')->with('status','Wing Deleted Successfully!');
    }
}
