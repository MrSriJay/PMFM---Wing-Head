<?php

namespace App;
use App\Models\Wing;
use App\Models\User;
use App\Models\Client;
use App\Models\Projects;

class Helper

{
    public static $baseurl = "http://127.0.0.1:8000";
    
    public static function getWingName($id){
        $data =Wing::select("wing_name")
        ->where('id', 'LIKE', "%$id%")
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
            case 'topmanagement': return "Top Management"; break;
            case 'developer': return "Developer"; break;
            case 'officer': return "Officer"; break;
            case 'admin': return "Admin"; break;
            case 'client': return "Client"; break;

        }
        
    }

    public static function getName($id){
        $data =User::select("first_name","last_name")
        ->where('user_id', 'LIKE', "%$id%")
            ->get();

            $output="";    
        foreach($data as $row)
        {
            $output = $row->first_name." ".$row->last_name;
        }

        return $output;
    }

    public static function getClientName($id){
        $data =Client::select("organization_name")
        ->where('id', 'LIKE', "%$id%")
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
        ->where('id', 'LIKE', "%$id%")
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
        ->where('id', 'LIKE', "%$id%")
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