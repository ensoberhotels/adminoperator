<?php

namespace App\Http\Controllers\Resource;

use Mail;
use PHPMailer\PHPMailer;
use View;
use Carbon\Carbon;
use App\Lead;
use App\Country;
use App\Region;
use App\City;
use App\Hotel;
use App\Operator;
use App\Contacts;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Controllers\Controller;
use App\AdminRequest;
use Storage;
use Log;
use DB;
use App\FollowupLead;
use App\TodaySaleReport;

class OptLeadResource extends Controller
{
	
	public function __construct(){
		//its just a dummy data object.
		$requests = AdminRequest::orderBy('id' , 'desc')->where('status','OPEN')->with('operator')->get();

		// Sharing is all view of admincontroller
		View::share('requests', $requests); 
	}
	
    /** 
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
		
        $operator_id = session()->get('operator');
		$Closeleads = [];
        if ($request->has('lead') && $request->input('lead')== 'new') {
           $leads  = Lead::whereDate('created_at', '=', date('Y-m-d'))->with('hotel')->orderBy('id' , 'desc')->where('company_id',$operator_id['company_id'][0])->where('property_id',$operator_id['property_id'][0])->where('user_id',$operator_id['id'][0])->get();
            
        } else if ($request->has('lead') && $request->input('lead')== 'active') {
            $leads  = Lead::where('status', 'ACTIVE')->where('lead_status', '!=', 'CLOSED')->with('hotel')->orderBy('id' , 'desc')->where('company_id',$operator_id['company_id'][0])->where('property_id',$operator_id['property_id'][0])->where('user_id',$operator_id['id'][0])->get();
            
        }else if ($request->has('lead') && $request->input('lead')== 'hot') {
            $leads  = Lead::where('status', 'ACTIVE')->where('lead_status', '!=', 'CLOSED')->where('lead_priority', 'Hot')->with('hotel')->where('company_id',$operator_id['company_id'][0])->where('property_id',$operator_id['property_id'][0])->where('user_id',$operator_id['id'][0])->orderBy('id' , 'desc')->get();
            
        }else if ($request->has('lead') && $request->input('lead')== 'follow_up') { 
            $leads  = Lead::where('status', 'ACTIVE')->where('lead_status', 'LEAD')->where('followup_date','=', date('Y-m-d'))->with('hotel')->where('company_id',$operator_id['company_id'][0])->where('property_id',$operator_id['property_id'][0])->where('user_id',$operator_id['id'][0])->orderBy('id' , 'desc')->get();
            
        }else if ($request->has('lead') && $request->input('lead')== 'inactive') {
            $leads = Lead::where('status', 'INACTIVE')->where('company_id',$operator_id['company_id'][0])->where('property_id',$operator_id['property_id'][0])->where('user_id',$operator_id['id'][0])->with('hotel')->orderBy('id' , 'desc')->get();
			
		}else if ($request->has('lead') && $request->input('lead')== 'book') {
            $leads = Lead::where('closed_status', 'BOOKED')->where('company_id',$operator_id['company_id'][0])->where('property_id',$operator_id['property_id'][0])->where('user_id',$operator_id['id'][0])->with('hotel')->orderBy('id' , 'desc')->get();
			
		}else if ($request->has('lead') && $request->input('lead')== 'loosed') {
            $leads = Lead::where('closed_status', 'LOST')->where('company_id',$operator_id['company_id'][0])->where('property_id',$operator_id['property_id'][0])->where('user_id',$operator_id['id'][0])->with('hotel')->orderBy('id' , 'desc')->get();
		}else if ($request->has('lead') && $request->input('lead')== 'poastponed') {
            $leads = Lead::where('closed_status', 'POSTPONED')->where('company_id',$operator_id['company_id'][0])->where('property_id',$operator_id['property_id'][0])->where('user_id',$operator_id['id'][0])->with('hotel')->orderBy('id' , 'desc')->get();
			
		}else if ($request->has('lead') && $request->input('lead')== 'closed') {
            $leads = Lead::where('lead_status', 'CLOSED')->where('company_id',$operator_id['company_id'][0])->where('property_id',$operator_id['property_id'][0])->where('user_id',$operator_id['id'][0])->with('hotel')->orderBy('id' , 'desc')->get();
			
		}else if ($request->has('lead') && $request->input('lead')== 'pendding') {
            $leads = Lead::where('lead_status', 'LEAD')->where('company_id',$operator_id['company_id'][0])->where('property_id',$operator_id['property_id'][0])->where('user_id',$operator_id['id'][0])->with('hotel')->orderBy('id' , 'desc')->get();
			
		}else if ($request->has('lead') && $request->input('lead')== 'yesterd') {
            $leads = Lead::where('company_id',$operator_id['company_id'][0])->where('property_id',$operator_id['property_id'][0])->where('user_id',$operator_id['id'][0])->whereDate('created_at', '=', date('Y-m-d',strtotime("-1 days")))->with('hotel')->orderBy('id' , 'desc')->get();
			
		}else if ($request->has('lead') && $request->input('lead')== 'total') {
            $leads = Lead::where('company_id',$operator_id['company_id'][0])->where('property_id',$operator_id['property_id'][0])->where('user_id',$operator_id['id'][0])->with('hotel')->orderBy('id' , 'desc')->get();
		
		}else if ($request->has('notclose') && $request->input('notclose')== '1') {
            $leads = Lead::where('company_id',$operator_id['company_id'][0])->where('property_id',$operator_id['property_id'][0])->where('user_id',$operator_id['id'][0])->where('lead_status', '!=', 'CLOSED')->orderBy('id' , 'desc')->with('hotel')->get();
			$Closeleads = Lead::where('company_id',$operator_id['company_id'][0])->where('property_id',$operator_id['property_id'][0])->where('user_id',$operator_id['id'][0])->where('lead_status', '=', 'CLOSED')->orderBy('id' , 'desc')->with('hotel')->get();
            
        }else {
          $leads = Lead::where('company_id',$operator_id['company_id'][0])->where('property_id',$operator_id['property_id'][0])->where('user_id',$operator_id['id'][0])->with('hotel')->orderBy('id' , 'desc')->get();
          
        }
			
			$total_count = Lead::where('company_id',$operator_id['company_id'][0])->where('property_id',$operator_id['property_id'][0])->where('user_id',$operator_id['id'][0])->count();
			
            $new = Lead::where('company_id',$operator_id['company_id'][0])->where('property_id',$operator_id['property_id'][0])->where('user_id',$operator_id['id'][0])->whereDate('created_at', '=', date('Y-m-d'))->get();
            $yester_count = Lead::where('company_id',$operator_id['company_id'][0])->where('property_id',$operator_id['property_id'][0])->where('user_id',$operator_id['id'][0])->whereDate('created_at', '=', date('Y-m-d',strtotime("-1 days")))->count();
			
            $new_count = $new->count();
            $active = Lead::where('company_id',$operator_id['company_id'][0])->where('property_id',$operator_id['property_id'][0])->where('user_id',$operator_id['id'][0])->where('status', 'ACTIVE')->where('lead_status','!=', 'CLOSED')->get(); 
            $active_count = $active->count();
            $inactive = Lead::where('company_id',$operator_id['company_id'][0])->where('property_id',$operator_id['property_id'][0])->where('user_id',$operator_id['id'][0])->where('status', 'INACTIVE')->get();
            $inactive_count = $inactive->count();
            $hot = Lead::where('company_id',$operator_id['company_id'][0])->where('property_id',$operator_id['property_id'][0])->where('user_id',$operator_id['id'][0])->where('status', 'ACTIVE')->where('lead_status','!=', 'CLOSED')->where('lead_priority', 'Hot')->get();
            $hot_count = $hot->count();
            $follow_up = Lead::where('company_id',$operator_id['company_id'][0])->where('property_id',$operator_id['property_id'][0])->where('user_id',$operator_id['id'][0])->where('status', 'ACTIVE')->where('lead_status', 'LEAD')->where('followup_date','=', date('Y-m-d'))->get();
            $follow_up_count = $follow_up->count(); 
			
			$book_count = Lead::where('company_id',$operator_id['company_id'][0])->where('property_id',$operator_id['property_id'][0])->where('user_id',$operator_id['id'][0])->where('closed_status', 'BOOKED')->count(); 
			
			$loosed_count = Lead::where('company_id',$operator_id['company_id'][0])->where('property_id',$operator_id['property_id'][0])->where('user_id',$operator_id['id'][0])->where('closed_status', 'LOST')->count();
			
			$postponed_count = Lead::where('company_id',$operator_id['company_id'][0])->where('property_id',$operator_id['property_id'][0])->where('user_id',$operator_id['id'][0])->where('closed_status', 'POSTPONED')->count();
			
			$closed_count = Lead::where('company_id',$operator_id['company_id'][0])->where('property_id',$operator_id['property_id'][0])->where('user_id',$operator_id['id'][0])->where('lead_status', 'CLOSED')->count();
			$pendding_count = Lead::where('company_id',$operator_id['company_id'][0])->where('property_id',$operator_id['property_id'][0])->where('user_id',$operator_id['id'][0])->where('lead_status', 'LEAD')->count();
            
        
        return view('operator.leads.index', compact('total_count','leads','Closeleads','new_count','active_count','inactive_count','hot_count','follow_up_count','book_count','loosed_count','postponed_count','yester_count','closed_count','pendding_count')); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
		$Countries = Country::where('status', 'ACTIVE')->get();
		$Operators = Operator::where('status', 'ACTIVE')->get();
        $hotels = Hotel::All();
        $lead_no = substr(str_shuffle("0123456789"), 0, 5);
        $operator_id = $request->session()->get('operator.id');
        return view('operator.leads.create', compact('Countries','hotels','lead_no','Operators','operator_id'));
    }

    /** 
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
	public function store(Request $request)
    {
        
        try{
			$user=session()->get('operator');
			//dd($user);
			$request->followup_date = date('Y-m-d', strtotime($request->followup_date));
            $request->followup_time = date('h:i:s', strtotime($request->followup_time));
            $post = $request->all();
			$hotel_name = $post['other_enquiry'];
			if($post['hotel_id'] >0){
				$hotel_detail = Hotel::where('id',$post['hotel_id'])->first();
				//dd($hotel_detail); 
				$post['country_id'] = $hotel_detail->country_id;
				$post['region_id'] = $hotel_detail->region_id;
				$post['city_id'] = $hotel_detail->city_id;
				$post['location'] = $hotel_detail->googleaddress;
				$post['hotel_type'] = $hotel_detail->start_category;
				$hotel_name = $hotel_detail->hotel_name;
			}
			
			$lead_count = Lead::whereDate('created_at', Carbon::today())->count();
			$post['lead_no'] = 'ENS'.date('ymd').sprintf("%03d", $lead_count);
			$post['lead_status'] = 'LEAD';
			$post['status'] = 'ACTIVE';
			$post['company_id'] = $user['company_id'][0];
			$post['property_id'] =$user['property_id'][0];
			$post['user_id'] =$user['id'][0];
            $res = Lead::create( $post );
			
            $contact = Contacts::where('mobile', $request->mobile)->orWhere('email', $request->email)->first();
            if( !empty($contact) ) {
                $contact->last_lead_no        =   $post['lead_no'];
                $contact->lead_count         =   $contact->lead_count+1;
                $contact->save();
            }else{
                $create_contact = new Contacts();
                $create_contact->mobile        =   $request->mobile;
                $create_contact->email         =   $request->email;
                $create_contact->name          =   $request->name;
                $create_contact->location      =   $request->location;  //
                if($request->customer_type =='B2B'){ $contact_type = 'Travel Agent';}else if($request->customer_type =='B2C' ) {$contact_type = 'Direct';}else{$contact_type = 'Referred';}
                $create_contact->contact_type  =   $contact_type;
                $create_contact->source        =   'CRM Lead';
                $create_contact->last_lead_no  =   $post['lead_no'];
                $create_contact->lead_count    =   1;
                $create_contact->status        =   'ACTIVE';
                $create_contact->company_id= $user['company_id'][0];
				$create_contact->property_id=$user['property_id'][0];
				$create_contact->user_id=$user['id'][0];
                $create_contact->save();
            }
			
			// Send email to customer
			if($request->send_message == 'WHATSAPP'){
				
			}elseif($request->send_message == 'EMAIL'){
				$message = 'Dear '.$request->name.', <br>
				
							Greetings from Ensober Hotels. Thank You for choosing Us.
							We have received your query "For '.$hotel_name.'".<br> Our Team will be in touch to serve you seamlessly, we will share the required information soon.<br><br>
							Regards,<br>
							Ensober Reservation Team';
				$subject = 'Thank you for your interest in the Ensober, Lead No - '.$post['lead_no'];
				$this->send($message, $subject, 'Sales@ensoberhotels.com', $request->email);
			}elseif($request->send_message == 'WHATSAPPEMAIL'){
				$message = 'Dear '.$request->name.', <br>
				
							Greetings from Ensober Hotels. Thank You for choosing Us.
							We have received your query "For '.$hotel_name.'".<br> Our Team will be in touch to serve you seamlessly, we will share the required information soon.<br><br>
							Regards,<br>
							Ensober Reservation Team';
				$subject = 'Thank you for your interest in the Ensober, Lead No - '.$post['lead_no'];
				$this->send($message, $subject, 'Sales@ensoberhotels.com', $request->email);
			}
			
			$newlead = '<!DOCTYPE html>
						<html>
						<head>
						<style>
						table {
						  font-family: arial, sans-serif;
						  border-collapse: collapse;
						  width: 100%;
						}

						td, th {
						  border: 1px solid #dddddd;
						  text-align: left;
						  padding: 8px;
						}

						tr:nth-child(even) {
						  background-color: #dddddd;
						}
						</style>
						</head>
						<body>
						<p>Dear '.$request->name.',</p>
						<br>
						<h2>Lead Details</h2>

						<table>
						  <tr>
							<th>Lead Number</th>
							<th>Hotel Name</th>
							<th>Contact Info</th>
							<th>Mobile</th>
							<th>FollowUp Date</th>
							<th>Comment</th>
							<th>Source</th>
							<th>CheckIn</th>
						  </tr>';
						  $newlead .= '<tr>
											<td>'.$post['lead_no'].'</td>
											<td> '.$hotel_name.'</td>
											<td> '.$request->name.'</td>
											<td> '.$request->mobile.'</td>
											<td> On '.$request->followup_date.' </td>
											<td>
												'.$request->lead_comment.'
											</td>
											<td>'.$request->lead_source.'</td>
											<td>
												On '.$request->start_date.'
											</td>											   
										  </tr>';
						$newlead .= '</table>

						</body>
						</html>';
			$this->sendAdmin($newlead, 'New Lead Created - '.$post['lead_no'].', '.$request->name, 'Sales@ensoberhotels.com'); 
            return back()->with('flash_success','lead Saved Successfully');

        } 

        catch (ModelNotFoundException $e) {
            return back()->with('flash_error', 'lead Not Found');
        }
    }
	
    public function store_old(Request $request)
    {
        
        try{

            $request->followup_date = date('Y-m-d', strtotime($request->followup_date));
            $request->followup_time = date('h:i:s', strtotime($request->followup_time));
            $post = $request->all();
			
			$lead_count = Lead::whereDate('created_at', Carbon::today())->count();
			$post['lead_no'] = 'ENS'.date('ymd').sprintf("%03d", $lead_count);
			
            $res = Lead::create( $post );
            
            $contact = Contacts::where('mobile', $request->mobile)->orWhere('email', $request->email)->first();
            if( !empty($contact) ) {
                $contact->last_lead_no        =   $post['lead_no'];
                $contact->lead_count         =   $contact->lead_count+1;
                $contact->save();
            }else{
                $create_contact = new Contacts();
                $create_contact->mobile        =   $request->mobile;
                $create_contact->email         =   $request->email;
                $create_contact->name          =   $request->name;
                $create_contact->location      =   $request->location;
                if($request->customer_type =='B2B'){ $contact_type = 'Travel Agent';}else if($request->customer_type =='B2C' ) {$contact_type = 'Direct';}else{$contact_type = 'Referred';}
                $create_contact->contact_type  =   $contact_type;
                $create_contact->source        =   'CRM Lead';
                $create_contact->last_lead_no  =   $post['lead_no'];
                $create_contact->lead_count    =   1;
                $create_contact->status        =   'ACTIVE';
                $create_contact->save();
            }
			// Send email to customer
			if($request->send_message == 'WHATSAPP'){
				
			}elseif($request->send_message == 'EMAIL'){
				$message = 'Dear '.$request->name.', 
				
							Greetings from Ensober Hotels. Thank You for choosing Us.
							We have received your query "For '.$request->hotel_id.'". Our Team will be in touch to serve you seamlessly, we will share the required information soon.
							Regards,
							Ensober Reservation Team';
				$subject = 'Thank you for your interest in the Ensober';
				$this->send($message, $subject, 'Sales@ensoberhotels.com', $request->email);
			}elseif($request->send_message == 'WHATSAPPEMAIL'){
				$message = 'Dear '.$request->name.', 
				
							Greetings from Ensober Hotels. Thank You for choosing Us.
							We have received your query "For '.$request->hotel_id.'". Our Team will be in touch to serve you seamlessly, we will share the required information soon.
							Regards,
							Ensober Reservation Team';
				$subject = 'Thank you for your interest in the Ensober';
				$this->send($message, $subject, 'Sales@ensoberhotels.com', $request->email);
			}
			
			
            return back()->with('flash_success','lead Saved Successfully');

        } 

        catch (ModelNotFoundException $e) {
            return back()->with('flash_error', 'lead Not Found');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Testimonial  $promocode
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            return Lead::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return $e;
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
      * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
     
    public function edit($id)
    {
        try {

            $lead = Lead::findOrFail($id);
			$Operators = Operator::where('status', 'ACTIVE')->get();
        	$Countries = Country::where('status', 'ACTIVE')->get();
			$Regions = Region::where('country_id', $lead->country_id)->where('status', 'ACTIVE')->get();
			$Cities = City::where('region_id', $lead->region_id)->where('status', 'ACTIVE')->get();
            $hotels = Hotel::All();
            return view('operator.leads.edit',compact('lead', 'Operators','Countries', 'hotels', 'Regions', 'Cities'));
        } catch (ModelNotFoundException $e) {
            return $e;
        }
    }

    /**
     * Update the specified resource in storage.
     *
      * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        /*$this->validate($request, [
            'name'          => 'required',
            'email'         => 'required|email|unique:leads,email,'.$id,
            'password'      => 'required|min:6',
            'lead_type'   => 'required',
            'country'       => 'required',
            'state'         => 'required',
            'city'          => 'required',            
        ]);**/
        try{
			$post = Lead::findOrFail($id);
			if( $post ) {
                $post->lead_source               =   $request->lead_source;
                $post->reference_name           =   $request->reference_name;
                $post->enquiry_type     =   $request->enquiry_type;
                $post->hotel_id  =   $request->hotel_id;
                $post->other_enquiry      =   $request->other_enquiry;
                $post->mobile        =   $request->mobile;
                $post->email         =   $request->email;
                $post->name               =   $request->name;
                $post->location           =   $request->location;
                $post->customer_type     =   $request->customer_type;
                $post->lead_priority  =   $request->lead_priority;
                $post->trip_type      =   $request->trip_type;
                //$post->assign_to        =   $request->assign_to;
                $post->hotel_type         =   $request->hotel_type;
                $post->city_id	       	=   $request->city_id;
                $post->region_id     =   $request->region_id;
                $post->country_id  =   $request->country_id;
                $post->start_date      =   $request->start_date;
                $post->no_nights        =   $request->no_nights;
                $post->no_room         =   $request->no_room;
                $post->sharing  =   $request->sharing;
                $post->pax      =   $request->pax;
                $post->kids        =   $request->kids;
                $post->infant         =   $request->infant;
                //$post->status       =   $request->status;                
                $post->lead_status       =   $request->lead_status; 
                if($request->lead_status=='CLOSED'){
                   $post->status       =   'INACTIVE'; 
                }else{
                 $post->status       =   $request->status;   
                }
                $post->closed_reason       =   $request->closed_reason; 
                $post->lead_comment       =   $request->lead_comment;                
            }
            
            $post->save();

            return redirect()->route('leads.index')->with('flash_success', 'lead Updated Successfully'); 
            
        } 

        catch (ModelNotFoundException $e) {
            return back()->with('flash_error', 'lead Not Found');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
      * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try { 

            $post = Lead::findOrFail($id);
            if( $post ) {
                $post->delete();
                return back()->with('flash_success', 'lead deleted successfully');
            }

        } 
        catch (ModelNotFoundException $e) {
            return back()->with('flash_error', 'lead Not Found');
        }
    }
	
	
	/**
     * Show the form for Lead follow_up view.
     *
      * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
     
    public function followUp($id)
    {
        try {

            $lead = Lead::findOrFail($id);
			$Operators = Operator::where('status', 'ACTIVE')->get();
        	$Countries = Country::where('status', 'ACTIVE')->get();
			$Regions = Region::where('country_id', $lead->country_id)->where('status', 'ACTIVE')->get();
			$Cities = City::where('region_id', $lead->region_id)->where('status', 'ACTIVE')->get();
            $hotels = Hotel::All();
			$followUps = FollowupLead::where('lead_id', $id)->with('getOperator')->get();

            return view('operator.leads.followup',compact('lead', 'Operators','Countries', 'hotels', 'Regions', 'Cities','followUps')); 
        } catch (ModelNotFoundException $e) {
            return $e;
        }
    }
	
	/**
     * Followup action of the lead.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function followUpAction(Request $request)
    {
        try{
			$post = Lead::findOrFail($request->lead_id);
			if( $post ) {
				$FollowupLead = new FollowupLead();
				$FollowupLead->lead_id = $request->lead_id;
				$FollowupLead->operator_id = $post->assign_to;
				$FollowupLead->followup_date = $post->followup_date;
				$FollowupLead->followup_time = $post->followup_time;
				$FollowupLead->comment = $request->comment;
				$FollowupLead->save();
                $post->followup_date      =   $request->followup_date;
                $post->followup_time        =   $request->followup_time;
                $post->followup_status         =   $request->followup_status;
				$post->save();
            }

            return redirect()->route('leads.index')->with('flash_success', 'lead Updated Successfully'); 
            
        } 

        catch (ModelNotFoundException $e) {
            return back()->with('flash_error', 'lead Not Found');
        }
    }
	
	/**
     * Check today followUp and set status.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
     
    public function checkTodayFollowup()
    {
        try {
            $leads = Lead::where('followup_date', date('Y-m-d'))->where('make_quatation', '0')->get();
			foreach($leads as $lead){
				$lead->today_followup = 'YES';
				$lead->save();
			}
			Log::info('Cron Run...'.date('d-m-Y, h:i:s A'));
			return 'Successfully!';
        } catch (ModelNotFoundException $e) {
            return $e;
        }
    }
	
	/**
     * This function use for close the lead.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function closeLead(Request $request)
    {
        try{
            $post = Lead::findOrFail($request->lead_id);
            
			if( $post ) {
                $post->lead_status       =   'CLOSED';
                $post->closed_status       =   $request->closed_status; 
                $post->closed_reason       =   $request->closed_reason;                
            }
            
            $post->save(); 
            return redirect()->route('leads.index')->with('flash_success', 'Lead Closed Successfully');
            //return back()->with('flash_success', 'lead Closed Successfully'); 
            
        } 

        catch (ModelNotFoundException $e) {
            return back()->with('flash_error', 'lead Not Found');
        }
    }
	
	/**
     * This function use for reopen the lead.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function reopenLead($lead_id)
    {
        try{
            $post = Lead::findOrFail($lead_id);
            
			if( $post ) {
                $post->lead_status       =   'LEAD';
                $post->closed_status       =   ''; 
                //$post->closed_reason       =   $request->closed_reason;                
            }
            
            $post->save(); 
            
            return back()->with('flash_success', 'lead Reopen Successfully'); 
            
        } 

        catch (ModelNotFoundException $e) {
            return back()->with('flash_error', 'lead Not Found');
        }
    }
	
	/**
     * This function use for Send followup report to operator email.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function sendFollowUpReport()
    {
        try{
            $operators = Operator::All();
			$message_admin = '';
            foreach($operators as $operator){
				$follow_up = Lead::where('assign_to', $operator->id)->where('status', 'ACTIVE')->where('lead_status','!=', 'CLOSED')->whereOr('followup_date','=', date('Y-m-d'))->with('hotel')->get();
				
				if($follow_up->count() > 0){
					$message = '<!DOCTYPE html>
						<html>
						<head>
						<style>
						table {
						  font-family: arial, sans-serif;
						  border-collapse: collapse;
						  width: 100%;
						}

						td, th {
						  border: 1px solid #dddddd;
						  text-align: left;
						  padding: 8px;
						}

						tr:nth-child(even) {
						  background-color: #dddddd;
						}
						</style>
						</head>
						<body>
						<p>Dear '.$operator->name.',</p>
						<br>
						<h2>Today Followup</h2>

						<table>
						  <tr style="background-color: #183678; color: #fff;">
							<th>Lead Number</th>
							<th>Hotel Name</th>
							<th>Contact Info</th>
							<th>Mobile</th>
							<th>FollowUp Date</th>
							<th>Comment</th>
							<th>Source</th>
							<th>CheckIn</th>
							<th>FollowUp</th>
						  </tr>';
						  foreach($follow_up as $lead){
						  $message .= '<tr>
											<td>'.$lead->lead_no.'</td>
											<td> '.@$lead->hotel['hotel_name'].'</td>
											<td> '.$lead->name.'</td>
											<td> '.$lead->mobile.'</td>
											<td> On '.$lead->followup_date.' </td>
											<td>
												'.$lead->lead_comment.'
											</td>
											<td>'.$lead->lead_source.'</td>
											<td>
												On '.$lead->start_date.'
											</td>
											<td>
												<a href="/operator/lead/followup/'.$lead->id.'" target="_blank"> FollowUp </a>
											</td>											
										  </tr>';
						  }
						$message .= '</table>

						</body>
						</html>';
						
						
						$message_admin .= '<!DOCTYPE html>
						<html>
						<head>
						<style>
						table {
						  font-family: arial, sans-serif;
						  border-collapse: collapse;
						  width: 100%;
						}

						td, th {
						  border: 1px solid #dddddd;
						  text-align: left;
						  padding: 8px;
						}

						tr:nth-child(even) {
						  background-color: #dddddd;
						}
						</style>
						</head>
						<body>
						<h2>Today Followup - '.$operator->name.'</h2>

						<table>
						  <tr style="background-color: #183678; color: #fff;">
							<th>Lead Number</th>
							<th>Hotel Name</th>
							<th>Contact Info</th>
							<th>Mobile</th>
							<th>FollowUp Date</th>
							<th>Comment</th>
							<th>Source</th>
							<th>CheckIn</th>
							<th>FollowUp</th>
						  </tr>';
						  foreach($follow_up as $lead){
						  $message_admin .= '<tr>
											<td>'.$lead->lead_no.'</td>
											<td> '.$lead->hotel['hotel_name'].'</td>
											<td> '.$lead->name.'</td>
											<td> '.$lead->mobile.'</td>
											<td> On '.$lead->followup_date.' </td>
											<td>
												'.$lead->lead_comment.'
											</td>
											<td>'.$lead->lead_source.'</td>
											<td>
												On '.$lead->start_date.'
											</td>
											<td>
												<a href="/operator/lead/followup/'.$lead->id.'" target="_blank"> FollowUp </a>
											</td>											
										  </tr>';
						  }
						$message_admin .= '</table>

						</body>
						</html>';
		
					$this->send($message, 'Today Lead FollowUp Report - '.date('d M y'), 'Sales@ensoberhotels.com', $operator->email); 
					Log::info($operator->name.' Today FollowUp Report Cron Run...'.date('d-m-Y, h:i:s A'));
				}
			}
			
			$this->sendAdmin($message_admin, 'Today Lead FollowUp Report New  - '.date('d M y'), 'Sales@ensoberhotels.com');
			return 'Successfully!';
        } 

        catch (ModelNotFoundException $e) {
            return back()->with('flash_error', 'lead Not Found');
        }
    }
	
	
	/**
     * This function use for Send today sale report to admin email.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function sendTodaySaleReport()
    {
        try{
            $today_sales = DB::select( DB::raw("select * from `today_sale_report`"));
			
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
						  border: 1px solid #dddddd;
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
						<h2>Today Total Sale</h2>

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
							<th>Per Night Cost</th>
							<th>Advance Received</th>
							<th>Bonfirmed By</th>
							<th>Create Date/Time</th>
						  </tr>';
			$cost_total = 0;
			$advance_total = 0;
            foreach($today_sales as $today_sale){
				$cost_total += $today_sale->cost;
				$advance_total += $today_sale->advance_received;
				$message_admin .= '<tr>
					<td>'.$today_sale->send_quotation_no.'</td>
					<td>'.$today_sale->name.'</td>
					<td>'.$today_sale->mobile.'</td>
					<td>'.$today_sale->email.'</td>
					<td>'.$today_sale->checkin.'</td>
					<td>'.$today_sale->checkout.'</td>
					<td>'.$today_sale->rooms.'</td>
					<td>'.$today_sale->night.'</td>
					<td>'.$today_sale->adult.'</td>
					<td>'.$today_sale->kids.'</td>
					<td>'.$today_sale->infant.'</td>
					<td>'.$today_sale->cost.'</td>
					<td>'.$today_sale->per_night_cost.'</td>
					<td>'.$today_sale->advance_received.'</td>
					<td>'.$today_sale->confirmed_by.'</td>
					<td>'.date('d M Y, H:i:s A', strtotime($today_sale->created_at)).'</td>
				</tr>';
			}
			$message_admin .= '<tr>
				<td colspan="10"></td>
				<td><b>Total:</b></td>
				<td>'.$cost_total.'</td>
				<td></td>
				<td>'.$advance_total.'</td>
				<td colspan="4"></td>
			</tr>';	
			$message_admin .= '</table><h4 style="display:none; color:#041879;">Total Sale: '.number_format($cost_total,2).'</h4><h4 style="display:none; color:green;">Total Advance Received: '.number_format($advance_total,2).'</h4> 
							</body>
						</html>';
			//echo $message_admin;
			//exit;
			
			$this->sendAdmin($message_admin, 'Today Sale Report - '.date('d M y'), 'Sales@ensoberhotels.com');
			return 'Successfully!';
        } 

        catch (ModelNotFoundException $e) {
            return back()->with('flash_error', 'lead Not Found');
        }
    }
	
	
	
	/**
     * This function use for Send one email morning 06:00 AM today is all rooms are booked, if all booked rooms day.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function sendTodayFullSaleNotify($hotel_id)
    {
        try{
			
			$total_hotel_rooms = DB::select( DB::raw("SELECT sum(room_count) as totalroom  FROM `room_categorys` WHERE `hotel_id`=$hotel_id"));
			$total_hotel_rooms = $total_hotel_rooms[0]->totalroom;
			
            $today_room_booked = DB::select( DB::raw("SELECT COUNT(no_of_room) as roombooked FROM `room_inventory` WHERE `hotel_id`=$hotel_id and cast(date as Date) = cast(NOW() as Date)"));
			$today_room_booked = $today_room_booked[0]->roombooked;
			
			$hotel = DB::select( DB::raw("SELECT hotel_name FROM `hotels` WHERE `id`=$hotel_id"));
			$hotel = $hotel[0]->hotel_name;
			
			if($total_hotel_rooms == $today_room_booked){
				$message_admin = '<!DOCTYPE html>
						<html>
						<head>
						<style>
							
						</style>
						</head>
						<body style="font-family: sans-serif; text-align:center;">
							<img src="/asset/images/cong.jpg" />
							<h2>'.$hotel.'</h2>
							<h4 style="color:green;">-: Today Full Rooms Are Booked :-</h4>
						</body>
						</html>';
						//echo $message_admin;
						//exit;
						
						$this->sendAdmin($message_admin, 'Today Full Rooms Are Booked - '.date('d M y'), 'Sales@ensoberhotels.com');
						return 'Successfully!';
			}else{
				return 'Today Not Booked Full Rooms!';
			}
        } 

        catch (ModelNotFoundException $e) {
            return back()->with('flash_error', 'lead Not Found');
        }
    }
	
	
}
