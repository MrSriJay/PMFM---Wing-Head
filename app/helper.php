<?php

namespace App;
use App\Models\Wing;


class Helper
{
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
            case 'civil': return "Civil Consultant"; break;
            case 'admin': return "Admin"; break;

        }

        
    }
}
   

?>