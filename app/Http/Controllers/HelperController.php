<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Help;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use App\Mail\HelpMessageMail;
use Illuminate\Support\Facades\Mail;
use App\helper;

class HelperController extends Controller
{
    public function index(){
        return view("help");
    }

    public function create(){
        $help = Help::All();
        return view("admin.view-help-messages")->with('help',$help);
    }

    public function store(Request $request){

        $validate = \Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'message' => 'required',
            'telephone' => ['required'],
            'email' => ['required']
            
        ]);
   
        if( $validate->fails()){
            return redirect()
            ->back()
            ->withErrors($validate)
            ->withInput();
        }

        $help = new Help;
        $help->name = $request->input('name');
        $help->message = $request->input('message');
        $help->email = $request->input('email');
        $help->telephone = $request->input('telephone');

        $help->save();

        return redirect()
        ->back()
        ->with('status','Message Sent!!');


    }

    public function sendReply(Request $request,$id){

        $help = Help::find($id);
        $help->delete();

        Helper::$help_message = [
            'question' => $request->question,
            'reply' => $request->reply
         ];

        Mail::to($request->email)->send(new HelpMessageMail());

        return redirect()
        ->back()
        ->with('status','Replied to messeage successfully!!');
    }
}
