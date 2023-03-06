<?php

namespace App\Http\Controllers\Resource;
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
use App\Http\Controllers\SMTPMail;
use Storage;

class leadResource extends Controller
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
    public function index()
    {
        $user=session()->get('admin');
        $leads = Lead::orderBy('id' , 'desc')->where('company_id',$user['comp_id'][0])->where('property_id',$user['id'][0])->paginate(10);
        return view('admin.lead.index', compact('leads'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		$Countries = Country::where('status', 'ACTIVE')->get();
		$Operators = Operator::where('status', 'ACTIVE')->get();
        $hotels = Hotel::All();
        $lead_no = substr(str_shuffle("0123456789"), 0, 5);
        return view('admin.lead.create', compact('Countries','hotels','lead_no','Operators'));
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
			$user=session()->get('admin');
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
			$post['property_id']=$user['id'][0];
            $post['company_id']=$user['comp_id'][0];
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
                $create_contact->property_id=$user['id'][0];
                $create_contact->company_id=$user['comp_id'][0];
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
				$subject = 'Thank you for your interest in the Ensober';
				$this->send($message, $subject, 'Sales@ensoberhotels.com', $request->email);
			}elseif($request->send_message == 'WHATSAPPEMAIL'){
				$message = 'Dear '.$request->name.', <br>
				
							Greetings from Ensober Hotels. Thank You for choosing Us.
							We have received your query "For '.$hotel_name.'".<br> Our Team will be in touch to serve you seamlessly, we will share the required information soon.<br><br>
							Regards,<br>
							Ensober Reservation Team';
				$subject = 'Thank you for your interest in the Ensober';
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
			$this->send($newlead, 'New Lead Created', 'Sales@ensoberhotels.com', env('ADMINEMAIL'));
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
            return view('admin.lead.edit',compact('lead', 'Operators','Countries', 'hotels', 'Regions', 'Cities'));
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
                $post->assign_to        =   $request->assign_to;
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
				
				$post->followup_date      =   $request->followup_date;
                $post->followup_time        =   $request->followup_time;
                $post->followup_status         =   $request->followup_status;
				
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

            return redirect()->route('lead.index')->with('flash_success', 'lead Updated Successfully'); 
            
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
     * This function use for close the lead.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function closeLead(Request $request){
        try{
            $post = Lead::findOrFail($request->lead_id);
            
			if( $post ) {
                $post->lead_status       =   'CLOSED';
                $post->closed_status       =   $request->closed_status; 
                $post->closed_reason       =   $request->closed_reason;                
            }
            
            $post->save(); 
            
			return redirect()->route('lead.index')->with('flash_success', 'Lead Closed Successfully'); 
            //return back()->with('flash_success', 'Lead Closed Successfully'); 
        } 

        catch (ModelNotFoundException $e) {
            return back()->with('flash_error', 'lead Not Found');
        }
    }
}
