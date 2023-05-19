<?php

namespace App\Http\Controllers\Resource;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\AdminRequest;
use App\MenuMaster;
use DB;
use View;

class FileMenuManagerController extends Controller
{   
    public function __construct(){
		//its just a dummy data object.
		$requests = AdminRequest::orderBy('id' , 'desc')->where('status','OPEN')->with('operator')->get();

		// Sharing is all view of admincontroller
		View::share('requests', $requests); 
	}


    // File menu manager for operator
    public function admin()
    {
        $log_user = session()->get('admin');
        $company_priv=DB::table('sua_company_privileges')->where('company_id',$log_user['comp_id'][0])->pluck('menu_id')->toArray();
        $data=MenuMaster::where('login_type','A')->whereIn('id',$company_priv)->get();
        return view('admin/filemeumanager',compact('data'));
    }

    // File menu manager for operator
    public function operator()
    {   
        $log_user       = session()->get('admin');
        $operator_id    = session()->get('operator.id');
        $data           = MenuMaster::select( 'sua_menu_masters.name', 'opt_file_privilage.id', 'opt_file_privilage.menu_flag')
                        ->join('opt_file_privilage', 'opt_file_privilage.menu_id', '=', 'sua_menu_masters.id')
                        ->where('opt_file_privilage.operator_id', $operator_id[0])
                        ->orderBy('sua_menu_masters.name' , 'ASC')->get();
        return view('operator/filemeumanager',compact('data'));
    }
}
