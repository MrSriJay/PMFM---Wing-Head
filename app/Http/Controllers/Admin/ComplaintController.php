<?php

namespace App\Http\Controllers\Admin;

use App\Models\Complaints;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ComplaintController extends Controller
{
    public function index()
    {
        $complaints = Complaints::all();
        return view('admin.complaints')->with('complaints',$complaints);
    }

    public function store(Request $request)
    {
    
        $complaints = new Complaints; 

        $complaints->system_name = $request->input('system');
        $complaints->description = $request->input('description');
        $complaints->images = $request->input('images');
        $complaints->date = $request->input('date');

        $complaints->save();
        return redirect('/complaint-register')->with('status','Complaint Added Successfully!');

    }

    public function edit($id)
    {
        $complaints = Complaints::findOrFail($id);
        return view('admin.complaint-edit')->with('complaints',$complaints);
    }

    public function update(Request $request, $id)
    {
        $complaints = Complaints::findOrFail($id);
        $complaints->system_name = $request->input('system');
        $complaints->description = $request->input('description');
        $complaints->images = $request->input('images');
        $complaints->date = $request->input('date');

        $complaints->update(); 
        return redirect('/complaint-register')->with('status','Complaint Updated Successfully!');
    }

    public function delete($id)
    {
        $complaints = Complaints::findOrFail($id);
        $complaints->delete(); 

        return redirect('/complaint-register')->with('status','Complaint Deleted Successfully!');

    }

}
