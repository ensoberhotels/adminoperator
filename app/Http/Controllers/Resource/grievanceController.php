<?php

namespace App\Http\Controllers\Resource;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use View;
use DB;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\AdminRequest;
use App\Admin;
use App\CompanyMaster;
use App\Operator;
use App\grievance;
use Storage;
use App\SMTPEmail;
use Mail;
use PHPMailer\PHPMailer;

class grievanceController extends Controller
{   
    public function __construct(){
		//its just a dummy data object.
		$requests = AdminRequest::orderBy('id' , 'desc')->where('status','OPEN')->with('operator')->get();

		// Sharing is all view of admincontroller
		View::share('requests', $requests);
	}

    public function index(){
        return view('grievance.index');
    }

    public function store(request $request){
        $this->validate($request, [
            'title'        => 'required',
            'description'  => 'required',
            'attachment'   => 'required',            
        ]);
        //dd($request->all());
		\DB::beginTransaction();
		try{
            $user=session()->get('admin');
            $userID   = $user['id'][0];
            $loginType = $user['login_type'][0];
            if ($loginType=='A') {
                $admin      =  Admin::where('id', $userID)->where('comp_admin_id', $user['comp_admin_id'][0])->where('comp_id', $user['comp_id'][0])->where('user_type', $loginType)->first();
                $from_name  =  @$admin->user.' (Admin)';
                $from_email =  @$admin->user_email;
            } else {
                $oprator    =  Operator::where('id', $userID)->where('company_id', $user['company_id'][0])->where('property_id', $user['property_id'][0])->first();
                $from_name  =  @$oprator->name.' (Operator)';
                $from_email =  @$user->email;
            }
            if($request->file('attachment')){
                $name = time().'_'.$request->file('attachment')->getClientOriginalName();
                $destinationPath = public_path('/asset/images/grievance');
                $request->file('attachment')->move($destinationPath, $name);
            }else{
                $name = '';
            }
            $data = new grievance();

            $data->title       = $request->title;
            $data->description = $request->description;
            $data->attachment  = $name;
            $data->from_id     = $userID;  
            $data->from_name   = $from_name;
            $data->save();

            $message="<table style='text-align: left;'>
                        <tr></tr><tr></tr>
                        <tr></tr><tr></tr>
                        <h3  style='text-align: center;'>New New Grievance By $from_name</h3>
                        <tr>
                            <th>Title :</th>
                            <td>$request->title</td>
                        </tr>
                        <tr>
                            <th>Description:</th>
                            <td>$request->description</td>
                        </tr>
                        <tr></tr><tr></tr>
                        <tr></tr><tr></tr>
                        <tr></tr><tr></tr>
                        <tr><td>Thanks and regards by Ensober Holets </td></tr>
                    </table>";
            $from = $from_email;
            // $to   = 'raj@ensoberhotels.com';
            $to   = '485kumarashish@gmail.com';
            $subject = "New Grievance By $from_name";
            $pdf_name=$destinationPath.'/'.$name;
            $ccemail= '';
            $this->send($message, $subject, $from, $to, $pdf_name='', $ccemail='');
            \DB::commit();
            return redirect('/grievance/thanks');
        }catch(Exception $e){
			\DB::rollback();
            return back()->with('flash_error', 'Error while saving grievance data');
		}
    }

    public function thanks(){
        return view('grievance.thanks');
    }
}
