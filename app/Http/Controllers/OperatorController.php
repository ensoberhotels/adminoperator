<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use DB;
use Storage;

use PHPMailer\PHPMailer;
use App\Admin;
use App\Vender;
use App\Operator;
use App\Contacts;
use App\AssignContacts;
use App\FollowupContacts;
use App\Lead;
use App\Hotel;
use App\HotelGallery;
use App\HotelAmenity;
use App\Amenity;
use App\RoomCategory;
use App\HotelSeasonRate;
use App\PaidAmenity;
use App\SMTPEmail;
use App\EmailHistory;
use App\HotelGroupSeasonRate;
use App\BulkEmailSendReport;
use App\BulkEmailSend;
use App\EmailTemplat;
use App\EmailCampaign;
use App\EmailList;
use App\Transport;
use App\City;
use App\SendQuotation;
use App\VisitingCard;
use App\Http\Controllers\SMTPMail;
use Google\Cloud\Vision\V1\ImageAnnotatorClient;
use App\WebsiteOrder;
use App\WebsiteOrderPayment;
use App\MenuMaster;
class OperatorController extends Controller
{
	
	/**
	 * This function use for load admin login view
	 *
	 * @return admin login page
	 */
	public function index(){ 
		return view('operator.login');
	}
	
	/**
	 * This function use for view hotel details
	 *
	 * @return array 
	 */
	public function viewHotel($id){
        
        $Hotel = Hotel::select('hotels.*', 'cities.name as city', 'countries.name as country', 'regions.name as region')
                       ->join('countries', 'countries.id', '=', 'hotels.country_id')
                       ->join('regions', 'regions.id', '=', 'hotels.region_id')
                       ->join('cities', 'cities.id', '=', 'hotels.city_id')
                       ->where('hotels.id', $id)->first();
         $hotelamenity = HotelAmenity::select('name')
                            ->join('amenities', 'amenities.id', '=', 'hotel_amenities.amenity_id')
                            ->where('hotel_amenities.hotel_id', $id)
                            ->get();
         $hotelroomcategoires = RoomCategory::where('hotel_id', $id)->get(); 
         $hotelgalleries = HotelGallery::where('hotel_id', $id)->get(); 
         $current_date = date('Y-m-d');
         $hotelseasonrate = HotelSeasonRate::where('start_date','<=', $current_date)
                                            ->where('end_date','>=', $current_date)
                                            ->where('status', 'ACTIVE')
                                            ->where('hotel_id',$id)
                                            ->orderBy('id', 'DESC')->first();
       return view('operator/hotel/viewhotel', compact('Hotel','hotelamenity','hotelroomcategoires', 'hotelgalleries','hotelseasonrate', 'current_date'));
	}
	
	/**
	 * This function use for Vender login action
	 *
	 * @return admin login page
	 */
	public function operatorLogin(Request $request){
		
		$this->validate($request, [
			'user' => 'required',
			'password' => 'required',
		]);
		
		try{
			$operator = Operator::where('email', $request->user)->first();
			
			if($operator != "" && Hash::check($request->password, $operator->password)){
				$request->session()->regenerate();
				$request->session()->put('operator', $operator->name);
				$request->session()->push('operator.name', $operator->name);
				$request->session()->push('operator.id', $operator->id);
				$request->session()->push('operator.room_inventory', $operator->room_inventory);
				$request->session()->push('operator.company_id', $operator->company_id);
				$request->session()->push('operator.property_id', $operator->property_id);
				$request->session()->put('admin', $operator->name);
				$request->session()->push('admin.name', $operator->name);
				$request->session()->push('admin.id', $operator->id);
				$request->session()->push('admin.room_inventory', $operator->room_inventory);
				$request->session()->push('admin.company_id', $operator->company_id);
				$request->session()->push('admin.property_id', $operator->property_id);
				$request->session()->push('admin.login_type', 'O');
				if($operator->room_inventory == 'Y'){
					//return redirect('operator/addroombook');
					$request->session()->push('operator.hotel', $operator->hotel);
					return redirect('operator/roominventorydashboard');
				}elseif($operator->room_status == 'Y'){
					return redirect('operator/room-available');
				}else{
					return redirect('operator/dashboard');
				}
			}else{
				return redirect('operator')->with('Failed', 'Username or password is incorrect');
			}
			
		}catch(Exseption $e){
			return response()->json(['error' => $e->getMessage()]);
		}
	}
	//menu status update
	public function ChangeStatus(Request $request){
		//dd($request->all());
		$data= DB::table('opt_file_privilage')->where('id',$request->id)->update(['menu_flag'=>$request->flag]);
		if($data){
			return response()->json(['status' => 1, 'msg' => 'Data Fetch Successfully!', 'data' => $request->flag]);
		}
	}
	/**
	 * This function use for Vender login action
	 *
	 * @return admin login page
	 */
	public function operatorAutoLogin(){
		//dd('Hello Code Is Commented!');
		$user = 'info@ensoberhotels.com';
		$password = 'soberEN123';
		
		try{
			$operator = Operator::where('email', $user)->first();
			
			if($operator != "" && Hash::check($password, $operator->password)){
				session()->regenerate();
				session()->put('operator', $operator->name);
				session()->push('operator.name', $operator->name);
				session()->push('operator.id', $operator->id);
				return redirect('operator/makequotation');
			}else{
				return redirect('operator');
			}
			
		}catch(Exseption $e){
			return response()->json(['error' => $e->getMessage()]);
		}
	}
	
	/**
	 * This function use for aulogin for payment history
	 *
	 * @return admin login page
	 */
	public function operatorAutoLoginPay(){
		//dd('Hello Code Is Commented!');
		$user = 'info@ensoberhotels.com';
		$password = 'par@123';
		
		try{
			$operator = Operator::where('email', $user)->first();
			
			if($operator != "" && Hash::check($password, $operator->password)){
				session()->regenerate();
				session()->put('operator', $operator->name);
				session()->push('operator.name', $operator->name);
				session()->push('operator.id', $operator->id);
				return redirect('operator/paymenthistory');
			}else{
				return redirect('operator');
			}
			
		}catch(Exseption $e){
			return response()->json(['error' => $e->getMessage()]);
		}
	}
	
	/**
	 * This function use for get the admin dashboard details 
	 *
	 * @return admin login page
	 */
	public function dashboard(Request $request){ 
		if (session()->exists('operator')) {
            $operator_id = session()->get('operator.id');
            $log_user = session()->get('admin');
            //$current_date = date('Y-m-d');
            $new = Lead::where('assign_to', $operator_id[0])->whereDate('created_at', '=', date('Y-m-d'))->get();
            $new_count = $new->count();
            $active = Lead::where('assign_to', $operator_id[0])->where('status', 'ACTIVE')->get();
            $active_count = $active->count();
            $inactive = Lead::where('assign_to', $operator_id[0])->where('status', 'INACTIVE')->get();
            $inactive_count = $inactive->count();
            $hot = Lead::where('assign_to', $operator_id[0])->where('lead_priority', 'Hot')->get();
            $hot_count = $hot->count();
            $quotation = Lead::where('assign_to', $operator_id[0])->where('lead_status', 'QUOTATION')->get();
            $quotation_count = $quotation->count();
            $booked = Lead::where('assign_to', $operator_id[0])->where('lead_status', 'BOOKED')->get();
            $booked_count = $booked->count();
            $leadlists = Lead::select( 'leads.lead_no', 'leads.create_date', 'leads.start_date', 'leads.lead_status','operators.name', 'quotations.price' )
                       ->join('operators', 'operators.id', '=', 'leads.assign_to')
                       ->leftJoin('quotations', 'quotations.lead_id', '=', 'leads.id')
                       ->where('leads.assign_to',$operator_id[0])
                       ->orderBy('leads.id' , 'desc')->paginate(25);
            // $data=DB::table('opt_file_privilage')->where('company_id',$log_user['company_id'][0])->where('operator_id',$log_user['id'][0])->where('admin_id',$log_user['property_id'][0])->pluck('menu_id')->toArray();
            // $data=MenuMaster::where('login_type','O')->whereIn('id',$data)->get();
			$data= MenuMaster::select( 'sua_menu_masters.name', 'opt_file_privilage.id', 'opt_file_privilage.menu_flag')
					->join('opt_file_privilage', 'opt_file_privilage.menu_id', '=', 'sua_menu_masters.id')
					->where('opt_file_privilage.operator_id', $operator_id[0])
					->orderBy('sua_menu_masters.name' , 'ASC')->get();
            return view('operator/dashboard', compact('new_count','active_count','inactive_count','hot_count','quotation_count','booked_count','leadlists','data'));
		}else{
			return redirect('/operator');
		}
	}
	
	/**
	 * This function use for get the room inventorty dashboard details 
	 *
	 * @return room inventory dashboard page
	 */
	public function roomInventorydashboard(Request $request){ 
		if (session()->exists('operator')) {
            $operator_id = session()->get('operator.id');
			$operator = Operator::where('id', $operator_id)->first();
            $hotel_id = session()->get('operator.hotel');
            $hotel = $this->getHotelDetailsByIdWithFullInfo(@$hotel_id[0]);
			$hotels = Hotel::All();
            return view('operator/roominventory_dashboard', compact('hotels','hotel','operator'));
		}else{
			return redirect('/operator');
		}
	}

	/**
	 * This function use for logout admin 
	 *
	 * @return vender login page
	 */
	public function logout(){
		session()->flush();
		return redirect('/operator');
	}
	
	/** 
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function myContact(Request $request)
    {
				$operator_id = session()->get('operator');  
        $Contacts = Contacts::where('company_id',$operator_id['company_id'][0])->where('property_id',$operator_id['property_id'][0])->where('user_id',$operator_id['id'][0])->orderBy('id' , 'desc')->paginate(10);
        $contact_types = Contacts::distinct()->get(['contact_type']);
        $sources  = Contacts::distinct()->get(['source']);
        $Operators = Operator::where('status', 'ACTIVE')->get();
        return view('operator.contactfollowup.mycontact', compact('Contacts','contact_types','sources','Operators'));
    }
	
	
	/** 
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function myContactHistory(Request $request)
    {
		$operator_id = session()->get('operator');  
        $Contacts = AssignContacts::where('company_id',$operator_id['company_id'][0])->where('property_id',$operator_id['property_id'][0])->where('user_id',$operator_id['id'][0])->where('status','!=','ACTIVE')->with('followUpComment')->orderBy('id' , 'desc')->paginate(10);
        $contact_types = Contacts::distinct()->get(['contact_type']);
        $sources  = Contacts::distinct()->get(['source']);
        $Operators = Operator::where('status', 'ACTIVE')->get();
        return view('operator.contactfollowup.mycontacthistory', compact('Contacts','contact_types','sources','Operators'));
    }
	
	/** 
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function myContactFavoriteHistory(Request $request)
    {
		$operator_id = session()->get('operator');  
        $Contacts = AssignContacts::where('company_id',$operator_id['company_id'][0])->where('property_id',$operator_id['property_id'][0])->where('user_id',$operator_id['id'][0])->where('favorite_status','=','favorite')->with('followUpComment')->orderBy('id' , 'desc')->paginate(10);
        $contact_types = Contacts::distinct()->get(['contact_type']);
        $sources  = Contacts::distinct()->get(['source']);
        $Operators = Operator::where('status', 'ACTIVE')->get();
        return view('operator.contactfollowup.mycontacthistory', compact('Contacts','contact_types','sources','Operators'));
    }
	
	/** 
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function allContacts(Request $request)
    {
		$operator_id = session()->get('operator.id'); 
        $Contacts = AssignContacts::where('operator_id', $operator_id)->with('followUpComment')->orderBy('id' , 'desc')->get();
        $contact_types = Contacts::distinct()->get(['contact_type']);
        $sources  = Contacts::distinct()->get(['source']);
        $Operators = Operator::where('status', 'ACTIVE')->get();
        return view('operator.contactfollowup.mycontacthistory', compact('Contacts','contact_types','sources','Operators'));
    }
	
	/** 
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function assignContacts(Request $request)
    {
		$operator_id = session()->get('operator');  
        $Contacts = AssignContacts::where('company_id',$operator_id['company_id'][0])->where('property_id',$operator_id['property_id'][0])->where('operator_id',$operator_id['id'][0])->where('status', 'ACTIVE')->with('followUpComment')->orderBy('id' , 'desc')->paginate(10);
        $contact_types = Contacts::distinct()->get(['contact_type']);
        $sources  = Contacts::distinct()->get(['source']);
        $Operators = Operator::where('status', 'ACTIVE')->get();
        return view('operator.contactfollowup.mycontacthistory', compact('Contacts','contact_types','sources','Operators'));
    }
	
	/** 
     * Send bulk email form.
     *
     * @return \Illuminate\Http\Response
     */
    public function bulkEmailSend()
    { 
				$operator = session()->get('operator'); 
				$operator_id=$operator['id'][0];
        $emailtemplates = EmailTemplat::where('status', 'ACTIVE')->where('company_id',$operator['company_id'][0])->where('property_id',$operator['property_id'][0])->orderBy('id' , 'desc')->get();
        $emailcampaigns = EmailCampaign::where('status', 'ACTIVE')->where('company_id',$operator['company_id'][0])->where('property_id',$operator['property_id'][0])->orderBy('id' , 'desc')->get();
        $smtpemails = SMTPEmail::where('status', 'ACTIVE')->where('company_id',$operator['company_id'][0])->where('property_id',$operator['property_id'][0])->orderBy('id' , 'desc')->get();
        return view('operator.sendbulkemail', compact('emailtemplates','emailcampaigns', 'smtpemails','operator_id'));
    }
	
	/** 
     * Send bulk email form.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendBulkEmailAction(Request $request) 
    {
		$this->validate($request, [
			'emailtemplate' => 'required',
			'emailcampaign' => 'required',
			'smtpemail' => 'required',
			'from' => 'required',
			'to' => 'required',
		]);
		$operator = session()->get('operator'); 
        $emailtemplates = EmailTemplat::where('status', 'ACTIVE')->where('id', $request->emailtemplate)->first();
        $emailcampaigns = EmailCampaign::where('status', 'ACTIVE')->where('id', $request->emailcampaign)->first();
		
		//$emails = explode(',',$emailcampaigns->contact_ids);
		$emails = EmailList::where('email_campaign_id', $emailcampaigns->id)->skip($request->from)->take($request->to)->get();
		
		$emailsend = new BulkEmailSend();
		$emailsend->operator_id = $request->operator_id;
		$emailsend->title = $emailtemplates->title;
		$emailsend->email_template_id = $emailtemplates->id;
		$emailsend->email_campaign_id = $emailcampaigns->id;
		$emailsend->company_id=$operator['company_id'][0];
		$emailsend->property_id=$operator['property_id'][0];
		$emailsend->save();
		
		
		foreach($emails as $email){
			$img = "/storage/app/".$emailtemplates->template;
			$template = '<table valign="top" width="100%" cellspacing="0" cellpadding="0" border="0" align="center">
  <tbody><tr>
    <td valign="top" align="center" style="padding: 100px 0 150px;border-collapse: collapse; background-color: rgb(22,22,22); background-image: url(/asset/images/icon/back_fal.gif);"><table style="width:700px;" width="700" cellspacing="0" cellpadding="0" border="0" align="center">
        
        <tbody><tr>
          <td style="padding:10px; border-top: 4px solid #9d6116; background-color: #eee;" valign="top" align="center">
			<table width="100%" cellspacing="0" cellpadding="0" border="0" align="center">
              <tbody>
			  <tr>
                <td style="font-family:Open Sans, Arial, sans-serif; font-size:12px; line-height:15px; color:#0d1121;" valign="top" align="center">ENSOBER ALL IN ONE ITINERARY TOUR | <a href="#" target="_blank" style="color:#0d1121; text-decoration:underline;">View Online</a></td>
              </tr>
            </tbody></table></td> 
        </tr>
		
        <tr>
          <td valign="top" align="center">
			
			<table width="100%" cellspacing="0" cellpadding="0" border="0" align="center" style="background-color: #ffffffdb;box-shadow: inset 0 0 9px 0 #9d6116; border-bottom: 3px solid #3a3333;">
              <tbody><tr>
				<td valign="top" align="left" style="padding: 0 15px;">
					<h2 style="font-family: Arial, sans-serif;margin: 21px 0 1px;font-size: 33px;color: #9d6116;">Ensober Hotels</h2>
					<p style="color: #978c25;font-size: 16px;font-weight: bold;">Ensober All In One Itinerary Tour...</p>
				</td>
                <td valign="top" align="center">
					<img alt="Ensober Logo" style="display:block;font-family:Arial, sans-serif;font-size:30px;line-height:34px;color:#000000;height: 79px;margin: 8px 0 15px;width: 125px;" src="/asset/images/logo/logo.png" border="0">
				</td>
              </tr>
            </tbody>
			</table>';
			
			$template .= '<table width="100%" cellspacing="0" cellpadding="0" border="0" align="center" style="background-color: #ffffffdb;"> 
              <tbody>
			  <tr>
				<td valign="top" align="center" style="padding: 25px 15px;">
					<img src="'.$img.'" style="max-width:700px;"/>
				</td>
			  </tr>
			  
            </tbody>
			</table>';
			
			$template .= '</td>
        </tr>
		
                 <tr>
          <td style="background-image: url(/asset/images/icon/nainital8.jpg);" valign="top" align="center"><table width="100%" cellspacing="0" cellpadding="0" border="0" align="center">
              <tbody><tr>
                <td style="padding: 35px 70px 0px; background-color: rgba(0,0,0,0.3); font-family:Open Sans, Arial, sans-serif; font-size:16px; line-height:30px; color:#ffffff;" valign="top" align="center">Ensober Hotels has its resorts, Corbett Panorama, Pine Crest & Devlok Primal in Uttarakhand.</td>
              </tr> 
              <tr>
                <td style="background-color: rgba(0,0,0,0.3); font-size:0px; line-height:0px; height:15px;" height="15">&nbsp;</td>
				
              </tr>
              <tr>
                <td style="background-color: rgba(0,0,0,0.3); font-family:Open Sans, Arial, sans-serif; font-size:18px; line-height:22px; color:#fbeb59; letter-spacing:2px;     padding: 35px 70px 30px;" valign="top" align="center">Apart from our own hotels in Uttarakhand, Ensober Hotels has a list of finest partner hotels and resorts on key locations in Uttarakhand.</td>
              </tr>
			  
            </tbody></table></td>
        </tr>

        <tr>
          <td style="padding:38px 30px;border-bottom: 7px solid #9d6116; background-color: #eee;" valign="top" align="center"><table width="100%" cellspacing="0" cellpadding="0" border="0" align="center">
              <tbody><tr>
                <td style="padding-bottom:16px;" valign="top" align="center"><table cellspacing="0" cellpadding="0" border="0" align="center">
                    <tbody><tr>
                      <td valign="top" align="center"><a href="#" target="_blank" style="text-decoration:none;"><img src="/asset/images/icon/f.png" alt="fb" style="display:block; font-family:Arial, sans-serif; font-size:14px; line-height:14px; color:#ffffff; max-width:26px;" width="26" border="0" height="26"></a></td>
                      <td style="width:6px;" width="6">&nbsp;</td>
                      <td valign="top" align="center"><a href="#" target="_blank" style="text-decoration:none;"><img src="/asset/images/icon/t.png" alt="tw" style="display:block; font-family:Arial, sans-serif; font-size:14px; line-height:14px; color:#ffffff; max-width:27px;" width="27" border="0" height="26"></a></td>
                      <td style="width:6px;" width="6">&nbsp;</td>
                      <td valign="top" align="center"><a href="#" target="_blank" style="text-decoration:none;"><img src="/asset/images/icon/g.jpg" alt="yt" style="display:block; font-family:Arial, sans-serif; font-size:14px; line-height:14px; color:#ffffff; max-width:26px;" width="26" border="0" height="26"></a></td>
                    </tr> 
                  </tbody></table></td> 
              </tr>
              <tr>
                <td style="font-family:Open Sans, Arial, sans-serif; font-size:11px; line-height:18px; color:#999999;" valign="top" align="center"><a href="#" target="_blank" style="color:#999999; text-decoration:underline;">T & C</a> | <a href="#" target="_blank" style="color:#999999; text-decoration:underline;">Privacy Policy</a> | <a href="#" target="_blank" style="color:#999999; text-decoration:underline;">Refund Policy</a><br>
                  © 2019 Ensober . All Rights Reserved .<br>
                  Ensober Hotels has its resorts, Corbett Panorama, Pine Crest & Devlok Primal in Uttarakhand.
				  <br>
				  <a href="#">Intrasted </a>|  <a href="/operator/unsuscribe/'.$email->contact_id.'">Unsubscribed</a>
				  </td> 
              </tr>
            </tbody></table></td> 
        </tr>
        <tr>
          <td style="line-height:1px;min-width:700px;background-color:#ffffff;"><img alt="" src="images/spacer.gif" style="max-height:1px; min-height:1px; display:block; width:700px; min-width:700px;" width="700" border="0" height="1"></td>
        </tr>
      </tbody></td>
  </tr>
</tbody></table>';


			//$contact = Contacts::where('id',$email)->first();
			$report = new BulkEmailSendReport();
			$report->bulk_email_send_id = $emailsend->id;
			$report->email_template_id = $emailtemplates->id;
			$report->email_campaign_id = $emailcampaigns->id;
			$report->contact_id = $email->contact_id;
			$report->send_date_time = date('Y-m-d H:i:s');
			$report->company_id=$operator['company_id'][0];
			$report->property_id=$operator['property_id'][0];
			$report->user_id=$operator['id'][0];
			//Send Email
			$smtpe = SMTPEmail::where('status','ACTIVE')->where('id', $request->smtpemail)->first();
			
			$mail             = new PHPMailer\PHPMailer(); // create a n
			$mail->SMTPDebug  = 2; // debugging: 1 = errors and messages, 2 = messages only
			$mail->SMTPAuth   = true; // authentication enabled
			$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
			$mail->Host       = $smtpe->host;
			$mail->Port       = $smtpe->port; // or 587
			$mail->IsHTML(true);
			$mail->Username = $smtpe->email; 
			$mail->Password = $smtpe->password;
			$mail->SetFrom($smtpe->email, 'Ensober');
			$mail->Subject = $emailtemplates->title." ".$email['co_name'];  
			$mail->Body    = $template;
			$mail->AddAddress($email['co_email'], $email['co_name']);
			
			
			if ($mail->Send()) {
				$report->send_status = 'SEND';
			} else {
				$report->send_status = 'UNSEND'; 
				$report->error_message = 'Error: '.$mail->ErrorInfo; 
				//dd($mail);
			}
			
			$report->save();
		}
        return back()->with('flash_success','Email Sended Successfully');;
    }
	
	
	/** 
     * Send bulk email form.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendBulkEmailActionTesting() 
    {
				
        $emailtemplates = EmailTemplat::where('status', 'ACTIVE')->where('id', 1)->first();
        $emailcampaigns = EmailCampaign::where('status', 'ACTIVE')->where('id', 7)->first();
		
		//$emails = explode(',',$emailcampaigns->contact_ids);
		$emails = EmailList::where('email_campaign_id', 8)->skip(0)->take(4)->get();
		
		foreach($emails as $email){
			$img = "/storage/app/".$emailtemplates->template;
			$template = '<table valign="top" width="100%" cellspacing="0" cellpadding="0" border="0" align="center">
  <tbody><tr>
    <td valign="top" align="center" style="padding: 100px 0 150px;border-collapse: collapse; background-color: rgb(22,22,22); background-image: url(/asset/images/icon/back_fal.gif);"><table style="width:700px;" width="700" cellspacing="0" cellpadding="0" border="0" align="center">
        
        <tbody><tr>
          <td style="padding:10px; border-top: 4px solid #9d6116; background-color: #eee;" valign="top" align="center">
			<table width="100%" cellspacing="0" cellpadding="0" border="0" align="center">
              <tbody>
			  <tr>
                <td style="font-family:Open Sans, Arial, sans-serif; font-size:12px; line-height:15px; color:#0d1121;" valign="top" align="center">ENSOBER ALL IN ONE ITINERARY TOUR | <a href="#" target="_blank" style="color:#0d1121; text-decoration:underline;">View Online</a></td>
              </tr>
            </tbody></table></td> 
        </tr>
		
        <tr>
          <td valign="top" align="center">
			
			<table width="100%" cellspacing="0" cellpadding="0" border="0" align="center" style="background-color: #ffffffdb;box-shadow: inset 0 0 9px 0 #9d6116; border-bottom: 3px solid #3a3333;">
              <tbody><tr>
				<td valign="top" align="left" style="padding: 0 15px;">
					<h2 style="font-family: Arial, sans-serif;margin: 21px 0 1px;font-size: 33px;color: #9d6116;">Ensober Hotels</h2>
					<p style="color: #978c25;font-size: 16px;font-weight: bold;">Ensober All In One Itinerary Tour...</p>
				</td>
                <td valign="top" align="center">
					<img alt="Ensober Logo" style="display:block;font-family:Arial, sans-serif;font-size:30px;line-height:34px;color:#000000;height: 79px;margin: 8px 0 15px;width: 125px;" src="/asset/images/logo/logo.png" border="0">
				</td>
              </tr>
            </tbody>
			</table>';
			
			$template .= '<table width="100%" cellspacing="0" cellpadding="0" border="0" align="center" style="background-color: #ffffffdb;"> 
              <tbody>
			  <tr>
				<td valign="top" align="center" style="padding: 25px 15px;">
					<img src="'.$img.'" style="max-width:700px;"/>
				</td>
			  </tr>
			  
            </tbody>
			</table>';
			
			$template .= '</td>
        </tr>
		
                 <tr>
          <td style="background-image: url(/asset/images/icon/nainital8.jpg);" valign="top" align="center"><table width="100%" cellspacing="0" cellpadding="0" border="0" align="center">
              <tbody><tr>
                <td style="padding: 35px 70px 0px; background-color: rgba(0,0,0,0.3); font-family:Open Sans, Arial, sans-serif; font-size:16px; line-height:30px; color:#ffffff;" valign="top" align="center">Ensober Hotels has its resorts, Corbett Panorama, Pine Crest & Devlok Primal in Uttarakhand.</td>
              </tr> 
              <tr>
                <td style="background-color: rgba(0,0,0,0.3); font-size:0px; line-height:0px; height:15px;" height="15">&nbsp;</td>
				
              </tr>
              <tr>
                <td style="background-color: rgba(0,0,0,0.3); font-family:Open Sans, Arial, sans-serif; font-size:18px; line-height:22px; color:#fbeb59; letter-spacing:2px;     padding: 35px 70px 30px;" valign="top" align="center">Apart from our own hotels in Uttarakhand, Ensober Hotels has a list of finest partner hotels and resorts on key locations in Uttarakhand.</td>
              </tr>
			  
            </tbody></table></td>
        </tr>

        <tr>
          <td style="padding:38px 30px;border-bottom: 7px solid #9d6116; background-color: #eee;" valign="top" align="center"><table width="100%" cellspacing="0" cellpadding="0" border="0" align="center">
              <tbody><tr>
                <td style="padding-bottom:16px;" valign="top" align="center"><table cellspacing="0" cellpadding="0" border="0" align="center">
                    <tbody><tr>
                      <td valign="top" align="center"><a href="#" target="_blank" style="text-decoration:none;"><img src="/asset/images/icon/f.png" alt="fb" style="display:block; font-family:Arial, sans-serif; font-size:14px; line-height:14px; color:#ffffff; max-width:26px;" width="26" border="0" height="26"></a></td>
                      <td style="width:6px;" width="6">&nbsp;</td>
                      <td valign="top" align="center"><a href="#" target="_blank" style="text-decoration:none;"><img src="/asset/images/icon/t.png" alt="tw" style="display:block; font-family:Arial, sans-serif; font-size:14px; line-height:14px; color:#ffffff; max-width:27px;" width="27" border="0" height="26"></a></td>
                      <td style="width:6px;" width="6">&nbsp;</td>
                      <td valign="top" align="center"><a href="#" target="_blank" style="text-decoration:none;"><img src="/asset/images/icon/g.jpg" alt="yt" style="display:block; font-family:Arial, sans-serif; font-size:14px; line-height:14px; color:#ffffff; max-width:26px;" width="26" border="0" height="26"></a></td>
                    </tr> 
                  </tbody></table></td> 
              </tr>
              <tr>
                <td style="font-family:Open Sans, Arial, sans-serif; font-size:11px; line-height:18px; color:#999999;" valign="top" align="center"><a href="#" target="_blank" style="color:#999999; text-decoration:underline;">T & C</a> | <a href="#" target="_blank" style="color:#999999; text-decoration:underline;">Privacy Policy</a> | <a href="#" target="_blank" style="color:#999999; text-decoration:underline;">Refund Policy</a><br>
                  © 2019 Ensober . All Rights Reserved .<br>
                  Ensober Hotels has its resorts, Corbett Panorama, Pine Crest & Devlok Primal in Uttarakhand.</td>
              </tr>
            </tbody></table></td> 
        </tr>
        <tr>
          <td style="line-height:1px;min-width:700px;background-color:#ffffff;"><img alt="" src="images/spacer.gif" style="max-height:1px; min-height:1px; display:block; width:700px; min-width:700px;" width="700" border="0" height="1"></td>
        </tr>
      </tbody></td>
  </tr>
</tbody></table>';


			//$contact = Contacts::where('id',$email)->first();
			
			
			//Send Email
			$smtpe = SMTPEmail::where('status','ACTIVE')->where('id', 2)->first();
			
			$mail             = new PHPMailer\PHPMailer(); // create a n
			$mail->SMTPDebug  = 1; // debugging: 1 = errors and messages, 2 = messages only
			$mail->SMTPAuth   = true; // authentication enabled
			$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
			$mail->Host       = $smtpe->host;
			$mail->Port       = $smtpe->port; // or 587
			$mail->IsHTML(true);
			$mail->Username = $smtpe->email; 
			$mail->Password = $smtpe->password;
			$mail->SetFrom($smtpe->email, 'Ensober');
			$mail->Subject = $emailtemplates->title;  
			$mail->Body    = $template;
			$mail->AddAddress($email->co_email, $email->co_name);
			
			if ($mail->Send()) {
				$report[$email->co_email] = 'SEND';
			} else {
				$report[$email->co_email] = 'UNSEND'; 
			}
			
			
			//$report->save();
		}
        //return back()->with('flash_success','Email Sended Successfully');;
    }
	
	
	/** 
     * Bulk email report
     *
     * @return \Illuminate\Http\Response
     */
    public function bulkEmailReport()
    {
    	$operator=session()->get('operator');
		$operator_id = session()->get('operator.id'); 
		$operator_name = session()->get('operator.name');
		// Bulk email send report
		$sendreports = BulkEmailSend::where('operator_id', $operator['id'][0])->where('company_id', $operator['company_id'][0])->where('property_id', $operator['property_id'][0])->with('EmailCampaign')->with('EmailTemplat')->with('BulkEmailSendReport')->orderBy('id' , 'desc')->get();
		
        return view('operator.bulkemailreport', compact('sendreports','operator_name'));
    }
	
	/** 
     * Display a listing of the Past Followup.
     *
     * @return \Illuminate\Http\Response
     */
    public function pastContactFollowup()
    {
          $operator_id = session()->get('operator.id'); 
		  $operator_name = str_replace(' ','_', session()->get('operator.name'));  
          $AssignContacts = AssignContacts::where('operator_id', $operator_id[0])->where('status','ACTIVE')->where('follow_up', 'DONE')->whereDate('follow_up_date', '<', date('Y-m-d'))->orderBy('id' , 'desc')->with('followUpComment')->get();
		  
		  // New Follow Up Count
		  $newcount = AssignContacts::where('operator_id', $operator_id[0])->where('status','ACTIVE')->where('follow_up', 'NOTDONE')->count();
		  
		  // Past Follow Up Count
		  $pastcount = AssignContacts::where('operator_id', $operator_id[0])->where('status','ACTIVE')->where('follow_up', 'DONE')->whereDate('follow_up_date', '<', date('Y-m-d'))->count();
		  
		  // Today Follow Up Count
		  $todaycount = AssignContacts::where('operator_id', $operator_id[0])->where('status','ACTIVE')->where('follow_up', 'DONE')->whereDate('follow_up_date', '=', date('Y-m-d'))->count();
		  
		  // Future Follow Up Count
		  $futurecount = AssignContacts::where('operator_id', $operator_id[0])->where('status','ACTIVE')->where('follow_up', 'DONE')->whereDate('follow_up_date', '>', date('Y-m-d'))->count();
          
        return view('operator.contactfollowup.index', compact('AssignContacts','operator_id', 'newcount', 'pastcount', 'todaycount', 'futurecount','operator_name'));
    } 
	
	
	/** 
     * Display a listing of the Past Followup only for mobile.
     *
     * @return \Illuminate\Http\Response
     */
    public function pastContactFollowupMobile()
    {
          $operator_id = session()->get('operator.id'); 
		  $operator_name = str_replace(' ','_', session()->get('operator.name'));  
          $AssignContacts = AssignContacts::where('operator_id', $operator_id[0])->where('status','ACTIVE')->where('follow_up', 'DONE')->whereDate('follow_up_date', '<', date('Y-m-d'))->orderBy('id' , 'desc')->with('followUpComment')->get();
		  
		  // New Follow Up Count
		  $newcount = AssignContacts::where('operator_id', $operator_id[0])->where('status','ACTIVE')->where('follow_up', 'NOTDONE')->count();
		  
		  // Past Follow Up Count
		  $pastcount = AssignContacts::where('operator_id', $operator_id[0])->where('status','ACTIVE')->where('follow_up', 'DONE')->whereDate('follow_up_date', '<', date('Y-m-d'))->count();
		  
		  // Today Follow Up Count
		  $todaycount = AssignContacts::where('operator_id', $operator_id[0])->where('status','ACTIVE')->where('follow_up', 'DONE')->whereDate('follow_up_date', '=', date('Y-m-d'))->count();
		  
		  // Future Follow Up Count
		  $futurecount = AssignContacts::where('operator_id', $operator_id[0])->where('status','ACTIVE')->where('follow_up', 'DONE')->whereDate('follow_up_date', '>', date('Y-m-d'))->count();
          
        return view('operator.contactfollowup.mobile', compact('AssignContacts','operator_id', 'newcount', 'pastcount', 'todaycount', 'futurecount','operator_name'));
    } 
	
	/** 
     * Display a listing of the Today Followup.
     *
     * @return \Illuminate\Http\Response
     */
    public function todayContactFollowup()
    {
          $operator_id = session()->get('operator.id');
		$operator_name = str_replace(' ','_', session()->get('operator.name'));  		  
          $AssignContacts = AssignContacts::where('operator_id', $operator_id[0])->where('status','ACTIVE')->where('follow_up', 'DONE')->whereDate('follow_up_date', '=', date('Y-m-d'))->orderBy('id' , 'desc')->get();
		  
		  // New Follow Up Count
		  $newcount = AssignContacts::where('operator_id', $operator_id[0])->where('status','ACTIVE')->where('follow_up', 'NOTDONE')->count();
		  
		  // Past Follow Up Count
		  $pastcount = AssignContacts::where('operator_id', $operator_id[0])->where('status','ACTIVE')->where('follow_up', 'DONE')->whereDate('follow_up_date', '<', date('Y-m-d'))->count();
		  
		  // Today Follow Up Count
		  $todaycount = AssignContacts::where('operator_id', $operator_id[0])->where('status','ACTIVE')->where('follow_up', 'DONE')->whereDate('follow_up_date', '=', date('Y-m-d'))->count();
		  
		  // Future Follow Up Count
		  $futurecount = AssignContacts::where('operator_id', $operator_id[0])->where('status','ACTIVE')->where('follow_up', 'DONE')->whereDate('follow_up_date', '>', date('Y-m-d'))->count();
          
        return view('operator.contactfollowup.index', compact('AssignContacts','operator_id', 'newcount', 'pastcount', 'todaycount', 'futurecount','operator_name'));
    } 
	
	
	/** 
     * Display a listing of the Today Followup only for mobile.
     *
     * @return \Illuminate\Http\Response
     */
    public function todayContactFollowupMobile()
    {
          $operator_id = session()->get('operator.id');
		$operator_name = str_replace(' ','_', session()->get('operator.name'));  		  
          $AssignContacts = AssignContacts::where('operator_id', $operator_id[0])->where('status','ACTIVE')->where('follow_up', 'DONE')->whereDate('follow_up_date', '=', date('Y-m-d'))->orderBy('id' , 'desc')->get();
		  
		  // New Follow Up Count
		  $newcount = AssignContacts::where('operator_id', $operator_id[0])->where('status','ACTIVE')->where('follow_up', 'NOTDONE')->count();
		  
		  // Past Follow Up Count
		  $pastcount = AssignContacts::where('operator_id', $operator_id[0])->where('status','ACTIVE')->where('follow_up', 'DONE')->whereDate('follow_up_date', '<', date('Y-m-d'))->count();
		  
		  // Today Follow Up Count
		  $todaycount = AssignContacts::where('operator_id', $operator_id[0])->where('status','ACTIVE')->where('follow_up', 'DONE')->whereDate('follow_up_date', '=', date('Y-m-d'))->count();
		  
		  // Future Follow Up Count
		  $futurecount = AssignContacts::where('operator_id', $operator_id[0])->where('status','ACTIVE')->where('follow_up', 'DONE')->whereDate('follow_up_date', '>', date('Y-m-d'))->count();
          
        return view('operator.contactfollowup.mobile', compact('AssignContacts','operator_id', 'newcount', 'pastcount', 'todaycount', 'futurecount','operator_name'));
    }
	
	
	/** 
     * Display a listing of the Future Followup.
     *
     * @return \Illuminate\Http\Response
     */
    public function futureContactFollowup()
    {
          $operator_id = session()->get('operator.id'); 
		  $operator_name = str_replace(' ','_', session()->get('operator.name'));   
          $AssignContacts = AssignContacts::where('operator_id', $operator_id[0])->where('status','ACTIVE')->where('follow_up', 'DONE')->whereDate('follow_up_date', '>', date('Y-m-d'))->orderBy('id' , 'desc')->get();
		  
		  // New Follow Up Count
		  $newcount = AssignContacts::where('operator_id', $operator_id[0])->where('status','ACTIVE')->where('follow_up', 'NOTDONE')->count();
		  
		  // Past Follow Up Count
		  $pastcount = AssignContacts::where('operator_id', $operator_id[0])->where('status','ACTIVE')->where('follow_up', 'DONE')->whereDate('follow_up_date', '<', date('Y-m-d'))->count();
		  
		  // Today Follow Up Count
		  $todaycount = AssignContacts::where('operator_id', $operator_id[0])->where('status','ACTIVE')->where('follow_up', 'DONE')->whereDate('follow_up_date', '=', date('Y-m-d'))->count();
		  
		  // Future Follow Up Count
		  $futurecount = AssignContacts::where('operator_id', $operator_id[0])->where('status','ACTIVE')->where('follow_up', 'DONE')->whereDate('follow_up_date', '>', date('Y-m-d'))->count();
          
        return view('operator.contactfollowup.index', compact('AssignContacts','operator_id', 'newcount', 'pastcount', 'todaycount', 'futurecount','operator_name'));
    }
	
	
	/** 
     * Display a listing of the Future Followup only for mobile.
     *
     * @return \Illuminate\Http\Response
     */
    public function futureContactFollowupMobile()
    {
          $operator_id = session()->get('operator.id'); 
		  $operator_name = str_replace(' ','_', session()->get('operator.name'));   
          $AssignContacts = AssignContacts::where('operator_id', $operator_id[0])->where('status','ACTIVE')->where('follow_up', 'DONE')->whereDate('follow_up_date', '>', date('Y-m-d'))->orderBy('id' , 'desc')->get();
		  
		  // New Follow Up Count
		  $newcount = AssignContacts::where('operator_id', $operator_id[0])->where('status','ACTIVE')->where('follow_up', 'NOTDONE')->count();
		  
		  // Past Follow Up Count
		  $pastcount = AssignContacts::where('operator_id', $operator_id[0])->where('status','ACTIVE')->where('follow_up', 'DONE')->whereDate('follow_up_date', '<', date('Y-m-d'))->count();
		  
		  // Today Follow Up Count
		  $todaycount = AssignContacts::where('operator_id', $operator_id[0])->where('status','ACTIVE')->where('follow_up', 'DONE')->whereDate('follow_up_date', '=', date('Y-m-d'))->count();
		  
		  // Future Follow Up Count
		  $futurecount = AssignContacts::where('operator_id', $operator_id[0])->where('status','ACTIVE')->where('follow_up', 'DONE')->whereDate('follow_up_date', '>', date('Y-m-d'))->count();
          
        return view('operator.contactfollowup.mobile', compact('AssignContacts','operator_id', 'newcount', 'pastcount', 'todaycount', 'futurecount','operator_name'));
    }
	
	/** 
     * Display a listing of the Future Followup.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendEmail($id)
    {
		$operator_id = session()->get('operator.id'); 
		$operator_name = str_replace(' ','_', session()->get('operator.name')); 
		DB::enableQueryLog();
		$SMTPEmails = SMTPEmail::where('status','ACTIVE')->get();
		$Hotels = Hotel::where('status','ACTIVE')->get();
		$contact = AssignContacts::where('operator_id', $operator_id[0])->where('status','ACTIVE')->where('id', $id)->first();
		//return DB::getQueryLog();
		//return $contact;
        return view('operator.contactfollowup.mail', compact('contact','SMTPEmails','Hotels'));
    }
	
	/** 
     * Display a listing of hotel and send the rate of hotels.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendHotelRateByCardPic(){
		$Hotels = Hotel::where('status','ACTIVE')->get();
		$cards = VisitingCard::All();
        return view('operator.scancard', compact('Hotels','cards'));
    }
	
	
	/** 
     * Display a listing of the Future Followup.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAllEmails()
    {
		          $operator_id = session()->get('operator'); 
		$operator_name = session()->get('operator.name'); 
		$emails = EmailHistory::where('company_id',$operator_id['company_id'][0])->where('property_id',$operator_id['property_id'][0])->where('user_id',$operator_id['id'][0])->get();
		
        return view('operator.contactfollowup.emailhistory', compact('operator_name','emails'));
    } 
	
	/** 
     * Display send quotation history.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAllSendQuotation(){
    	$operator= session()->get('operator'); 
		$operator_id = session()->get('operator.id'); 
		$operator_name = session()->get('operator.name'); 
		$sendquotations = SendQuotation::where('company_id',$operator['company_id'][0])->where('property_id',$operator['property_id'][0])->where('user_id',$operator['id'][0])->orderBy('id','DESC')->paginate(10);
		
        return view('operator.contactfollowup.sendquotationhistory', compact('sendquotations'));
    } 
	
	public function getTemplate($id)
    {
		$operator_id = session()->get('operator.id'); 
		$operator_name = session()->get('operator.name'); 
		$email = EmailHistory::where('id',$id)->where('operator_id', $operator_id[0])->first();
		
        return view('operator.contactfollowup.template', compact('email'));
    } 
	
	public function smtpSendEmail(Request $request){
		$this->validate($request, [
			'from' => 'required',
			'to' => 'required',
			'subject' => 'required',
		]);
		// Save attachment
		if($request->HasFile('attachment')){
			$path = $request->file('attachment')->store('email_template');
		}else{
			$path = '';
		}
		$smtpe = SMTPEmail::where('status','ACTIVE')->where('id', $request->from)->first();
		$text             = $request->message; 
        $mail             = new PHPMailer\PHPMailer(); // create a n
        $mail->SMTPDebug  = 1; // debugging: 1 = errors and messages, 2 = messages only
        $mail->SMTPAuth   = true; // authentication enabled
        $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
        $mail->Host       = $smtpe->host;
        $mail->Port       = $smtpe->port; // or 587
        $mail->IsHTML(true);
        $mail->Username = $smtpe->email; 
        $mail->Password = $smtpe->password;
        $mail->SetFrom($smtpe->email, 'Ensober');
        $mail->Subject = $request->subject;
        $mail->Body    = $text;
        $mail->AddAddress($request->to, $request->name);
		if($request->cc){
			$mail->AddAddress($request->cc);
		}
		if($path != ''){
			$mail->addAttachment('storage/app/'.$path);
		}
        if ($mail->Send()) {
			$operator_id = $request->session()->get('operator.id'); 
			$EmailHistory = new EmailHistory();
			$EmailHistory->operator_id = $operator_id[0];
			$EmailHistory->from = $smtpe->email;
			$EmailHistory->to = $request->to;
			$EmailHistory->cc	 = $request->cc;
			$EmailHistory->to_name	 = $request->name;
			$EmailHistory->subject	 = $request->subject;
			$EmailHistory->hotel_id	 = $request->hotel_id;
			$EmailHistory->template	 = $text;
			$EmailHistory->send_date	 = date('Y-m-d');
			$EmailHistory->send_time	 = date('H:i:m');
			$EmailHistory->save();
			
			return back()->with('flash_success','Email Sended Successfully');
        } else {
			return back()->with('flash_error', 'Failed to Send Email');
        }
	}
	
	public function makeItinerary(){
		$cities = City::select('hotels.*','cities.id as city_id','cities.name as name')->join('hotels', 'cities.id', '=', 'hotels.city_id')->get();
		$transports = Transport::orderBy('id' , 'desc')->with('car')->with('venderName')->with('car_segment')->with('car_model')->with('car_seats')->with('countryName')->with('stateName')->with('cityName')->get();
		return view('operator/makeitinerary', compact('cities','transports'));
	}
	
	
	// Save visiting card
	public function saveVisitingCard(Request $request){
		//dd($request->all());
		$path = $request->file('image')->store('visiting_cards');
		$image = storage_path('app/'.$path);
		$data_text = $this->convertImageToText($image);
		//$data_text = $this->convertImageToTextByGoggle($image);
		
		/* $data_text = ["text" => "Virendra Tower, Ilnd Floor Near CTS Bus Stand, Amit Khandelwal +91 9928232324 Deals in : House, Factory, Farm House, Flats Sanganer, Jaipur, Tel. : 0141-3101702 Email : info@sribalajiconstruction.com — Shri Balaji Construction (6 +91 7891919632 ",
		"email" =>  [
			"sarwanmawai@gmail.com"
		],
		"mobile" => [
			"9928232324"
		]]; */
		
		$SMTPMail = new SMTPMail();
		$template = $SMTPMail->generateTemplate($request);
		
		$VisitingCard = new VisitingCard();
		$VisitingCard->raw_text = $data_text['text'];
		$VisitingCard->email = $data_text['email'][0];
		$VisitingCard->mobile = $data_text['mobile'][0];
		$VisitingCard->card = $path;
		$VisitingCard->save();
		$res = $this->send($template, $request->subject, 'Sales@ensoberhotels.com', $data_text['email'][0]);
		return back()->with('flash_success','Email Sended Successfully');
	}
	
	// Convert image to text
	function convertImageToTextByGoggle($path){
		$path = public_path('/google_config.json');
		
		putenv("GOOGLE_APPLICATION_CREDENTIALS=$path");
		$imageAnnotator = new ImageAnnotatorClient();

		# annotate the image
		$response = $imageAnnotator->faceDetection($path);
		
		$faces = $response->getFaceAnnotations();

		# names of likelihood from google.cloud.vision.enums
		$likelihoodName = ['UNKNOWN', 'VERY_UNLIKELY', 'UNLIKELY',
		'POSSIBLE', 'LIKELY', 'VERY_LIKELY'];

		printf('%d faces found:' . PHP_EOL, count($faces));
		foreach ($faces as $face) {
			$anger = $face->getAngerLikelihood();
			printf('Anger: %s' . PHP_EOL, $likelihoodName[$anger]);

			$joy = $face->getJoyLikelihood();
			printf('Joy: %s' . PHP_EOL, $likelihoodName[$joy]);

			$surprise = $face->getSurpriseLikelihood();
			printf('Surprise: %s' . PHP_EOL, $likelihoodName[$surprise]);

			# get bounds
			$vertices = $face->getBoundingPoly()->getVertices();
			$bounds = [];
			foreach ($vertices as $vertex) {
				$bounds[] = sprintf('(%d,%d)', $vertex->getX(), $vertex->getY());
			}
			print('Bounds: ' . join(', ', $bounds) . PHP_EOL);
			print(PHP_EOL);
		}

		$imageAnnotator->close();
	}
	
	
	// Convert image to text
	public function convertImageToText($image){
		// Provide your user name and license code
        $license_code = '2D35ED8A-7906-49CD-AD29-73131E7E2C0E';
        $username =  'sarwanverma';
		
		
        // Extraction text with English language
        $url = 'http://www.ocrwebservice.com/restservices/processDocument?gettext=true';

        // Full path to uploaded document
        $filePath = $image;
	
        $fp = fopen($filePath, 'r');
		
        $session = curl_init();

        curl_setopt($session, CURLOPT_URL, $url);
        curl_setopt($session, CURLOPT_USERPWD, "$username:$license_code");

        curl_setopt($session, CURLOPT_UPLOAD, true);
        curl_setopt($session, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($session, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($session, CURLOPT_TIMEOUT, 200);
        curl_setopt($session, CURLOPT_HEADER, false);
        curl_setopt($session, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
 
        curl_setopt($session, CURLOPT_INFILE, $fp);
        curl_setopt($session, CURLOPT_INFILESIZE, filesize($filePath));

        $result = curl_exec($session);

		$httpCode = curl_getinfo($session, CURLINFO_HTTP_CODE);
        curl_close($session);
        fclose($fp);
	
        if($httpCode == 401){
           // Please provide valid username and license code
           die('Unauthorized request');
        }

        // Output response
		$data = json_decode($result);
		if($httpCode != 200){
			// OCR error
           die($data->ErrorMessage);
        }

		$text = $data->OCRText[0][0];

		// Mobile
		$pattern = "/\b\d{10}\b/";
		preg_match($pattern,$text, $match);
		$mobile = $match;
		
		// Email
		
		$pattern = '/[a-z0-9_\-\+\.]+@[a-z0-9\-]+\.([a-z]{2,4})(?:\.[a-z]{2})?/i';
		preg_match_all($pattern, $text, $matches);
		$email = $matches[0];
		
		$result = array('text' => $text, 'email' => $email, 'mobile' => $mobile);
		return $result;
		
	}
	
	/**
     * This function use for get the all orders
     *
     * @return $response
     */     
    public function getAllOrders(){ 
		
        try {
            $orders = WebsiteOrder::groupBy('order_id')->with('orderpayment')->orderBy('id', 'DESC')->paginate(10);
			
			return view('operator.websites_orders', compact('orders'));
        }catch(Exception $e) {
            return response()->json(['status' => 0, 'error' => 1, 'msg' => $e->getMessage(), 'data' => '']);
        }
    }
	
	/**
     * This function use for update order
     *
     * @return $response
     */     
    public function cancelOrders(Request $request){
        try {
            $orders = WebsiteOrder::where('order_id', $request->order_id)->update(['status' => 'canceled']);
			
			return back()->with('flash_success', $request->order_id.' Order Canceled Successfully!');
        }catch(Exception $e) {
            return response()->json(['status' => 0, 'error' => 1, 'msg' => $e->getMessage(), 'data' => '']);
        }
    }
	
	/**
     * This function use for update the order status checkin after check the checkin date
     *
     * @return $response
     */     
    public function setCheckinStatus(){
        try {
            $orders = SendQuotation::where('quotation_type', 'voucher')->whereDate('checkin', '=', date('Y-m-d', strtotime("+1 day")))->update(['checkin_checkout_status' => 'checkin']);
			return 'Order status change Successfully!';
        }catch(Exception $e) {
            return response()->json(['status' => 0, 'error' => 1, 'msg' => $e->getMessage(), 'data' => '']);
        }
    }
	
	/**
     * This function use for update the order status checkout after checkout the hotel
     *
     * @return $response
     */     
    public function setCheckoutStatus(){
        try {
            $orders = SendQuotation::where('quotation_type', 'voucher')->whereDate('checkout', '=', date('Y-m-d', strtotime("-1 day")))->update(['checkin_checkout_status' => 'checkout']);
			return 'Order status change Successfully!';
        }catch(Exception $e) {
            return response()->json(['status' => 0, 'error' => 1, 'msg' => $e->getMessage(), 'data' => '']);
        }
    }
	
	/**
     * This function use for get the all checkin orders
     *
     * @return $response
     */     
    public function getCheckinOrders(){ 
		
        try {
            $orders = SendQuotation::where('checkin_checkout_status', 'checkin')->whereDate('checkin', '=', date('Y-m-d', strtotime("+1 day")))->with('orderpayment')->orderBy('id', 'DESC')->paginate(10);
			
			return view('operator.checkin_orders', compact('orders'));
        }catch(Exception $e) {
            return response()->json(['status' => 0, 'error' => 1, 'msg' => $e->getMessage(), 'data' => '']);
        }
    }
	
	/**
     * This function use for get the all checkin orders hotel wise
     *
     * @return $response
     */     
    public function getCheckinHotelOrders(Request $request){
        try {
			$hotels = Hotel::where('status', 'ACTIVE')->get();
			$operator_id = session()->get('operator.id');
			$operator = Operator::where('id', $operator_id)->first();
            $hotel_id = session()->get('operator.hotel');
			$hotel_name = '';
			if($hotel_id > 0){
				$hotel_name = $this->getHotelDetailsByIdWithFullInfo(@$hotel_id[0])->hotel_name;
				$orders = SendQuotation::where('hotel_id', $hotel_id)->where('checkin_checkout_status', 'checkin')->whereDate('checkin', '=', date('Y-m-d', strtotime("+1 day")))->with('orderpayment')->orderBy('id', 'DESC')->get();
				return view('operator.checkin_hotel_orders', compact('orders','hotels','hotel_name'));
			}
			
			if($request->has('hotel_id') && $request->hotel_id != ''){
				$orders = SendQuotation::where('hotel_id', $request->hotel_id)->where('checkin_checkout_status', 'checkin')->whereDate('checkin', '=', date('Y-m-d', strtotime("+1 day")))->with('orderpayment')->orderBy('id', 'DESC')->get();
			}else{
				$orders = SendQuotation::where('checkin_checkout_status', 'checkin')->whereDate('checkin', '=', date('Y-m-d', strtotime("+1 day")))->with('orderpayment')->orderBy('id', 'DESC')->get();
			}
			
			return view('operator.checkin_hotel_orders', compact('orders','hotels'));
        }catch(Exception $e) {
            return response()->json(['status' => 0, 'error' => 1, 'msg' => $e->getMessage(), 'data' => '']);
        }
    }
	
	/**
     * This function use for get the all checkout orders
     *
     * @return $response
     */     
    public function getCheckoutOrders(){ 
        try {
            $orders = SendQuotation::where('checkin_checkout_status', 'checkout')->whereDate('checkout', '=', date('Y-m-d', strtotime("-1 day")))->with('orderpayment')->orderBy('id', 'DESC')->paginate(10);
			return view('operator.checkout_orders', compact('orders'));
        }catch(Exception $e) {
            return response()->json(['status' => 0, 'error' => 1, 'msg' => $e->getMessage(), 'data' => '']);
        }
    }
	
	/**
     * This function use for get the all checkout orders hotel wise
     *
     * @return $response
     */     
    public function getCheckoutHotelOrders(Request $request){ 
        try {
			$hotels = Hotel::where('status', 'ACTIVE')->get();
			$operator_id = session()->get('operator.id');
			$operator = Operator::where('id', $operator_id)->first();
            $hotel_id = session()->get('operator.hotel');
			$hotel_name = '';
			if($hotel_id > 0){
				$hotel_name = $this->getHotelDetailsByIdWithFullInfo(@$hotel_id[0])->hotel_name;
				$orders = SendQuotation::where('hotel_id', $hotel_id)->where('checkin_checkout_status', 'checkout')->whereDate('checkout', '=', date('Y-m-d', strtotime("-1 day")))->with('orderpayment')->orderBy('id', 'DESC')->get();
				
				return view('operator.checkout_hotel_orders', compact('orders','hotels','hotel_name'));
			}
			
			if($request->has('hotel_id') && $request->hotel_id != ''){
				$orders = SendQuotation::where('hotel_id', $request->hotel_id)->where('checkin_checkout_status', 'checkout')->whereDate('checkout', '=', date('Y-m-d', strtotime("-1 day")))->with('orderpayment')->orderBy('id', 'DESC')->get();
			}else{
				$orders = SendQuotation::where('checkin_checkout_status', 'checkout')->whereDate('checkout', '=', date('Y-m-d', strtotime("-1 day")))->with('orderpayment')->orderBy('id', 'DESC')->get();
			}
			
            
			return view('operator.checkout_hotel_orders', compact('orders','hotels'));
        }catch(Exception $e) {
            return response()->json(['status' => 0, 'error' => 1, 'msg' => $e->getMessage(), 'data' => '']);
        }
    }
	
	/**
     * This function use for get the checkout orders for accept the account saction from hotel
     *
     * @return $response
     */     
    public function acceptHotelSideOrders($id){ 
        try {
            $orders = SendQuotation::where('send_quotation_no', $id)->with('orderpayment')->get();
			$closefrom = 'closed_f_vendor';
			return view('operator.accept_order', compact('orders','closefrom'));
        }catch(Exception $e) {
            return response()->json(['status' => 0, 'error' => 1, 'msg' => $e->getMessage(), 'data' => '']);
        }
    }
	
	/**
     * This function use for get the checkout orders for accept the account saction from owner
     *
     * @return $response
     */     
    public function acceptOwnerSideOrders($id){ 
        try {
            $orders = SendQuotation::where('send_quotation_no', $id)->with('orderpayment')->get();
			$closefrom = 'closed_f_owner';
			return view('operator.accept_order', compact('orders','closefrom'));
        }catch(Exception $e) {
            return response()->json(['status' => 0, 'error' => 1, 'msg' => $e->getMessage(), 'data' => '']);
        }
    }
	
	/**
     * This function use for update the order status closed
     *
     * @return $response
     */     
    public function setClosedStatus(Request $request){
        try {
            $orders = SendQuotation::where('quotation_type', 'voucher')->where('send_quotation_no',  $request->send_quotation_no)->update([$request->closedfrom => 1]);
			return back()->with('flash_success','Order Closed From Your Side Successfully');
        }catch(Exception $e) {
            return response()->json(['status' => 0, 'error' => 1, 'msg' => $e->getMessage(), 'data' => '']);
        }
    }
	
	/**
     * This function use for update the order status closed which is closed from both side
     *
     * @return $response
     */     
    public function checkAndClosedStatus(){
        try {
            $orders = SendQuotation::where('quotation_type', 'voucher')->where('closed_f_owner',  1)->where('closed_f_vendor', 1)->get();
			foreach($orders as $order){
				$order->checkin_checkout_status = 'closed';
				$order->save();
			}
			return 'Order Closed Successfully';
        }catch(Exception $e) {
            return response()->json(['status' => 0, 'error' => 1, 'msg' => $e->getMessage(), 'data' => '']);
        }
    }
	
	/**
     * This function use for send checkin orders to hotel
     *
     * @return $response
     */     
    public function sendCheckinOrdersToHotel(){
		
        try {
            $hotels = Hotel::where('status', 'ACTIVE')->get();
			foreach($hotels as $hotel){
				$quotations = DB::select( DB::raw("select * from `checkin_quotations` where `hotel_id` = $hotel->id"));
				
				if(count($quotations) <= 0){
					continue;
				}
				$message_admin = '<!DOCTYPE html>
							<html>
							<head>
							<style>
							table {
							  font-family: arial, sans-serif;
							  border-collapse: collapse;
							  width: 100%;
							}

							td, th {
							  border: 1px solid #555;
							  text-align: left;
							  padding: 8px;
							}

							tr:nth-child(even) {
							  background-color: #dddddd;
							}
							</style>
							</head>
							<body style="font-family: sans-serif;">
							<p>Dear Admin,</p>
							<br>
							<h2>Today CheckIn Orders</h2>

							<table>
							  <tr style="background-color: #183678; color: #fff;">
								<th>Quotation No</th>
								<th>Name</th>
								<th>Mobile</th>
								<th style="display:none;">Email</th>
								<th>Checkin</th>
								<th>Checkout</th>
								<th>Rooms</th>
								<th>Night</th>
								<th>Adult</th>
								<th>Kids</th>
								<th>Infant</th>
								<th>Cost</th>
								<th>Advance Received</th>
								<th>Agent Name</th>
							  </tr>';
							$cost_total = 0;
							$advance_total = 0;
							foreach($quotations as $quotation){
								$cost_total += $quotation->final_cost;
								$advance_total += $quotation->advance_received;
								$message_admin .= '<tr>
									<td>'.$quotation->send_quotation_no.'</td>
									<td>'.$quotation->name.'</td>
									<td>'.$quotation->mobile.'</td>
									<td style="display:none;">'.$quotation->email.'</td>
									<td>'.$quotation->checkin.'</td>
									<td>'.$quotation->checkout.'</td>
									<td>'.$quotation->rooms.'</td>
									<td>'.$quotation->night.'</td>
									<td>'.$quotation->adult.'</td>
									<td>'.$quotation->kids.'</td>
									<td>'.$quotation->infant.'</td>
									<td>'.$quotation->final_cost.'</td>
									<td>'.$quotation->advance_received.'</td>
									<td>'.$quotation->agent_name.'</td>
								</tr>';
							}
							$message_admin .= '<tr>
								<td colspan="9"></td>
								<td><b>Total:</b></td>
								<td>'.$cost_total.'</td>
								<td>'.$advance_total.'</td>
								<td></td>
							</tr>';	
							$message_admin .= '</table><h4 style="display:none; color:#041879;">Total Sale: '.number_format($cost_total,2).'</h4><h4 style="display:none; color:green;">Total Advance Received: '.number_format($advance_total,2).'</h4> 
											</body>
										</html>';
				$this->sendAdmin($message_admin, 'Today Checkin Orders - '.$hotel->hotel_name.' - '.date('d M y'), 'Sales@ensoberhotels.com');
				
				$this->send($message_admin, 'Today Checkin Orders - '.$hotel->hotel_name.' - '.date('d M y'), 'Sales@ensoberhotels.com', $hotel->contact_email);
				unset($message_admin);
			}
			return 'Successfully!';
			//return view('operator.checkout_orders', compact('orders'));
        }catch(Exception $e) {
            return response()->json(['status' => 0, 'error' => 1, 'msg' => $e->getMessage(), 'data' => '']);
        }
    }
	
	/**
     * This function use for send checkin orders to hotel
     *
     * @return $response
     */     
    public function sendCheckoutOrdersToHotel(){
		
        try {
            $hotels = Hotel::where('status', 'ACTIVE')->get();
			foreach($hotels as $hotel){
				$quotations = DB::select( DB::raw("select * from `checkout_quotations` where `hotel_id` = $hotel->id"));
				if(count($quotations) <= 0){
					continue;
				}
				
				// This template for hotel vendor
				$message_vendor = '<!DOCTYPE html>
							<html>
							<head>
							<style>
							table {
							  font-family: arial, sans-serif;
							  border-collapse: collapse;
							  width: 100%;
							}

							td, th {
							  border: 1px solid #555;
							  text-align: left;
							  padding: 8px;
							}

							tr:nth-child(even) {
							  background-color: #dddddd;
							}
							</style>
							</head>
							<body style="font-family: sans-serif;">
							<p>Dear Admin,</p>
							<br>
							<h2>Yesterday CheckOut Orders For <span style="color:#d93025;">'.$hotel->hotel_name.'</span> </h2>

							<table>
							  <tr style="background-color: #183678; color: #fff;">
								<th>Quotation No</th>
								<th>Name</th>
								<th style="display:none;">Mobile</th>
								<th style="display:none;">Email</th>
								<th>Checkin</th>
								<th>Checkout</th>
								<th>Rooms</th>
								<th>Night</th>
								<th>Adult</th>
								<th>Kids</th>
								<th>Infant</th>
								<th>Cost</th>
								<th>Advance Received</th>
								<th>Agent Name</th>
								<th>Action</th>
							  </tr>';
							$cost_total = 0;
							$advance_total = 0;
							foreach($quotations as $quotation){
								$cost_total += (int)$quotation->final_cost;
								$advance_total += (int)$quotation->advance_received;
								$message_vendor .= '<tr>
									<td>'.$quotation->send_quotation_no.'</td>
									<td>'.$quotation->name.'</td>
									<td style="display:none;">'.$quotation->mobile.'</td>
									<td style="display:none;">'.$quotation->email.'</td>
									<td>'.$quotation->checkin.'</td>
									<td>'.$quotation->checkout.'</td>
									<td>'.$quotation->rooms.'</td>
									<td>'.$quotation->night.'</td>
									<td>'.$quotation->adult.'</td>
									<td>'.$quotation->kids.'</td>
									<td>'.$quotation->infant.'</td>
									<td>'.$quotation->final_cost.'</td>
									<td>'.$quotation->advance_received.'</td>
									<td>'.$quotation->agent_name.'</td>
									<td><a href="'.url('operator/acceptorder/'.$quotation->send_quotation_no).'" target="_blank"><button>Aprove</button></a></td>
								</tr>';
							}
							$message_vendor .= '<tr>
								<td colspan="10"></td>
								<td><b>Total:</b></td>
								<td>'.$cost_total.'</td>
								<td>'.$advance_total.'</td>
								<td colspan="2"></td>
							</tr>';	
							$message_vendor .= '</table><h4 style="display:none; color:#041879;">Total Sale: '.number_format($cost_total,2).'</h4><h4 style="display:none; color:green;">Total Advance Received: '.number_format($advance_total,2).'</h4> 
											</body>
										</html>';
										
				// This template for hotel owner
				$message_admin = '<!DOCTYPE html>
							<html>
							<head>
							<style>
							table {
							  font-family: arial, sans-serif;
							  border-collapse: collapse;
							  width: 100%;
							}

							td, th {
							  border: 1px solid #555;
							  text-align: left;
							  padding: 8px;
							}

							tr:nth-child(even) {
							  background-color: #dddddd;
							}
							</style>
							</head>
							<body style="font-family: sans-serif;">
							<p>Dear Admin,</p>
							<br>
							<h2>Yesterday CheckOut Orders For <span style="color:#d93025;">'.$hotel->hotel_name.'</span> </h2>

							<table>
							  <tr style="background-color: #183678; color: #fff;">
								<th>Quotation No</th>
								<th>Name</th>
								<th>Mobile</th>
								<th>Email</th>
								<th>Checkin</th>
								<th>Checkout</th>
								<th>Rooms</th>
								<th>Night</th>
								<th>Adult</th>
								<th>Kids</th>
								<th>Infant</th>
								<th>Cost</th>
								<th>Advance Received</th>
								<th>Agent Name</th>
								<th>Action</th>
							  </tr>';
							$cost_total = 0;
							$advance_total = 0;
							foreach($quotations as $quotation){
								$cost_total += (int)$quotation->final_cost;
								$advance_total += (int)$quotation->advance_received;
								$message_admin .= '<tr>
									<td>'.$quotation->send_quotation_no.'</td>
									<td>'.$quotation->name.'</td>
									<td>'.$quotation->mobile.'</td>
									<td>'.$quotation->email.'</td>
									<td>'.$quotation->checkin.'</td>
									<td>'.$quotation->checkout.'</td>
									<td>'.$quotation->rooms.'</td>
									<td>'.$quotation->night.'</td>
									<td>'.$quotation->adult.'</td>
									<td>'.$quotation->kids.'</td>
									<td>'.$quotation->infant.'</td>
									<td>'.$quotation->final_cost.'</td>
									<td>'.$quotation->advance_received.'</td>
									<td>'.$quotation->agent_name.'</td>
									<td><a href="'.url('operator/acceptorderfromowner/'.$quotation->send_quotation_no).'" target="_blank"><button>Aprove</button></a></td>
								</tr>';
							}
							$message_admin .= '<tr>
								<td colspan="10"></td>
								<td><b>Total:</b></td>
								<td>'.$cost_total.'</td>
								<td>'.$advance_total.'</td>
								<td colspan="2"></td>
							</tr>';	
							$message_admin .= '</table><h4 style="display:none; color:#041879;">Total Sale: '.number_format($cost_total,2).'</h4><h4 style="display:none; color:green;">Total Advance Received: '.number_format($advance_total,2).'</h4> 
											</body>
										</html>';
				$this->sendAdmin($message_admin, 'Yesterday Checkout Orders - '.$hotel->hotel_name.' - '.date('d M y'), 'Sales@ensoberhotels.com');
				
				$this->send($message_vendor, 'Yesterday CheckOut Orders - '.$hotel->hotel_name.' - '.date('d M y'), 'Sales@ensoberhotels.com', $hotel->contact_email);
				unset($message_vendor);
				unset($message_admin);
				
			}
			return 'Successfully!';
			//return view('operator.checkout_orders', compact('orders'));
        }catch(Exception $e) {
            return response()->json(['status' => 0, 'error' => 1, 'msg' => $e->getMessage(), 'data' => '']);
        }
    }
	
	/**
     * This function use for send unclosed orders Reminder to hotel
     *
     * @return $response
     */     
    public function sendUnclosedOrdersToHotel(){
		
        try {
            $hotels = Hotel::where('status', 'ACTIVE')->get();
			foreach($hotels as $hotel){
				$quotations = SendQuotation::where('quotation_type', 'voucher')->whereDate('checkout', '<=', date('Y-m-d', strtotime("-2 day")))->where('checkin_checkout_status', 'checkout')->where('hotel_id', $hotel->id)->get();
				//dd($quotations);
				if(count($quotations) <= 0){
					continue;
				}
				
				// This template for hotel vendor
				$message_vendor = '<!DOCTYPE html>
							<html>
							<head>
							<style>
							table {
							  font-family: arial, sans-serif;
							  border-collapse: collapse;
							  width: 100%;
							}

							td, th {
							  border: 1px solid #555;
							  text-align: left;
							  padding: 8px;
							}

							tr:nth-child(even) {
							  background-color: #dddddd;
							}
							</style>
							</head>
							<body style="font-family: sans-serif;">
							<p>Dear Admin,</p>
							<br>
							<h2>Pending Bookings Reminder For <span style="color:#d93025;">'.$hotel->hotel_name.'</span> </h2>

							<table>
							  <tr style="background-color: #183678; color: #fff;">
								<th>Quotation No</th>
								<th>Name</th>
								<th style="display:none;">Mobile</th>
								<th style="display:none;">Email</th>
								<th>Checkin</th>
								<th>Checkout</th>
								<th>Rooms</th>
								<th>Night</th>
								<th>Adult</th>
								<th>Kids</th>
								<th>Infant</th>
								<th>Cost</th>
								<th>Advance Received</th>
								<th>Agent Name</th>
								<th>Action</th>
							  </tr>';
							$cost_total = 0;
							$advance_total = 0;
							foreach($quotations as $quotation){
								$cost_total += (int)$quotation->final_cost;
								$advance_total += (int)$quotation->advance_received;
								$message_vendor .= '<tr>
									<td>'.$quotation->send_quotation_no.'</td>
									<td>'.$quotation->name.'</td>
									<td style="display:none;">'.$quotation->mobile.'</td>
									<td style="display:none;">'.$quotation->email.'</td>
									<td>'.$quotation->checkin.'</td>
									<td>'.$quotation->checkout.'</td>
									<td>'.$quotation->rooms.'</td>
									<td>'.$quotation->night.'</td>
									<td>'.$quotation->adult.'</td>
									<td>'.$quotation->kids.'</td>
									<td>'.$quotation->infant.'</td>
									<td>'.$quotation->final_cost.'</td>
									<td>'.$quotation->advance_received.'</td>
									<td>'.$quotation->agent_name.'</td>
									<td><a href="'.url('operator/acceptorder/'.$quotation->send_quotation_no).'" target="_blank"><button>Aprove</button></a></td>
								</tr>';
							}
							$message_vendor .= '<tr>
								<td colspan="10"></td>
								<td><b>Total:</b></td>
								<td>'.$cost_total.'</td>
								<td>'.$advance_total.'</td>
								<td colspan="2"></td>
							</tr>';	
							$message_vendor .= '</table><h4 style="display:none; color:#041879;">Total Sale: '.number_format($cost_total,2).'</h4><h4 style="display:none; color:green;">Total Advance Received: '.number_format($advance_total,2).'</h4> 
											</body>
										</html>';
										
				// This template for hotel owner
				$message_admin = '<!DOCTYPE html>
							<html>
							<head>
							<style>
							table {
							  font-family: arial, sans-serif;
							  border-collapse: collapse;
							  width: 100%;
							}

							td, th {
							  border: 1px solid #555;
							  text-align: left;
							  padding: 8px;
							}

							tr:nth-child(even) {
							  background-color: #dddddd;
							}
							</style>
							</head>
							<body style="font-family: sans-serif;">
							<p>Dear Admin,</p>
							<br>
							<h2>Pending Bookings Reminder For <span style="color:#d93025;">'.$hotel->hotel_name.'</span> </h2>

							<table>
							  <tr style="background-color: #183678; color: #fff;">
								<th>Quotation No</th>
								<th>Name</th>
								<th>Mobile</th>
								<th>Email</th>
								<th>Checkin</th>
								<th>Checkout</th>
								<th>Rooms</th>
								<th>Night</th>
								<th>Adult</th>
								<th>Kids</th>
								<th>Infant</th>
								<th>Cost</th>
								<th>Advance Received</th>
								<th>Agent Name</th>
								<th>Action</th>
							  </tr>';
							$cost_total = 0;
							$advance_total = 0;
							foreach($quotations as $quotation){
								$cost_total += (int)$quotation->final_cost;
								$advance_total += (int)$quotation->advance_received;
								$message_admin .= '<tr>
									<td>'.$quotation->send_quotation_no.'</td>
									<td>'.$quotation->name.'</td>
									<td>'.$quotation->mobile.'</td>
									<td>'.$quotation->email.'</td>
									<td>'.$quotation->checkin.'</td>
									<td>'.$quotation->checkout.'</td>
									<td>'.$quotation->rooms.'</td>
									<td>'.$quotation->night.'</td>
									<td>'.$quotation->adult.'</td>
									<td>'.$quotation->kids.'</td>
									<td>'.$quotation->infant.'</td>
									<td>'.$quotation->final_cost.'</td>
									<td>'.$quotation->advance_received.'</td>
									<td>'.$quotation->agent_name.'</td>
									<td><a href="'.url('operator/acceptorderfromowner/'.$quotation->send_quotation_no).'" target="_blank"><button>Aprove</button></a></td>
								</tr>';
							}
							$message_admin .= '<tr>
								<td colspan="10"></td>
								<td><b>Total:</b></td>
								<td>'.$cost_total.'</td>
								<td>'.$advance_total.'</td>
								<td colspan="2"></td>
							</tr>';	
							$message_admin .= '</table><h4 style="display:none; color:#041879;">Total Sale: '.number_format($cost_total,2).'</h4><h4 style="display:none; color:green;">Total Advance Received: '.number_format($advance_total,2).'</h4> 
											</body>
										</html>';
				
				
				
				
				$this->sendAdmin($message_vendor, 'Pending Bookings Reminder - '.$hotel->hotel_name.' - '.date('d M y'), 'Sales@ensoberhotels.com');
				
				$this->send($message_admin, 'Pending Bookings Reminder - '.$hotel->hotel_name.' - '.date('d M y'), 'Sales@ensoberhotels.com', $hotel->contact_email); 
				
				unset($message_vendor);
				unset($message_admin);
				
			}
			return 'Successfully!';
			//return view('operator.checkout_orders', compact('orders'));
        }catch(Exception $e) {
            return response()->json(['status' => 0, 'error' => 1, 'msg' => $e->getMessage(), 'data' => '']);
        }
    }
	
	/**
     * This function use for get the all checkout orders
     *
     * @return $response
     */     
    public function getClosedOrders(){ 
		
        try {
            $orders = SendQuotation::where('checkin_checkout_status', 'closed')->with('orderpayment')->orderBy('id', 'DESC')->paginate(10);
			
			return view('operator.closed_orders', compact('orders'));
        }catch(Exception $e) {
            return response()->json(['status' => 0, 'error' => 1, 'msg' => $e->getMessage(), 'data' => '']);
        }
    }
	
	/**
     * This function use for get the all checkout orders hotel wise
     *
     * @return $response
     */     
    public function getClosedHotelOrders(Request $request){ 
		
        try {
			$hotels = Hotel::where('status', 'ACTIVE')->get();
			$operator_id = session()->get('operator.id');
			$operator = Operator::where('id', $operator_id)->first();
            $hotel_id = session()->get('operator.hotel');
			$hotel_name = '';
			if($hotel_id > 0){
				$hotel_name = $this->getHotelDetailsByIdWithFullInfo(@$hotel_id[0])->hotel_name;
				$orders = SendQuotation::where('hotel_id', $hotel_id)->where('checkin_checkout_status', 'closed')->with('orderpayment')->orderBy('id', 'DESC')->get();
				return view('operator.closed_hotel_orders', compact('orders','hotels','hotel_name'));
			}
			
			if($request->has('hotel_id') && $request->hotel_id != ''){
				$orders = SendQuotation::where('hotel_id', $request->hotel_id)->where('checkin_checkout_status', 'closed')->with('orderpayment')->orderBy('id', 'DESC')->get();
			}else{
				$orders = SendQuotation::where('checkin_checkout_status', 'closed')->with('orderpayment')->orderBy('id', 'DESC')->get();
			}
            
			return view('operator.closed_hotel_orders', compact('orders','hotels'));
        }catch(Exception $e) {
            return response()->json(['status' => 0, 'error' => 1, 'msg' => $e->getMessage(), 'data' => '']);
        }
    }
	
	

}
