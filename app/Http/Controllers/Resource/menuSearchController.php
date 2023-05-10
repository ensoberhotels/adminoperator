<?php

namespace App\Http\Controllers\Resource;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\MenuMaster;
use URL;
use DB;

class menuSearchController extends Controller
{   
    // This function is used for search menus 
    public function search(Request $request)
    {   
        $value     = $request->val;
        $user      =session()->get('admin');

        // check login type
        $loginType = $user['login_type'][0];
        if ($loginType=='A') {          // Find Admin Menu 
            $company_id    =  $user['comp_id'][0];
            $company_priv  =  DB::table('sua_company_privileges')->where('company_id',$company_id)->where('login_type', $loginType)->where('permission', 'Y')->pluck('menu_id')->toArray();
            $menus         =  MenuMaster::where('login_type', $loginType)->where('menu_flag', 'Y')->whereIn('id',$company_priv)->where('type', 'FORM')->orderby('name', 'ASC')->get();
        } 
        else {                          // Find Operator Menu                
            $operator_id   =  $user['id'][0];
            $company_id    =  $user['company_id'][0];
            $property_id   =  $user['property_id'][0];
            $admin_priv    =  DB::table('opt_file_privilage')->where('operator_id',$operator_id)->where('company_id',$company_id)->where('admin_id',$property_id)->pluck('menu_id')->toArray();
            $menus         =  MenuMaster::where('login_type', $loginType)->where('menu_flag', 'Y')->whereIn('id',$admin_priv)->where('type', 'FORM')->orderby('name', 'ASC')->get();
        }

        // code for finding filterd menu 
        foreach ($menus as $key => $menu) {
            $url     = URL::to($menu->path);
            $content = $menu->tcode .'- '. $menu->name; 
            echo "<li class='search_li'><a href='$url' class='search_content'>$content</a></li>";
        }
    }
}
