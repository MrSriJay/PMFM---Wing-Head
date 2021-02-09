<?php

namespace App;
use App\Models\Wing;
use App\Models\User;
use App\Models\Client;
use App\Models\Projects;

class Helper

{
    public static $baseurl = "http://127.0.0.1:8000";
    public static $login_data =[];
    
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
        }
        
    }

    public static function getName($id){
        $data =User::select("first_name","last_name","usertype")
        ->where('user_id',$id)
            ->get();

            $output="";    
        foreach($data as $row)
        
        {

            if($row->usertype=="client"){

                $output = $row->first_name;
            }
            else{

                $output = $row->first_name." ".$row->last_name;
            }
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
  



  // Dashboard------------------------

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

     //-----------------------------------

}
   

?>