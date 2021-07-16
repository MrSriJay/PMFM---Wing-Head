<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ranks;

class RanksController extends Controller
{
    public function index()
    {
       $rank = Ranks::All();
       return view('admin.view-ranks')->with('rank',$rank);
    }

    public function show($id)
    {
        $rank = Ranks::orderBy('rankname', 'ASC')->findOrFail($id);
        return view('admin.view-rank-details')->with('rank', $rank);
    }

    public function store(Request $request)
    {
    
        $rankname = $request->input('name');
        $data =Ranks::where('rankname', '=', $rankname)->first();

        if ($data === null) {

            $rank = new Ranks; 
            $rank->rankname = $request->input('name');

            $rank->save();
            return redirect('/admin/ranks')->with('status','Rank Added Successfully!');

        }
        else{

            return redirect()->back()->with('error','Rank Already Exists');
        }
       
    }

    public function update (Request $request, $id)
    {

        $rank = Ranks::findOrFail($id);
        $rank->rankname = $request->input('rankname');

        $rank->save();

        return redirect('/admin/ranks')->with('status','Rank Updated Successfully!');

    }

    public function destroy($id)
    {
        
        $wing = Ranks::find($id);
        $wing->delete();
        return redirect('/admin/ranks')->with('status','Rank Deleted Successfully!');
    }
}
