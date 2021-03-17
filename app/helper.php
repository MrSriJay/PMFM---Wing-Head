<?php

namespace App;
use App\Models\Wing;
use App\Models\User;
use App\Models\Client;
use App\Models\Projects;
use App\Models\Complaints;
use App\Models\Message;

class Helper

{
    public static $baseurl = "http://127.0.0.1:8000";

    // Email 
    public static $login_data =[];
    public static $complaint_data =[];
    public static $dev_data =[];
    public static $status_message =[];
    public static $feedback_message =[];
    public static $help_message =[];


    public static function getWingName($id){
        $data =Wing::select("wing_name")
        ->where('id', $id)
            ->get();

            $output="";    
        foreach($data as $row)
        {
            $output = $row->wing_name;
        }

        return $output;
    }

    public static function getDesignation($id){
        switch($id){
            case 'winghead': return "Winghead"; break;
            case 'developer': return "Developer"; break;
            case 'officer': return "Officer"; break;
            case 'admin': return "Admin"; break;
            case 'client': return "Client"; break;
            case 'dg': return "Director General"; break;
            case 's01': return "Staff Officer 01"; break;
            case 'c-controller': return "Cheif Controller"; break;
            case 'c-coordinator': return "Cheif Quadianator"; break;
            case 'hq': return "Headquaters"; break;
            case 'all': return "Public"; break;
        }
        
    }

    public static function getDesignationFromID($id){
        $data =User::select("usertype")
        ->where('user_id',$id)
            ->get();

            $output="";    
        foreach($data as $row)
        {
            $output = $row->usertype;

        }

        switch($output){
            case 'winghead': return "Winghead"; break;
            case 'developer': return "Developer"; break;
            case 'officer': return "Officer"; break;
            case 'admin': return "Admin"; break;
            case 'client': return "Client"; break;
            case 'dg': return "Director General"; break;
            case 's01': return "Staff Officer 01"; break;
            case 'c-controller': return "Cheif Controller"; break;
            case 'c-coordinator': return "Cheif Quadianator"; break;
            case 'hq': return "Headquaters"; break;
        }
        
    }

    public static function getName($id){
        $data =User::select("first_name","rank","last_name","usertype")
        ->where('user_id',$id)
            ->get();
            $output="";    
        foreach($data as $row)
        
        {
            if($row->usertype=="client"){

                $output = $row->first_name;
            }
            else{

                $user_rank="";
                $rank=$row->rank;
                if($rank=="Civil Personnel"){
                $user_rank="";
                }
                else{
                $user_rank=$row->rank.". ";
                }
                $output = $user_rank."".$row->first_name." ".$row->last_name;
            }
        }

        return $output;
    }

    public static function getUserType($id){
        $data =User::select("usertype")
        ->where('user_id',$id)
            ->get();
            $output="";    
        foreach($data as $row)
        {
            $output = $row->usertype;
           
        }

        return $output;
    }

    public static function getClientName($id){
        $data =Client::select("organization_name")
        ->where('id', $id)
            ->get();

            $output="";    
        foreach($data as $row)
        {
            $output = $row->organization_name;    
        }

        return $output;
    }

 

    public static function getWingId($id){
        $data =Projects::select("wingid")
        ->where('id', $id)
            ->get();    
    
            $output="";    
        foreach($data as $row)
        {
            $output = $row->wingid;
        }
    
        return $output;
    }
    
    public static function getprojectName($id){
        $data =Projects::select("title")
        ->where('id', $id)
            ->get();    
    
            $output="";    
        foreach($data as $row)
        {
            $output = $row->title;
        }
    
        return $output;
    }
  
  
    public static function getClientId($id){
        $data =Client::select("id")
        ->where('email',$id)
            ->get();    
    
        $output="";    
        foreach($data as $row)
        {
            $output = $row->id;
        }
    
        return $output;
    }



    public static function getProjectClientId($id){
        $data =Projects::select("clientid")
        ->where('id',$id)
            ->get();    
    
        $output="";    
        foreach($data as $row)
        {
            $output = $row->clientid;
        }
    
        return $output;
    } 


    

    public static function getSenderDetails($id){
        $data =Client::select("organization_name","address","email","contact_no")
        ->where('id', $id)
            ->get();

            $output="";    
        foreach($data as $row)
        {

            $output = $row->organization_name."<br>".$row->address."<br>".$row->email."<br>".$row->contact_no;

        }

        return $output;
    }



    public static function getComplaintStatus($id){

        switch($id){

            case '0': return "DEVELOPER(S) NOT ASSIGNED"; break;
            case '1': return "DEVELOPER(S) ASSIGNED"; break;
            case '2': return "SEEN BY DEVELOPER"; break;
            case '3': return "SOLUTION GIVEN BY DEVELOPER"; break;
            case '4': return "SOLUTION REJECTED"; break;
            case '5': return "SOLVED"; break;
        }
        
    }
  
    public static function getEmailfromUserID($id){
        $data =User::select("email")
        ->where('user_id',$id)
            ->get();

            $output="";    
        foreach($data as $row)
        {  

                $output = $row->email;

        }

        return $output;
    }

    public static function getEmailfromUsertype($usertype,$wing_name){
        $data =User::select("email")
        ->where('wing_name',$wing_name)
        ->where('usertype',$usertype)
            ->get();

            $output="";    
        foreach($data as $row)
        {  

                $output = $row->email;

        }

        return $output;
    }

    public static function getWingHead($wing_name){
        $data =User::select("user_id")
        ->where('wing_name',$wing_name)
        ->where('usertype','winghead')
            ->get();
            $output="";    
        foreach($data as $row)
        {  
            $output = $row->user_id;
        }

        return $output;
    }
  //  Winghead Dashboard------------------------

    public static function getcountOfficers($id){
        $data =User::select("user_id")
        ->where('wing_name', $id) ->count();
        return $data;
    }
    
    public static function getcountProjects($id){
        $data =Projects::select("id")
        ->where('wingid', $id) ->count();
        return $data;
    }

    public static function getCountComplaintsWinghead($id){
        $data =Complaints::select("id")
        ->where('status', 0)
        ->where('wing_id', $id)
        ->count();
        return $data;
    }

    public static function getMessagesforWinghead($id){
        $data =Message::select("id")
        ->where('receiver',$id)
        ->count();
        return $data;
    }

    public static function getLatestComplaint_WingHead($id){
        $data =Complaints::select("id","system_name")
        ->where('wing_id',$id)
        ->first() ->get();

        $output="";    
        foreach($data as $row)
        {
            $output = $row->system_name;
        }
    
        return $output;

    }

    public static function getLatestComplaintDate_WingHead($id){
        $data =Complaints::select("id","updated_at")
        ->where('wing_id',$id)
        ->first() ->get();

        $output="";    
        foreach($data as $row)
        {
            $output = $row->updated_at;
        }
    
        return $output;

    }

    public static function getLatestMessage($id){
        $data =Message::select("id","message")
        ->where('receiver',$id)
        ->first();

        $output="";    
        if($data != null){
           
         $output = $data->message;
           
        }
        else{
         $output="No messages yet"; 
        }
    
        return $output;

    }

    public static function getLatestMessage_By($id){
        $data =Message::select("id","sender")
        ->where('receiver',$id)
        ->first();

        $output="";    
        if($data != null){
           
                $output = $data->sender;
           
        }
        else{
            $output=" "; 
        }
    
        return $output;

    }

    //-------------- Client Dashboard ----------------------------------

    public static function getcountProjects_client($id){
        $data =Projects::select("id")
        ->where('clientid', $id) ->count();
        return $data;
    }

    public static function getCountComplaint_client($id){
        $data =Complaints::select("id")
        ->Where(function ($query){
            $query->where('status', 0)
            ->orWhere('status', 1)
            ->orWhere('status', 2)
            ->orWhere('status', 3)
            ->orWhere('status', 4);
          })
        ->where('client_id', $id)
        ->count();
        return $data;
    }

    public static function getSystemStatus($id, $status){
        $data =Projects::select("id")
        ->where('clientid', $id)
        ->where('status', $status) 
         ->count();
        return $data;
    }

    public static function getComplaintStatusDisplay($id, $status){

        $data =Complaints::select("id")
        ->where('client_id', $id)
        ->where('status', $status) 
         ->count();
        return $data;
    }


     //-----------------------------------

}
   

?>