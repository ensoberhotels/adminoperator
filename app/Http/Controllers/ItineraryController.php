<?php

namespace App\Http\Controllers;

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
use App\SendQuotationRate;
use App\PaymentSource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File; 
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Controllers\Controller;
use App\AdminRequest;
use App\HotelSeasonRate;
use App\Transport;
use App\Voucher;
use App\RoomCategory;
use App\HotelGallery;
use App\RoomTypes;
use App\Activity;
use App\ActivityVoucher;
use PDF;
use Storage;
use Log;
use DB;
use Session;
use DateTime;
use App\FollowupLead;
use App\SendQuotation;
use App\HotelAmenity;
use App\RoomBookedDetails;
use App\RoomInventory;
use App\Vender;
use App\ActivityCat;
use App\AgentContact;
use QrCode;
use App\Via;
use App\ITIRoute;
use App\ITIBasicInfo;
use App\ITITransport;
use App\ITIHotel;
use App\ITIActivity;
use App\PaymentHistory;
use App\ITIPrice;
use App\ITIDayWiseItinerary;
use App\BookingFrom;
use App\BookingSource;

class ItineraryController extends Controller
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
    public function index(Request $request){
        echo "Hello";
    }
	
	
	/**
     * Show the form for Lead follow_up view.
     *
      * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
     
    public function makeItineraryv1($id)
    {
        try {
            $lead = Lead::findOrFail($id);
			$Operators = Operator::where('status', 'ACTIVE')->get();
        	$Countries = Country::where('status', 'ACTIVE')->get();
			$Regions = Region::where('country_id', $lead->country_id)->where('status', 'ACTIVE')->get();
			$Cities = City::where('region_id', $lead->region_id)->where('status', 'ACTIVE')->get();
            $hotels = Hotel::All();
			$citiesh = City::select('hotels.*','cities.id as city_id','cities.name as name')->join('hotels', 'cities.id', '=', 'hotels.city_id')->get();
			$followUps = FollowupLead::where('lead_id', $id)->with('getOperator')->get();
			$transports = Transport::orderBy('id' , 'desc')->with('car')->with('venderName')->with('car_segment')->with('car_model')->with('car_seats')->with('countryName')->with('stateName')->with('cityName')->get();

            return view('operator/makeitinerarynew',compact('lead', 'Operators','Countries', 'hotels', 'Regions', 'Cities','followUps', 'citiesh', 'transports')); 
        } catch (ModelNotFoundException $e) {
            return $e;
        }
    }
	
	/**
     * Show the form for make quotation.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function makeQuotation()
    {
        try {
            $hotels = Hotel::All();
			$citiesh = City::select('hotels.*','cities.id as city_id','cities.name as name')->join('hotels', 'cities.id', '=', 'hotels.city_id')->groupBy('cities.id')->get();
            return view('operator/makequotation',compact('hotels', 'citiesh')); 
        } catch (ModelNotFoundException $e) {
            return $e;
        }
    }
	
	/**
     * This function use for load the view page of add payment
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function addPaymentView(){
        try {
            $hotels = Hotel::where('status', 'ACTIVE')->get();
			$paymentsources = PaymentSource::where('status', 'ACTIVE')->get();
			$paymenthistories = PaymentHistory::orderBy('id', 'DESC')->paginate(5);
            return view('operator/payment_history',compact('hotels', 'paymentsources','paymenthistories')); 
        } catch (ModelNotFoundException $e) {
            return $e;
        }
    }
	
	/**
     * This function use for delete the payment
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function deletePayment($id){
        try {
			PaymentHistory::where('id', $id)->delete();
            return back(); 
        } catch (ModelNotFoundException $e) {
            return $e;
        }
    }
	
	/**
     * This function use for save the payment
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function addPayment(Request $request){ 
        try {
			$log_user = session()->get('operator');
			
			if($request->HasFile('pay_screenshort')){
				$path = $request->file('pay_screenshort')->store('payment_snapshots');
				
			}else{
				$path = '';
			}
			if($request->send_quotation_no != ''){
				$SendQuotation = SendQuotation::where('send_quotation_no', $request->send_quotation_no)->first();
				if (!$SendQuotation) {
					return back()->with('flash_error', "Incorrect quotation no. $request->send_quotation_no");
				}
				if($SendQuotation->checkin_checkout_status == 'closed'){
					return back()->with('payment_add_back', '0');
				}
			}
			$PaymentHistory = new PaymentHistory();
			$PaymentHistory->send_quotation_no = $request->send_quotation_no;
			$PaymentHistory->name = $request->name;
			$PaymentHistory->pay_screenshort = $path;
			$PaymentHistory->amount = $request->amount;
			$PaymentHistory->payment_to = $request->payment_to;
			$PaymentHistory->payment_to_id = $request->payment_to_id;
			$PaymentHistory->create_by = $log_user['id'][0];
			$PaymentHistory->hotel = $request->hotel;
			$PaymentHistory->checkin_date = $request->checkin_date;
			$PaymentHistory->save();
            return back()->with('payment_add_back', '1');
        } catch (ModelNotFoundException $e) {
            return $e;
        }
    }
	
	/**
     * This function use for check the quotation closed or not
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function checkQuotationIsClosed(Request $request){
        try {
			if($request->send_quotation_no != ''){
				$SendQuotation = SendQuotation::where('send_quotation_no', $request->send_quotation_no)->first();
				if(!$SendQuotation){
					return response()->json(['status' => 'notclosed', 'msg' => 'Quotation not found']);
				}
				if($SendQuotation->checkin_checkout_status == 'closed'){
					return response()->json(['status' => 'closed', 'msg' => 'This quotation is closed, Should not add payment for this']);
				}else{
					return response()->json(['status' => 'notclosed', 'msg' => '']);
				}
			}
            return view('operator/payment_approve',compact('payment_detail')); 
        } catch (ModelNotFoundException $e) {
            return $e;
        }
    }
	
	/**
     * This function use for approve the payment screen
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function approvePaymentView($id){
        try {
			$payment_detail = PaymentHistory::where('id', $id)->first();
            return view('operator/payment_approve',compact('payment_detail')); 
        } catch (ModelNotFoundException $e) {
            return $e;
        }
    }
	
	/**
     * This function use for approve the payment action
     *
     * @param  \Illuminate\Http\Request  $request
     * @return back()
     */
    public function approvePaymentAction(Request $request){
        try {
			$id = $request->id;
			$payment_detail = PaymentHistory::where('id', $id)->first();
			$payment_detail->payment_received = $request->payment_received;
			$payment_detail->approval_date = date('Y-m-d');
			$payment_detail->save();
			if($request->payment_received == 'P'){
				return back()->with('flash_success', 'Payment Pending Updated Successfully!');
			}else{
				return back(); 
			}
        } catch (ModelNotFoundException $e) {
            return $e;
        }
    }
	
	/**
     * Show the form for make activity voucher.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function makeActivityVoucher()
    {
        try {
        	$user=session()->get('operator');
            $hotels = Hotel::where('company_id',$user['company_id'][0])->where('property_id',$user['property_id'][0])->get();
			$citiesh = City::select('hotels.*','cities.id as city_id','cities.name as name')->join('hotels', 'cities.id', '=', 'hotels.city_id')->groupBy('cities.id')->get();
			$venders = Vender::where('vender_type','EVENT VENDER')->orderBy('id' , 'desc')->get();
			$activities = ActivityCat::orderBy('id' , 'desc')->get();
            return view('operator/makeactivityvoucher',compact('hotels', 'citiesh','venders','activities')); 
        } catch (ModelNotFoundException $e) {
            return $e;
        }
    }
	
	/**
     * Show the form for make quotation.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getQuotation($quotation_no)
    {
        try {
			$check_valid = $this->checkQuotationNoIsValid($quotation_no);
			if($check_valid == 0){
				echo "<center><h4 style='color:red;'>This Quotation No Is Invalid, Quotation No Is: <span style='color:blue'>$quotation_no</span> </h4></center><br> <center><a href='/operator/makequotation'><button>Go Back</button></a></center>";
				exit;
			}
			$citiesh = City::select('hotels.*','cities.id as city_id','cities.name as name')->join('hotels', 'cities.id', '=', 'hotels.city_id')->groupBy('cities.id')->get();
			$quotation = SendQuotation::where('send_quotation_no', $quotation_no)->with('QuotationRate')->orderBy('checkin','ASC')->get();
			if(isset($quotation[0]->destination)){
				$hotels = Hotel::where('city_id', $quotation[0]->destination)->get();
				$roomtypes = RoomCategory::where('hotel_id', $quotation[0]->hotel_id)->get();
				$paymentsources = PaymentSource::where('hotel_id', $quotation[0]->hotel_id)->get();
			}else{
				$hotels = Hotel::All();
				$roomtypes = RoomCategory::get();
				$paymentsources = PaymentSource::get();
			}
			
			// If inventory user
			$checkroominv = Session::get('operator.room_inventory');
			$session_data = Session::get('operator');
			if(@$checkroominv[0] == 'Y'){
				$paymentsources = PaymentSource::where('hotel_id', $session_data['hotel'][0])->get();
			}

				
			$roomsrate = SendQuotationRate::where('send_quotation_no', $quotation_no)->with('RoomType')->get();
			$lead = Lead::where('send_quotation_no', $quotation_no)->first();
			
			$collection = collect();
			foreach($quotation as $quot) {
				$quot['roomtypes'] =   $collection->merge($roomtypes);
				$quot['paymentsources'] =   $collection->merge($paymentsources);
			}

			$booking_detail = RoomBookedDetails::where('send_quotation_no', $quotation_no)->first();
			$booking_froms	=	BookingFrom::where('company_id', $session_data['company_id'][0])->get();
			$booking_sources =   BookingSource::where('company_id', $session_data['company_id'][0])->get();
			// dd($session_data, $quotation_no, $booking_froms, $booking_sources);

            return view('operator/getquotation',compact('hotels', 'citiesh','quotation','lead','roomtypes','roomsrate','booking_detail', 'booking_froms', 'booking_sources')); 
        } catch (ModelNotFoundException $e) {
            return $e;
        }
    }
	
	/**
     * Show the form for update the activity voucher.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getActivityVoucher($vouvher_no)
    {
        try {
			$check_valid = $this->checkActivityVoucherNoIsValid($vouvher_no);
			if($check_valid == 0){
				echo "<center><h4 style='color:red;'>This Activity VOucher No Is Invalid, Quotation No Is: <span style='color:blue'>$vouvher_no</span> </h4></center><br> <center><a href='/operator/makeactivityvoucher'><button>Go Back</button></a></center>";
				exit;
			}
			$citiesh = City::select('hotels.*','cities.id as city_id','cities.name as name')->join('hotels', 'cities.id', '=', 'hotels.city_id')->groupBy('cities.id')->get();
			
			$venders = Vender::where('vender_type','EVENT VENDER')->orderBy('id' , 'desc')->get();
			
			$voucher = ActivityVoucher::where('voucher_no', $vouvher_no)->first();
			$activity = Activity::where('id',$voucher->activity_id)->with('activityCat')->with('activitySubCat')->first();
			$activities = ActivityCat::orderBy('id' , 'desc')->get();
            return view('operator.getactivityvoucher',compact('activity','voucher', 'citiesh','venders','activities')); 
        } catch (ModelNotFoundException $e) {
            return $e;
        }
    }
	
	/**
     * Get all activity voucher.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getAllActivityVouchers(Request $request)
    {
        try { 
        	$user=session()->get('operator');
			if($request->vender_id != '' && ($request->from == '' && $request->to == '')){
				$vouchers = ActivityVoucher::where('company_id',$user['company_id'][0])->where('property_id',$user['property_id'][0])->where('vendor_id', $request->vender_id)->with('Vender')->paginate(10);
			}elseif($request->vender_id == '' && $request->from != '' && $request->to != ''){
				$vouchers = ActivityVoucher::where('company_id',$user['company_id'][0])->where('property_id',$user['property_id'][0])->whereBetween('date', array($request->from, $request->to))->with('Vender')->paginate(10);
			}elseif($request->vender_id != '' && $request->from != '' && $request->to != ''){
				$vouchers = ActivityVoucher::where('company_id',$user['company_id'][0])->where('property_id',$user['property_id'][0])->where('vendor_id', $request->vender_id)->whereBetween('date', array($request->from, $request->to))->with('Vender')->paginate(10);
			}else{
				$vouchers = ActivityVoucher::where('company_id',$user['company_id'][0])->where('property_id',$user['property_id'][0])->with('Vender')->paginate(10);
			}
			$venders = Vender::where('vender_type','EVENT VENDER')->orderBy('id' , 'desc')->get();
			
            return view('operator.getallactivityvouchers',compact('vouchers','venders')); 
        } catch (ModelNotFoundException $e) {
            return $e;
        }
    }
	
	/**
     * Calculate the total cost.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
     
    public function NainitalCalculateTotalCost($noofroom,$noofnight,$noofadult,$noofextchieldwbad,$noofextchieldwobad,$per_night_cost,$adult_extra_cost,$one_occupancy_cost,$child_extra_cost_wd,$child_extra_cost_wod, $id=0){
		$message_log = "'noofroom' => $noofroom, 'noofnight' => $noofnight, 'noofadult' => $noofadult, 'noofextchieldwbad' => $noofextchieldwbad, 'noofextchieldwobad' => $noofextchieldwobad, 'per_night_cost' => $per_night_cost, 'adult_extra_cost' => $adult_extra_cost, 'one_occupancy_cost' => $one_occupancy_cost, 'child_extra_cost_wd' => $child_extra_cost_wd, 'child_extra_cost_wod' => $child_extra_cost_wod, 'id' => $id";
        $extra_adult = 0;
		$allow_no_of_adult = $noofroom*2;
		$cost = $per_night_cost*$noofnight*$noofroom;
		$extra_chield_wbad_cost = 0;
		$extra_chield_wobad_cost = 0;
		$single_occupancy_cost = 0;
		$extra_adult_cost = 0;
		$total_cost = $cost ;
		if($noofadult > $allow_no_of_adult){
			$extra_adult = $noofadult-$allow_no_of_adult;
			$extra_adult_cost = $adult_extra_cost*$extra_adult*$noofnight;
			if($noofextchieldwbad > 0){
				$extra_chield_wbad_cost = $noofextchieldwbad*$child_extra_cost_wd*$noofnight;
			}
			if($noofextchieldwobad > 0){
				$extra_chield_wobad_cost = $noofextchieldwobad*$child_extra_cost_wod*$noofnight;
			}
			$total_cost = $cost+$extra_adult_cost+$extra_chield_wbad_cost+$extra_chield_wobad_cost;
		}elseif($noofadult < $allow_no_of_adult){
			$single_occupancy_adult = $allow_no_of_adult-$noofadult;
			if($noofextchieldwbad > 0){
				$noof_extra_chield_wbad = $single_occupancy_adult-$noofextchieldwbad;
				if($noof_extra_chield_wbad > 0){
					$single_occupancy_cost = $noof_extra_chield_wbad*$one_occupancy_cost*$noofnight;
				}elseif($noof_extra_chield_wbad < 0){
					$noof_extra_chield_wbad = $noofextchieldwbad-$single_occupancy_adult;
					$extra_chield_wbad_cost = $noof_extra_chield_wbad*$child_extra_cost_wd*$noofnight;
					//dd($extra_chield_wbad_cost);
					if($noofextchieldwobad > 0){
						$extra_chield_wobad_cost = $noofextchieldwobad*$child_extra_cost_wod*$noofnight;
					}
				}elseif($noof_extra_chield_wbad == 0){
					$extra_chield_wobad_cost = $noofextchieldwobad*$child_extra_cost_wod*$noofnight;
				}
				
			}elseif($noofextchieldwbad == 0){
				$noof_extra_chield_wbad = $single_occupancy_adult-$noofextchieldwbad;
				$single_occupancy_cost = $noof_extra_chield_wbad*$one_occupancy_cost*$noofnight;
			}
			$total_cost = $cost-$single_occupancy_cost+$extra_chield_wobad_cost+$extra_chield_wbad_cost;
		}elseif($noofadult == $allow_no_of_adult){
			if($noofextchieldwbad > 0){
				$extra_chield_wbad_cost = $noofextchieldwbad*$child_extra_cost_wd*$noofnight;
			}
			if($noofextchieldwobad > 0){
				$extra_chield_wobad_cost = $noofextchieldwobad*$child_extra_cost_wod*$noofnight;
			}
			$total_cost = $cost+$extra_chield_wbad_cost+$extra_chield_wobad_cost;
		}
		
		if($id != 0){
			DB::enableQueryLog();
			//$quo_rate = SendQuotationRate::where('id',$id)->first();
			//dd(DB::getQueryLog());
			
			$discount = 0;
			//if($quo_rate){
				//$discount = $quo_rate->cost-$total_cost+$quo_rate->discount;
			//}
			$message_log .= "'total_cost' => $total_cost, 'discount' => $discount, 'extra_adult_cost' => $extra_adult_cost, 'extra_adult' => $extra_adult, 'extra_chield_wbad_cost' => $extra_chield_wbad_cost, 'extra_chield_wobad_cost' => $extra_chield_wobad_cost, 'single_occupancy_cost' => $single_occupancy_cost";
			Log::info($message_log);
			return array('total_cost' => $total_cost, 'discount' => $discount, 'extra_adult_cost' => $extra_adult_cost, 'extra_adult' => $extra_adult, 'extra_chield_wbad_cost' => $extra_chield_wbad_cost, 'extra_chield_wobad_cost' => $extra_chield_wobad_cost, 'single_occupancy_cost' => $single_occupancy_cost);
		}else if($id == 0){
			$message_log .= "'total_cost' => $total_cost, 'discount' => 0, 'extra_adult_cost' => $extra_adult_cost, 'extra_adult' => $extra_adult, 'extra_chield_wbad_cost' => $extra_chield_wbad_cost, 'extra_chield_wobad_cost' => $extra_chield_wobad_cost, 'single_occupancy_cost' => $single_occupancy_cost";
			Log::info($message_log);
			return array('total_cost' => $total_cost, 'discount' => 0, 'extra_adult_cost' => $extra_adult_cost, 'extra_adult' => $extra_adult, 'extra_chield_wbad_cost' => $extra_chield_wbad_cost, 'extra_chield_wobad_cost' => $extra_chield_wobad_cost, 'single_occupancy_cost' => $single_occupancy_cost);
		} 	
    }
	
	
	
	/**
     * Check price available or not for particular hotel by date
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function checkHotelPriceAvailableOrNot(Request $request){
		$checkin = $request->checkin;
		$hotel_id = $request->hotel_id;
		$room_type = $request->room_type;
		$hotel_rate = $this->GetSeasonHotelRate($checkin, $hotel_id, $room_type);
		if(@$hotel_rate['status'] == true){
			echo 1;
		}else{
			echo 0;
		}
    }
	
	/**
	 * This function use for get hotel details
	 *
	 * @return html
	 */
	public function getHotelDetailById(Request $request){
        $id = $request->hotel_id;
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
		 $hotel_price = '';
		 if($request->checkin != ''){
			$checkin = date('Y-m-d', strtotime($request->checkin));
			$hotelseasonrate = HotelSeasonRate::where('start_date','<=', $checkin)
				->where('end_date','>=', $checkin)
				->where('status', 'ACTIVE')
				->where('room_type_id',$request->room_type)
				->where('hotel_id',$id)
				->orderBy('id', 'DESC')->first(); 
			$hotel_price = '<b class="tarif_text">Price: </b>
							<div class="price_main">
								<label for="email2" class="mb-2 mr-sm-2 price_text">EP:</label>
								<b class="form-control mb-2 mr-sm-2 price_value" id="ep_price">'.$hotelseasonrate->ep_price.'</b>
								
								<label for="email2" class="mb-2 mr-sm-2 price_text">CP:</label>
								<b class="form-control mb-2 mr-sm-2 price_value" id="cp_price">'.$hotelseasonrate->cp_price.'</b>
								
								<label for="email2" class="mb-2 mr-sm-2 price_text">MAP:</label>
								<b class="form-control mb-2 mr-sm-2 price_value" id="map_price">'.$hotelseasonrate->map_price.'</b>
								
								<label for="email2" class="mb-2 mr-sm-2 price_text">AP:</label>
								<b class="form-control mb-2 mr-sm-2 price_value" id="ap_price">'.$hotelseasonrate->ap_price.'</b>
							</div>';
		 }
         
		if($Hotel->start_category == "ONE"){
			$star=1;
		}elseif($Hotel->start_category=="TWO"){
			$star=2;
		}elseif($Hotel->start_category=="THREE"){
			$star=3;
		}elseif($Hotel->start_category=="FOUR"){
			$star=4;
		}elseif($Hotel->start_category=="FIVE"){
			$star=5;
		}
		$hotel_view = '
			<style>
				.hotel_rating li {
					width: 30px;
					display: inline-block; 
				}
				.detal_1 {
					float: left;
					width: 75%;
				}
				.hotel_detail_main {
					float: left;
					width: 98%;
					margin-left: 15px;
					padding: 10px 20px 35px;
					border: 2px solid #7280ce;
				}
				b.hotel_name {
					font-size: 30px;
					color: #ff4081;
				}
				.hotel_detail_w60 {
					float: left;
					width: 100%;
				}
				.hotel_detail_w40 {
					float: left;
					width: 100%;
				}
				.hotel_rating {
					float: left;
					width: 100%;
				}
				ul.ho_contact_detail {
					float: left;
					width: 100%;
					margin: 0;
				}
				ul.ho_contact_detail li {
					display: inline-block;
					width: 100%;
					vertical-align: middle;
				}
				ul.ho_contact_detail li i {
					color: #ff4081;
					font-size: 28px;
					display: inline-block;
				}
				ul.ho_contact_detail li b {
					position: relative;
					display: inline-block;
					top: -10px;
					width:90%; 
				}
				b.tarif_text {
					float: left;
					width: 100%;
					border-bottom: 2px solid #7280ce;
					font-size: 20px;
					padding: 5px 0 7px;
					margin: 0 0 8px;
				}
				.price_text {
					font-size: 18px;
					color: #ff4081;
					font-weight: bold;
					margin-right: 4px;
				}
				.price_value {
					font-size: 16px;
					color: green;
					font-weight: bold;
					margin-right: 5px;
				}
				.date_text {
					font-size: 18px;
					font-weight: bold;
					color: #ff4081;
					float: left;
					width: 107px;
				}
				.date_val {
					float: left;
					width: 192px !important;
				}
				.select_date {
					float: left;
					width: 100%;
				}
				.price_main {
					float: left;
					width: 100%;
				}
				.hotel_left {
					float: left;
					width: 100%;
					padding-right: 15px;
					margin-right: 15px;
				}
				.hotel_amenities {
					float: left;
					width: 100%;
					margin: 20px 0 0;
				}
				.hotel_amenities li {
					font-size: 17px;
				}
				.slider .slides {
					height: 400px !important;
				}
				.hotel_img {
					margin: 5px;
					display: inline-block;
					width: 150px;
					height: 100px;
					background-color: #fff;
					box-shadow: 0 0 4px 1px;
					padding: 5px;
				}
			</style>
		
		<div class="row">
			<div class="hotel_detail_main">
				<span class="b-close close_btn" style="display:none;"><i class="material-icons">close</i></span>
				<div class="hotel_left">
				<div class="hotel_detail hotel_detail_w60">
					
					<div class="detal_1">
						<b class="hotel_name">'.$Hotel->hotel_name.'</b>
						<div class="hotel_rating">
						   <ul>';
								
								for($i = 0; $i < $star; $i++){
									$hotel_view .= '<li><img src="'.url('public/asset/images/icon/star.png').'"/></li>';
								}
							$hotel_view .= '</ul>
						</div>
						
						<ul class="ho_contact_detail">
							<li>
								<i class="material-icons">account_balance</i> 
								<b>'.$Hotel->address.', '.$Hotel->city.', '.$Hotel->region.', '.$Hotel->country.'</b>
							</li>
						</ul>
					</div>
				</div>
				'.$hotel_price.'
				<div class="hotel_gallery hotel_detail_w60" style="">
					<div class="slider1">
						<ul class="slides mt-2">
							<li class="hotel_img">
								<a href="'.url('/storage/app/'.$Hotel->hotel_image).'" target="_blank"><img src="'.url('/storage/app/'.$Hotel->hotel_image).'" alt="'.$Hotel->hotel_name.'" style="width:100%; height:100%;"></a>
							</li>';
							if($hotelgalleries){
								foreach($hotelgalleries as $hotelgallery){
									$hotel_view .= '<li class="hotel_img">
										<a href="'.url('/storage/app/'.$hotelgallery->image).'" target="_blank"><img src="'.url('/storage/app/'.$hotelgallery->image).'" alt="'.$Hotel->hotel_name.'" style="width:100%; height:100%;"></a>
									</li>';
								}
							}
	  
						$hotel_view .= '</ul>
					  </div>
					</div>
				</div>
				<div class="hotel_amenities hotel_detail_w40">
					<b class="tarif_text">Amenities: </b>';
					if($hotelgalleries){
					$hotel_view .= '<ul class="amenities_lest">';
						foreach($hotelamenity  as $h_amenity){
							$hotel_view .= '<li>'.$h_amenity->name.'</li>';
						}
					$hotel_view .= '</ul>';
					}
				$hotel_view .= '</div>
			</div>
		</div>';
					
		echo $hotel_view;
	}
	
	/**
     * Show the form for make quotation.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateQuotationRate(Request $request)
    {
		$count = count($request->quorate['id']);
		for($x = 0; $x< $count; $x++){	
			$sendquotationrate = SendQuotationRate::where('id', $request->quorate['id'][$x])->first();
			$sendquotationrate->per_night_cost = $request->quorate['per_night_cost'][$x];
			$sendquotationrate->adult_extra_cost = $request->quorate['adult_extra_cost'][$x];
			$sendquotationrate->one_occupancy_cost = $request->quorate['one_occupancy_cost'][$x];
			$sendquotationrate->child_extra_cost_wd = $request->quorate['child_extra_cost_wd'][$x];
			$sendquotationrate->child_extra_cost_wod = $request->quorate['child_extra_cost_wod'][$x];
			$sendquotationrate->save();
		}
		echo json_encode(array('status'=>true,'msg'=>'Updated Quotation'));
    }
	
	/**
     * Make the total day and night text
     *
     * @param  $to_date, $from_date
     * @return String
     */
    public function makeTotalDayNightText($from_date, $to_date){
		//dd('from_date = '.$from_date.' to_date = '.$to_date);
		$from_date = new DateTime($from_date);
		$to_date = new DateTime($to_date);
		
		$difference = $from_date->diff($to_date);
		//$difference = json_encode($difference);
		//dd($difference);
		//dd('from_date = '.$from_date.' to_date = '.$to_date.' result='.$difference->days);
		$night = str_pad($difference->days, 2, '0', STR_PAD_LEFT);
		$day = str_pad($difference->days+1, 2, '0', STR_PAD_LEFT);
		return $night.' Night '.$day.' Days Package';
    }
	
	/**
     * Get room type name
     *
     * @param  $room_type_id
     * @return String
     */
    public function getRoomTypeNameById($room_type_id){
		$RoomType = RoomTypes::where('id', $room_type_id)->first();
		return $RoomType->room_type;
    }
	
	/**
     * This function use for get hotels by city id
     *
     * @return html
     */
    public function getHotelRoomTypeByIdITI(Request $request){
		DB::enableQueryLog();
        $roomtypes = RoomCategory::where('hotel_id', $request->hotel_id)->get();
		$que = DB::getQueryLog();
            $html = '<option value="">Select Room Type</option>';
        foreach($roomtypes as $roomtype){
            $html .= '<option value="'.$roomtype->room_type_id.'">'.$roomtype->type.' ('.$roomtype->name.')</option>';
        }
        //$html .= "</select>";
        echo $html;
    }
	
	
	/**
     * Save add room booking
     *
     * @param  $request, $send_quotation_no
     * @return boolean@@@
     */
    public function addRoomBookedActionByVoucher($request, $send_quotation_no){
        try {
			$new_booking_status = RoomBookedDetails::where('send_quotation_no',$send_quotation_no)->delete();
			
			RoomInventory::where('send_quotation_no',$send_quotation_no)->delete();
			$noof_cat = count($request->daywaise['room_type']);
			$hotel_operators = Operator::select('email')->where('hotel', $request->hotel)->pluck('email')->toArray();
			if(!$hotel_operators){
				$hotel_operators = [];
			}
			$checkroominv = session()->get('operator.room_inventory');
			$id = session()->get('operator.id');
			$log_operator = Operator::where('id', $id)->first();
			$log_operator_email = $log_operator->email;
			$parent_booking_no = substr(rand(0,time()),3);//str_pad(rand(0,999999), 6, "0", STR_PAD_LEFT);
			
			$final_checkin = current($request->daywaise['checkin']);
			$final_checkout = $request->daywaise['checkout'][count($request->daywaise['checkout'])-1];
			$staying_day = 0; 
			for($x=0; $x<$noof_cat; $x++){
				
				// Add Booking Details				
				$client_name = $request->name;
				$total_rooms = array_sum($request->daywaise['rooms']);
				$booked_no = substr(rand(0,time()),3);//str_pad(rand(0,9999), 4, "0", STR_PAD_LEFT);
				$RoomBookedDetails = new RoomBookedDetails();
				$RoomBookedDetails->booked_no = $booked_no;
				$RoomBookedDetails->parent_booking_no = $parent_booking_no;
				$RoomBookedDetails->send_quotation_no = $send_quotation_no;
				$RoomBookedDetails->hotel = $request->hotel;
				$RoomBookedDetails->room_type = $request->daywaise['room_type'][$x];
				$RoomBookedDetails->noofrooms = $request->daywaise['rooms'][$x];
				$RoomBookedDetails->check_in = $final_checkin;//$request->daywaise['checkin'][$x];
				$RoomBookedDetails->check_out = $final_checkout;//$request->daywaise['checkout'][$x];
				$RoomBookedDetails->client_name = $client_name;
				$RoomBookedDetails->agent_name = $request->agent_name;
				$RoomBookedDetails->total_rooms = $total_rooms;
				$RoomBookedDetails->plan = $request->daywaise['meal_type'][$x];
				$RoomBookedDetails->adults = $request->daywaise['adult'][$x];
				$RoomBookedDetails->kidswd = $request->daywaise['kids'][$x];
				$RoomBookedDetails->kidswod = $request->daywaise['kidswod'][$x];
				$RoomBookedDetails->infant = $request->daywaise['infant'][$x];
				$RoomBookedDetails->booking_from = $request->booking_from;
				$RoomBookedDetails->source = $request->source;
				$RoomBookedDetails->confirmed_by = $request->confirmed_by;
				if($request->total_price != ''){
					$RoomBookedDetails->total_bill = $request->total_price;
				}elseif($request->final_cost != ''){
					$RoomBookedDetails->total_bill = $request->final_cost;
				}else{
					$RoomBookedDetails->total_bill = $request->cost; 
				}				
				$RoomBookedDetails->advance_amount = $request->advance_received;
				$RoomBookedDetails->payment_source = $request->payment_source;
				$RoomBookedDetails->date_of_advance = $request->date_of_advance;
				$RoomBookedDetails->booking_status = $request->booking_status;
				$RoomBookedDetails->payment_snapshot = $request->payment_snapshot;
				$RoomBookedDetails->comment = $request->comment;
				$RoomBookedDetails->comment_for_balace = $request->voucher_note;
				$RoomBookedDetails->save();
				
				// Add inventory
				$check_in = $request->daywaise['checkin'][$x];
				$check_out_array = $request->daywaise['checkout'];
				$check_out = end($check_out_array);
				$check_out_last = date('Y-m-d', strtotime($check_out));
				$check_out = $request->daywaise['checkout'][$x]; //date('Y-m-d', strtotime($check_out));
				$date = $check_in;
				
				for($day = 1; $date < $check_out; $day++){ 
					$contractDateBegin = date('Y-m-d', strtotime($check_in));
					$contractDateEnd = date('Y-m-d', strtotime($check_out_last));
					if(($date >= $contractDateBegin) && ($date <= $contractDateEnd)){ 
						$staying_day ++;
					}
					$RoomInventory = new RoomInventory();
					$RoomInventory->room_booked_id = $RoomBookedDetails->booked_no;
					$RoomInventory->parent_booking_no = $RoomBookedDetails->parent_booking_no;
					$RoomInventory->send_quotation_no = $RoomBookedDetails->send_quotation_no;
					$RoomInventory->year = date('Y', strtotime($date));
					$RoomInventory->month = date('m', strtotime($date));
					$RoomInventory->date = $date;
					$RoomInventory->hotel_id = $RoomBookedDetails->hotel;
					$RoomInventory->room_cat_id = $RoomBookedDetails->room_type;
					$RoomInventory->plan = $RoomBookedDetails->plan;
					$RoomInventory->no_of_room = $RoomBookedDetails->noofrooms;
					$RoomInventory->source = $request->source;
					$RoomInventory->booking_status = $RoomBookedDetails->booking_status;
					$RoomInventory->staying_day = $staying_day;
					$RoomInventory->adult = $request->daywaise['adult'][$x];
					$RoomInventory->kids = $request->daywaise['kids'][$x]+$request->daywaise['kidswod'][$x];
					$RoomInventory->infant = $request->daywaise['infant'][$x];
					$RoomInventory->save(); 
					
					$date = date('Y-m-d', strtotime("+1 day", strtotime($date)));
				}
			}
			$heading = 'A new booking has been added with below details:';
			if(!$new_booking_status){
				$this->sendNewRoomInventoryAlert($RoomBookedDetails->parent_booking_no, $heading, $hotel_operators);
			}
			return true;
			
        } catch (ModelNotFoundException $e) {
            return $e;
        }
    }
	
	
	/**
     * Show the form for genearte send quotation.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function generateSendQuotation(Request $request)
    { 
		//dd($request->all());room_inventory_checkbox
		DB::beginTransaction();

		try {
			// Check room type not blank
			foreach($request->daywaise['room_type'] as $room_type){
				if($room_type == ''){
					echo json_encode(array('status'=>false,'msg'=>'Roome Type Is Required!'));
					exit; 
				}
			}
			
			
			$final_checkin = $request->daywaise['checkin'][0];
			$final_checkout = $request->daywaise['checkout'];
			
			$final_checkout = end($final_checkout);
			if($final_checkin == $final_checkout){
				$final_checkin = $request->daywaise['checkin'];
				$final_checkin = end($final_checkin);
				$final_checkout = $request->daywaise['checkout'][0];
			}
			
			
			//dd($final_checkin);
			$operator_id = session()->get('operator.id');
			$company_id = session()->get('operator.company_id');
			$property_id = session()->get('operator.property_id');
			$hotel = $this->getHotelDetailsById($request->hotel);
			if($request->send_quotation_no != ''){
				$send_quotation_no = $request->send_quotation_no; 
				//SendQuotation::where('send_quotation_no',$send_quotation_no)->delete();
				$lead = Lead::where('send_quotation_no',$request->send_quotation_no)->first();
			}else{
				$send_quotation_no = 'ENS'.mt_rand(100000, 999999);
				$lead_count = Lead::whereDate('created_at', Carbon::today())->count();
				$lead_no = 'ENS'.date('ymd').sprintf("%03d", $lead_count);
				
				// Add Lead
				$request->name = $request->ff_c_name.$request->name;
				$lead = new Lead();
				$lead->lead_no = $lead_no;
				$lead->send_quotation_no = $send_quotation_no;
				$lead->name = $request->name;
				$lead->mobile = $request->mobile;
				if(!empty($request->email)){
					$lead->email = $request->email;
				}
				$lead->hotel_id = $request->hotel;
				$lead->location = $hotel->googleaddress;
				$lead->country_id = $hotel->country_id;
				$lead->region_id = $hotel->region_id;
				$lead->city_id = $hotel->city_id;
				$lead->start_date = $request->daywaise['checkin'][0];
				$lead->end_date = $request->daywaise['checkout'][0];
				$lead->no_nights = $request->daywaise['night'][0];
				$lead->no_room = $request->daywaise['rooms'][0];
				$lead->pax = $request->daywaise['adult'][0];
				$lead->kids = $request->daywaise['kids'][0]+$request->daywaise['kidswod'][0];
				$lead->infant = $request->daywaise['infant'][0]; 
				$lead->status = 'ACTIVE';//'INACTIVE';
				$lead->assign_to = $operator_id[0];
				$lead->lead_status = 'SENDQUOTATION';
				$lead->company_id = $company_id;
				$lead->property_id = $property_id;
				$lead->user_id = $operator_id;
				$lead->save();
				
				// Add Contact
				$create_contact = new Contacts();
                $create_contact->mobile        =   $request->mobile;
                $create_contact->email         =   $request->email;
                $create_contact->name          =   $request->name;
                $create_contact->location      =   $hotel->googleaddress;  
                /*if($request->customer_type =='B2B'){ $contact_type = 'Travel Agent';}else if($request->customer_type =='B2C' ) {$contact_type = 'Direct';}else{$contact_type = 'Referred';}*/
                $create_contact->source        =   'SENDQUOTATION';
                $create_contact->last_lead_no  =   $lead_no;
                $create_contact->lead_count    =   1;
                $create_contact->status        =   'ACTIVE';
				$create_contact->company_id = $company_id;
				$create_contact->property_id = $property_id;
				$create_contact->user_id = $operator_id;
                $create_contact->save();
				
				// Add agent contact
				$agent_contact = $this->checkAgentContact($request->agent_email, $request->agent_mobile);
				if($agent_contact == 0){
					$agent_contact = new AgentContact(); 
					$agent_contact->send_quotation_no        =   $request->send_quotation_no;
					$agent_contact->name        =   $request->agent_name;
					$agent_contact->mobile      =   $request->agent_mobile;
					$agent_contact->email       =   $request->agent_email;
					$agent_contact->save(); 
				}
				
				// Send Email For Create Lead
				$message = 'Dear '.$request->name.', <br>
				
							Greetings from Ensober Hotels. Thank You for choosing Us.
							We have received your query "For '.$hotel->hotel_name.'".<br> Our Team will be in touch to serve you seamlessly, we will share the required information soon.<br><br>
							Regards,<br>
							Ensober Reservation Team';
							
				$comment = "Room: ".$request->daywaise['rooms'][0]."<br>";
				$comment .= "Night: ".$request->daywaise['night'][0]."<br>";
				$comment .= "Adult: ".$request->daywaise['adult'][0]."<br>";
				$comment .= "Kids With Bed: ".$request->daywaise['kids'][0]."<br>";
				$comment .= "Kids Without Bed: ".$request->daywaise['kidswod'][0]."<br>";
				
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
							<th>FollowUp</th>
						  </tr>';
						  $newlead .= '<tr>
											<td>'.$lead_no.'</td>
											<td> '.$hotel->hotel_name.'</td>
											<td> '.$request->name.'</td>
											<td> '.$request->mobile.'</td>
											<td> NA </td>
											<td>
												'.$comment.'
											</td>
											<td>NA</td>
											<td>
												On '.$request->daywaise['checkin'][0].'
											</td>	
											<td>
												<a href="/operator/lead/followup/'.$lead->id.'" target="_blank"> FollowUp </a>
											</td>
										  </tr>';
						$newlead .= '</table>

						</body>
						</html>';
				$subject = 'Thank you for your interest in the Ensober, Lead No - '.$lead_no;
				
				if($request->send_quotation_no == ''){ 
				// Send to admin
				$this->sendAdmin($newlead, 'New Lead Created - '.$lead_no.', '.$request->name, 'Sales@ensoberhotels.com');
				
				// Send to Customer
				$this->send($message, $subject, 'Sales@ensoberhotels.com', $request->email);
				}
			}
			// Create QRCode
// 			\QrCode::size(500)
// 			->format('png')
// 			->generate('/storage/app/quotations/'.$send_quotation_no.'.pdf', public_path('qrcodes/'.$send_quotation_no.'_qrcode.png'));
			
			
			// Add room booking code
			if($request->has('room_inventory_checkbox')){
				$this->addRoomBookedActionByVoucher($request, $send_quotation_no);
			}
			// \Add room booking code
			
			$email_body = 'Dear Guest,<br>
							Please find attached the booking details as per your travel plan.<br>
							For any further assistance please feel free to contact us as per the details given. 
							We assure you of the best of our services and attention at all time!<br><br>
							Regards,<br>';
			$lead->send_quotation_no = $send_quotation_no;
			$lead->name = $request->name;
			$lead->mobile = $request->mobile;
			$lead->email = $request->email;
			$lead->status = 'ACTIVE';//'INACTIVE';
			$lead->lead_status = 'SENDQUOTATION';
			$lead->save(); 
			
			$hotelamenity = HotelAmenity::select('name','image','paid_status')
                            ->join('amenities', 'amenities.id', '=', 'hotel_amenities.amenity_id')
                            ->where('hotel_amenities.hotel_id', $request->hotel)
                            ->get();
			
			$count = count($request->daywaise['checkin']);
			
			$quotation_rate = '<form class="quotation_rate" id="quotation_rate" method="post" action=""><input type="hidden" value="" name="total_price" id="total_price" /><table style="font-size:12px; margin:10px 0px 5px;" class="dayhotelrate body">
									<tbody>
										<tr> 
											<th>Room Rate</th>
											<th title="One Occupancy Discount">Single Ocpncy Discount</th>
											<th>Extra Adult</th>
											<th title="Kids Without Bed Charge">Kids W-Bed</th>
											<th title="Kids Without Bed Charge">Kids Wo-Bed</th>
											<th>Total Cost</th>
										</tr>'; 
			$send_quo_rate_details = '';
			
			//SendQuotationRate::where('send_quotation_no',$send_quotation_no)->delete();
			//SendQuotation::where('send_quotation_no',$send_quotation_no)->delete();
			$total_cost = [];
			for($x = 0; $x< $count; $x++){	
				
				// Hotel rate canculation
				$hotel_rate = $this->GetSeasonHotelRate($request->daywaise['checkin'][$x], $request->hotel, $request->daywaise['room_type'][$x]);
				//dd($hotel_rate);
				$cost = '--';
				if($hotel_rate['status'] == true){
					if($x == 0){
						SendQuotationRate::where('send_quotation_no',$send_quotation_no)->delete();
						SendQuotation::where('send_quotation_no',$send_quotation_no)->delete();
						//dd('dfgfdg');
					}
					if($request->has('quorate')){
						$meal_type = $request->daywaise['meal_type'][$x];
						$per_night_cost = $request->quorate['per_night_cost'][$x];
						//$cost = $per_night_cost*$request->daywaise['night'][$x];
						
						$noofroom = $request->daywaise['rooms'][$x];
						$noofnight = $request->daywaise['night'][$x];
						$noofadult = $request->daywaise['adult'][$x];
						$noofextchieldwbad = $request->daywaise['kids'][$x];
						$noofextchieldwobad = $request->daywaise['kidswod'][$x];
						$adult_extra_cost = $request->quorate['adult_extra_cost'][$x];
						$one_occupancy_cost = $request->quorate['one_occupancy_cost'][$x];
						$child_extra_cost_wd = $request->quorate['child_extra_cost_wd'][$x];
						$child_extra_cost_wod = $request->quorate['child_extra_cost_wod'][$x];
						
						$cost_data = $this->NainitalCalculateTotalCost($noofroom,$noofnight,$noofadult,$noofextchieldwbad,$noofextchieldwobad,$per_night_cost,$adult_extra_cost,$one_occupancy_cost,$child_extra_cost_wd,$child_extra_cost_wod,$request->quorate['id'][$x]);
						$cost = $cost_data['total_cost'];
						$quo_discount = $cost_data['discount'];
						
						// Show rate for customer
						$adult_extra_cost_func = $cost_data['extra_adult_cost'];
						$one_occupancy_cost_func = $cost_data['single_occupancy_cost'];
						$child_extra_cost_wd_func = $cost_data['extra_chield_wbad_cost'];
						$child_extra_cost_wod_func = $cost_data['extra_chield_wobad_cost'];
					}else{ 
						$meal_type = $request->daywaise['meal_type'][$x];
						$per_night_cost = $hotel_rate['hotelseasonrate']->$meal_type;
						//$cost = $per_night_cost*$request->daywaise['night'][$x];
						$noofroom = $request->daywaise['rooms'][$x];
						$noofnight = $request->daywaise['night'][$x];
						$noofadult = $request->daywaise['adult'][$x];
						$noofextchieldwbad = $request->daywaise['kids'][$x];
						$noofextchieldwobad = $request->daywaise['kidswod'][$x];
						
						$adult_extra_cost_f = $per_night_cost*$hotel->adult_extra_cost/100;
						$one_occupancy_cost_f = $per_night_cost*$hotel->one_occupancy_cost/100;
						$child_extra_cost_wd_f = $per_night_cost*$hotel->child_extra_cost/100;
						$child_extra_cost_wod_f = $per_night_cost*$hotel->child_extra_cost_wod/100;
						
						$cost_data = $this->NainitalCalculateTotalCost($noofroom,$noofnight,$noofadult,$noofextchieldwbad,$noofextchieldwobad,$per_night_cost,$adult_extra_cost_f,$one_occupancy_cost_f,$child_extra_cost_wd_f,$child_extra_cost_wod_f);
						$cost = $cost_data['total_cost'];
						$quo_discount = 0;
						
						// Show rate for customer  
						$adult_extra_cost_func = $cost_data['extra_adult_cost'];
						$one_occupancy_cost_func = $cost_data['single_occupancy_cost'];
						$child_extra_cost_wd_func = $cost_data['extra_chield_wbad_cost'];
						$child_extra_cost_wod_func = $cost_data['extra_chield_wobad_cost'];
						
						$adult_extra_cost = $per_night_cost*$hotel->adult_extra_cost/100*$request->daywaise['night'][$x];
						$one_occupancy_cost = $per_night_cost*$hotel->one_occupancy_cost/100*$request->daywaise['night'][$x];
						$child_extra_cost_wd = $per_night_cost*$hotel->child_extra_cost/100*$request->daywaise['night'][$x];
						$child_extra_cost_wod = $per_night_cost*$hotel->child_extra_cost_wod/100*$request->daywaise['night'][$x];
					}
					
					$adult_extra_cost_class = '';
					$child_extra_cost_wd_class = '';
					$child_extra_cost_wod_class = '';
					$one_occupancy_cost_class = '';
					if($adult_extra_cost_func == 0){
						$adult_extra_cost_class = 'style="background-color: #ff000040;"';
					}
					if($child_extra_cost_wd_func == 0){
						$child_extra_cost_wd_class = 'style="background-color: #ff000040;"';
					}
					if($child_extra_cost_wod_func == 0){
						$child_extra_cost_wod_class = 'style="background-color: #ff000040;"';
					}
					if($one_occupancy_cost_func == 0){
						$one_occupancy_cost_class = 'style="background-color: #ff000040;"';
					}
					//dd($one_occupancy_cost_func);
					$old_cost = $cost+$quo_discount;
					if($request->has('room_inventory_checkbox')){
						$room_inventory_checkbox = $request->room_inventory_checkbox;
					}else{
						$room_inventory_checkbox = 'N';
					}
					
					// Add Quotation
					$total_cost[] = $cost;
					$per_night_costs[] = $per_night_cost;
					if($request->HasFile('payment_snapshot')){
						$path = $request->file('payment_snapshot')->store('snapshot');
						//dd('image upload');
					}else{
						$path = '';
					}
					$sendquotation = new SendQuotation(); 
					$sendquotation->destination = $request->destination;
					$sendquotation->send_quotation_no = $send_quotation_no;
					$sendquotation->hotel_id = $request->hotel;
					$sendquotation->name = $request->name;
					$sendquotation->mobile = $request->mobile;
					$sendquotation->email = $request->email;
					if($request->final_cost > 0){
						$sendquotation->final_cost = $request->final_cost;
						$old_cost = $request->final_cost;
					}
					$sendquotation->checkin = $request->daywaise['checkin'][$x];
					$sendquotation->checkout = $request->daywaise['checkout'][$x];
					$sendquotation->room_type = $request->daywaise['room_type'][$x];
					$sendquotation->meal_type = $request->daywaise['meal_type'][$x];
					$sendquotation->rooms = $request->daywaise['rooms'][$x];
					$sendquotation->night = $request->daywaise['night'][$x];
					$sendquotation->adult = $request->daywaise['adult'][$x];
					$sendquotation->kids = $request->daywaise['kids'][$x]+$request->daywaise['kidswod'][$x]; 
					$sendquotation->kidswd = $request->daywaise['kids'][$x];
					$sendquotation->kidswod = $request->daywaise['kidswod'][$x];
					$sendquotation->infant = $request->daywaise['infant'][$x];
					$sendquotation->discount = $request->discount;
					$sendquotation->per_night_cost = $per_night_cost;
					$sendquotation->cost = $cost;
					$sendquotation->quotation_type = $request->quotation_type;
					$sendquotation->agent_name = $request->agent_name;
					$sendquotation->agent_mobile      =   $request->agent_mobile;
					$sendquotation->agent_email       =   $request->agent_email;
					$sendquotation->confirmed_by = $request->confirmed_by;
					$sendquotation->advance_received = $request->advance_received;
					$sendquotation->balance = $request->balance;
					$sendquotation->voucher_note = $request->voucher_note;
					$sendquotation->quotation_note = $request->quotation_note;
					$sendquotation->quotation_note_status = 1;
					
					$sendquotation->room_inventory_checkbox = $room_inventory_checkbox;
					$sendquotation->booking_from = $request->booking_from;
					$sendquotation->source = $request->source;
					$sendquotation->payment_source = $request->payment_source;
					$sendquotation->date_of_advance = $request->date_of_advance;
					$sendquotation->booking_status = $request->booking_status;
					$sendquotation->comment = $request->comment;
					$sendquotation->payment_snapshot = $request->payment_snapshot;
					$sendquotation->status = 'ACTIVE';
					$sendquotation->indexing = $x;
					$sendquotation->company_id = $company_id;
					$sendquotation->property_id = $property_id;
					$sendquotation->user_id = $operator_id;
					$sendquotation->save();
					
					$open_img_popup = 0;
					
					if($sendquotation->quotation_type == 'voucher' && $sendquotation->payment_snapshot == ''){
						$open_img_popup = 1;
					}
					
					// Add quotation rate
					$sendquotationrate = new SendQuotationRate();
					$sendquotationrate->send_quotation_no = $send_quotation_no;
					$sendquotationrate->send_quotation_id = $sendquotation->id;
					$sendquotationrate->check_in = $request->daywaise['checkin'][$x];
					$sendquotationrate->hotel_id = $request->hotel;
					$sendquotationrate->room_type_id = $request->daywaise['room_type'][$x];
					$sendquotationrate->meal_type = $request->daywaise['meal_type'][$x];
					$sendquotationrate->per_night_cost = $per_night_cost;
					$sendquotationrate->adult_extra_cost = $adult_extra_cost;
					$sendquotationrate->one_occupancy_cost = $one_occupancy_cost;
					$sendquotationrate->child_extra_cost_wd = $child_extra_cost_wd;
					$sendquotationrate->child_extra_cost_wod = $child_extra_cost_wod;
					$sendquotationrate->cost = $old_cost;
					$sendquotationrate->offer_cost = $cost;
					$sendquotationrate->discount = $quo_discount;
					$sendquotationrate->save();
					
					$meal_plane_title = explode('_',$request->daywaise['meal_type'][$x]);
					$quotation_rate .= '<tr title="'.$this->getRoomTypeNameById($request->daywaise['room_type'][$x]).'-'.strtoupper($meal_plane_title[0]).'">
								<td>
									<span class="quo_show_fiels">'.$per_night_cost.'</span>
									<input type="number" value="'.$per_night_cost.'" style="width: 53px !important;padding: 0px !important; height: 20px !important; text-align: center;display:none;" class="quo_edit_fiels" name="quorate[per_night_cost][]" />

									<input type="hidden" value="'.$sendquotationrate->id.'" class="quo_edit_fiels" name="quorate[id][]" />
								</td> 
								<td '.$one_occupancy_cost_class.'>
									<span class="quo_show_fiels">'.$one_occupancy_cost.'</span>
									<input type="number" value="'.$one_occupancy_cost.'" style="width: 53px !important;padding: 0px !important; height: 20px !important; text-align: center;display:none;" name="quorate[one_occupancy_cost][]" class="quo_edit_fiels" />
								</td>
								<td '.@$adult_extra_cost_class.'>
									<span class="quo_show_fiels">'.$adult_extra_cost.'</span>
									<input type="number" value="'.$adult_extra_cost.'" style="width: 53px !important;padding: 0px !important; height: 20px !important; text-align: center;display:none;" name="quorate[adult_extra_cost][]" class="quo_edit_fiels" />
								</td>
								<td '.@$child_extra_cost_wd_class.'>
									<span class="quo_show_fiels">'.$child_extra_cost_wd.'</span>
									<input type="number" value="'.$child_extra_cost_wd.'" style="width: 53px !important;padding: 0px !important; height: 20px !important; text-align: center;display:none;" name="quorate[child_extra_cost_wd][]" class="quo_edit_fiels" />
								</td>
								<td '.@$child_extra_cost_wod_class.'>
									<span class="quo_show_fiels">'.$child_extra_cost_wod.'</span>
									<input type="number" value="'.$child_extra_cost_wod.'" style="width: 53px !important;padding: 0px !important; height: 20px !important; text-align: center; display:none;" name="quorate[child_extra_cost_wod][]" class="quo_edit_fiels" /> 
								</td>
								<td>'.$cost.'</td> 
							</tr>';
							
							$send_quo_rate_details .= '<table class="body">
							<tr style="background-color: #cd8445;color: #fff;">
								<td> 
									<span style="font-size: 14px;"><b> &nbsp; &nbsp;  Check In: '.date("d M'y", strtotime($request->daywaise['checkin'][$x])).'</b></span>
								</td>
								<td colspan="2">
									<span style="font-size: 14px;"><b>Check Out: '.date("d M'y", strtotime($request->daywaise['checkout'][$x])).'</b></span>
								</td>
								<td>
									
								</td>
								<td>
									
								</td>
								<td>
									
								</td>
							</tr>
							<tr>
								<td colspan="6">';
									if($request->quotation_type == 'voucher'){
										$send_quo_rate_details .= '<table style="font-size:14px; margin:10px 0px;" class="dayhotelrate body">
											<tr>
												<td>Room Type</td>
												<td>'.$this->getRoomTypeById($request->hotel,$request->daywaise['room_type'][$x]).'</td>
											</tr>
											<tr>
												<td>Agent Name</td>
												<td>'.$request->agent_name.'</td>
											</tr>
											<tr>
												<td>Confirmation No. / Confirmed By</td>
												<td>'.$request->confirmed_by.'</td>
											</tr>
											<tr>
												<td>Meal Plan</td>
												<td>'.$this->getMealFullNameByCode($request->daywaise['meal_type'][$x]).'</td>
											</tr>
											<tr>
												<td>Room</td>
												<td>'.str_pad($request->daywaise['rooms'][$x], 2, '0', STR_PAD_LEFT).'</td>
											</tr>
											<tr>
												<td>Nights</td>
												<td>'.str_pad($request->daywaise['night'][$x], 2, '0', STR_PAD_LEFT).'</td>
											</tr>
											<tr>
												<td>Adults</td>
												<td>'.str_pad($request->daywaise['adult'][$x], 2, '0', STR_PAD_LEFT).'</td>
											</tr>
											<tr>
												<td>Kids</td>
												<td>'.str_pad($request->daywaise['kids'][$x]+$request->daywaise['kidswod'][$x], 2, '0', STR_PAD_LEFT).'</td>
											</tr>
											<tr>
												<td>Infant</td>
												<td>'.str_pad($request->daywaise['infant'][$x], 2, '0', STR_PAD_LEFT).'</td>
											</tr>';
											if($request->final_cost <= 0){
												$send_quo_rate_details .= '<tr>
													<td>Room Rate</td>
													<td>'.$per_night_costs[$x].'</td>
												</tr>';
												if($adult_extra_cost_func > 0){
													$send_quo_rate_details .= '
														<td>Extra Adult</td>
														<td>'.$adult_extra_cost_func.'</td>
													</tr>';
												}
												if($child_extra_cost_wd_func > 0){
													$send_quo_rate_details .= '<tr>
														<td title="Kids With Bed Charge">Kids W-Bed</td>
														<td>'.$child_extra_cost_wd_func.'</td>
													</tr>';
												}
												if($child_extra_cost_wod_func > 0){
													$send_quo_rate_details .= '<tr>
														<td title="Kids Without Bed Charge">Kids Wo-Bed</td>
														<td>'.$child_extra_cost_wod_func .'</td>
													</tr>';
												}
												
											}
											
											$send_quo_rate_details .= '</table>';
									}else{
										$send_quo_rate_details .= '<table style="font-size:12px; margin:10px 0px;" class="dayhotelrate body">
											<tr>
												<th>Room Type</th>
												<th>Meal Plan</th>
												<th>Room</th>
												<th>Nights</th>
												<th>Adults</th>
												<th>Kids</th>
												<th>Infant</th>';
												if($request->final_cost <= 0){
													$send_quo_rate_details .= '<th>Room Rate</th>';
													if($adult_extra_cost_func > 0){
													$send_quo_rate_details .= '<th>Extra Adult</th>';
													}
													if($child_extra_cost_wd_func > 0){
													$send_quo_rate_details .= '<th title="Kids With Bed Charge">Kids W-Bed</th>';
													}
													if($child_extra_cost_wod_func > 0){
													$send_quo_rate_details .= '<th title="Kids Without Bed Charge">Kids Wo-Bed</th>';
													}
													$send_quo_rate_details .= '<th>Total Cost</th>';
												}
											$send_quo_rate_details .= '</tr>
											<tr>
												<td>'.$this->getRoomTypeById($request->hotel,$request->daywaise['room_type'][$x]).'</td>
												<td>'.$this->getMealFullNameByCode($request->daywaise['meal_type'][$x]).'</td>
												<td>'.str_pad($request->daywaise['rooms'][$x], 2, '0', STR_PAD_LEFT).'</td>
												<td>'.str_pad($request->daywaise['night'][$x], 2, '0', STR_PAD_LEFT).'</td>
												<td>'.str_pad($request->daywaise['adult'][$x], 2, '0', STR_PAD_LEFT).'</td>
												<td>'.str_pad($request->daywaise['kids'][$x]+$request->daywaise['kidswod'][$x], 2, '0', STR_PAD_LEFT).'</td>
												<td>'.str_pad($request->daywaise['infant'][$x], 2, '0', STR_PAD_LEFT).'</td>';
												
												if($request->final_cost <= 0){
													$send_quo_rate_details .= '<td>'.$per_night_costs[$x].'</td>';
													if($adult_extra_cost_func > 0){
													$send_quo_rate_details .= '<td>'.$adult_extra_cost_func.'</td>';
													}
													if($child_extra_cost_wd_func > 0){
													$send_quo_rate_details .= '<td>'.$child_extra_cost_wd_func.'</td>';
													}
													if($child_extra_cost_wod_func > 0){
													$send_quo_rate_details .= '<td>'.$child_extra_cost_wod_func .'</td>';
													}
													
													$send_quo_rate_details .= '<td>'.$total_cost[$x].'</td>';
												}
											$send_quo_rate_details .= '</tr>
										</table>';
									}
								$send_quo_rate_details .= '</td>
							</tr>
							<tr style="background-color: #cd8445;color: #fff; display:none;">
								<td>
									<span style="font-size: 14px;"><b> &nbsp; &nbsp;  Price: '.$old_cost.'/-</b></span>
								</td>';
								
								if($quo_discount == 0){
									$send_quo_rate_details .= '<td>
										<span style="font-size: 14px;"></span>
									</td>
									<td>
										<span style="font-size: 14px;"></span>
									</td>';
								}else{
									$send_quo_rate_details .= '<td>
										<span style="font-size: 14px;"><b>Discount: '.$quo_discount.'/-</b></span>
									</td>
									<td>
										<span style="font-size: 14px;"><b>Offer Cost: '.$total_cost[$x].'/-</b></span>
									</td>';
								}
								
								$send_quo_rate_details .= '<td>
									
								</td> 
								<td></td>
								<td></td>
							</tr>
						</table><br>';
				}
			
				
			}
			
			$quotation_rate .= '</tbody></table></form>';
			$user=session()->get('operator');
			//dd($user);
			$company=DB::table('sua_company_master')->where('id',$user['company_id'][0])->first();
			//$meals = $this->getNoOfBLD($cp,$map,$ap); 
			if($request->final_cost <= 0){
				$final_cost = array_sum($total_cost);
			}else{
				$final_cost = $request->final_cost;
			}

			// Update total price in booting inventory table
			RoomBookedDetails::where('send_quotation_no', $send_quotation_no)->update(['total_bill' => $final_cost]);
			 
			//$final_cost = $final_cost-$discount;
			$lead_detail = Lead::where('send_quotation_no', $send_quotation_no)->first();
			$quo_detail = SendQuotation::where('send_quotation_no', $send_quotation_no)->with('QuotationRate')->get();
			//dd($send_quotation_no);
			if($request->quotation_type == 'quotation'){
				$subject = $company->company_name.' - Quotation For - '.$hotel->hotel_name.' | '.$lead_detail->name.' | '.date("d M'y", strtotime($quo_detail[0]->checkin)); 
			}elseif($request->quotation_type == 'confirmation'){
				$subject = $company->company_name.' - Confirmation For - '.$hotel->hotel_name.' | '.$lead_detail->name.' | '.date("d M'y", strtotime($quo_detail[0]->checkin)); 
			}elseif($request->quotation_type == 'voucher'){
				$subject = 'Ensober - Reservation Voucher For - '.$hotel->hotel_name.' | '.$lead_detail->name.' | '.date("d M'y", strtotime($quo_detail[0]->checkin)); 
			}
			
			$discount = $request->discount;
			
			$send_quo_html = '<html><head><style>
										td.lable_text {
											text-align: center;
											background-color: #009688;
												color:#fff;
											padding: 5px 0;
										}
										table.footer {
											border-top: 1px solid #555;
											font-size: 13px;
										}
										
										table.header {
											text-align: center;
										}
										table.header tr {
											border:none !important;
										}
										table.body td {
											padding: 0px 0 !important; 
											border:none !important;
										}
										table.body tr { 
											border:none !important;
										}
									
										.bottom_area {
											width: 100%;
											text-align: center;
											padding-top: 24px;
											border-top: 1px solid #555;
											margin-top: 15px;
											margin-bottom: 15px;
										}
										td.lable_text {
											text-align: center;
											background-color: #009688;
											color:#fff;
											padding: 5px 0;
										}
										.hotel_img {
											width: 90px;
											height: 90px;
											border: 1px solid #b3b0b0;
											padding: 5px;
											margin-top: 5px;
										}
										
										table.body {
											width:100%;
											color:#000;
											border-spacing: -1px;
											border:collapse; 
										}
										main123{
											margin-top:140px;
											margin-bottom:150px;
										}
										@page { margin: 0px 0px 100px;} 
										.iti_foo_left {
											display:inline-block;
											height:110px;
											width: 200px;
											text-align: left;
											padding: 20px 10px 0px;
											margin: 10px 0 0;
										}
										.iti_foo_middil {
											display:inline-block;
											width: 230px;
											font-size: 13px;
											padding: 20px 10px 0px;
											text-align: left;
											color: #fff;
											height:110px;
											border-right:0.5px solid #fff;
										}
										.iti_foo_right {
											display:inline-block;
											width: 250px;
											font-size: 13px;
											padding: 20px 10px 0px;
											color: #fff;
											height:110px;
											text-align: right;
										}
										header ul { padding:0px; margin:0px; }
										main ul { padding:0px; margin:0px; }
											
										header {
											height: 100px;
											color: #000;
											text-align: center;
											margin: 0px 0px 5px;
											font-family: sans-serif;
											border-bottom: 2px solid #b46d2e;
										}
										.iti_hea_right {
											float: right;
											width: 250px;
											vertical-align: middle;
											height: 80px;
											padding-top: 20px;
										}
										.iti_hea_left {
											float: left;
											text-align: left;
											padding: 2px 12px;
										}
										footer {
											height: 100px;
											background-color: #b46d2e;
											color: #000;
											text-align: center;
											font-family: sans-serif;
											padding-left: 0px !important;
											margin: 0px 0px;
											position: fixed; 
											bottom: -100px; 
											left: 0px; 
											right: 0px;
										}
										#email_body header{
											position: fixed;
											top: -110px;
											left: 0px;
											right: 0px;
										}
										
										img{max-width:100%;}
										.hotel_rating {
											display: inline-block;
											width: 100%;
											padding: 5px 0;
											margin-left:10px;
										}
										.hotel_rating li {
											display: inline;
											margin: 0 -5px;
										}
										table.dayhotelrate td, th {
											border: 1px solid #555 !important;
											text-align: center;
										}
										table.dayhotelrate th {
											background-color: blanchedalmond;
										}
										td.payment_details p50 {
											width: 47%;
											display: inline-block;
											padding: 15px 10px 0px;
										}
										td.payment_details p100 {
											width: 100%;
											display: inline-block;
											padding: 15px 10px 0px;
										}
									</style></head>

									<body style="width: 770px; margin: 0 auto; font-family: sans-serif;">
										<header>
											<div class="iti_hea_left">';
												if($request->quotation_type == 'quotation'){
													$send_quo_html .= '<span style="font-size:20px;">Quotation </span>'; 
												}elseif($request->quotation_type == 'confirmation'){
													$send_quo_html .= '<span style="font-size:20px;">Confirmation</span>';
												}elseif($request->quotation_type == 'voucher'){
													$send_quo_html .= '<span style="font-size:20px;">Reservation Voucher</span>';
												}
												
												$send_quo_html .= '<ul>
													<li style="line-height: 20px; list-style:none;"><b style="font-size: 14px; ">Name: </b>'.$lead_detail->name.'</li>
													<li style="line-height: 20px; list-style:none;"><b style="font-size: 14px; ">Mobile: </b>'.$lead_detail->mobile.'</li>
													<li style="line-height: 20px; list-style:none; display:none;"><b style="font-size: 14px; ">Email: </b>'.$lead_detail->email.'</li> 
												</ul>
											</div>
											<div class="iti_hea_right">
												Total Amount (INR)<br>
												<span style="font-size: 20px;"><img src="'.url('/public/asset/images/rupee.jpg').'"
												 style="width: 13px; margin-right: -8px;"/> &nbsp;'.$final_cost.'</span> 
											</div>
										</header> 
										
										<footer>
											<div class="iti_foo_left">
												<img src="http://cadmin.hotelthegrandview.com/public/asset/company_logo/'.$company->c_logo.'"/>
											</div>
											<div class="iti_foo_middil">
												<b>'.$company->company_name.'</b><br>
												'. $company->company_name.'
											</div>
											<div class="iti_foo_right">
												<b>Contact Information</b><br>
												Telephone : '. $company->mobile.'  '. $company->phone.'<br>
												Email : '. $company->email.'<br>
												Web: <a href="'. $company->website.'" target="_blank">'. $company->website.'</a>
											</div>
										</footer>
										
										<!-- Wrap the content of your PDF inside a main tag -->
										<main>
											<table class="body">
												<tbody>
												<tr>
													<td width="250px"><b>'.ucfirst($request->quotation_type).' No: </b> <span style="font-size:14px;">'.$lead_detail->send_quotation_no.'</span></td>
													<td style="text-align: center;" width="200px"><b>Create Date: </b> <span style="font-size:14px;">'.date('d M Y').'</span></td>
													<td style="text-align: right;">&nbsp;</td> 
												</tr>
												</tbody>
											</table> <br>
											<!---- ======== Hotel & Rooms Area ======== ------>
											<table class="body">
												<tbody>
												<tr> 
													<td style="font-size:20px;border-bottom: 3px dotted #72534a !important;color: #72534a;"><b>Hotel & Rooms Info</b></td>
												</tr>
												</tbody>
											</table>
											<table class="body">
												<tr>
													<td style="vertical-align: text-bottom;">
														<table class="body">
															<tr>
																<td style="vertical-align:top;" width="215px">
																	<a href="'.$hotel->gallery_link.'" target="_blank"><img src="'.url('/storage/app/'.$hotel->hotel_image).'" style="min-width: 200px;height:140px;  border: 1px solid #b3b0b0; padding: 2px; margin-top: 5px; " /></a>
																</td>
																<td style="vertical-align:top; text-align:left;">
																	<span stype="">
																		<img src="'.url('storage/app/'.$hotel->hotel_logo).'" style="min-width:150px; height:60px;margin-top:10px;background: #ffffff;"/>
																	</span>
																	<br><span><img src="'.url('/public/asset/images/icon/hotel-icon.JPG').'" alt="" style="margin-bottom: -3px;"/></span><b style="font-size: 18px; ">'.$hotel->hotel_name.'</b><br>
																	<div class="hotel_rating">
																		   <ul>';
																		   
																			if($hotel->start_category=="ONE"){
																			   $star=1;
																			}elseif($hotel->start_category=="TWO"){
																				$star=2;
																			}elseif($hotel->start_category=="THREE"){
																				$star=3;
																			}elseif($hotel->start_category=="FOUR"){
																				$star=4;
																			}elseif($hotel->start_category=="FIVE"){
																				$star=5;
																			}
																			for($i = 0; $i < 5; $i++){
																				if($i < $star){
																					$send_quo_html .= '<li>
																						<img src="'.url('/public/asset/images/icon/rated.JPG').'">
																					</li>';
																				}else{
																					$send_quo_html .= '<li>
																						<img src="'.url('/public/asset/images/icon/unrated.JPG').'">
																					</li>';
																				}
																			}
																			$send_quo_html .= '</ul>
																		</div><br>
																		<span><img src="'.url('/public/asset/images/icon/map.JPG').'" alt="" style="margin-bottom: -3px;"/></span><b style="font-size: 18px;">'.$this->getCityNameById($hotel->city_id).' </b>
																</td> 
																<td style="vertical-align:top; text-align:center;"><br>';
																
																$qrCode = base64_encode(QrCode::format('png')->size(120)->generate('https://ensoberfiles.s3.amazonaws.com/quotations/'.$send_quotation_no.'.pdf'));
																
																
																$send_quo_html .= '<img src="data:image/png;base64,'.$qrCode.'"
																	style="height:120px; width:120px; min-width:120px;display:inline-block; text-align: center; margin-top: 10px;" class="url_qrcode" alt=""/>
																</td> 
																<td style="vertical-align:top; text-align:center;">
																	<b style="display:inline-block; font-size: 20px; padding: 20px 0 10px;">'.$this->makeTotalDayNightText($final_checkin, $final_checkout).'</b><br>
																		
																	<b style="display:inline-block; text-align: right;background-color: #b46d2e;padding: 1px 10px;font-size: 16px;border: 1px dashed #e5b991;color: #fff;">Cost: '.$final_cost.'/-</b>
																</td>
															</tr>
														</table> <br>
													</td> 
												</tr>
												<tr>
													<td style="vertical-align: text-bottom;">';
													
														$send_quo_html .= $send_quo_rate_details;
														$send_quo_html .= '</td>
												</tr>
											</table>';
											$payable = $final_cost-$request->advance_received;
											if($request->quotation_type == 'voucher'){
												$send_quo_html .= '<table style="font-size:16px; margin:0px 0 10px;" class="dayhotelrate body">
														<tr>
															<td>Total Cost</td>
															<td>'.$final_cost.'</td>
														</tr>
															<tr>
															<td>Advance Received</td>
															<td>'.$request->advance_received.'</td>
														</tr>
														</tr>
															<tr>
															<td>Balance</td>
															<td>'.$payable.'</td>
														</tr>
												</table>';
											}
											
											
											if($request->quotation_type != 'confirmation' && $request->quotation_type != 'voucher'){
											$send_quo_html .= '<!---- ======== Hotel Amenities/Activities ======== ------>
											<table class="body" style="margin-bottom:5px;">
												<tbody>
												<tr> 
													<td style="font-size:20px;border-bottom: 3px dotted #72534a !important;color: #72534a;"><b>Hotel Amenities/Activities</b></td>
												</tr>
												</tbody>
											</table>
											
											<table class="body">
												<tbody>
												<tr> 
													<td style="">
														<ul style="display: inline-block; text-align:left;">
														';
														foreach($hotelamenity as $amenity){
															$send_quo_html .= '<li style="list-style:none; display: inline-block;vertical-align: middle; text-align:left;"><span style="font-size:15px;display: inline-block;margin: 3px;border: 1px solid #eee;padding: 5px;"><img src="'.url('/storage/app/'.$amenity->image).'"
															 style="vertical-align: middle;width: 35px; margin-right: 10px; display: inline-block;">'.$amenity->name.'</span></li>';
														}
														
													$send_quo_html .= '</ul></td>
												</tr>
												
												</tbody>
											</table> 
											
											<!---- ======== Hotel Amenities/Activities ======== ------>
											<br>';
											}
											
											if($request->quotation_type != 'voucher'){
											$send_quo_html .= '<!---- ======== Payment Instructions ======== ------>
											<table class="body" style="margin-bottom:5px;">
												<tbody>
												<tr> 
													<td style="font-size:20px;border-bottom: 3px dotted #72534a !important;color: #72534a;"><b>Payment Instructions</b></td>
												</tr>
												</tbody>
											</table>
											<table class="body">
												<tr>
													<td style="font-size:14px;" class="payment_details">
														'.$hotel->payment_details.'
													</td>
												</tr>
											</table>
											<!---- ======== Please initiate the payment in below account for final confirmation. ======== ------>';
											}
											$send_quo_html .= '<!---- ======== Cancelation Policy ======== ------>
											<table class="body" style="margin-bottom:5px;">
												<tbody>
												<tr> 
													<td style="font-size:20px;border-bottom: 3px dotted #72534a !important;color: #72534a;"><b>Cancelation Policy:</b></td>
												</tr>
												</tbody>
											</table>
											<table class="body">
												<tr>
													<td style="font-size:14px;">
														'.$hotel->cancelation_policy;
														
														if($request->quotation_type == 'voucher'){
															
															$send_quo_html .= '<br><p>
																			*Kindly follow the Social distancing and Covid-19 guidelines as per Govt.<br>
																			Standard Check In Time : 1:00 PM<br>
																			Standard Check Out Time: 10:00 AM<br>
																			Stay Safe! Stay Healthy!</p>';
																	
															$send_quo_html .= '<br>T&C<br><b style="color:red;">*Balance Payment at Check-In at Resort.</b><br><b>*Food included in Package will be served in Restaurant</b><p>This is a computer generated voucher and does not require signature.</p>';
															
															if($request->voucher_note != ''){
																$send_quo_html .= '<p>Note: "'.$request->voucher_note.'"</p>';
															}
														}
														
														if($request->quotation_note_status == '1'){
															$send_quo_html .= '<br><p>Quotation Note: '.$request->quotation_note.'</p>';
														}
													$send_quo_html .= '</td>
												</tr>
											</table>
											<!---- ======== Cancelation Policy ======== ------>
										</main>
											</body></html>'; 
			DB::commit();
			$this->savePdfQuotation($send_quotation_no,$send_quo_html);
			echo json_encode(array('status'=>true,'msg'=>'Quotation Generated', 'final_cost_val' => $final_cost, 'send_message' => $send_quo_html, 'send_quotation_no' => $send_quotation_no, 'quotation_rate' => $quotation_rate, 'subject' => $subject, 'email_body' => $email_body, 'final_cost' => $request->final_cost, 'open_img_popup' => $open_img_popup)); 
			
			
		} catch (\Exception $e) {
			// something went wrong
			DB::rollback();
			echo json_encode(array('status'=> false,'msg'=>'Quotation Generating Issue! '.$e, 'final_cost_val' => '', 'send_message' => '', 'send_quotation_no' => '', 'quotation_rate' => '', 'subject' => '', 'email_body' => '', 'final_cost' => ''));
		} 
        
    }
	
	
	
	/**
     * download the genearte send quotation.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function downloadSendQuotation($quotation_no){ 
		$quotation = SendQuotation::where('send_quotation_no',$quotation_no)->first();
		$file_name = $quotation->send_quotation_no.$quotation->name.$quotation->checkin.'.'.'pdf';
		$file_name = str_replace('/','-',$file_name);
		$url_array = explode('/',public_path());
		array_pop($url_array);
		$base_url = implode('/',$url_array);
		$file= "storage/app/quotations/".$quotation_no.".pdf"; 
		$file = base_path($file);
		
		if (file_exists($file)) {
			ob_clean();
			$headers = [
				'Content-Type' => 'application/pdf',
			];
			return \Response::download($file, $file_name, $headers);
		}
    }
	
	
	/**
     * Generate the activity voucher.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function generateActivityVoucher(Request $request){ 
		try {
			// Add activity voucher
			$user=session()->get('operator');
			if(@$request->activity_voucher_no != ''){
				$voucher_no = $request->activity_voucher_no;
				$activityvoucher = ActivityVoucher::where('voucher_no', $voucher_no)->first();
			}else{
				$voucher_no = 'ENSAV'.mt_rand(100000, 999999);
				$activityvoucher = new ActivityVoucher();
			}
			
			$activityvoucher->voucher_no = $voucher_no;
			$activityvoucher->destination = $request->destination;
			$activityvoucher->activity_id = $request->activity_id;
			$activityvoucher->date = $request->date;
			$activityvoucher->slot = $request->slot;
			$activityvoucher->time = $request->time;
			$activityvoucher->adults = $request->adult;
			$activityvoucher->chields = $request->kids;
			$activityvoucher->total_visitors = $request->total_visitor;
			$activityvoucher->client_name = $request->ff_c_name.' '.$request->client_name;
			$activityvoucher->email = $request->email;
			$activityvoucher->mobile = $request->mobile;
			$activityvoucher->total_bill = $request->total_bill;
			$activityvoucher->advance_received = $request->advance_received;
			$activityvoucher->balance = $request->total_bill-$request->advance_received;
			$activityvoucher->payment_type = $request->payment_type;
			$activityvoucher->comment = $request->comment;
			$activityvoucher->payment_received_by = $request->payment_received_by;
			$activityvoucher->comment_for_advance = $request->comment_for_advance;
			$activityvoucher->date_of_advance = date('Y-m-d');
			$activityvoucher->vendor_id = $request->vendor_id;
			$activityvoucher->actual_cost = $request->actual_cost;
			$activityvoucher->pickup_point = $request->pickup_point;
			$activityvoucher->ccemail = $request->ccemail;
			$activityvoucher->no_of_jeeps = $request->no_of_jeeps;
			$activityvoucher->company_id = $user['company_id'][0];
			$activityvoucher->property_id = $user['property_id'][0];
			$activityvoucher->save(); 
				
			
			$activity_name = $this->getActivityNameById($request->activity_id);
			$vendor_name = $this->getVendorNameById($request->vendor_id);
			
			// Send Email For Create Lead
			$message = 'Dear '.$request->client_name.', <br> 
			Greetings from Ensober Hotels. Thank You for choosing Us.
			We have received your query "For '.$activity_name.'".<br> Our Team will be in touch to serve you seamlessly, we will share the required information soon.<br><br>
			Regards,<br>
			Ensober Reservation Team';
							
			$new_activ_voucher = 'Dear Admin, <br>';
			$new_activ_voucher .= "Voucher No: ".$voucher_no."<br>";
			$new_activ_voucher .= "Client Name: ".$request->client_name."<br>";
			$new_activ_voucher .= "Total Visitors: ".$request->total_visitor."<br>";
			$new_activ_voucher .= "Avtivity Name: ".$activity_name."<br>";
			$new_activ_voucher .= "Date: ".$request->date."<br>";
			$new_activ_voucher .= "Time: ".ucwords(str_replace('_',' ',$activityvoucher->slot))." ".$request->time."<br>";
			$new_activ_voucher .= "Total Bill: ".$activityvoucher->total_bill."<br>";
			$new_activ_voucher .= "Advance Received: ".$activityvoucher->advance_received."<br>";
			$new_activ_voucher .= "Balance: ".$activityvoucher->balance."<br>";
			$new_activ_voucher .= "<br><br>Regards,<br>
							Ensober Reservation Team";
			
			$subject = 'Thank you for your interest in the Ensober, Activity Voucher No - '.$voucher_no;
			
			if(@$request->activity_voucher_no == ''){
			// Send to admin
			//$this->sendAdmin($new_activ_voucher, 'New Activity Voucher Created - '.$voucher_no.', '.$request->client_name, 'Sales@ensoberhotels.com');
			
			// Send to Customer
			//$this->send($message, $subject, 'Sales@ensoberhotels.com', $request->email);
			}
			$activity = Activity::where('id',$request->activity_id)->with('activityCat')->with('activitySubCat')->first();
			
			$send_quo_html = '<html><head><style>
										td.lable_text {
											text-align: center;
											background-color: #009688;
												color:#fff;
											padding: 5px 0;
										}
										table.footer {
											border-top: 1px solid #555;
											font-size: 13px;
										}
										
										table.header {
											text-align: center;
										}
										table.header tr {
											border:none !important;
										}
										table.body td {
											padding: 0px 0 !important; 
											border:none !important;
										}
										table.body tr { 
											border:none !important;
										}
									
										.bottom_area {
											width: 100%;
											text-align: center;
											padding-top: 24px;
											border-top: 1px solid #555;
											margin-top: 15px;
											margin-bottom: 15px;
										}
										td.lable_text {
											text-align: center;
											background-color: #009688;
											color:#fff;
											padding: 5px 0;
										}
										.hotel_img {
											width: 90px;
											height: 90px;
											border: 1px solid #b3b0b0;
											padding: 5px;
											margin-top: 5px;
										}
										
										table.body {
											width:100%;
											color:#000;
											border-spacing: -1px;
											border:collapse; 
										}
										main123{
											margin-top:140px;
											margin-bottom:150px;
										}
										@page { margin: 0px 0px 100px;} 
										.iti_foo_left {
											display:inline-block;
											height:110px;
											width: 200px;
											text-align: left;
											padding: 20px 10px 0px;
											margin: 10px 0 0;
										}
										.iti_foo_middil {
											display:inline-block;
											width: 230px;
											font-size: 13px;
											padding: 20px 10px 0px;
											text-align: left;
											color: #fff;
											height:110px;
											border-right:0.5px solid #fff;
										}
										.iti_foo_right {
											display:inline-block;
											width: 250px;
											font-size: 13px;
											padding: 20px 10px 0px;
											color: #fff;
											height:110px;
											text-align: right;
										}
										header ul { padding:0px; margin:0px; }
										main ul { padding:0px; margin:0px; }
											
										header {
											height: 100px;
											color: #000;
											text-align: center;
											margin: 0px 0px 5px;
											font-family: sans-serif;
											border-bottom: 2px solid #b46d2e;
										}
										.iti_hea_right {
											float: right;
											width: 250px;
											vertical-align: middle;
											height: 80px;
											padding-top: 20px;
										}
										.iti_hea_left {
											float: left;
											text-align: left;
											padding: 2px 12px;
										}
										footer {
											height: 100px;
											background-color: #b46d2e;
											color: #000;
											text-align: center;
											font-family: sans-serif;
											padding-left: 0px !important;
											margin: 0px 0px;
											position: fixed; 
											bottom: -100px; 
											left: 0px; 
											right: 0px;
										}
										header{
											position: fixed;
											top: -110px;
											left: 0px;
											right: 0px;
											background-size: 100% 100%;
											background-image: url(/asset/images/activity_voucher_header_new.jpg);
											color:#fff;
										}
										
										img{max-width:100%;}
										.hotel_rating {
											display: inline-block;
											width: 100%;
											padding: 5px 0;
											margin-left:10px;
										}
										.hotel_rating li {
											display: inline;
											margin: 0 -5px;
										}
										table.dayhotelrate td, th {
											border: 1px solid #555 !important;
											text-align: center;
										}
										table.dayhotelrate th {
											background-color: blanchedalmond;
										}
										td.payment_details p50 {
											width: 47%;
											display: inline-block;
											padding: 15px 10px 0px;
										}
										td.payment_details p100 {
											width: 100%;
											display: inline-block;
											padding: 15px 10px 0px;
										}
									</style></style></head>

									<body style="width: 770px; margin: 0 auto; font-family: sans-serif;">
										<header>
											<div class="iti_hea_left">';
												$send_quo_html .= '<span style="font-size:20px;"></span>
												
											</div>
											<div class="iti_hea_right">
												 
											</div>
										</header> 
										
										<footer>
											<div class="iti_foo_left">
												<img src="/asset/images/Ensober.jpg"/>
											</div>
											<div class="iti_foo_middil">
												<b>Ensober Hotels</b><br>
												Luxury Hotels in Uttarakhand <br> Corbett | Nainital | Haridwar <br> 
												I-1804, SAMRIDHI GRAND AVENUE, NOIDA, DELHI-NCR
											</div>
											<div class="iti_foo_right">
												<b>Contact Information</b><br>
												Telephone : 8383908656, 8368643151<br>
												Email : raj@ensoberhotels.com; pragya@ensoberhotels.com<br>
												Web: <a href="http://www.ensoberhotels.com/" target="_blank">http://www.ensoberhotels.com/</a>
											</div>
										</footer>
										
										<!-- Wrap the content of your PDF inside a main tag -->
										<main>
											<table class="body">
												<tbody>
												<tr>
													<td width="350px"><b>Confirmation Voucher </b></td>
													<td style="text-align: center;" width="200px"><b>Created Date: </b> <span style="font-size:14px;">'.date('d M Y').'</span></td>
												</tr>
												</tbody>
											</table> <br>
											<!---- ======== Activity Details ======== ------>
											<table class="body">
												<tbody>
												<tr> 
													<td style="font-size:20px;border-bottom: 3px dotted #72534a !important;color: #72534a;"><b>'.$activity->activityCat->activity_cat.' Details</b></td>
												</tr>
												</tbody> 
											</table>
											<table class="body">
												<tr>
													<td style="vertical-align: text-bottom;">
														<table class="body">
															<tr>
																<td style="vertical-align:top;" width="215px">
																	<img src="/storage/app/'.$activity['image'].'" style="min-width: 200px;height:140px;  border: 1px solid #b3b0b0; padding: 2px; margin-top: 5px; " />
																</td> 
																<td style="vertical-align:top; text-align:left;">
																	<b style="display:inline-block; font-size: 18px; padding: 20px 0 10px;">'.$activity->activityCat->activity_cat.': <span style="font-weight:normal;">'.$activity->activitySubCat->activity_subcat.'</span></b><br>
																	<b style="display:inline-block; font-size: 16px; padding: 0px 0 2px;">On Of Jeeps: <span style="font-weight:normal;">'.$request->no_of_jeeps.'</span></b><br>
																	<b style="display:inline-block; font-size: 16px; padding: 0px 0 2px;">Guest: <span style="font-weight:normal;">'.$request->client_name.'</span></b><br>
																	
																	<b style=" font-size: 16px; padding: 0px 0 2px;">Mobile: <span style="font-weight:normal;">'.$request->mobile.'</span></b><br>
																		
																	<b style="display:none; font-size: 16px; padding: 0px 0 2px;">Email: <span style="font-weight:normal;">'.$request->email.'</span></b><br>
																</td>
															</tr>
														</table> <br>
													</td> 
												</tr>
											</table>';
											
											$send_quo_html .= '<table style="font-size:14px; margin:10px 0px;" class="dayhotelrate body">
											<tr> 
												<td>Voucher No</td>
												<td>'.$voucher_no.'</td>
											</tr>
											<tr>
												<td>Guest Name</td>
												<td>'.$request->client_name.'</td>
											</tr>
											<tr>
												<td>Total Visitors</td>
												<td>'.$request->total_visitor.'</td>
											</tr>
											<tr>
												<td>Activity Zone</td>
												<td>'.$activity->activitySubCat->activity_subcat.'</td>
											</tr>
											<tr>
												<td>Date</td>
												<td>'.date('d M Y', strtotime($request->date)).'</td>
											</tr>
											<tr>
												<td>Pickup Time</td>
												<td>'.$activityvoucher->time.'</td>
											</tr>
											<tr>
												<td>Slot</td>
												<td>'.ucwords(str_replace('_',' ',$activityvoucher->slot)).'</td>
											</tr>
											<tr>
												<td>Vendor Name</td>
												<td>'.$vendor_name.'</td>
											</tr>';
											
											$send_quo_html .= '</table>'; 
											
											$send_quo_html .= '<table style="font-size:16px; margin:0px 0 10px;" class="dayhotelrate body">
														<tr>
															<td>Advance Received</td>
															<td>'.$request->advance_received.'</td>
														</tr>';
														if($request->advance_received < $request->total_bill){
															$send_quo_html .= '</tr>
																<tr>
																<td>Balance</td>
																<td>'.$activityvoucher->balance.'</td>
															</tr>';
														}
												$send_quo_html .= '
												<tr>
													<td>Advance Received By</td>
													<td>'.$activityvoucher->payment_received_by.'</td>
												</tr>
												</table>';
											
											$send_quo_html .= '
											<table class="body" style="margin-bottom:5px;">
												<tbody>
												<tr> 
													<td>
														<p>Comment: '.$request->comment.'</p>
													</td>
												</tr>
												</tbody>
											</table>';
											
											$send_quo_html .= '<!---- ======== Cancelation Policy ======== ------>
											<table class="body" style="margin-bottom:5px;">
												<tbody>
												<tr> 
													<td style="font-size:20px;border-bottom: 3px dotted #72534a !important;color: #72534a;"><b>Terms & Conditions:</b></td>
												</tr>
												</tbody>
											</table>
											<table class="body">
												<tr>
													<td style="font-size:14px;">';
								$send_quo_html .= '<b>Please Note:- </b><br>
								<p>1. Visitor Will have to compulsory show their above mentioned Id card at the time of Enrty. Guests have to necessarily get their permits checked at the CTR reception. Also discrepancy in payment, due to any reason have to sorted out before entering the park.</p>
													</td>
												</tr>
											</table>
								<table class="body">
								<tr>
								<td style="font-size:14px;">
								<p>2. No private vehicle would be allowed inside the tourism zone. Visitors are allowed to go in registered vehicle only Green color Gypsy.</p>
								</td>
								</tr>
								</table>

								<table class="body">
								<tr>
								<td style="font-size:14px;">
								<p>3. Any booking for day visit to CTR during rainy season (1st June to 14th Nov.) is provisional and can be cancelled at a short notice depending on the weather condition, to ensure visitors safety. Hence all such bookings during this period are done at visitors risk and no refund can be claimed if it is cancelled due to bad weather conditions.</p>
								</td>
								</tr>
								</table>
								
								<table class="body">
								<tr>
								<td style="font-size:14px;">
								<p>4. Canteen Facility is not available in Sonanadi Zone</p>
								</td>
								</tr>
								</table>
								
								<table class="body">
								<tr>
								<td style="font-size:14px;">
								<b>Rules And Regulations: </b><br>
								</td>
								</tr>
								</table>
								
								<table class="body">
								<tr>
								<td style="font-size:14px;">
								<p>1. All reservations inside the tiger reserve are provisional and can be changed or cancelled without prior information. The decision of director CTR will be final in the matter.</p>
								</td>
								</tr>
								</table>
								
								<table class="body">
								<tr>
								<td style="font-size:14px;">
								<p>2. Carrying of firearms of any kind is not permitted within the Tiger Reserve.</p>
								</td>
								</tr>
								</table>
								
								<table class="body">
								<tr>
								<td style="font-size:14px;">
								<p>3. No pets can be taken inside the Tiger Reserve. </p>
								</td>
								</tr>
								</table>
								
								<table class="body">
								<tr>
								<td style="font-size:14px;">
								<p>4. Walking or trekking is strictly prohibited.</p>
								</td>
								</tr>
								</table>
								
								<table class="body">
								<tr>
								<td style="font-size:14px;">
								<p>5. Driving inside the Tiger Reserve after sunset is prohibited.</p>
								</td>
								</tr>
								</table>
								
								<table class="body">
								<tr>
								<td style="font-size:14px;">
								<p>6. Cooking is not allowed within the Tiger Reserve and at Dhikala and Bijrani tourist complexes. In other rest houses visitors can cook within the provided space. </p>
								</td>
								</tr>
								</table>
								
								<table class="body">
								<tr>
								<td style="font-size:14px;">
								<p>7. Visitors are required to carry a litter bag while entering the Tiger Reserve and bring back their non-biodegradable litter (tin cans, plastic, glass bottles, metal foils etc.) outside the Reserve. Throwing litter inside the Tiger Reserve other than in garbage bins will invite severe penalties.</p>
								</td>
								</tr>
								</table>
								
								<table class="body">
								<tr>
								<td style="font-size:14px;">
								<p>8. Official registered guide is compulsory on all excursions.</p>
								</td>
								</tr>
								</table>
								
								<table class="body">
								<tr>
								<td style="font-size:14px;">
								<p>9. Smoking outside residential complexes/rest houses and lighting of any kind of fire is strictly prohibited.</p>
								</td>
								</tr>
								</table>
								
								<table class="body">
								<tr>
								<td style="font-size:14px;">
								<p>10. Playing of transistors and tape recorders within the Tiger Reserve is strictly prohibited.</p>
								</td>
								</tr>
								</table>
								
								<table class="body">
								<tr>
								<td style="font-size:14px;">
								<p>11. Visitors are prohibited from taking vehicles off the designated routes thereby causing damage to plant or animal life or their habitat.</p>
								</td>
								</tr>
								</table>
								
								<table class="body">
								<tr>
								<td style="font-size:14px;">
								<p>12. Blowing of horns and driving above the speed limit is strictly prohibited within the Tiger Reserve.</p>
								<p>13. Entry into the restricted zone by the visitors is prohibited.</p>
								</td>
								</tr>
								</table>
								
								<table class="body">
								<tr>
								<td style="font-size:14px;">
								<p>14. Shouting, teasing or chasing animals or attempts to feed them are prohibited and will invite severe penalties.</p>
								</td>
								</tr>
								</table>
								
								<table class="body">
								<tr>
								<td style="font-size:14px;">
								<p>15. Visitors are advised to occupy the accommodation as reserved on the first day itself or send prior intimation to hold the accommodation. Otherwise, the reservation will be treated as cancelled.</p>
								</td>
								</tr>
								</table>
								
								<table class="body">
								<tr>
								<td style="font-size:14px;">
								<p>16. Maximum two adults and two children (below 12 years) per room are allowed to stay in the tourism zone. One extra bed can be provided on payment of prescribed charges.</p>
								</td>
								</tr>
								</table>
								
								<br>
								<table class="body dayhotelrate">
								  <tr>
									<th>Zone</th>
									<th>EntryGate</th>
									<th>Morning</th>
									<th>Evening</th>
								  </tr>
								  <tr>
									<td>Bijrani</td>
									<td>Amdanda</td>
									<td>6:15 AM</td>
									<td>2:0 PM</td>
								  </tr>
								  <tr>
									<td>Dhikala</td>
									<td>Dhangari</td>
									<td>6:0 AM</td>
									<td>11:0 AM</td>
								  </tr>
								  <tr>
									<td>Durga Devi</td>
									<td>Durga Devi</td>
									<td>6:15 AM</td>
									<td>2:0 PM</td>
								  </tr>
								  <tr>
									<td>Pakharo</td>
									<td>Pakhro</td>
									<td>5:45 AM</td>
									<td>3:0 PM</td>
								  </tr>
								  <tr>
									<td>Dhela</td>
									<td>Dhela</td>
									<td>5:45 AM</td>
									<td>3:0 PM</td>
								  </tr>
								  <tr>
									<td>Jhirna</td>
									<td>Dhela</td>
									<td>5:45 AM</td>
									<td>3:0 PM</td>
								  </tr>
								  <tr>
									<td>Sonanadi</td>
									<td>Vatanvasa</td>
									<td>6:15 AM</td>
									<td>2:0 PM</td>
								  </tr>
								  <tr>
									<td>Garjiya</td>
									<td>Garjia</td>
									<td>5:45 AM</td>
									<td>3:0 PM</td>
								  </tr>
								</table>
								<br>
								<center><b>(Entry within the Tiger Reserve after sunset is strictly prohibited)</b></center>
								<br>
								
								<table class="body">
								<tr>
								<td style="font-size:14px;">
								<p>17. Day visit to Dhikala Tourism Zone is not permitted except in conducted tours organized by Corbett Tiger Reserve</p>
								<p>18. Entry of private vehicle in All Tourism Zone is prohibited.</p>
								</td>
								</tr>
								</table>
								
								<table class="body">
								<tr>
								<td style="font-size:14px;">
								<p>19. Entry into the Tiger Reserve with or without a pass in on the own risk of the visitor. The authorities shall not be responsible in any way for damages caused if any.</p>
								<p>20. Permit is not transferable. Once permit is issued the amount is not refundable.</p>
								</td>
								</tr>
								</table>
								
								<table class="body">
								<tr>
								<td style="font-size:14px;">
								<p>21. Non vegetarian food is prohibited inside CTR. All visitors to the Tiger Reserve are governed by the provisions of the Wildlife Protection Act and rules made there under.</p>
								</td>
								</tr>
								</table>'; 
								$send_quo_html .= '</td>
												</tr>
											</table>
											<!---- ======== Cancelation Policy ======== ------>
										</main>
											</body></html>'; 
			$this->savePdfQuotation($voucher_no,$send_quo_html); 
			echo json_encode(array('status'=>true,'msg'=>'Activity Voucher Generated', 'final_cost_val' => $activityvoucher->total_bill, 'send_message' => $send_quo_html, 'activity_voucher_no' => $voucher_no));
		} catch (\Exception $e) {
			echo json_encode(array('status'=>false,'msg'=>'Activity Voucher Generating Issue! '.$e, 'final_cost_val' => '', 'send_message' => '', 'activity_voucher_no' => ''));
		}
        
    }
	
	/**
     * Download the activity voucher.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function downloadActivityVoucher($activity_id){ 
		try {
			$activity = ActivityVoucher::where('voucher_no',$activity_id)->first();
			
			$activity_details = $this->getActivityDetailsById($activity->activity_id);
			//dd($activity_details);
			$activity_name = $this->getActivityNameWCById($activity->activity_id);
			$vendor_name = $this->getVendorNameById($activity->vendor_id);
			
			$send_quo_html = '<html><head><style>
										td.lable_text {
											text-align: center;
											background-color: #009688;
												color:#fff;
											padding: 5px 0;
										}
										table.footer {
											border-top: 1px solid #555;
											font-size: 13px;
										}
										
										table.header {
											text-align: center;
										}
										table.header tr {
											border:none !important;
										}
										table.body td {
											padding: 0px 0 !important; 
											border:none !important;
										}
										table.body tr { 
											border:none !important;
										}
									
										.bottom_area {
											width: 100%;
											text-align: center;
											padding-top: 24px;
											border-top: 1px solid #555;
											margin-top: 15px;
											margin-bottom: 15px;
										}
										td.lable_text {
											text-align: center;
											background-color: #009688;
											color:#fff;
											padding: 5px 0;
										}
										.hotel_img {
											width: 90px;
											height: 90px;
											border: 1px solid #b3b0b0;
											padding: 5px;
											margin-top: 5px;
										}
										
										table.body {
											width:100%;
											color:#000;
											border-spacing: -1px;
											border:collapse; 
										}
										main123{
											margin-top:140px;
											margin-bottom:150px;
										}
										@page { margin: 0px 0px 100px;} 
										.iti_foo_left {
											display:inline-block;
											height:110px;
											width: 200px;
											text-align: left;
											padding: 20px 10px 0px;
											margin: 10px 0 0;
										}
										.iti_foo_middil {
											display:inline-block;
											width: 230px;
											font-size: 13px;
											padding: 20px 10px 0px;
											text-align: left;
											color: #fff;
											height:110px;
											border-right:0.5px solid #fff;
										}
										.iti_foo_right {
											display:inline-block;
											width: 250px;
											font-size: 13px;
											padding: 20px 10px 0px;
											color: #fff;
											height:110px;
											text-align: right;
										}
										header ul { padding:0px; margin:0px; }
										main ul { padding:0px; margin:0px; }
											
										header {
											height: 100px;
											color: #000;
											text-align: center;
											margin: 0px 0px 5px;
											font-family: sans-serif;
											border-bottom: 2px solid #b46d2e;
										}
										.iti_hea_right {
											float: right;
											width: 250px;
											vertical-align: middle;
											height: 80px;
											padding-top: 20px;
										}
										.iti_hea_left {
											float: left;
											text-align: left;
											padding: 2px 12px;
										}
										footer {
											height: 100px;
											background-color: #b46d2e;
											color: #000;
											text-align: center;
											font-family: sans-serif;
											padding-left: 0px !important;
											margin: 0px 0px;
											position: fixed; 
											bottom: -100px; 
											left: 0px; 
											right: 0px;
										}
										header{
											position: fixed;
											top: -110px;
											left: 0px;
											right: 0px;
											background-size: 100% 100%;
											background-image: url(/asset/images/activity_voucher_header_new.jpg);
											color:#fff;
										}
										
										img{max-width:100%;}
										.hotel_rating {
											display: inline-block;
											width: 100%;
											padding: 5px 0;
											margin-left:10px;
										}
										.hotel_rating li {
											display: inline;
											margin: 0 -5px;
										}
										table.dayhotelrate td, th {
											border: 1px solid #555 !important;
											text-align: center;
										}
										table.dayhotelrate th {
											background-color: blanchedalmond;
										}
										td.payment_details p50 {
											width: 47%;
											display: inline-block;
											padding: 15px 10px 0px;
										}
										td.payment_details p100 {
											width: 100%;
											display: inline-block;
											padding: 15px 10px 0px;
										}
									</style></style></head>

									<body style="width: 770px; margin: 0 auto; font-family: sans-serif;">
										<header>
											<div class="iti_hea_left">';
												$send_quo_html .= '<span style="font-size:20px;"></span>
												
											</div>
											<div class="iti_hea_right">
												 
											</div>
										</header> 
										
										<footer>
											<div class="iti_foo_left">
												<img src="/asset/images/Ensober.jpg"/>
											</div>
											<div class="iti_foo_middil">
												<b>Ensober Hotels</b><br>
												Luxury Hotels in Uttarakhand <br> Corbett | Nainital | Haridwar <br> 
												I-1804, SAMRIDHI GRAND AVENUE, NOIDA, DELHI-NCR
											</div>
											<div class="iti_foo_right">
												<b>Contact Information</b><br>
												Telephone : 8383908656, 8368643151<br>
												Email : raj@ensoberhotels.com; pragya@ensoberhotels.com<br>
												Web: <a href="http://www.ensoberhotels.com/" target="_blank">http://www.ensoberhotels.com/</a>
											</div>
										</footer>
										
										<!-- Wrap the content of your PDF inside a main tag -->
										<main>
											<table class="body">
												<tbody>
												<tr>
													<td width="350px"><b>Confirmation Voucher </b></td>
													<td style="text-align: center;" width="200px"><b>Created Date: </b> <span style="font-size:14px;">'.date('d M Y').'</span></td>
												</tr>
												</tbody>
											</table> <br>
											<!---- ======== Activity Details ======== ------>
											<table class="body">
												<tbody>
												<tr> 
													<td style="font-size:20px;border-bottom: 3px dotted #72534a !important;color: #72534a;"><b>'.@$activity_name['cat'].' Details</b></td>
												</tr>
												</tbody> 
											</table>
											<table class="body">
												<tr>
													<td style="vertical-align: text-bottom;">
														<table class="body">
															<tr>
																<td style="vertical-align:top;" width="215px">
																	<img src="/storage/app/'.$activity_details->image.'" style="min-width: 200px;height:140px;  border: 1px solid #b3b0b0; padding: 2px; margin-top: 5px; " />
																</td> 
																<td style="vertical-align:top; text-align:left;">
																	<b style="display:inline-block; font-size: 18px; padding: 20px 0 10px;">'.@$activity_name['name'].'</b><br>
																	<b style="display:inline-block; font-size: 16px; padding: 0px 0 2px;">On Of Jeeps: <span style="font-weight:normal;">'.$activity->no_of_jeeps.'</span></b><br>
																	<b style="display:inline-block; font-size: 16px; padding: 0px 0 2px;">Guest: <span style="font-weight:normal;">'.$activity->client_name.'</span></b><br>
																	
																	<b style=" font-size: 16px; padding: 0px 0 2px;">Mobile: <span style="font-weight:normal;">'.$activity->mobile.'</span></b><br>
																		
																	<b style="display:none; font-size: 16px; padding: 0px 0 2px;">Email: <span style="font-weight:normal;">'.$activity->email.'</span></b><br>
																</td>
															</tr>
														</table> <br>
													</td> 
												</tr>
											</table>';
											
											$send_quo_html .= '<table style="font-size:14px; margin:10px 0px;" class="dayhotelrate body">
											<tr> 
												<td>Voucher No</td>
												<td>'.$activity->voucher_no.'</td>
											</tr>
											<tr>
												<td>Guest Name</td>
												<td>'.$activity->client_name.'</td>
											</tr>
											<tr>
												<td>Total Visitors</td>
												<td>'.$activity->total_visitors.'</td>
											</tr>
											<tr>
												<td>Activity Zone</td>
												<td>'.@$activity_name['sub_cat'].'</td>
											</tr>
											<tr>
												<td>Date</td>
												<td>'.date('d M Y', strtotime($activity->date)).'</td>
											</tr>
											<tr>
												<td>Pickup Time</td>
												<td>'.$activity->time.'</td>
											</tr>
											<tr>
												<td>Slot</td>
												<td>'.ucwords(str_replace('_',' ',$activity->slot)).'</td>
											</tr>
											<tr>
												<td>Vendor Name</td>
												<td>'.$vendor_name.'</td>
											</tr>';
											
											$send_quo_html .= '</table>'; 
											
											$send_quo_html .= '<table style="font-size:16px; margin:0px 0 10px;" class="dayhotelrate body">
														<tr>
															<td>Advance Received</td>
															<td>'.$activity->advance_received.'</td>
														</tr>';
														if($activity->advance_received < $activity->total_bill){
															$send_quo_html .= '</tr>
																<tr>
																<td>Balance</td>
																<td>'.$activity->balance.'</td>
															</tr>';
														}
												$send_quo_html .= '
												<tr>
													<td>Advance Received By</td>
													<td>'.$activity->payment_received_by.'</td>
												</tr>
												</table>';
											
											$send_quo_html .= '
											<table class="body" style="margin-bottom:5px;">
												<tbody>
												<tr> 
													<td>
														<p>Comment: '.$activity->comment.'</p>
													</td>
												</tr>
												</tbody>
											</table>';
											
											$send_quo_html .= '<!---- ======== Cancelation Policy ======== ------>
											<table class="body" style="margin-bottom:5px;">
												<tbody>
												<tr> 
													<td style="font-size:20px;border-bottom: 3px dotted #72534a !important;color: #72534a;"><b>Terms & Conditions:</b></td>
												</tr>
												</tbody>
											</table>
											<table class="body">
												<tr>
													<td style="font-size:14px;">';
								$send_quo_html .= '<b>Please Note:- </b><br>
								<p>1. Visitor Will have to compulsory show their above mentioned Id card at the time of Enrty. Guests have to necessarily get their permits checked at the CTR reception. Also discrepancy in payment, due to any reason have to sorted out before entering the park.</p>
													</td>
												</tr>
											</table>
								<table class="body">
								<tr>
								<td style="font-size:14px;">
								<p>2. No private vehicle would be allowed inside the tourism zone. Visitors are allowed to go in registered vehicle only Green color Gypsy.</p>
								</td>
								</tr>
								</table>

								<table class="body">
								<tr>
								<td style="font-size:14px;">
								<p>3. Any booking for day visit to CTR during rainy season (1st June to 14th Nov.) is provisional and can be cancelled at a short notice depending on the weather condition, to ensure visitors safety. Hence all such bookings during this period are done at visitors risk and no refund can be claimed if it is cancelled due to bad weather conditions.</p>
								</td>
								</tr>
								</table>
								
								<table class="body">
								<tr>
								<td style="font-size:14px;">
								<p>4. Canteen Facility is not available in Sonanadi Zone</p>
								</td>
								</tr>
								</table>
								
								<table class="body">
								<tr>
								<td style="font-size:14px;">
								<b>Rules And Regulations: </b><br>
								</td>
								</tr>
								</table>
								
								<table class="body">
								<tr>
								<td style="font-size:14px;">
								<p>1. All reservations inside the tiger reserve are provisional and can be changed or cancelled without prior information. The decision of director CTR will be final in the matter.</p>
								</td>
								</tr>
								</table>
								
								<table class="body">
								<tr>
								<td style="font-size:14px;">
								<p>2. Carrying of firearms of any kind is not permitted within the Tiger Reserve.</p>
								</td>
								</tr>
								</table>
								
								<table class="body">
								<tr>
								<td style="font-size:14px;">
								<p>3. No pets can be taken inside the Tiger Reserve. </p>
								</td>
								</tr>
								</table>
								
								<table class="body">
								<tr>
								<td style="font-size:14px;">
								<p>4. Walking or trekking is strictly prohibited.</p>
								</td>
								</tr>
								</table>
								
								<table class="body">
								<tr>
								<td style="font-size:14px;">
								<p>5. Driving inside the Tiger Reserve after sunset is prohibited.</p>
								</td>
								</tr>
								</table>
								
								<table class="body">
								<tr>
								<td style="font-size:14px;">
								<p>6. Cooking is not allowed within the Tiger Reserve and at Dhikala and Bijrani tourist complexes. In other rest houses visitors can cook within the provided space. </p>
								</td>
								</tr>
								</table>
								
								<table class="body">
								<tr>
								<td style="font-size:14px;">
								<p>7. Visitors are required to carry a litter bag while entering the Tiger Reserve and bring back their non-biodegradable litter (tin cans, plastic, glass bottles, metal foils etc.) outside the Reserve. Throwing litter inside the Tiger Reserve other than in garbage bins will invite severe penalties.</p>
								</td>
								</tr>
								</table>
								
								<table class="body">
								<tr>
								<td style="font-size:14px;">
								<p>8. Official registered guide is compulsory on all excursions.</p>
								</td>
								</tr>
								</table>
								
								<table class="body">
								<tr>
								<td style="font-size:14px;">
								<p>9. Smoking outside residential complexes/rest houses and lighting of any kind of fire is strictly prohibited.</p>
								</td>
								</tr>
								</table>
								
								<table class="body">
								<tr>
								<td style="font-size:14px;">
								<p>10. Playing of transistors and tape recorders within the Tiger Reserve is strictly prohibited.</p>
								</td>
								</tr>
								</table>
								
								<table class="body">
								<tr>
								<td style="font-size:14px;">
								<p>11. Visitors are prohibited from taking vehicles off the designated routes thereby causing damage to plant or animal life or their habitat.</p>
								</td>
								</tr>
								</table>
								
								<table class="body">
								<tr>
								<td style="font-size:14px;">
								<p>12. Blowing of horns and driving above the speed limit is strictly prohibited within the Tiger Reserve.</p>
								<p>13. Entry into the restricted zone by the visitors is prohibited.</p>
								</td>
								</tr>
								</table>
								
								<table class="body">
								<tr>
								<td style="font-size:14px;">
								<p>14. Shouting, teasing or chasing animals or attempts to feed them are prohibited and will invite severe penalties.</p>
								</td>
								</tr>
								</table>
								
								<table class="body">
								<tr>
								<td style="font-size:14px;">
								<p>15. Visitors are advised to occupy the accommodation as reserved on the first day itself or send prior intimation to hold the accommodation. Otherwise, the reservation will be treated as cancelled.</p>
								</td>
								</tr>
								</table>
								
								<table class="body">
								<tr>
								<td style="font-size:14px;">
								<p>16. Maximum two adults and two children (below 12 years) per room are allowed to stay in the tourism zone. One extra bed can be provided on payment of prescribed charges.</p>
								</td>
								</tr>
								</table>
								
								<br>
								<table class="body dayhotelrate">
								  <tr>
									<th>Zone</th>
									<th>EntryGate</th>
									<th>Morning</th>
									<th>Evening</th>
								  </tr>
								  <tr>
									<td>Bijrani</td>
									<td>Amdanda</td>
									<td>6:15 AM</td>
									<td>2:0 PM</td>
								  </tr>
								  <tr>
									<td>Dhikala</td>
									<td>Dhangari</td>
									<td>6:0 AM</td>
									<td>11:0 AM</td>
								  </tr>
								  <tr>
									<td>Durga Devi</td>
									<td>Durga Devi</td>
									<td>6:15 AM</td>
									<td>2:0 PM</td>
								  </tr>
								  <tr>
									<td>Pakharo</td>
									<td>Pakhro</td>
									<td>5:45 AM</td>
									<td>3:0 PM</td>
								  </tr>
								  <tr>
									<td>Dhela</td>
									<td>Dhela</td>
									<td>5:45 AM</td>
									<td>3:0 PM</td>
								  </tr>
								  <tr>
									<td>Jhirna</td>
									<td>Dhela</td>
									<td>5:45 AM</td>
									<td>3:0 PM</td>
								  </tr>
								  <tr>
									<td>Sonanadi</td>
									<td>Vatanvasa</td>
									<td>6:15 AM</td>
									<td>2:0 PM</td>
								  </tr>
								  <tr>
									<td>Garjiya</td>
									<td>Garjia</td>
									<td>5:45 AM</td>
									<td>3:0 PM</td>
								  </tr>
								</table>
								<br>
								<center><b>(Entry within the Tiger Reserve after sunset is strictly prohibited)</b></center>
								<br>
								
								<table class="body">
								<tr>
								<td style="font-size:14px;">
								<p>17. Day visit to Dhikala Tourism Zone is not permitted except in conducted tours organized by Corbett Tiger Reserve</p>
								<p>18. Entry of private vehicle in All Tourism Zone is prohibited.</p>
								</td>
								</tr>
								</table>
								
								<table class="body">
								<tr>
								<td style="font-size:14px;">
								<p>19. Entry into the Tiger Reserve with or without a pass in on the own risk of the visitor. The authorities shall not be responsible in any way for damages caused if any.</p>
								<p>20. Permit is not transferable. Once permit is issued the amount is not refundable.</p>
								</td>
								</tr>
								</table>
								
								<table class="body">
								<tr>
								<td style="font-size:14px;">
								<p>21. Non vegetarian food is prohibited inside CTR. All visitors to the Tiger Reserve are governed by the provisions of the Wildlife Protection Act and rules made there under.</p>
								</td>
								</tr>
								</table>'; 
								$send_quo_html .= '</td>
												</tr>
											</table>
											<!---- ======== Cancelation Policy ======== ------>
										</main>
											</body></html>'; 
											
			$voucher_no = $activity->voucher_no;
			$name = $activity->client_name;
			$date = date('dMY', strtotime($activity->date));
			$pdf = PDF::loadHTML($send_quo_html);
			$fileName = $voucher_no.$name.$date.'.'.'pdf';
			return $pdf->download($fileName);
			
		} catch (\Exception $e) {
			echo $e;
		}
        
    }
	
	

	/**
     * Send quotation to customer.
     *
     * @param  \App\Testimonial  $promocode
     * @return \Illuminate\Http\Response
     */
    public function sendQuotation(Request $request){
		$message = $request->email_message;
		$to = $request->email; 
		$ccemail = $request->ccemail; 
		$subject = $request->email_subject;
		$from = 'info@ensoberhotels.com';//'Sales@ensoberhotels.com';
		$pdf_name = $request->quot_pdf;
		$message .= '<br> If you want voucher in PDF: <a target="_blank" href="'.$pdf_name.'">Click Here</a><br>';
		$send_status = $this->send($message, $subject, $from, $to, $pdf_name, $ccemail);
		echo $send_status;
    }
	
	/**
     * Update final cost for quotation
     *
     * @param  Request
     * @return \Illuminate\Http\Response
     */
    public function updateFinalCost(Request $request){
		$final_cost = $request->final_cost;
		$send_quotation_no = $request->send_quotation_no; 
		$update_status = SendQuotation::where('send_quotation_no', $send_quotation_no)->update(['final_cost' => $final_cost]);
		if($update_status){
			echo "Final Cost Updated!";
		}else{
			echo "Error!!!";
		}
    }
	
	
	/**
     * Display the specified resource.
     *
     * @param  \App\Testimonial  $promocode
     * @return \Illuminate\Http\Response
     */
    public function pdfview($id)
    {
        $voucher = Voucher::findOrFail($id);
        return view('itinerary.view', compact('voucher'));
    }
	
	/**
     * Display the specified resource.
     *
     * @param  \App\Testimonial  $promocode
     * @return \Illuminate\Http\Response
     */
    public function itineraryView($itinerary_no){
		// Basic Info
		$basic_info = ITIBasicInfo::where('itinerary_no', $itinerary_no)->with('arrivalCity')->first();
		
		// Hotel Info
		$hotel_info = ITIHotel::where('itinerary_no', $itinerary_no)->with('getHotel')->with('getdistination')->with('getRoomType')->get();
		
		// Transort Info
		$transport_info = ITITransport::where('itinerary_no', $itinerary_no)->with('getTransport')->get();
		
		// Route Info
		$route_info = ITIRoute::where('itinerary_no', $itinerary_no)->with('getStartDistination')->with('getToDistination')->get();
		
		// Get the all distinatio name
		$routes = '';
		$tcout = count($route_info);
		$x=1;
		foreach($route_info as $route){
			if($x == $tcout){
				$routes .= $route->getToDistination->name;
			}else{
				$routes .= $route->getToDistination->name.' - ';
			}

			$x++;
		}

		// Activity Info
		$activity_info = ITIActivity::where('itinerary_no', $itinerary_no)->with('cityName')->with('getActivity')->get();
		
		// Day Wise Itinerary Info
		$daywiseiti_info = ITIDayWiseItinerary::where('itinerary_no', $itinerary_no)->with('getDistination')->orderBy('day', 'ASC')->get();


        return view('itinerary.itinerary_view', compact('basic_info','hotel_info','transport_info','route_info','routes','activity_info','daywiseiti_info'));
    }

	public function downloadItinerary($itinerary_no){
		// Basic Info
		$basic_info = ITIBasicInfo::where('itinerary_no', $itinerary_no)->with('arrivalCity')->first();
		
		// Hotel Info
		$hotel_info = ITIHotel::where('itinerary_no', $itinerary_no)->with('getHotel')->with('getdistination')->with('getRoomType')->get();
		
		// Transort Info
		$transport_info = ITITransport::where('itinerary_no', $itinerary_no)->with('getTransport')->get();
		
		// Route Info
		$route_info = ITIRoute::where('itinerary_no', $itinerary_no)->with('getStartDistination')->with('getToDistination')->get();
		
		// Get the all distinatio name
		$routes = '';
		$tcout = count($route_info);
		$x=1;
		foreach($route_info as $route){
			if($x == $tcout){
				$routes .= $route->getStartDistination->name;
			}else{
				$routes .= $route->getStartDistination->name.' - ';
			}

			$x++;
		}

		// Activity Info
		$activity_info = ITIActivity::where('itinerary_no', $itinerary_no)->with('cityName')->with('getActivity')->get();
		
		// Day Wise Itinerary Info
		$daywiseiti_info = ITIDayWiseItinerary::where('itinerary_no', $itinerary_no)->with('getDistination')->orderBy('day', 'ASC')->get();

		ob_clean();
		//return view('itinerary.itinerary_view', compact('basic_info','hotel_info','transport_info','route_info','routes','activity_info','daywiseiti_info'));
		$pdf = PDF::loadView('itinerary.itinerary_view', compact('basic_info','hotel_info','transport_info','route_info','routes','activity_info','daywiseiti_info'));
		//$this->uploadPdfItinerary($id);
		
		return $pdf->download('newitinerary.pdf');
    }

	public function updateItineraryNew($itinerary_no){

		// Basic Info
		$basic_info = ITIBasicInfo::where('itinerary_no', $itinerary_no)->with('arrivalCity')->first();
		
		// Hotel Info
		$hotel_info = ITIHotel::where('itinerary_no', $itinerary_no)->with('getHotel')->with('getdistination')->with('getRoomType')->get();
		
		// Transort Info
		$transport_info = ITITransport::where('itinerary_no', $itinerary_no)->with('getTransport')->get();
		
		// Route Info
		$route_info = ITIRoute::where('itinerary_no', $itinerary_no)->with('getStartDistination')->with('getToDistination')->get();
		
		// Get the all distinatio name
		$routes = '';
		$tcout = count($route_info);
		$x=1;
		foreach($route_info as $route){
			if($x == $tcout){
				$routes .= $route->getStartDistination->name;
			}else{
				$routes .= $route->getStartDistination->name.' - ';
			}

			$x++;
		}

		// Activity Info
		$activity_info = ITIActivity::where('itinerary_no', $itinerary_no)->with('cityName')->with('getActivity')->get();
		
		// Day Wise Itinerary Info
		$daywiseiti_info = ITIDayWiseItinerary::where('itinerary_no', $itinerary_no)->with('getDistination')->get();


		//$cities = City::select('hotels.*','cities.id as city_id','cities.name as name')->join('hotels', 'cities.id', '=', 'hotels.city_id')->get();
		$cities = City::select('id as city_id','name as name')->where('itinerary_city','1')->groupBy('id')->get();
		
		$transports = Transport::orderBy('id' , 'desc')->with('car')->with('venderName')->with('car_segment')->with('car_model')->with('car_seats')->with('countryName')->with('stateName')->with('cityName')->get();

		return view('itinerary/updateitinerarynew', compact('cities','transports','basic_info','hotel_info','transport_info','route_info','routes','activity_info','daywiseiti_info'));
	}
	
	// Update itinerary for only mobile view
	public function updateItineraryNewM($itinerary_no){

		// Basic Info
		$basic_info = ITIBasicInfo::where('itinerary_no', $itinerary_no)->with('arrivalCity')->first();
		
		$basic_info->drop_date_time = $basic_info->drop_date.'T'.$basic_info->drop_time;
		$basic_info->arrival_date_time = $basic_info->arrival_date.'T'.$basic_info->arrival_time;
		
		// Hotel Info
		$hotel_info = ITIHotel::where('itinerary_no', $itinerary_no)->with('getHotel')->with('getdistination')->with('getRoomType')->get();
		
		// Transort Info
		$transport_info = ITITransport::where('itinerary_no', $itinerary_no)->with('getTransport')->get();
		
		// Route Info
		$route_info = ITIRoute::where('itinerary_no', $itinerary_no)->with('getStartDistination')->with('getToDistination')->get();
		
		// Get the all distinatio name
		$routes = '';
		$tcout = count($route_info);
		$x=1;
		foreach($route_info as $route){
			if($x == $tcout){
				$routes .= $route->getStartDistination->name;
			}else{
				$routes .= $route->getStartDistination->name.' - ';
			}

			$x++;
		}

		// Activity Info
		$activity_info = ITIActivity::where('itinerary_no', $itinerary_no)->with('cityName')->with('getActivity')->get();
		
		// Day Wise Itinerary Info
		$daywiseiti_info = ITIDayWiseItinerary::where('itinerary_no', $itinerary_no)->with('getDistination')->get();


		//$cities = City::select('hotels.*','cities.id as city_id','cities.name as name')->join('hotels', 'cities.id', '=', 'hotels.city_id')->get();
		$cities = City::select('id as city_id','name as name')->where('itinerary_city','1')->groupBy('id')->get();
		
		$transports = Transport::orderBy('id' , 'desc')->with('car')->with('venderName')->with('car_segment')->with('car_model')->with('car_seats')->with('countryName')->with('stateName')->with('cityName')->get();

		return view('itinerary/updateitinerarynewm', compact('cities','transports','basic_info','hotel_info','transport_info','route_info','routes','activity_info','daywiseiti_info'));
	}
	
	// For update day wise itinerary
	public function updateDaywiseItinerary($itinerary_no){

		// Day Wise Itinerary
		$itineraries = ITIDayWiseItinerary::where('itinerary_no', $itinerary_no)->get();

		return view('itinerary/updatedaywiseiti', compact('itineraries'));
	}
	
	// For update day wise itinerary
	public function updateDaywiseItineraryAct(Request $request){
		$x=0;
		foreach($request->description as $description){
			$DayWiseDetail = ITIDayWiseItinerary::where('id', $request->id[$x])->first();
			$DayWiseDetail->description = $description;	
			$DayWiseDetail->save();
			$x++;
		} 
		return back()->with('flash_success', 'Day Wise Itinerary Updated Successfully'); 
	}


	public function getItineraryForListig(){
		// Basic Info
		$itineraries = ITIBasicInfo::with('dropCity')->with('arrivalCity')->orderBy('id', 'DESC')->get();
		
		return view('itinerary.itinerary_list', compact('itineraries')); 
    }


	// This function use for manage the itinerary
	public function itineraryManage($itinerary_no){
		return view('itinerary.itinerary_manage', compact('itinerary_no')); 
    }

	public function uploadPdfItinerary($id){
		$pdf = PDF::loadView('itinerary.itinerary_view');
		$path = storage_path('app/itinerary');
		$fileName = 'ENBITI-100001' . '.' . 'pdf' ;
		$pdf->save($path . '/' . $fileName);
    }
	
	public function downloadpdf($id){
		$voucher = Voucher::findOrFail($id);
		//return view('itinerary.dwnvoucher', compact('voucher')); 
		$pdf = PDF::loadView('itinerary.dwnvoucher', compact('voucher'));
		$this->savePdfItinerary($id);
		return $pdf->download('pdfview111qwwqe.pdf');
    }
	
	public function savePdfItinerary($id){
		$voucher = Voucher::findOrFail($id);
		$pdf = PDF::loadView('itinerary.dwnvoucher', compact('voucher'));
		$path = storage_path('app/itinerary');
		$fileName = 'ENBITI-100001' . '.' . 'pdf' ;
		$pdf->save($path . '/' . $fileName);
    }
	
	// Save Quotation in PDF
	public function savePdfQuotation($quotation_no, $html){
		$pdf = PDF::loadHTML($html);
		$path = storage_path('app/quotations');
		$fileName = $quotation_no. '.' . 'pdf' ;
		//$pdf->save($path . '/' . $fileName);
		\Storage::disk('s3')->put('quotations/'.$fileName, $pdf->output(), 'public');
		$url = \Storage::disk('s3')->url('quotations/'.$fileName);
    }
	
	public function savePdfVoucher($id){
		$voucher = Voucher::findOrFail($id);
		$pdf = PDF::loadView('itinerary.dwnvoucher', compact('voucher'));
		$path = storage_path('app/voucher/pdf');
		$fileName = $voucher->reservation_no . '.' . 'pdf' ;
		$pdf->save($path . '/' . $fileName);
    }
    
	public function sendVoucher(Request $request)
    {
		$id = $request->voucher_id;
		$email = $request->email;
		$voucher = Voucher::findOrFail($id);
		$this->savePdfVoucher($id);
		$pdf_name = $voucher->reservation_no. '.' . 'pdf';
		$text             = 'Dear Sir, <br> Please find voucher in attachment.';
        $mail             = new PHPMailer\PHPMailer(); // create a n
		
		try {
			$mail->SMTPDebug  = 0; // debugging: 1 = errors and messages, 2 = messages only
			$mail->IsSMTP();
			$mail->IsMail();
			$mail->SMTPAuth   = true; // authentication enabled
			$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
			$mail->Host       = "smtp.gmail.com";
			$mail->Port       = 25; // or 587
			$mail->IsHTML(true);
			$mail->Username = "Sales@ensoberhotels.com"; 
			$mail->Password = "rajensober1124";
			$mail->SetFrom("Sales@ensoberhotels.com", 'Ensober');
			$mail->Subject = "Ensober Hotel Voucher";
			$mail->Body    = $text;
			$mail->AddAddress($email,'');
			$mail->addAttachment('storage/app/itinerary/'.$pdf_name); 
			if(!$mail->Send()) {
				return $error = 'Mail error: '.$mail->ErrorInfo; 
				//return false;
			} else {
				return back()->with('flash_success','Voucher Send Successfully!');
			}
		} catch (phpmailerException  $e) {
			echo $e->errorMessage(); //Pretty error messages from PHPMailer
		} catch (\Exception $e) { //The leading slash means the Global PHP Exception class will be caught
			echo $e->getMessage(); //Boring error messages from anything else!
		}

        
    }
	
	
	
	/**
     * Show the room curent statau
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
     
    public function roomsCurrentStatus(){
        try {
            $operator_id = session()->get('operator.id');
			$operator = Operator::where('id', $operator_id)->first();
			$hotel = [];
			if(@$operator->room_inventory == 'Y'){
				$hotels = Hotel::where('id', $operator->hotel)->get();
				$hotel_id = session()->get('operator.hotel');
				$hotel = $this->getHotelDetailsByIdWithFullInfo(@$hotel_id[0]);
			}else{
				$hotel_id = session()->get('operator.hotel');
				$hotel = $this->getHotelDetailsByIdWithFullInfo(@$hotel_id[0]);
				$hotels = Hotel::All();
			}
			$citiesh = City::select('hotels.*','cities.id as city_id','cities.name as name')->join('hotels', 'cities.id', '=', 'hotels.city_id')->groupBy('cities.id')->get();
			
			$years = DB::select('SELECT EXTRACT(year from `checkin`) as year FROM `send_quotations` GROUP BY year');
            return view('operator/roomstatus',compact('hotels', 'citiesh','hotel','operator','years')); 
        } catch (ModelNotFoundException $e) {
            return $e;
        }
    }
	
	/**
     * Show the room curent statau
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function roomsAvailable(){
        try {
            $operator_id = session()->get('operator.id');
			$operator = Operator::where('id', $operator_id)->first();
			$hotel = [];
			if(@$operator->room_status == 'Y'){
				$hotels = Hotel::whereIn('id', explode(',', $operator->assigned_hotels))->get();
			}else{
				$hotel_id = session()->get('operator.hotel');
				$hotel = $this->getHotelDetailsByIdWithFullInfo(@$hotel_id[0]);
				$hotels = Hotel::All();
			}
			$citiesh = City::select('hotels.*','cities.id as city_id','cities.name as name')->join('hotels', 'cities.id', '=', 'hotels.city_id')->groupBy('cities.id')->get();
            return view('operator/roomavailable',compact('hotels', 'citiesh','hotel','operator')); 
        } catch (ModelNotFoundException $e) {
            return $e;
        }
    }
	
	/**
     * Show the add room booking form
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function addRoomBooking(){
        try {
			$operator_id = session()->get('operator');
			$operator = Operator::where('id', $operator_id['id'][0])->first();
			if($operator->room_inventory == 'Y'){
				$hotels = Hotel::where('id', $operator->hotel)->get();
			}else{
				$hotels = Hotel::All();
			}
			//dd($operator);
            
			$citiesh = City::select('hotels.*','cities.id as city_id','cities.name as name')->join('hotels', 'cities.id', '=', 'hotels.city_id')->groupBy('cities.id')->get();
            return view('operator/add_booking',compact('hotels', 'citiesh')); 
        } catch (ModelNotFoundException $e) {
            return $e;
        }
    }
	
	/**
     * Save add room booking
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function addRoomBookedAction(Request $request){
        try {
			
			$noof_cat = count($request->room_type);
			$hotel_operators = Operator::select('email')->where('hotel', $request->hotel)->pluck('email')->toArray();
			if(!$hotel_operators){
				$hotel_operators = [];
			}
			//dd($hotel_operators);
			$checkroominv = session()->get('operator.room_inventory');
			$user=session()->get('operator');
			$id = session()->get('operator.id');
			$log_operator = Operator::where('id', $id)->first();
			$log_operator_email = $log_operator->email;
			$parent_booking_no = str_pad(rand(0,999999), 6, "0", STR_PAD_LEFT);
			$staying_day = 1;
			for($x=0; $x<$noof_cat; $x++){
				// Add Booking Details
				if($request->HasFile('payment_snapshot')){
					$path = $request->file('payment_snapshot')->store('payment_snapshots');
				}else{
					$path = '';
				}
				$client_name = $request->ff_c_name.$request->client_name;
				$booked_no = str_pad(rand(0,9999), 4, "0", STR_PAD_LEFT);
				$RoomBookedDetails = new RoomBookedDetails();
				$RoomBookedDetails->booked_no = $booked_no;
				$RoomBookedDetails->parent_booking_no = $parent_booking_no;
				$RoomBookedDetails->hotel = $request->hotel;
				$RoomBookedDetails->room_type = $request->room_type[$x];
				$RoomBookedDetails->noofrooms = $request->noofrooms[$x];
				$RoomBookedDetails->check_in = $request->check_in[$x];
				$RoomBookedDetails->check_out = $request->check_out[$x];
				$RoomBookedDetails->client_name = $client_name;
				$RoomBookedDetails->agent_name = $request->agent_name;
				$RoomBookedDetails->total_rooms = $request->total_rooms;
				$RoomBookedDetails->plan = $request->plan[$x];
				$RoomBookedDetails->adults = $request->adults[$x];
				$RoomBookedDetails->kidswd = $request->kidswd[$x];
				$RoomBookedDetails->kidswod = $request->kidswod[$x];
				$RoomBookedDetails->infant = $request->infant[$x];
				$RoomBookedDetails->booking_from = $request->booking_from;
				$RoomBookedDetails->source = $request->source;
				$RoomBookedDetails->confirmed_by = $request->confirmed_by;
				$RoomBookedDetails->total_bill = $request->total_bill;
				$RoomBookedDetails->advance_amount = $request->advance_amount;
				$RoomBookedDetails->payment_source = $request->payment_source;
				$RoomBookedDetails->date_of_advance = $request->date_of_advance;
				$RoomBookedDetails->booking_status = $request->booking_status;
				$RoomBookedDetails->payment_snapshot = $path;
				$RoomBookedDetails->comment = $request->comment;
				$RoomBookedDetails->comment_for_balace = $request->comment_for_balace;
				$RoomBookedDetails->company_id=$user['company_id'][0];
				$RoomBookedDetails->property_id=$user['property_id'][0];
				$RoomBookedDetails->user_id=$user['id'][0];
				$RoomBookedDetails->save();
				
				// Add inventory
				$check_in = $request->check_in[$x];
				$check_out = $request->check_out[$x];
				$final_checkin = current($request->check_in); 
				$final_checkout = $request->check_out[count($request->check_out)-1];
				$from_date = new DateTime($final_checkin);
				$to_date = new DateTime($final_checkout);
				$noofdays = $from_date->diff($to_date);
				$noofdays = $noofdays->days;
				//dd($noofdays);
				$date = $check_in;
				
				for($day = 1; $date < $check_out; $day++){
					
					$RoomInventory = new RoomInventory();
					$RoomInventory->room_booked_id = $RoomBookedDetails->booked_no;
					$RoomInventory->parent_booking_no = $RoomBookedDetails->parent_booking_no;
					$RoomInventory->year = date('Y', strtotime($date));
					$RoomInventory->month = date('m', strtotime($date));
					$RoomInventory->date = $date;
					$RoomInventory->hotel_id = $RoomBookedDetails->hotel;
					$RoomInventory->room_cat_id = $RoomBookedDetails->room_type;
					$RoomInventory->plan = $RoomBookedDetails->plan;;
					$RoomInventory->no_of_room = $RoomBookedDetails->noofrooms;
					$RoomInventory->staying_day = $staying_day;//$day;
					$RoomInventory->company_id=$user['company_id'][0];
					$RoomInventory->property_id=$user['property_id'][0];
					$RoomInventory->user_id=$user['id'][0];
					$RoomInventory->save(); 
					
					$date = date('Y-m-d', strtotime("+1 day", strtotime($date)));
					if($staying_day < $noofdays){ $staying_day++;}
				}
			}
			$heading = 'A new booking has been added with below details:';
			$this->sendNewRoomInventoryAlert($RoomBookedDetails->parent_booking_no, $heading, $hotel_operators);
			
			return redirect('operator/addroombook')->with('flash_success', 'Add Room Booing Successfully Added!');
			
        } catch (ModelNotFoundException $e) {
            return $e;
        }
    }
	
	
	/**
     * Update room booking details
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateRoomBookedAction(Request $request){
        try {
			$hotel_operators = Operator::select('email')->where('hotel', $request->hotel)->pluck('email')->toArray();
			if(!$hotel_operators){
				$hotel_operators = [];
			}
			
			$checkroominv = session()->get('operator.room_inventory');
			$id = session()->get('operator.id');
			$log_operator = Operator::where('id', $id)->first();
			$log_operator_email = $log_operator->email;
			
			if($request->has('delete')){
				
				// Send Delete alert
				$heading = 'A record has been deleted with below details:';
				$this->sendNewRoomInventoryAlert($request->booked_no, $heading, $hotel_operators, 'Record Deleted:');
				
				// Delete old room booked details with inventry
				RoomBookedDetails::where('parent_booking_no',$request->booked_no)->delete();
				RoomInventory::where('parent_booking_no',$request->booked_no)->delete();
			
				echo json_encode(array('status'=>true, 'msg'=>'Room Booing Successfully Deleted Booking No: '.$request->booked_no));
				exit;
			}
			
			if($request->has('cancel_booking')){
				// Cancel booking with inventry
				RoomBookedDetails::where('parent_booking_no',$request->booked_no)->update(array('booking_status' => 'Canceled', 'cancel_reason' => $request->reason, 'cancel_refund' => $request->cancel_refund, 'extra_bill' => $request->extra_bill, 'extra_bill_comment' => $request->extra_bill_comment));
				RoomInventory::where('parent_booking_no',$request->booked_no)->update(array('booking_status' => 'Canceled'));
				
				// Send Cancel alert
				$heading = 'A booking has been Canceled with below details:';
				$this->sendNewRoomInventoryAlert($request->booked_no, $heading, $hotel_operators, 'Booking Canceled:');
				echo json_encode(array('status'=>true, 'msg'=>'Room Booing Successfully Cancel Booking No: '.$request->booked_no));
				exit;
			}
			
			
			// Get Old Data Of Room Booking Details
			$old_detail = $this->getRoomBookingDetailsByBookNo($request->booked_no);
			
			// Delete old room booked details with inventry
			RoomBookedDetails::where('parent_booking_no',$request->booked_no)->delete();
			RoomInventory::where('parent_booking_no',$request->booked_no)->delete();
			
			
			$noof_cat = count($request->room_type);
			$parent_booking_no = $request->booked_no;//str_pad(rand(0,999999), 6, "0", STR_PAD_LEFT);
			$send_quotation_no = $request->send_quotation_no;
			
			$staying_day = 0; 
			$final_checkin = current($request->check_in);
			$final_checkout = $request->check_out[count($request->check_out)-1];
			for($x=0; $x<$noof_cat; $x++){
				if($request->HasFile('payment_snapshot')){
					File::delete($request->payment_snapshot_old);
					$path = $request->file('payment_snapshot')->store('payment_snapshots');
				}else{
					$path = $request->payment_snapshot_old;
				}
				$client_name = $request->ff_c_name.$request->client_name;
				$booked_no = str_pad(rand(0,9999), 4, "0", STR_PAD_LEFT);
				$RoomBookedDetails = new RoomBookedDetails();
				$RoomBookedDetails->booked_no = $booked_no;
				$RoomBookedDetails->parent_booking_no = $parent_booking_no;
				$RoomBookedDetails->send_quotation_no = $send_quotation_no;
				$RoomBookedDetails->hotel = $request->hotel;
				$RoomBookedDetails->room_type = $request->room_type[$x];
				$RoomBookedDetails->noofrooms = $request->noofrooms[$x];
				$RoomBookedDetails->check_in = $final_checkin; //$request->check_in[$x];
				$RoomBookedDetails->check_out = $final_checkout; //$request->check_out[$x];
				$RoomBookedDetails->client_name = $client_name;
				$RoomBookedDetails->agent_name = $request->agent_name;
				$RoomBookedDetails->total_rooms = $request->total_rooms;
				$RoomBookedDetails->plan = $request->plan[$x];
				$RoomBookedDetails->adults = $request->adults[$x];
				$RoomBookedDetails->kidswd = $request->kidswd[$x];
				$RoomBookedDetails->kidswod = $request->kidswod[$x];
				$RoomBookedDetails->infant = $request->infant[$x];
				$RoomBookedDetails->booking_from = $request->booking_from;
				$RoomBookedDetails->source = $request->source;
				$RoomBookedDetails->confirmed_by = $request->confirmed_by;
				$RoomBookedDetails->total_bill = $request->total_bill;
				$RoomBookedDetails->advance_amount = $request->advance_amount;
				$RoomBookedDetails->payment_source = $request->payment_source;
				$RoomBookedDetails->date_of_advance = $request->date_of_advance;
				$RoomBookedDetails->payment_snapshot = $path;
				$RoomBookedDetails->comment = $request->comment;
				$RoomBookedDetails->comment_for_balace = $request->comment_for_balace;
				$RoomBookedDetails->save(); 
				
				
				// Add inventory
				$check_in = $request->check_in[$x];
				$check_out_array = $request->check_out;
				$check_out = end($check_out_array);
				$check_out_last = date('Y-m-d', strtotime($check_out));
				$check_out = $request->check_out[$x];
				$date = $check_in;
				$search_mon = date('m', strtotime($date));
				$search_year = date('Y', strtotime($date));
				
				for($day = 1; $date < $check_out; $day++){
					$contractDateBegin = date('Y-m-d', strtotime($check_in));
					$contractDateEnd = date('Y-m-d', strtotime($check_out_last));
					if(($date >= $contractDateBegin) && ($date <= $contractDateEnd)){ 
						$staying_day ++;
					}
					$RoomInventory = new RoomInventory();
					$RoomInventory->room_booked_id = $RoomBookedDetails->booked_no;
					$RoomInventory->parent_booking_no = $RoomBookedDetails->parent_booking_no;
					$RoomInventory->send_quotation_no = $RoomBookedDetails->send_quotation_no;
					$RoomInventory->year = date('Y', strtotime($date));
					$RoomInventory->month = date('m', strtotime($date));
					$RoomInventory->date = $date;
					$RoomInventory->hotel_id = $RoomBookedDetails->hotel;
					$RoomInventory->plan = $request->plan[$x];
					$RoomInventory->room_cat_id = $RoomBookedDetails->room_type;
					$RoomInventory->no_of_room = $RoomBookedDetails->noofrooms;
					$RoomInventory->staying_day = $staying_day;
					$RoomInventory->save();
					
					$date = date('Y-m-d', strtotime("+1 day", strtotime($date)));
				}
			}
			
			// Send Updated Alert
			$this->sendUpdateRoomInventoryAlert($RoomBookedDetails->parent_booking_no, $old_detail, $hotel_operators);
			
			return redirect('operator/roomsstatus?year='.$search_year.'&month='.$search_mon.'&hotel='.$RoomBookedDetails->hotel)->with('flash_success', 'Room Booing Successfully Updated!');
			
        } catch (ModelNotFoundException $e) {
            return $e;
        }
    }
	
	/**
     * Upload Image for quotation
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function uploadImageQuotation(Request $request){
        try {
			//$url = Storage::disk('s3')->delete('https://ensober.s3.ap-south-1.amazonaws.com/payment_snapshots/DjY1uH9vAiZT0rxMOrmFTLErDoqjOGEF3ZBfRlGJ.png'); 
			//$url = Storage::disk('s3')->delete('payment_snapshots/DjY1uH9vAiZT0rxMOrmFTLErDoqjOGEF3ZBfRlGJ.png'); 
			//dd($url);
			$parent_booking_no = $request->booked_no;
			$send_quotation_no = $request->send_quotation_no;
			
			if($request->HasFile('payment_snapshot')){
				File::delete($request->payment_snapshot_old);
				$path = $request->file('payment_snapshot')->store('payment_snapshots');
				//$path = $request->file('payment_snapshot')->store('payment_snapshots','s3');
				//Storage::disk('s3')->setVisibility($path, 'public');

				//$url = Storage::disk('s3')->url($path); 
				//echo "<img src='".$url."' />";
				//exit;
			}else{
				$path = $request->payment_snapshot_old;
			}
			
			RoomBookedDetails::where('parent_booking_no',$parent_booking_no)->update(['payment_snapshot'=> $path]);
			
			SendQuotation::where('send_quotation_no',$send_quotation_no)->update(['payment_snapshot'=> $path]);
			
			// Add payment history
			$this->addPaymentWhileAdvance($send_quotation_no);
			
			$redirect_url = 'operator/makequotation/'.$send_quotation_no;
			if($request->update_mode == 1){
				$redirect_url = 'operator/makequotation/'.$send_quotation_no.'?update=1';
			}
			

			return redirect($redirect_url)->with('flash_success', 'Image Upload Successfully');
			
        } catch (ModelNotFoundException $e) {
            return $e;
        }
    }
	
	
	/**
     * Update room booking details
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function addPaymentWhileAdvance($send_quotation_no){ 
		$log_user = session()->get('operator');
		$quotdata = SendQuotation::where('send_quotation_no', $send_quotation_no)->first();
		$PaymentHistory = new PaymentHistory();
		$PaymentHistory->send_quotation_no = $send_quotation_no;
		$PaymentHistory->name = $quotdata->name;
		$PaymentHistory->pay_screenshort = $quotdata->payment_snapshot;
		$PaymentHistory->amount = $quotdata->advance_received;
		$PaymentHistory->payment_to = $quotdata->payment_source;
		$PaymentHistory->payment_to_id = $this->getPaymentSourceId($quotdata->hotel_id, $quotdata->payment_source);
		$PaymentHistory->create_by = $log_user['id'][0];
		$PaymentHistory->hotel = $quotdata->hotel_id;
		$PaymentHistory->checkin_date = $quotdata->checkin;
		$PaymentHistory->save();
	}
	
	/**
     * Get the room status html
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getRoomBookedStatus(Request $request){
        try {
			$operator_id = session()->get('operator.id');
			$operator = Operator::where('id', $operator_id)->first();
			
			$hotel = [];
			if($operator->room_inventory != 'Y'){
				$request->session()->forget('operator.hotel'); 
				$request->session()->push('operator.hotel', $request->hotel_id); 
			}
			
			$s_year = $request->s_year;
			$s_month = $request->s_month;
			$no_day = cal_days_in_month(CAL_GREGORIAN, $s_month, $s_year);  
			$room_status = '';
			$hotel = $this->getHotelDetailsByIdWithFullInfo($request->hotel_id);
			$hotel_name = $hotel->hotel_name;
			//dd($request->s_date);
			for($i=1; $i<=$no_day; $i++){ 
				$mon_date = $s_year.'-'.$s_month.'-'.$i;
				if($request->s_date){
					//dd($mon_date); 
					if($request->s_date != $mon_date){
						//continue;
					}
				}
				$room_status .= '
				<li id="basic_info" class="iti_input_form">
					<div class="collapsible-header">
						<div class="col s3">
							<i class="material-icons" style="margin-right: 1px; vertical-align: text-bottom;">date_range</i>'.date('D', strtotime($mon_date)).' <br>'.date('d M, y', strtotime($mon_date)).'
						</div>';
						foreach($hotel->RoomCategory as $room_cat){
							$booked_count = $this->getRoomBookingByDate($s_year, $s_month, $mon_date, $request->hotel_id, $room_cat->room_type_id);
							$room_status .= '<div class="col s3 mobile_f_s_rc">
								'.$room_cat->name.':<br> <span class="counter_style" style="font-size:13px;">';
								if($booked_count >0){
									$room_status .= '<span style="color:#b59f01;">'.$booked_count.'</span>';
								}else{
									$room_status .= '<span style="color:green;">'.$booked_count.'</span>';
								}
								$room_status .= ' / <span style="color:red;">'.$room_cat->room_count.'</span></span>
							</div>';
						}
					$room_status .= '</div>
					<div class="collapsible-body">
						<ul class="collapsible" data-collapsible="accordion">';
							$print_price = [];
							foreach($hotel->RoomCategory as $room_cat){
								$booked_count = $this->getRoomBookingByDate($s_year, $s_month, $mon_date, $request->hotel_id, $room_cat->room_type_id);
								$booked_details = $this->getRoomBookingDetailsByDate($s_year, $s_month, $mon_date, $request->hotel_id, $room_cat->room_type_id);
								
								$vacant_room = $room_cat->room_count-$booked_count;
								$room_status .= '<li id="room_type" class="room_details_main">
								<div class="collapsible-header open_room_details">
									<div class="room_cat_for_m">
										<div class="col s6">
											<i class="material-icons">hotel</i><span>'.$room_cat->name.'</span>
										</div>
										<div class="col s2" style="color:#a6a609;"> 
											R: <span class="counter_style"> '.$room_cat->room_count.'</span>
										</div>
										<div class="col s2" style="color:green;">
											B: <span class="counter_style"> '.$booked_count.'</span>
										</div>
										<div class="col s2" style="color:red;">
											V: <span class="counter_style"> '.$vacant_room.'</span>
										</div>
									</div>
									<div class="room_cat_for_d">
										<div class="col s5">
											<i class="material-icons">hotel</i>'.$room_cat->name.'
										</div>
										<div class="col s2" style="color:#a6a609;">
											Rooms: <span class="counter_style">'.$room_cat->room_count.'</span>
										</div>
										<div class="col s2" style="color:green;">
											Booked: <span class="counter_style">'.$booked_count.'</span>
										</div>
										<div class="col s2" style="color:red;">
											Vacant: <span class="counter_style">'.$vacant_room.'</span>
										</div>
									</div>
								</div>
								<div class="collapsible-body booking_details">
									
									<!-- Rooms Booking Details -->
									<span class="book_d_head"> Booking Details:-</span>
									<table class="rstbl booked_details">
										<thead>
											<tr>
												<th>Booking No</th>
												<th>Booking Status</th>
												<th>Client Name</th>
												<th>Check In</th>
												<th>Check Out</th>
												<th>No Of Rooms</th>
												<th>Total Rooms</th>
												<th>Meal Plan</th>
												<th>Total Billing</th>
												<th>Staying Day</th>
												<th>Adults</th>
												<th>Kids WB</th>
												<th>Kids WOB</th>
												<th>Infant</th>
												<th>Agent Name</th>
												<th>Booking From</th>
												<th>Source</th>
												<th>Confirmed By</th>
												<th>Comment</th>
												<th>Advance Amount</th>
												<th>Date of Advance</th>
												<th>Payment Source</th>
												<th>Comment For Balance </th>
												<th>Extras Billing</th>
												<th>Payment Snapshot</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody>';
										foreach($booked_details as $booked_detail){ 
											if($booked_detail->RoomBookedDetails['send_quotation_no'] == ''){continue;}
											
											$room_inventory = $this->getStayingDayByDate($booked_detail->room_booked_id, date('Y-m-d', strtotime($mon_date)));
											
											if($booked_detail->booking_status == 'Canceled'){
												$cancel_class = 'cancel_room_booking';
											}else{
												$cancel_class = '';
											}
											$room_status .= '<tr class="'.$cancel_class.'">
												<td>'.$booked_detail->RoomBookedDetails['send_quotation_no'].'</td>
												<td>'.$booked_detail->RoomBookedDetails['booking_status'].'</td>
												<td>'.$booked_detail->RoomBookedDetails['client_name'].'</td>
												<td>'.date('d M', strtotime($booked_detail->RoomBookedDetails['check_in'])).'</td>
												<td>'.date('d M', strtotime($booked_detail->RoomBookedDetails['check_out'])).'</td>
												<td>'.$booked_detail->RoomBookedDetails['noofrooms'].'</td>
												<td style="width:300px;">('.$room_inventory->Totalroomcount.' Rooms)</td>
												<td>'.$this->getMealShortNameByCode($booked_detail->RoomBookedDetails['plan']).'</td>';
												
												if($room_inventory->staying_day == 1 && !in_array($booked_detail->RoomBookedDetails['parent_booking_no'], $print_price)){
													$print_price[] = $booked_detail->RoomBookedDetails['parent_booking_no']; 
													$room_status .= '<td>'.$booked_detail->RoomBookedDetails['total_bill'].'</td>';
												}else{
													$room_status .= '<td>--</td>';
												}
												
												
												$room_status .= '<td>Day '.@$room_inventory->staying_day.'</td>
												<td>'.$booked_detail->RoomBookedDetails['adults'].'</td>
												<td>'.$booked_detail->RoomBookedDetails['kidswd'].'</td>
												<td>'.$booked_detail->RoomBookedDetails['kidswod'].'</td>
												<td>'.$booked_detail->RoomBookedDetails['infant'].'</td>
												<td>'.$booked_detail->RoomBookedDetails['agent_name'].'</td>
												<td>'.$booked_detail->RoomBookedDetails['booking_from'].'</td>
												<td>'.$booked_detail->RoomBookedDetails['source'].'</td>
												<td>'.$booked_detail->RoomBookedDetails['confirmed_by'].'</td>';
												
												if($room_inventory->staying_day == 1){
													$room_status .= '<td>'.$booked_detail->RoomBookedDetails['comment'].'</td>';
												}else{
													$room_status .= '<td>--</td>';
												}
												
												if($room_inventory->staying_day == 1){
													$room_status .= '<td>'.$booked_detail->RoomBookedDetails['advance_amount'].'</td>';
												}else{
													$room_status .= '<td>--</td>';
												}
												
												if($room_inventory->staying_day == 1){
													$room_status .= '<td>'.$booked_detail->RoomBookedDetails['date_of_advance'].'</td>';
												}else{
													$room_status .= '<td>--</td>';
												}
												
												if($room_inventory->staying_day == 1){
													$room_status .= '<td>'.$booked_detail->RoomBookedDetails['payment_source'].'</td>';
												}else{
													$room_status .= '<td>--</td>';
												}
												
												$room_status .= '<td>'.$booked_detail->RoomBookedDetails['comment_for_balace'].'</td>
												<td title="'.$booked_detail->RoomBookedDetails['extra_bill_comment'].'">'.$booked_detail->RoomBookedDetails['extra_bill'].'<br><span style="color: #2700ff;">'.$booked_detail->RoomBookedDetails['extra_bill_comment'].'</span></td>
												<td>';
													if($booked_detail->RoomBookedDetails['payment_snapshot']){
														$room_status .= '<a href="/storage/app/'.$booked_detail->RoomBookedDetails['payment_snapshot'].'" target="_blank"><img src="/storage/app/'.$booked_detail->RoomBookedDetails['payment_snapshot'].'" style="width:50px;" class="img-responsive"></a>'; 
													}
												$room_status .= '</td>
												<td>';
												
												if($operator->view_only != 'Y'){
													$room_status .= '<a href="/operator/makequotation/'.$booked_detail->send_quotation_no.'?update=1"><button type="button" class="btn waves-effect gradient-45deg-red-pink waves-light update_room_book_details_hide" style="float: right;margin: 2px 0 !important;padding: 0 5px !important;height: 20px !important;line-height: 2px !important;" " booking_id="'.$booked_detail->parent_booking_no.'">Update</button></a>
													
													<button type="button" class="btn waves-effect gradient-45deg-red-pink waves-light delete_room_book_details" style="float: right;margin: 2px 0 !important;padding: 0 5px !important;height: 20px !important;line-height: 2px !important;" " booking_id="'.$booked_detail->parent_booking_no.'">Delete</button>';
													
													if($booked_detail->booking_status != 'Canceled'){
														$room_status .= '<button type="button" class="btn waves-effect gradient-45deg-red-pink waves-light cancel_room_book_details" style="float: right;margin: 2px 0 !important;padding: 0 5px !important;height: 20px !important;line-height: 2px !important;" " booking_id="'.$booked_detail->parent_booking_no.'">Cancel</button>';
													}else{
														$room_status .= '<span class="reason_msg">Reason: '.$booked_detail->RoomBookedDetails['cancel_reason'].'</span>';
													}
												}
												if($booked_detail->send_quotation_no != ''){
												$link = "https://ensoberfiles.s3.amazonaws.com/quotations/".$booked_detail->send_quotation_no.".pdf";
													$room_status .= '<a href="'.$link.'" target="_blank"><button type="button" class="btn waves-effect gradient-45deg-red-pink waves-light" style="float: right;margin: 2px 0 !important;padding: 0 5px !important;height: 20px !important;line-height: 2px !important;" " booking_id="'.$booked_detail->parent_booking_no.'">Voucher</button></a>';
												}
												$room_status .= '</td>
											</tr>';
										}
										$room_status .= '</tbody>
									</table>
									<!-- /Rooms Booking Details -->
								</div>
							</li>';
								
							}
							
						$room_status .= '</ul>
					</div>
				</li>';
			}
			//echo $room_status;
			echo json_encode(array('room_status'=>$room_status,'hotel_name'=>$hotel_name));
			
        } catch (ModelNotFoundException $e) {
            return $e;
        }
    }
	
	
	/**
     * Get the room status html
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getRoomAvailable(Request $request){
        try {
			$operator_id = session()->get('operator.id');
			$operator = Operator::where('id', $operator_id)->first();
			
			$hotel = [];
			if($operator->room_inventory != 'Y'){
				$request->session()->forget('operator.hotel'); 
				$request->session()->push('operator.hotel', $request->hotel_id); 
			}
			
			$s_year = $request->s_year;
			$s_month = $request->s_month;
			$no_day = cal_days_in_month(CAL_GREGORIAN, $s_month, $s_year);  
			$room_status = '';
			$hotel = $this->getHotelDetailsByIdWithFullInfo($request->hotel_id);
			$hotel_name = $hotel->hotel_name;
			//dd($request->s_date);
			for($i=1; $i<=$no_day; $i++){ 
				$mon_date = $s_year.'-'.$s_month.'-'.$i;
				if($request->s_date){
					//dd($mon_date); 
					if($request->s_date != $mon_date){
						continue;
					}
				}
				$room_status .= '
				<li id="basic_info" class="iti_input_form">
					<div class="collapsible-header">
						<div class="col s3">
							<i class="material-icons" style="margin-right: 1px; vertical-align: text-bottom;">date_range</i>'.date('D', strtotime($mon_date)).' <br>'.date('d M, y', strtotime($mon_date)).'
						</div>';
						foreach($hotel->RoomCategory as $room_cat){
							$booked_count = $this->getRoomBookingByDate($s_year, $s_month, $mon_date, $request->hotel_id, $room_cat->room_type_id);
							$room_status .= '<div class="col s3 mobile_f_s_rc">
								'.$room_cat->name.':<br> <span class="counter_style" style="font-size:13px;">';
								if($booked_count >0){
									$room_status .= '<span style="color:#b59f01;">'.$booked_count.'</span>';
								}else{
									$room_status .= '<span style="color:green;">'.$booked_count.'</span>';
								}
								$room_status .= ' / <span style="color:red;">'.$room_cat->room_count.'</span></span>
							</div>';
						}
					$room_status .= '</div>
					</div>
				</li>';
			}
			//echo $room_status;
			echo json_encode(array('room_status'=>$room_status,'hotel_name'=>$hotel_name));
			
        } catch (ModelNotFoundException $e) {
            return $e;
        }
    }
	
	/**
     * Get room booked details for popup
     *
     * @param  $request
     * @return Html
     */     
    public function getRoomBookedDetailsPop(Request $request){
        try {
			$hotels = Hotel::All();
			$roombookingdetails = $this->getRoomBookingDetailsById($request->booking_id);
			$popup_html_new = '
						<div class="row" id="details"> 
						<div class="col s12">
							<span class="b-close close_btn" ><i class="material-icons">close</i></span>
							<h3 class="card-title follow_title" style="padding:6px 0 !important;"><strong>Updating Booking</strong></h3>
							<div class="booking_form_main">
								<div class=""> 
									<div class="col s12 m3">
										<label for="hotel">Hotel:</label><br>
										<select class="form-control hotel_list" name="hotel" id="hotel">
											<option></option>';
											foreach($hotels as $hotel){
												if($roombookingdetails[0]['hotel'] == $hotel->id){
													$popup_html_new .= '<option value="'.$hotel->id.'" selected>'.$hotel->hotel_name.'</option>';
												}else{
													$popup_html_new .= '<option value="'.$hotel->id.'">'.$hotel->hotel_name.'</option>';
												}
											}
										$popup_html_new .= '</select>
									</div>
									<div class="col s6 m3">
										<label for="client_name">Client Name:</label><br>
										<input type="hidden" class="form-control" name="send_quotation_no" id="send_quotation_no" value="'.$roombookingdetails[0]['send_quotation_no'].'"/>
										<input type="text" class="form-control" name="client_name" id="client_name" value="'.$roombookingdetails[0]['client_name'].'"/>
									</div>
									<div class="col s6 m3">
										<label for="agent_name">Agent Name:</label><br>
										<input type="text" class="form-control" name="agent_name" id="agent_name" value="'.$roombookingdetails[0]['agent_name'].'"/>
									</div>
									<div class="col s4 m3">
										<label for="total_rooms">Total Rooms:</label><br>
										<input type="number" class="form-control" name="total_rooms" id="total_rooms" value="'.$roombookingdetails[0]['total_rooms'].'"/>
									</div>
									<div class="col s4 m3">
										<label for="total_rooms">Total Billing:</label><br>
										<input type="number" class="form-control" value="'.$roombookingdetails[0]['total_bill'].'" name="total_bill" id="total_rooms"/>
									</div>
									<div class="col s4 m3">
										<label for="extra_bill">Extra Billing:</label><br>
										<input type="number" class="form-control" name="extra_bill" id="extra_bill" value="'.$roombookingdetails[0]['extra_bill'].'"/>
									</div>
									<div class="col s4 m3">
										<label for="booking_from">Booking From:</label><br>
										<select class="form-control" name="booking_from" id="booking_from">';
											if($roombookingdetails[0]['booking_from'] == 'ONLINE'){
												$popup_html_new .= '<option value="ONLINE" selected>ONLINE</option>
												<option value="ENSOBER">ENSOBER</option>
												<option value="OPERATIONTEAM">OPERATION TEAM</option>';
											}elseif($roombookingdetails[0]['booking_from'] == 'ENSOBER'){
												$popup_html_new .= '<option value="ONLINE">ONLINE</option>
												<option value="ENSOBER" selected>ENSOBER</option>
												<option value="OPERATIONTEAM">OPERATION TEAM</option>';
											}elseif($roombookingdetails[0]['booking_from'] == 'OPERATIONTEAM'){
												$popup_html_new .= '<option value="ONLINE">ONLINE</option>
												<option value="ENSOBER">ENSOBER</option>
												<option value="OPERATIONTEAM" selected>OPERATION TEAM</option>';
											}
										$popup_html_new .= '</select>
									</div>
									<div class="col s4 m3">
										<label for="source">Source:</label><br>
										<select class="form-control" name="source" id="source">
											<option value=""></option>';
											if($roombookingdetails[0]['source'] == 'AGENT'){
												$popup_html_new .= '<option value="AGENT" selected>AGENT</option>
												<option value="DIRECT">DIRECT</option>
												<option value="HOTELPARTNER">HOTEL PARTNER</option>
												<option value="ONLINE">ONLINE</option>';
											}elseif($roombookingdetails[0]['source'] == 'DIRECT'){
												$popup_html_new .= '<option value="AGENT">AGENT</option>
												<option value="DIRECT" selected>DIRECT</option>
												<option value="HOTELPARTNER">HOTEL PARTNER</option>
												<option value="ONLINE">ONLINE</option>';
											}elseif($roombookingdetails[0]['source'] == 'HOTELPARTNER'){
												$popup_html_new .= '<option value="AGENT">AGENT</option>
												<option value="DIRECT">DIRECT</option>
												<option value="HOTELPARTNER" selected>HOTEL PARTNER</option>
												<option value="ONLINE">ONLINE</option>';
											}elseif($roombookingdetails[0]['source'] == 'ONLINE'){
												$popup_html_new .= '<option value="AGENT">AGENT</option>
												<option value="DIRECT">DIRECT</option>
												<option value="HOTELPARTNER">HOTEL PARTNER</option>
												<option value="ONLINE" selected>ONLINE</option>';
											}
										$popup_html_new .= '</select>
									</div>
									<div class="col s4 m3">
										<label for="confirmed_by">Confirmed By:</label><br>
										<input type="text" class="form-control" name="confirmed_by" id="confirmed_by" value="'.$roombookingdetails[0]['confirmed_by'].'"/>
									</div>
									<div class="col s4 m3">
										<label for="advance_amount">Advance Amount:</label><br>
										<input type="number" class="form-control" name="advance_amount" id="advance_amount" value="'.$roombookingdetails[0]['advance_amount'].'"/>
									</div>
									<div class="col s4 m3">
										<label for="payment_source">Payment Source:</label><br>
										<select class="form-control" name="payment_source" id="payment_source">';
										
										$hotel_id = $roombookingdetails[0]['hotel'];
										$paymentsources = PaymentSource::where('hotel_id', $hotel_id)->where('status', 'ACTIVE')->get();
										$paymentsource_html = '<option></option>';
										foreach($paymentsources as $paymentsource){
											if($roombookingdetails[0]['payment_source'] == $paymentsource->source){
												$popup_html_new .= '<option value="'.$paymentsource->source.'" selected>'.$paymentsource->source.'</option>';
											}else{
												$popup_html_new .= '<option value="'.$paymentsource->source.'">'.$paymentsource->source.'</option>';
											}
										}
										$popup_html_new .= '</select>
									</div>
									<div class="col s4 m3">
										<label for="date_of_advance">Date Of Advance:</label><br>
										<input type="date" class="form-control" name="date_of_advance" id="date_of_advance" value="'.$roombookingdetails[0]['date_of_advance'].'"/>
									</div>
									<div class="col s12 m3">
										<label for="payment_snapshot">Payment Snapshot:</label><br>
										<input type="file" id="payment_snapshot" name="payment_snapshot" class="dropify">
										<img src="/storage/app/'.$roombookingdetails[0]['payment_snapshot'].'" style="width:50px;" class="img-responsive">
									</div>
									<div class="col s12 m3">
										<label for="comment">Comment:</label><br>
										<textarea class="form-control" name="comment" id="comment">'.$roombookingdetails[0]['comment'].'</textarea>
									</div>
									<div class="col s12 m3">
										<label for="comment_for_balace">Comment For Balace:</label><br>
										<textarea class="form-control" name="comment_for_balace" id="comment_for_balace">'.$roombookingdetails[0]['comment_for_balace'].'</textarea>
									</div>
								</div>
								
								<div class="mul_cat_room_main">';
								
									$noof_cat = count($roombookingdetails);
									for($x=0; $x<$noof_cat; $x++){
										//echo $request->room_type[$x]."<br>";
									$popup_html_new .= '<div class="mul_cat_room_details" id="mul_cat_room_details">
										<div class="col s6 m3">
											<label for="room_type">Room Category:</label><br>
											<select class="form-control room_type_list" name="room_type[]" id="room_type">
												'.$this->getHotelRoomTypes($roombookingdetails[$x]['hotel'], $roombookingdetails[$x]['room_type']).'
											</select>
										</div>
										<div class="col s6 m3">
											<label for="noofrooms">No Of Rooms:</label><br>
											<input type="number" class="form-control" name="noofrooms[]" id="noofrooms" value="'.$roombookingdetails[$x]['noofrooms'].'"/>
										</div>
										<div class="col s6 m3">
											<label for="check_in">Check In:</label><br>
											<input type="date" class="form-control" name="check_in[]" id="check_in" value="'.$roombookingdetails[$x]['check_in'].'" />
										</div>
										<div class="col s6 m3">
											<label for="check_out">Check Out:</label><br>
											<input type="date" class="form-control" name="check_out[]" id="check_out" value="'.$roombookingdetails[$x]['check_out'].'"/>
										</div>
										<div class="col s4 m3">
											<label for="plan">Meal Plan:</label><br>
											<select class="form-control" name="plan[]" id="plan">';
												if($roombookingdetails[$x]['plan'] == 'ap_price'){
													$popup_html_new .= '<option value="ep_price">EP (Room Only)</option>
													<option value="cp_price">CP (Room with Breakfast)</option>
													<option value="map_price">MAP (Room with Brkfst &amp; Dnr)</option>
													<option value="ap_price" selected>AP (Room with all meals plan)</option>';
												}elseif($roombookingdetails[$x]['plan'] == 'map_price'){
													$popup_html_new .= '<option value="ep_price">EP (Room Only)</option>
													<option value="cp_price">CP (Room with Breakfast)</option>
													<option value="map_price" selected>MAP (Room with Brkfst &amp; Dnr)</option>
													<option value="ap_price">AP (Room with all meals plan)</option>';
												}elseif($roombookingdetails[$x]['plan'] == 'cp_price'){
													$popup_html_new .= '<option value="ep_price">EP (Room Only)</option>
													<option value="cp_price" selected>CP (Room with Breakfast)</option>
													<option value="map_price">MAP (Room with Brkfst &amp; Dnr)</option>
													<option value="ap_price">AP (Room with all meals plan)</option>';
												}elseif($roombookingdetails[$x]['plan'] == 'ep_price'){
													$popup_html_new .= '<option value="ep_price" selected>EP (Room Only)</option>
													<option value="cp_price">CP (Room with Breakfast)</option>
													<option value="map_price">MAP (Room with Brkfst &amp; Dnr)</option>
													<option value="ap_price">AP (Room with all meals plan)</option>';
												}else{
													$popup_html_new .= '<option value=""></option>
													<option value="ep_price">EP (Room Only)</option>
													<option value="cp_price">CP (Room with Breakfast)</option>
													<option value="map_price">MAP (Room with Brkfst &amp; Dnr)</option>
													<option value="ap_price">AP (Room with all meals plan)</option>';
												}
											$popup_html_new .= '</select>
										</div>
										<div class="col s3 m3">
											<label for="adults">Adults:</label><br>
											<input type="number" class="form-control" name="adults[]" id="adults" value="'.$roombookingdetails[$x]['adults'].'"/>
										</div>
										<div class="col s3 m3">
											<label for="kidswd">Kids WB:</label><br>
											<input type="number" class="form-control" name="kidswd[]" id="kidswd" value="'.$roombookingdetails[$x]['kidswd'].'"/>
										</div>
										<div class="col s3 m3">
											<label for="kidswod">Kids WOB:</label><br>
											<input type="number" class="form-control" name="kidswod[]" id="kidswod" value="'.$roombookingdetails[$x]['kidswod'].'"/>
										</div>
										<div class="col s3 m3">
											<label for="infant">Infant:</label><br>
											<input type="number" class="form-control" name="infant[]" id="infant" value="'.$roombookingdetails[$x]['infant'].'"/>
										</div>
										
										<div class="col s6 m3">
											<label for="kidswd">&nbsp;</label><br>
											<div style="width: 50%; float: left; vertical-align: middle;" class="remove_btn_room_cat">
												<a class="mb-6 btn-floating gradient-45deg-purple-deep-orange" title="Delete" onclick="removeRoom($(this))" style="height: 30px;width: 30px;line-height: 32px;">
													<i class="material-icons">delete_sweep</i>
												</a>
												<span class="btn_text" style="font-size: 11px; margin: 0 5px;">Remove Room</span>
											</div>
											<div style="width: 50%; float: left; vertical-align: middle;">
												<a class="mb-6 btn-floating gradient-45deg-green-teal gradient-shadow" title="Add Row" onclick="addMoreRoom()" style="float:right;height: 30px;width: 30px;line-height: 32px;">
													<i class="material-icons">note_add</i>
												</a>
												<span class="btn_text" style="font-size: 11px; float:right; margin: 11px 5px 0; display:block;">Add Room</span>
											</div>
										</div>
									</div>';
									}
								$popup_html_new .= '</div>
																
								<div class="col s12 m12" style="text-align: right;">
									<input type="hidden" name="payment_snapshot_old" id="payment_snapshot_old" value="'.$roombookingdetails[0]['payment_snapshot'].'" />
									<input type="hidden" name="booked_no" id="booked_no" value="'.$roombookingdetails[0]['parent_booking_no'].'" />
									<button type="submit" class="btn waves-effect gradient-45deg-red-pink waves-light" id="addbookingbtn" onclick="addRoomBooking1();">Submit Room Booing</button>
									<p style="color:green;" id="add_room_msg"></p>
								</div>
							</div>
						</div>
					</div>';
					
			return $popup_html_new;
        } catch (ModelNotFoundException $e) {
            return $e;
        }
    }
	
	/**
     * This function use for get hotels category by id
     *
     * @return html
     */
    public function getHotelRoomTypeById($hotel_id, $cat_id){
		DB::enableQueryLog();
        $roomtype = RoomCategory::where('hotel_id', $hotel_id)->where('room_type_id', $cat_id)->first();
		$html = '<option value="'.$roomtype->room_type_id.'">'.$roomtype->type.' ('.$roomtype->name.')</option>';
        return $html;
    }
	
	/**
     * This function use for get hotels category by id
     *
     * @return html
     */
    public function getHotelRoomTypes($hotel_id, $cat_id){ 
        $roomtypes = RoomCategory::where('hotel_id', $hotel_id)->get();
		$html = '';
		foreach($roomtypes as $roomtype){
			$selected = '';
			if($roomtype->room_type_id == $cat_id){
				$selected = 'selected';
			}
			$html .= '<option value="'.$roomtype->room_type_id.'" '.$selected.'>'.$roomtype->type.' ('.$roomtype->name.')</option>';
		}
        return $html;
    }
	
	
	/**
     * Get no of booking particular hotel date and category
     *
     * @param  $year, $month, $date, $hotel_id, $room_cat_id
     * @return Array
     */     
    public function getRoomBookingByDate($year, $month, $date, $hotel_id, $room_cat_id){
        try {
			DB::enableQueryLog();
            $RoomInventory = RoomInventory::where('year', $year)->where('month', $month)->where('date', $date)->where('hotel_id', $hotel_id)->where('booking_status','!=','Canceled')->where('room_cat_id', $room_cat_id)->sum('no_of_room');
			//dd(DB::getQueryLog());
			return $RoomInventory;
        } catch (ModelNotFoundException $e) {
            return $e;
        }
    }
	
	/**
     * Get booking details particular hotel date and category
     *
     * @param  $year, $month, $date, $hotel_id, $room_cat_id
     * @return Array
     */     
    public function getRoomBookingDetailsByDate($year, $month, $date, $hotel_id, $room_cat_id){
        try {
			
			DB::enableQueryLog();
            $RoomInventory = RoomInventory::where('year', $year)->where('month', $month)->where('hotel_id', $hotel_id)->where('room_cat_id', $room_cat_id)->where('date', $date)->with('RoomBookedDetails')->get()->unique('room_booked_id');
			//dd(DB::getQueryLog());
			if($date == '2021-10-6'){
				//dd(DB::getQueryLog());
			}
			
			//dd($RoomInventory);
			return $RoomInventory;
        } catch (ModelNotFoundException $e) {
            return $e;
        }
    }
	
	/**
     * Get booking details particular hotel by room_book_id
     *
     * @param  $room_book_id
     * @return Array
     */     
    public function getRoomBookingDetailsByBookNo($room_book_id){
        try {
			DB::enableQueryLog();
            //$RoomInventory = RoomInventory::where('parent_booking_no', $room_book_id)->with('RoomBookedDetails')->get();
            $RoomInventory = RoomBookedDetails::where('parent_booking_no', $room_book_id)->with('hotel')->get();
			//dd($RoomInventory);
			return $RoomInventory;
        } catch (ModelNotFoundException $e) {
            return $e;
        }
    }
	
	/**
     * Get booking details by booking id
     *
     * @param  $booking_id
     * @return Array
     */     
    public function getRoomBookingDetailsById($booking_id){
        try {
			DB::enableQueryLog();
            //$Roombookdetails = RoomBookedDetails::where('booked_no', $booking_id)->first();
            $Roombookdetails = RoomBookedDetails::where('parent_booking_no', $booking_id)->get();
			return $Roombookdetails;
        } catch (ModelNotFoundException $e) {
            return $e;
        }
    }
	
	
	/**
     * Get staying day by 
     *
     * @param  $booking_id, $date
     * @return Array
     */     
    public function getStayingDayByDate($booking_id, $date){
        try {
            $RoomInventory = RoomInventory::where('room_booked_id', $booking_id)->where('date', $date)->first();
			$Totalroomcount = RoomInventory::where('parent_booking_no', $RoomInventory->parent_booking_no)->where('date', $date)->sum('no_of_room');
			$RoomInventory->Totalroomcount = $Totalroomcount;
			return $RoomInventory;
        } catch (ModelNotFoundException $e) {
            return $e;
        }
    }
	
	/**
     * This function use for Send send alert for update the room inventory.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function sendUpdateRoomInventoryAlert($room_booked_id, $old_datas, $emails=[]){
        try{
            
			$new_details = $this->getRoomBookingDetailsByBookNo($room_booked_id);
			
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
						  border: 1px solid #000;
						  text-align: left;
						  padding: 8px;
						}

						tr:nth-child(even) {
						  background-color: #dddddd;
						}
						</style>
						</head>
						<body>
						<p>Hi Team,</p>
						<br>
						<p>Booking has been updated with below details:</p><br>
						<p>Previous booking details:</p>

						<table>
						  <thead style="background-color: blanchedalmond;">
								<tr>
									<th>Booking Status</th>
									<th>Client Name</th>
									<th>Hotel Name</th>
									<th>Check In</th>
									<th>Check Out</th>
									<th>Room Category</th>
									<th>No Of Rooms</th>
									<th>Total Rooms</th>
									<th>Meal Plan</th>
									<th>Total Billing</th>
									<th>Adults</th>
									<th>Kids WB</th>
									<th>Kids WOB</th>
									<th>Infant</th>
									<th>Agent Name</th>
									<th>Booking From</th>
									<th>Source</th>
									<th>Confirmed By</th>
									<th>Comment</th>
									<th>Advance Amount</th>
									<th>Date of Advance</th>
									<th>Payment Source</th>
									<th>Comment For Balance </th>
									<th>Extras Billing</th>
									<th>Payment Snapshot</th>
								</tr>
							</thead><tbody>';
							foreach($new_details as $new_detail){
								$message .= '<tr>
											<td>'.$new_detail->booking_status.'</td>
											<td>'.$new_detail->client_name.'</td>
											<td>'.$new_detail->Hotel->hotel_name.'</td>
											<td>'.date('d M, Y', strtotime($new_detail->check_in)).'</td>
											<td>'.date('d M, Y', strtotime($new_detail->check_out)).'</td>
											<td>'.$this->getRoomTypeById($new_detail->hotel, $new_detail->room_type).'</td>
											<td>'.$new_detail->noofrooms.'</td>
											<td style="width:300px;">('.$new_detail->total_rooms.' Rooms)</td>
											<td>'.$this->getMealShortNameByCode($new_detail->plan).'</td>
											<td>'.$new_detail->total_bill.'</td>
											<td>'.$new_detail->adults.'</td>
											<td>'.$new_detail->kidswd.'</td>
											<td>'.$new_detail->kidswod.'</td>
											<td>'.$new_detail->infant.'</td>
											<td>'.$new_detail->agent_name.'</td>
											<td>'.$new_detail->booking_from.'</td>
											<td>'.$new_detail->source.'</td>
											<td>'.$new_detail->confirmed_by.'</td>
											<td>'.$new_detail->comment.'</td>
											<td>'.$new_detail->advance_amount.'</td>
											<td>'.$new_detail->date_of_advance.'</td>
											<td>'.$new_detail->payment_source.'</td>
											<td>'.$new_detail->comment_for_balace.'</td>
											<td>'.$new_detail->extra_bill.'</td>
											<td><a href="/storage/app/'.$new_detail->payment_snapshot.'" target="_blank"><img src="/storage/app/'.$new_detail->payment_snapshot.'" style="width:50px;" class="img-responsive"></a></td>
										</tr>';
							}
						$message .= '</tbody></table>
						
						
						<br>
						<p>Updated booking details:</p>

						<table>
						  <thead style="background-color: blanchedalmond;">
								<tr>
									<th>Booking Status</th>
									<th>Client Name</th>
									<th>Hotel Name</th>
									<th>Check In</th>
									<th>Check Out</th>
									<th>Room Category</th>
									<th>No Of Rooms</th>
									<th>Total Rooms</th>
									<th>Meal Plan</th>
									<th>Total Billing</th>
									<th>Adults</th>
									<th>Kids WB</th>
									<th>Kids WOB</th>
									<th>Infant</th>
									<th>Agent Name</th>
									<th>Booking From</th>
									<th>Source</th>
									<th>Confirmed By</th>
									<th>Comment</th>
									<th>Advance Amount</th>
									<th>Date of Advance</th>
									<th>Payment Source</th>
									<th>Comment For Balance </th>
									<th>Extras Billing</th>
									<th>Payment Snapshot</th>
								</tr>
							</thead><tbody>';
							foreach($old_datas as $old_data){
								$message .= '<tr>
											<td>'.$old_data->booking_status.'</td>
											<td>'.$old_data->client_name.'</td>
											<td>'.$old_data->Hotel->hotel_name.'</td>
											<td>'.date('d M, Y', strtotime($old_data->check_in)).'</td>
											<td>'.date('d M, Y', strtotime($old_data->check_out)).'</td>
											<td>'.$this->getRoomTypeById($old_data->hotel, $old_data->room_type).'</td>
											<td>'.$old_data->noofrooms.'</td>
											<td style="width:300px;">('.$old_data->total_rooms.' Rooms)</td>
											<td>'.$this->getMealShortNameByCode($old_data->plan).'</td>
											<td>'.$old_data->total_bill.'</td>
											<td>'.$old_data->adults.'</td>
											<td>'.$old_data->kidswd.'</td>
											<td>'.$old_data->kidswod.'</td>
											<td>'.$old_data->infant.'</td>
											<td>'.$old_data->agent_name.'</td>
											<td>'.$old_data->booking_from.'</td>
											<td>'.$old_data->source.'</td>
											<td>'.$old_data->confirmed_by.'</td>
											<td>'.$old_data->comment.'</td>
											<td>'.$old_data->advance_amount.'</td>
											<td>'.$old_data->date_of_advance.'</td>
											<td>'.$old_data->payment_source.'</td>
											<td>'.$old_data->comment_for_balace.'</td>
											<td>'.$old_data->extra_bill.'</td>
											<td><a href="/storage/app/'.$old_data->payment_snapshot.'" target="_blank"><img src="/storage/app/'.$old_data->payment_snapshot.'" style="width:50px;" class="img-responsive"></a></td>
										</tr>';
							}
							
						$message .= '</tbody></table><br>
						Regards,<br>
						Team Ensober
						</body>
						</html>';
						
			if(count($emails) > 0){
				foreach($emails as $email){
					$subject = "Details Updated: Guest Name-".$new_detail->client_name.", Check In ".date('d M, Y', strtotime($new_detail->check_in));
					$this->send($message, $subject, 'Sales@ensoberhotels.com', $email);
				}				
			}
			
			$subject_admin = "Details Updated: Guest Name-".$new_detail->client_name.", Check In ".date('d M, Y', strtotime($new_detail->check_in));
			$this->sendAdmin($message, $subject_admin, 'Sales@ensoberhotels.com');
			return 'Successfully!';
        } 

        catch (ModelNotFoundException $e) {
            return back()->with('flash_error', 'lead Not Found');
        }
    }
	
	
	/**
     * This function use for Send send alert for add new room inventory.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function sendNewRoomInventoryAlert($room_booked_id, $heading, $emails=[], $subj_short='New Room Added:'){
        try{
            
			$room_book_details = $this->getRoomBookingDetailsByBookNo($room_booked_id);
			
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
						  border: 1px solid #000;
						  text-align: left;
						  padding: 8px;
						}

						tr:nth-child(even) {
						  background-color: #dddddd;
						}
						</style>
						</head>
						<body>
						<h4>Hi Team,</h4>
						
						<p>'.$heading.'</p>';

						$message .= '<table>
						  <thead style="background-color: blanchedalmond;">
								<tr>
									<th>Booking Status</th>
									<th>Client Name</th>
									<th>Hotel Name</th>
									<th>Check In</th>
									<th>Check Out</th>
									<th>Room Category</th>
									<th>No Of Rooms</th>
									<th>Total Rooms</th>
									<th>Meal Plan</th>
									<th>Total Billing</th>
									<th>Adults</th>
									<th>Kids WB</th>
									<th>Kids WOB</th>
									<th>Infant</th>
									<th>Agent Name</th>
									<th>Booking From</th>
									<th>Source</th>
									<th>Confirmed By</th>
									<th>Comment</th>
									<th>Advance Amount</th>
									<th>Date of Advance</th>
									<th>Payment Source</th>
									<th>Comment For Balance </th>
									<th>Extras Billing</th>
									<th>Payment Snapshot</th>';
									if($room_book_details[0]->booking_status == 'Canceled'){
										$message .= '<th>Cancel Reason</th>';
									}
								$message .= '</tr>
							</thead><tbody>';
							foreach($room_book_details as $room_book_detail){
							
							$message .= '<tr>
											<td>'.$room_book_detail->booking_status.'</td>
											<td>'.$room_book_detail->client_name.'</td>
											<td>'.$room_book_detail->Hotel->hotel_name.'</td>
											<td>'.date('d M, Y', strtotime($room_book_detail->check_in)).'</td>
											<td>'.date('d M, Y', strtotime($room_book_detail->check_out)).'</td>
											<td>'.$this->getRoomTypeById($room_book_detail->hotel, $room_book_detail->room_type).'</td>
											<td>'.$room_book_detail->noofrooms.'</td>
											<td style="width:300px;">('.$room_book_detail->total_rooms.' Rooms)</td>
											<td>'.$this->getMealShortNameByCode($room_book_detail->plan).'</td>
											<td>'.$room_book_detail->total_bill.'</td>
											<td>'.$room_book_detail->adults.'</td>
											<td>'.$room_book_detail->kidswd.'</td>
											<td>'.$room_book_detail->kidswod.'</td>
											<td>'.$room_book_detail->infant.'</td>
											<td>'.$room_book_detail->agent_name.'</td>
											<td>'.$room_book_detail->booking_from.'</td>
											<td>'.$room_book_detail->source.'</td>
											<td>'.$room_book_detail->confirmed_by.'</td>
											<td>'.$room_book_detail->comment.'</td>
											<td>'.$room_book_detail->advance_amount.'</td>
											<td>'.$room_book_detail->date_of_advance.'</td>
											<td>'.$room_book_detail->payment_source.'</td>
											<td>'.$room_book_detail->comment_for_balace.'</td>
											<td>'.$room_book_detail->extra_bill.'</td>
											<td><a href="/storage/app/'.$room_book_detail->payment_snapshot.'" target="_blank"><img src="/storage/app/'.$room_book_detail->payment_snapshot.'" style="width:50px;" class="img-responsive"></a></td>';
											
											if($room_book_detail->booking_status == 'Canceled'){
												$message .= '<td>'.$room_book_detail->cancel_reason.'</td>';
											}										
											
										$message .= '</tr>';
							}
						$message .= '</tbody></table><br>
						Regards,<br>
						Team Ensober
						</body>
						</html>';
			
			if(count($emails) > 0){
				foreach($emails as $email){
					$subject = $subj_short." Guest Name- ".$room_book_detail->client_name.", Check In ".date('d M, Y', strtotime($room_book_detail->check_in));
					$this->send($message, $subject, 'Sales@ensoberhotels.com', $email);
				}				
			}
			$subject_admin = $subj_short." Guest Name- ".$room_book_detail->client_name.", Check In ".date('d M, Y', strtotime($room_book_detail->check_in));
			$this->sendAdmin($message, $subject_admin, 'Sales@ensoberhotels.com');
			return 'Successfully!';
        } 

        catch (ModelNotFoundException $e) {
            return back()->with('flash_error', 'lead Not Found');
        }
    }
	
	/**
     * Get total room booked
     *
     * @param  $hotel_id, $cat_id, $date
     * @return count
     */     
    public function getTotalRoomBooked($hotel_id, $room_cat_id, $date){
        try {
			DB::enableQueryLog();
            $roomavalable = RoomInventory::where('hotel_id', $hotel_id)->where('room_cat_id', $room_cat_id)->where('date', $date)->where('booking_status','!=','Canceled')->sum('no_of_room');
			return $roomavalable;
        } catch (ModelNotFoundException $e) {
            return $e;
        }
    }
	
	/**
     * Get Payment source by hotel id
     *
     * @param  $hotel_id
     * @return count
     */     
    public function getPaymentSourcesByHotelId(Request $request){
        try {
			$hotel_id = $request->hotel_id;
            $paymentsources = PaymentSource::where('hotel_id', $hotel_id)->where('status', 'ACTIVE')->get();
			$paymentsource_html = '<option></option>';
			foreach($paymentsources as $paymentsource){
				$paymentsource_html .= '<option value="'.$paymentsource->source.'" payment_to_id="'.$paymentsource->id.'">'.$paymentsource->source.'</option>';
			}
			return $paymentsource_html;
        } catch (ModelNotFoundException $e) {
            return $e;
        }
    }
	
	
	/**
     * Check room availability
     *
     * @param  $request
     * @return Array
     */     
    public function checkRoomAvailablity(Request $request){
        try {
			$hotel_total_rooms = RoomCategory::where('hotel_id', $request->hotel)->where('room_type_id', $request->room_type)->sum('room_count');
			
			$total_room_booked = $this->getTotalRoomBooked($request->hotel, $request->room_type, $request->check_in);
			
			$available_room = $hotel_total_rooms-$total_room_booked;
			if($available_room >= $request->noofrooms){
				echo json_encode(array('status'=>true,'hotel_total_rooms'=>$hotel_total_rooms, 'total_room_booked' => $total_room_booked, 'available_room' => $available_room, 'noofrooms' => $request->noofrooms, 'msg' => ''));
			}else{
				echo json_encode(array('status'=>false,'hotel_total_rooms'=>$hotel_total_rooms, 'total_room_booked' => $total_room_booked, 'available_room' => $available_room, 'noofrooms' => $request->noofrooms, 'msg' => 'Room Not Available For This Date, Total Rooms: '.$hotel_total_rooms.' Total Booked Rooms: '.$total_room_booked));
			}
        } catch (ModelNotFoundException $e) {
            return $e;
        }
    }
	
	/**
     * Get room inventory dashboard data
     *
     * @param  Request
     * @return JSON
     */
    public function roomInventoryDashboardData(Request $request){
		/* ====== Total Billing ====== */
		// Total Billing
		DB::enableQueryLog();
		$total_bill = RoomBookedDetails::select('total_bill')->where('hotel', $request->log_hotel_id)->whereBetween('check_in', array($request->from_date, $request->to_date))->where('booking_status','!=','Canceled')->groupBy('send_quotation_no')->get()->sum('total_bill');
		//dd(DB::getQueryLog()); 
		//dd($total_bill);
		
		// Extra Billing
		$extra_bill = RoomBookedDetails::where('hotel', $request->log_hotel_id)->whereBetween('check_in', array($request->from_date, $request->to_date))->where('booking_status','!=','Canceled')->distinct('parent_booking_no')->sum('extra_bill');
		
		// Cancel Advance Billing
		$advance_amount = RoomBookedDetails::where('hotel', $request->log_hotel_id)->whereBetween('check_in', array($request->from_date, $request->to_date))->where('booking_status','Canceled')->where('cancel_refund','N')->distinct('parent_booking_no')->sum('advance_amount');
		
		$PaymentSources = PaymentSource::where('hotel_id', $request->log_hotel_id)->get();
		$payment = [];
		foreach($PaymentSources as $PaymentSource){
			$advance_payment = RoomBookedDetails::where('hotel', $request->log_hotel_id)->whereBetween('check_in', array($request->from_date, $request->to_date))->where('booking_status','!=','Canceled')->where('payment_source',$PaymentSource->source)->distinct('parent_booking_no')->sum('advance_amount');
			
			$cancel_payment = RoomBookedDetails::where('hotel', $request->log_hotel_id)->whereBetween('check_in', array($request->from_date, $request->to_date))->where('booking_status','Canceled')->where('cancel_refund','N')->distinct('parent_booking_no')->where('payment_source',$PaymentSource->source)->sum('advance_amount');
			
			$payment[$PaymentSource->source] = $advance_payment+$cancel_payment;
		}
		
		$source_wise_payment = '<table>';
			$total_payment = [];
			foreach($payment as $sourse => $payment){
				$total_payment[] = $payment;
				$source_wise_payment .= '<tr>
					<td>'.$sourse.'</td>
					<td>Rs. '.number_format($payment,2).'</td>
				</tr>';
			}
			$source_wise_payment .= '<tr style="font-weight: bold; color: green;">
				<td>Total</td>
				<td>Rs. '.number_format(array_sum($total_payment),2).'</td>
			</tr>
		</table>';
		
		// Dashboard Total Billing
		$das_total_billing = $total_bill+$extra_bill+$advance_amount;
		
		// Total Room Inventory
		$inventory_rooms = RoomCategory::where('hotel_id', $request->log_hotel_id)->sum('room_count');
		
		$noofdays = $this->getNoOfDays($request->from_date, $request->to_date);
		
		if($noofdays == 0){
			$total_rooms = $inventory_rooms;
		}else{
			$total_rooms = $inventory_rooms*$noofdays;
		}
		
		// Set session for select hotel
		$operator_id = session()->get('operator.id');
		$operator = Operator::where('id', $operator_id)->first();
		
		if($operator->room_inventory != 'Y'){
			$request->session()->forget('operator.hotel'); 
			$request->session()->push('operator.hotel', $request->log_hotel_id); 
		}
		
		// Booked Rooms
		//DB::enableQueryLog();
		//$noofrooms = RoomBookedDetails::where('hotel', $request->log_hotel_id)->whereBetween('check_in', array($request->from_date, $request->to_date))->where('booking_status','!=','Canceled')->sum('noofrooms');
		$noofrooms = RoomInventory::where('hotel_id', $request->log_hotel_id)->whereBetween('date', array($request->from_date, $request->to_date))->where('booking_status','!=','Canceled')->sum('no_of_room');
		//dd(DB::getQueryLog());
		// Dashboard Total Billing Tab Details
		$das_total_billing_data = array('total_billing' => round($das_total_billing), 'total_rooms' => $total_rooms, 'booked_rooms' => $noofrooms);
		
		/* /====== Total Billing ====== */
		
		/* ====== ARR ====== */
		
		if($noofrooms > 0){
			$arr = $das_total_billing/$noofrooms;
		}else{
			$arr = 0;
		}
		
		// Dashboard ARR Tab Details
		$das_arr_data = array('arr' => round($arr), 'total_bill' => round($das_total_billing), 'total_rooms' => $total_rooms, 'booked_rooms' => $noofrooms);
		
		/* /====== ARR ====== */
		
		/* ====== AP ARR ====== */
		// AP Total Billing
		
		$ap_total_bill = RoomBookedDetails::where('hotel', $request->log_hotel_id)->whereBetween('check_in', array($request->from_date, $request->to_date))->where('booking_status','!=','Canceled')->where('plan', 'ap_price')->distinct('parent_booking_no')->sum('total_bill');
		
		// AP Extra Billing
		$ap_extra_bill = RoomBookedDetails::where('hotel', $request->log_hotel_id)->whereBetween('check_in', array($request->from_date, $request->to_date))->where('booking_status','!=','Canceled')->where('plan', 'ap_price')->distinct('parent_booking_no')->sum('extra_bill');
		
		// AP Cancel Advance Billing
		$ap_advance_amount = RoomBookedDetails::where('hotel', $request->log_hotel_id)->whereBetween('check_in', array($request->from_date, $request->to_date))->where('booking_status','Canceled')->where('cancel_refund','N')->where('plan', 'ap_price')->distinct('parent_booking_no')->sum('advance_amount');
		
		// Dashboard Total Billing
		$ap_das_total_billing = $ap_total_bill+$ap_extra_bill+$ap_advance_amount;
		
		// AP Booked Rooms
		//$ap_noofrooms = RoomBookedDetails::where('hotel', $request->log_hotel_id)->whereBetween('check_in', array($request->from_date, $request->to_date))->where('booking_status','!=','Canceled')->where('plan', 'ap_price')->sum('noofrooms');
		
		$ap_noofrooms = RoomInventory::where('hotel_id', $request->log_hotel_id)->whereBetween('date', array($request->from_date, $request->to_date))->where('booking_status','!=','Canceled')->where('plan', 'ap_price')->sum('no_of_room');
		//dd(DB::getQueryLog());
		if($ap_noofrooms > 0){
			$aparr = $ap_das_total_billing/$ap_noofrooms;
		}else{
			$aparr = 0;
		}
		
		// AP Dashboard ARR Tab Details
		$das_aparr_data = array('aparr' => round($aparr), 'ap_das_total_billing' => round($ap_das_total_billing), 'ap_total_rooms' => $total_rooms, 'ap_booked_rooms' => $ap_noofrooms);
		
		/* /====== AP ARR ====== */
		
		/* ====== MAP ARR ====== */
		// MAP Total Billing
		$map_total_bill = RoomBookedDetails::where('hotel', $request->log_hotel_id)->whereBetween('check_in', array($request->from_date, $request->to_date))->where('booking_status','!=','Canceled')->where('plan', 'map_price')->distinct('parent_booking_no')->sum('total_bill');
		
		// MAP Extra Billing
		$map_extra_bill = RoomBookedDetails::where('hotel', $request->log_hotel_id)->whereBetween('check_in', array($request->from_date, $request->to_date))->where('booking_status','!=','Canceled')->where('plan', 'map_price')->distinct('parent_booking_no')->sum('extra_bill');
		
		// MAP Cancel Advance Billing
		$map_advance_amount = RoomBookedDetails::where('hotel', $request->log_hotel_id)->whereBetween('check_in', array($request->from_date, $request->to_date))->where('booking_status','Canceled')->where('cancel_refund','N')->where('plan', 'map_price')->distinct('parent_booking_no')->sum('advance_amount');
		
		// Dashboard Total Billing
		$map_das_total_billing = $map_total_bill+$map_extra_bill+$map_advance_amount;
		//dd($map_das_total_billing);
		// MAP Booked Rooms
		//$map_noofrooms = RoomBookedDetails::where('hotel', $request->log_hotel_id)->whereBetween('check_in', array($request->from_date, $request->to_date))->where('booking_status','!=','Canceled')->where('plan', 'map_price')->sum('noofrooms');
		$map_noofrooms = RoomInventory::where('hotel_id', $request->log_hotel_id)->whereBetween('date', array($request->from_date, $request->to_date))->where('booking_status','!=','Canceled')->where('plan', 'map_price')->sum('no_of_room');
		//dd(DB::getQueryLog());
		if($map_noofrooms > 0){
			$maparr = $map_das_total_billing/$map_noofrooms;
		}else{
			$maparr = 0;
		}
		
		// MAP Dashboard ARR Tab Details
		$das_maparr_data = array('maparr' => round($maparr), 'map_das_total_billing' => round($map_das_total_billing), 'map_total_rooms' => $total_rooms, 'map_booked_rooms' => $map_noofrooms);
		
		/* /====== MAP ARR ====== */
		
		/* ====== CP ARR ====== */
		// CP Total Billing
		$cp_total_bill = RoomBookedDetails::where('hotel', $request->log_hotel_id)->whereBetween('check_in', array($request->from_date, $request->to_date))->where('booking_status','!=','Canceled')->where('plan', 'cp_price')->distinct('parent_booking_no')->sum('total_bill');
		
		// CP Extra Billing
		$cp_extra_bill = RoomBookedDetails::where('hotel', $request->log_hotel_id)->whereBetween('check_in', array($request->from_date, $request->to_date))->where('booking_status','!=','Canceled')->where('plan', 'cp_price')->distinct('parent_booking_no')->sum('extra_bill');
		
		// CP Cancel Advance Billing
		$cp_advance_amount = RoomBookedDetails::where('hotel', $request->log_hotel_id)->whereBetween('check_in', array($request->from_date, $request->to_date))->where('booking_status','Canceled')->where('cancel_refund','N')->where('plan', 'cp_price')->distinct('parent_booking_no')->sum('advance_amount');
		
		// Dashboard Total Billing
		$cp_das_total_billing = $cp_total_bill+$cp_extra_bill+$cp_advance_amount;
		
		// CP Booked Rooms
		//$cp_noofrooms = RoomBookedDetails::where('hotel', $request->log_hotel_id)->whereBetween('check_in', array($request->from_date, $request->to_date))->where('booking_status','!=','Canceled')->where('plan', 'cp_price')->sum('noofrooms');
		//DB::enableQueryLog();
		$cp_noofrooms = RoomInventory::where('hotel_id', $request->log_hotel_id)->whereBetween('date', array($request->from_date, $request->to_date))->where('booking_status','!=','Canceled')->where('plan', 'cp_price')->sum('no_of_room');
		//dd(DB::getQueryLog());
		if($cp_noofrooms > 0){
			$cparr = $cp_das_total_billing/$cp_noofrooms;
		}else{
			$cparr = 0;
		}
		
		// CP Dashboard ARR Tab Details
		$das_cparr_data = array('cparr' => round($cparr), 'cp_das_total_billing' => round($cp_das_total_billing), 'cp_total_rooms' => $total_rooms, 'cp_booked_rooms' => $cp_noofrooms);
		
		/* /====== CP ARR ====== */
		
		/* ====== EP ARR ====== */
		// EP Total Billing
		$ep_total_bill = RoomBookedDetails::where('hotel', $request->log_hotel_id)->whereBetween('check_in', array($request->from_date, $request->to_date))->where('booking_status','!=','Canceled')->where('plan', 'ep_price')->distinct('parent_booking_no')->sum('total_bill');
		
		// EP Extra Billing
		$ep_extra_bill = RoomBookedDetails::where('hotel', $request->log_hotel_id)->whereBetween('check_in', array($request->from_date, $request->to_date))->where('booking_status','!=','Canceled')->where('plan', 'ep_price')->distinct('parent_booking_no')->sum('extra_bill');
		
		// EP Cancel Advance Billing
		$ep_advance_amount = RoomBookedDetails::where('hotel', $request->log_hotel_id)->whereBetween('check_in', array($request->from_date, $request->to_date))->where('booking_status','Canceled')->where('cancel_refund','N')->where('plan', 'ep_price')->distinct('parent_booking_no')->sum('advance_amount');
		
		// Dashboard Total Billing
		$ep_das_total_billing = $ep_total_bill+$ep_extra_bill+$ep_advance_amount;
		
		// EP Booked Rooms
		//$ep_noofrooms = RoomBookedDetails::where('hotel', $request->log_hotel_id)->whereBetween('check_in', array($request->from_date, $request->to_date))->where('booking_status','!=','Canceled')->where('plan', 'ep_price')->sum('noofrooms');
		$ep_noofrooms = RoomInventory::where('hotel_id', $request->log_hotel_id)->whereBetween('date', array($request->from_date, $request->to_date))->where('booking_status','!=','Canceled')->where('plan', 'ep_price')->sum('no_of_room');
		
		if($ep_noofrooms > 0){
			$eparr = $ep_das_total_billing/$ep_noofrooms;
		}else{
			$eparr = 0;
		}
		
		// EP Dashboard ARR Tab Details
		$das_eparr_data = array('eparr' => round($eparr), 'ep_das_total_billing' => round($ep_das_total_billing), 'ep_total_rooms' => $total_rooms, 'ep_booked_rooms' => $ep_noofrooms);
		
		/* /====== EP ARR ====== */
		
		/* ====== Today Occupancy ====== */
		//$today_noofrooms = RoomBookedDetails::where('hotel', $request->log_hotel_id)->whereBetween('check_in', array('2021-04-02', '2021-04-02'))->where('booking_status','!=','Canceled')->sum('noofrooms');
		
		$today_noofrooms = RoomInventory::where('hotel_id', $request->log_hotel_id)->whereBetween('date', array(date('Y-m-d'), date('Y-m-d')))->where('booking_status','!=','Canceled')->sum('no_of_room');
		
		$today_acc = $today_noofrooms/$inventory_rooms*100;
		
		// Dashboard Today Occupancy Tab Details
		$das_todayocc_data = array('today_acc' => number_format($today_acc,2), 'today_acc_total_rooms' => $inventory_rooms, 'today_acc_booked_rooms' => $today_noofrooms);
		
		/* /====== Today Occupancy ====== */
		
		/* ====== Occupancy ====== */
		
		if($total_rooms > 0){
			$acc = $noofrooms/$total_rooms*100;
		}else{
			$acc = 0;
		} 
		
		// Dashboard Occupancy Tab Details
		$das_occ_data = array('acc' => number_format($acc,2), 'acc_total_rooms' => $total_rooms, 'acc_booked_rooms' => $noofrooms);
		
		/* /====== Occupancy ====== */
		
		/* ====== Week Day Occupancy ====== */
		$from_date = $request->from_date;
		$to_date = $request->to_date;
		$noofdays = $this->getNoOfDays($from_date, $to_date, 1);
		$weekday_noofrooms = DB::select(DB::raw("select sum(`no_of_room`) as aggregate from `room_inventory` where `hotel_id` = $request->log_hotel_id and `date` between '$from_date' and '$to_date' and `booking_status` != 'Canceled' and DAYOFWEEK(date) NOT IN (1,7);"));
		$weekday_noofrooms = $weekday_noofrooms[0]->aggregate;
		if(!$weekday_noofrooms){
			$weekday_noofrooms = 0;
		}
		$inventory_rooms_weekday = $inventory_rooms*$noofdays;
		$weekday_acc = $weekday_noofrooms/$inventory_rooms_weekday*100; 
		
		// Dashboard Week Day Occupancy Tab Details
		$das_week_day_occ_data = array('weekday_acc' => number_format($weekday_acc,2), 'weekday_acc_total_rooms' => $inventory_rooms_weekday, 'weekday_acc_booked_rooms' => $weekday_noofrooms);
		
		/* /====== Week Day Occupancy ====== */
		
		/* ====== Week End Occupancy ====== */
		$weekend_noofrooms = DB::select(DB::raw("select sum(`no_of_room`) as aggregate from `room_inventory` where `hotel_id` = $request->log_hotel_id and `date` between '$from_date' and '$to_date' and `booking_status` != 'Canceled' and DAYOFWEEK(date) IN (1,7);"));
		$weekend_noofrooms = $weekend_noofrooms[0]->aggregate;
		$noofdays_weekend = $this->getNoOfDays($from_date, $to_date, 2);
		$inventory_rooms_weekend = $inventory_rooms*$noofdays_weekend;
		if(!$weekend_noofrooms){
			$weekend_noofrooms = 0;
			$weekend_acc = 0;
		}else{
			$weekend_acc = $weekend_noofrooms/$inventory_rooms_weekend*100;
		}
		
		// Dashboard Occupancy Tab Details
		$das_week_end_occ_data = array('weekend_acc' => number_format($weekend_acc,2), 'weekend_acc_total_rooms' => $inventory_rooms_weekend, 'weekend_acc_booked_rooms' => $weekend_noofrooms);
		
		/* /====== Week End Occupancy ====== */
		
		
		
		/* ====== Today Pax ====== */
		
		// Adult
		$today_noofadult = RoomBookedDetails::where('hotel', $request->log_hotel_id)->whereBetween('check_in', array(date('Y-m-d'), date('Y-m-d')))->where('booking_status','!=','Canceled')->sum('adults');
		
		// Chield
		$today_noofkidswd = RoomBookedDetails::where('hotel', $request->log_hotel_id)->whereBetween('check_in', array(date('Y-m-d'), date('Y-m-d')))->where('booking_status','!=','Canceled')->sum('kidswd');
		
		$today_noofkidswod = RoomBookedDetails::where('hotel', $request->log_hotel_id)->whereBetween('check_in', array(date('Y-m-d'), date('Y-m-d')))->where('booking_status','!=','Canceled')->sum('kidswod');
		
		$today_noofchield = $today_noofkidswd+$today_noofkidswod;
		
		// Infant
		$today_noofinfant = RoomBookedDetails::where('hotel', $request->log_hotel_id)->whereBetween('check_in', array(date('Y-m-d'), date('Y-m-d')))->where('booking_status','!=','Canceled')->sum('infant');
		
		$today_total_pax = $today_noofadult+$today_noofchield+$today_noofinfant;
		// Dashboard Today Pax Tab Details
		$das_todaypax_data = array('today_total_pax' => $today_total_pax, 'today_noofadult' => $today_noofadult, 'today_noofchield' => $today_noofchield, 'today_noofinfant' => $today_noofinfant);
		
		/* /====== Today Pax ====== */
		
		
		// Total Adults
		$total_adult = RoomBookedDetails::where('hotel', $request->log_hotel_id)->whereBetween('check_in', array($request->from_date, $request->to_date))->where('booking_status','!=','Canceled')->sum('adults');
		
		// Total Chields
		$total_kidswd = RoomBookedDetails::where('hotel', $request->log_hotel_id)->whereBetween('check_in', array($request->from_date, $request->to_date))->where('booking_status','!=','Canceled')->sum('kidswd');
		
		$total_kidswod = RoomBookedDetails::where('hotel', $request->log_hotel_id)->whereBetween('check_in', array($request->from_date, $request->to_date))->where('booking_status','!=','Canceled')->sum('kidswod');
		
		$total_chield = $total_kidswd+$total_kidswod;
		
		
		// Total Infants
		$total_infant = RoomBookedDetails::where('hotel', $request->log_hotel_id)->whereBetween('check_in', array($request->from_date, $request->to_date))->where('booking_status','!=','Canceled')->sum('infant');
		
		//dd($this->numberOfWorkingDays($request->from_date, $request->to_date));
		echo json_encode(array('status'=>true,'reqeust'=> $request->all(), 'total_bill' => $total_bill, 'extra_bill' => $extra_bill, 'advance_amount' => $advance_amount, 'das_total_billing' => $das_total_billing, 'das_total_billing_data' => $das_total_billing_data, 'das_arr_data' => $das_arr_data, 'das_aparr_data' => $das_aparr_data, 'das_maparr_data' => $das_maparr_data, 'das_cparr_data' => $das_cparr_data, 'das_eparr_data' => $das_eparr_data, 'das_todayocc_data' => $das_todayocc_data, 'das_occ_data' => $das_occ_data, 'das_week_day_occ_data' => $das_week_day_occ_data, 'das_week_end_occ_data' => $das_week_end_occ_data, 'das_todaypax_data' => $das_todaypax_data, 'total_adult' => $total_adult, 'total_chield' => $total_chield, 'total_infant' => $total_infant, 'source_wise_payment' => $source_wise_payment));
    }
	
	/**
     * Get room inventory dashboard data for online booking only
     *
     * @param  Request
     * @return JSON
     */
    public function roomInventoryDashboardDataOnline(Request $request){
		/* ====== Total Billing ====== */
		// Total Billing
		$total_bill = RoomBookedDetails::select('total_bill')->where('hotel', $request->log_hotel_id)->whereBetween('check_in', array($request->from_date, $request->to_date))->where('booking_status','!=','Canceled')->where('source', 'ONLINE')->groupBy('send_quotation_no')->get()->sum('total_bill');
		
		
		// Extra Billing
		$extra_bill = RoomBookedDetails::where('hotel', $request->log_hotel_id)->whereBetween('check_in', array($request->from_date, $request->to_date))->where('booking_status','!=','Canceled')->where('source', 'ONLINE')->distinct('parent_booking_no')->sum('extra_bill');
		
		// Cancel Advance Billing
		$advance_amount = RoomBookedDetails::where('hotel', $request->log_hotel_id)->whereBetween('check_in', array($request->from_date, $request->to_date))->where('booking_status','Canceled')->where('cancel_refund','N')->where('source', 'ONLINE')->distinct('parent_booking_no')->sum('advance_amount');
		
		$PaymentSources = PaymentSource::where('hotel_id', $request->log_hotel_id)->get();
		$payment = [];
		foreach($PaymentSources as $PaymentSource){
			$advance_payment = RoomBookedDetails::where('hotel', $request->log_hotel_id)->whereBetween('check_in', array($request->from_date, $request->to_date))->where('booking_status','!=','Canceled')->where('source', 'ONLINE')->where('payment_source',$PaymentSource->source)->distinct('parent_booking_no')->sum('advance_amount');
			
			$cancel_payment = RoomBookedDetails::where('hotel', $request->log_hotel_id)->whereBetween('check_in', array($request->from_date, $request->to_date))->where('booking_status','Canceled')->where('cancel_refund','N')->where('source', 'ONLINE')->distinct('parent_booking_no')->where('payment_source',$PaymentSource->source)->sum('advance_amount');
			
			$payment[$PaymentSource->source] = $advance_payment+$cancel_payment;
		}
		
		$source_wise_payment = '<table>';
			$total_payment = [];
			foreach($payment as $sourse => $payment){
				$total_payment[] = $payment;
				$source_wise_payment .= '<tr>
					<td>'.$sourse.'</td>
					<td>Rs. '.number_format($payment,2).'</td>
				</tr>';
			}
			$source_wise_payment .= '<tr style="font-weight: bold; color: green;">
				<td>Total</td>
				<td>Rs. '.number_format(array_sum($total_payment),2).'</td>
			</tr>
		</table>';
		
		// Dashboard Total Billing
		$das_total_billing = $total_bill+$extra_bill+$advance_amount;
		
		// Total Room Inventory
		$inventory_rooms = RoomCategory::where('hotel_id', $request->log_hotel_id)->sum('room_count');
		
		$noofdays = $this->getNoOfDays($request->from_date, $request->to_date);
		
		if($noofdays == 0){
			$total_rooms = $inventory_rooms;
		}else{
			$total_rooms = $inventory_rooms*$noofdays;
		}
		
		// Set session for select hotel
		$operator_id = session()->get('operator.id');
		$operator = Operator::where('id', $operator_id)->first();
		
		if($operator->room_inventory != 'Y'){
			$request->session()->forget('operator.hotel'); 
			$request->session()->push('operator.hotel', $request->log_hotel_id); 
		}
		
		// Booked Rooms
		//DB::enableQueryLog();
		//$noofrooms = RoomBookedDetails::where('hotel', $request->log_hotel_id)->whereBetween('check_in', array($request->from_date, $request->to_date))->where('booking_status','!=','Canceled')->sum('noofrooms');
		$noofrooms = RoomInventory::where('hotel_id', $request->log_hotel_id)->whereBetween('date', array($request->from_date, $request->to_date))->where('booking_status','!=','Canceled')->where('source', 'ONLINE')->sum('no_of_room');
		//dd(DB::getQueryLog());
		// Dashboard Total Billing Tab Details
		$das_total_billing_data = array('total_billing' => round($das_total_billing), 'total_rooms' => $total_rooms, 'booked_rooms' => $noofrooms);
		
		/* /====== Total Billing ====== */
		
		/* ====== ARR ====== */
		
		if($noofrooms > 0){
			$arr = $das_total_billing/$noofrooms;
		}else{
			$arr = 0;
		}
		
		// Dashboard ARR Tab Details
		$das_arr_data = array('arr' => round($arr), 'total_bill' => round($das_total_billing), 'total_rooms' => $total_rooms, 'booked_rooms' => $noofrooms);
		
		/* /====== ARR ====== */
		
		/* ====== AP ARR ====== */
		// AP Total Billing
		
		$ap_total_bill = RoomBookedDetails::where('hotel', $request->log_hotel_id)->whereBetween('check_in', array($request->from_date, $request->to_date))->where('booking_status','!=','Canceled')->where('plan', 'ap_price')->where('source', 'ONLINE')->distinct('parent_booking_no')->sum('total_bill');
		
		// AP Extra Billing
		$ap_extra_bill = RoomBookedDetails::where('hotel', $request->log_hotel_id)->whereBetween('check_in', array($request->from_date, $request->to_date))->where('booking_status','!=','Canceled')->where('plan', 'ap_price')->where('source', 'ONLINE')->distinct('parent_booking_no')->sum('extra_bill');
		
		// AP Cancel Advance Billing
		$ap_advance_amount = RoomBookedDetails::where('hotel', $request->log_hotel_id)->whereBetween('check_in', array($request->from_date, $request->to_date))->where('booking_status','Canceled')->where('cancel_refund','N')->where('plan', 'ap_price')->where('source', 'ONLINE')->distinct('parent_booking_no')->sum('advance_amount');
		
		// Dashboard Total Billing
		$ap_das_total_billing = $ap_total_bill+$ap_extra_bill+$ap_advance_amount;
		
		// AP Booked Rooms
		//$ap_noofrooms = RoomBookedDetails::where('hotel', $request->log_hotel_id)->whereBetween('check_in', array($request->from_date, $request->to_date))->where('booking_status','!=','Canceled')->where('plan', 'ap_price')->sum('noofrooms');
		
		$ap_noofrooms = RoomInventory::where('hotel_id', $request->log_hotel_id)->whereBetween('date', array($request->from_date, $request->to_date))->where('booking_status','!=','Canceled')->where('source', 'ONLINE')->where('plan', 'ap_price')->sum('no_of_room');
		//dd(DB::getQueryLog());
		if($ap_noofrooms > 0){
			$aparr = $ap_das_total_billing/$ap_noofrooms;
		}else{
			$aparr = 0;
		}
		
		// AP Dashboard ARR Tab Details
		$das_aparr_data = array('aparr' => round($aparr), 'ap_das_total_billing' => round($ap_das_total_billing), 'ap_total_rooms' => $total_rooms, 'ap_booked_rooms' => $ap_noofrooms);
		
		/* /====== AP ARR ====== */
		
		/* ====== MAP ARR ====== */
		// MAP Total Billing
		$map_total_bill = RoomBookedDetails::where('hotel', $request->log_hotel_id)->whereBetween('check_in', array($request->from_date, $request->to_date))->where('booking_status','!=','Canceled')->where('plan', 'map_price')->where('source', 'ONLINE')->distinct('parent_booking_no')->sum('total_bill');
		
		// MAP Extra Billing
		$map_extra_bill = RoomBookedDetails::where('hotel', $request->log_hotel_id)->whereBetween('check_in', array($request->from_date, $request->to_date))->where('booking_status','!=','Canceled')->where('plan', 'map_price')->where('source', 'ONLINE')->distinct('parent_booking_no')->sum('extra_bill');
		
		// MAP Cancel Advance Billing
		$map_advance_amount = RoomBookedDetails::where('hotel', $request->log_hotel_id)->whereBetween('check_in', array($request->from_date, $request->to_date))->where('booking_status','Canceled')->where('cancel_refund','N')->where('plan', 'map_price')->where('source', 'ONLINE')->distinct('parent_booking_no')->sum('advance_amount');
		
		// Dashboard Total Billing
		$map_das_total_billing = $map_total_bill+$map_extra_bill+$map_advance_amount;
		//dd($map_das_total_billing);
		// MAP Booked Rooms
		//$map_noofrooms = RoomBookedDetails::where('hotel', $request->log_hotel_id)->whereBetween('check_in', array($request->from_date, $request->to_date))->where('booking_status','!=','Canceled')->where('plan', 'map_price')->sum('noofrooms');
		$map_noofrooms = RoomInventory::where('hotel_id', $request->log_hotel_id)->whereBetween('date', array($request->from_date, $request->to_date))->where('booking_status','!=','Canceled')->where('source', 'ONLINE')->where('plan', 'map_price')->sum('no_of_room');
		//dd(DB::getQueryLog());
		if($map_noofrooms > 0){
			$maparr = $map_das_total_billing/$map_noofrooms;
		}else{
			$maparr = 0;
		}
		
		// MAP Dashboard ARR Tab Details
		$das_maparr_data = array('maparr' => round($maparr), 'map_das_total_billing' => round($map_das_total_billing), 'map_total_rooms' => $total_rooms, 'map_booked_rooms' => $map_noofrooms);
		
		/* /====== MAP ARR ====== */
		
		/* ====== CP ARR ====== */
		// CP Total Billing
		$cp_total_bill = RoomBookedDetails::where('hotel', $request->log_hotel_id)->whereBetween('check_in', array($request->from_date, $request->to_date))->where('booking_status','!=','Canceled')->where('plan', 'cp_price')->where('source', 'ONLINE')->distinct('parent_booking_no')->sum('total_bill');
		
		// CP Extra Billing
		$cp_extra_bill = RoomBookedDetails::where('hotel', $request->log_hotel_id)->whereBetween('check_in', array($request->from_date, $request->to_date))->where('booking_status','!=','Canceled')->where('plan', 'cp_price')->where('source', 'ONLINE')->distinct('parent_booking_no')->sum('extra_bill');
		
		// CP Cancel Advance Billing
		$cp_advance_amount = RoomBookedDetails::where('hotel', $request->log_hotel_id)->whereBetween('check_in', array($request->from_date, $request->to_date))->where('booking_status','Canceled')->where('cancel_refund','N')->where('plan', 'cp_price')->where('source', 'ONLINE')->distinct('parent_booking_no')->sum('advance_amount');
		
		// Dashboard Total Billing
		$cp_das_total_billing = $cp_total_bill+$cp_extra_bill+$cp_advance_amount;
		
		// CP Booked Rooms
		//$cp_noofrooms = RoomBookedDetails::where('hotel', $request->log_hotel_id)->whereBetween('check_in', array($request->from_date, $request->to_date))->where('booking_status','!=','Canceled')->where('plan', 'cp_price')->sum('noofrooms');
		//DB::enableQueryLog();
		$cp_noofrooms = RoomInventory::where('hotel_id', $request->log_hotel_id)->whereBetween('date', array($request->from_date, $request->to_date))->where('booking_status','!=','Canceled')->where('source', 'ONLINE')->where('plan', 'cp_price')->sum('no_of_room');
		//dd(DB::getQueryLog());
		if($cp_noofrooms > 0){
			$cparr = $cp_das_total_billing/$cp_noofrooms;
		}else{
			$cparr = 0;
		}
		
		// CP Dashboard ARR Tab Details
		$das_cparr_data = array('cparr' => round($cparr), 'cp_das_total_billing' => round($cp_das_total_billing), 'cp_total_rooms' => $total_rooms, 'cp_booked_rooms' => $cp_noofrooms);
		
		/* /====== CP ARR ====== */
		
		/* ====== EP ARR ====== */
		// EP Total Billing
		$ep_total_bill = RoomBookedDetails::where('hotel', $request->log_hotel_id)->whereBetween('check_in', array($request->from_date, $request->to_date))->where('booking_status','!=','Canceled')->where('plan', 'ep_price')->where('source', 'ONLINE')->distinct('parent_booking_no')->sum('total_bill');
		
		// EP Extra Billing
		$ep_extra_bill = RoomBookedDetails::where('hotel', $request->log_hotel_id)->whereBetween('check_in', array($request->from_date, $request->to_date))->where('booking_status','!=','Canceled')->where('plan', 'ep_price')->where('source', 'ONLINE')->distinct('parent_booking_no')->sum('extra_bill');
		
		// EP Cancel Advance Billing
		$ep_advance_amount = RoomBookedDetails::where('hotel', $request->log_hotel_id)->whereBetween('check_in', array($request->from_date, $request->to_date))->where('booking_status','Canceled')->where('cancel_refund','N')->where('plan', 'ep_price')->where('source', 'ONLINE')->distinct('parent_booking_no')->sum('advance_amount');
		
		// Dashboard Total Billing
		$ep_das_total_billing = $ep_total_bill+$ep_extra_bill+$ep_advance_amount;
		
		// EP Booked Rooms
		//$ep_noofrooms = RoomBookedDetails::where('hotel', $request->log_hotel_id)->whereBetween('check_in', array($request->from_date, $request->to_date))->where('booking_status','!=','Canceled')->where('plan', 'ep_price')->sum('noofrooms');
		$ep_noofrooms = RoomInventory::where('hotel_id', $request->log_hotel_id)->whereBetween('date', array($request->from_date, $request->to_date))->where('booking_status','!=','Canceled')->where('source', 'ONLINE')->where('plan', 'ep_price')->sum('no_of_room');
		
		if($ep_noofrooms > 0){
			$eparr = $ep_das_total_billing/$ep_noofrooms;
		}else{
			$eparr = 0;
		}
		
		// EP Dashboard ARR Tab Details
		$das_eparr_data = array('eparr' => round($eparr), 'ep_das_total_billing' => round($ep_das_total_billing), 'ep_total_rooms' => $total_rooms, 'ep_booked_rooms' => $ep_noofrooms);
		
		/* /====== EP ARR ====== */
		
		/* ====== Today Occupancy ====== */
		//$today_noofrooms = RoomBookedDetails::where('hotel', $request->log_hotel_id)->whereBetween('check_in', array('2021-04-02', '2021-04-02'))->where('booking_status','!=','Canceled')->sum('noofrooms');
		
		$today_noofrooms = RoomInventory::where('hotel_id', $request->log_hotel_id)->whereBetween('date', array(date('Y-m-d'), date('Y-m-d')))->where('booking_status','!=','Canceled')->where('source', 'ONLINE')->sum('no_of_room');
		
		$today_acc = $today_noofrooms/$inventory_rooms*100;
		
		// Dashboard Today Occupancy Tab Details
		$das_todayocc_data = array('today_acc' => number_format($today_acc,2), 'today_acc_total_rooms' => $inventory_rooms, 'today_acc_booked_rooms' => $today_noofrooms);
		
		/* /====== Today Occupancy ====== */
		
		/* ====== Occupancy ====== */
		
		if($total_rooms > 0){
			$acc = $noofrooms/$total_rooms*100;
		}else{
			$acc = 0;
		} 
		
		// Dashboard Occupancy Tab Details
		$das_occ_data = array('acc' => number_format($acc,2), 'acc_total_rooms' => $total_rooms, 'acc_booked_rooms' => $noofrooms);
		
		/* /====== Occupancy ====== */
		
		/* ====== Week Day Occupancy ====== */
		$from_date = $request->from_date;
		$to_date = $request->to_date;
		$noofdays = $this->getNoOfDays($from_date, $to_date, 1);
		$weekday_noofrooms = DB::select(DB::raw("select sum(`no_of_room`) as aggregate from `room_inventory` where `hotel_id` = $request->log_hotel_id and `date` between '$from_date' and '$to_date' and `booking_status` != 'Canceled' and `source` = 'ONLINE' and DAYOFWEEK(date) NOT IN (1,7);"));
		$weekday_noofrooms = $weekday_noofrooms[0]->aggregate;
		if(!$weekday_noofrooms){
			$weekday_noofrooms = 0;
		}
		$inventory_rooms_weekday = $inventory_rooms*$noofdays;
		if($weekday_noofrooms == 0){
			$weekday_acc = $weekday_noofrooms/$inventory_rooms_weekday*100; 
		}else{
			$weekday_acc = 0; 
		}
		
		// Dashboard Week Day Occupancy Tab Details
		$das_week_day_occ_data = array('weekday_acc' => number_format($weekday_acc,2), 'weekday_acc_total_rooms' => $inventory_rooms_weekday, 'weekday_acc_booked_rooms' => $weekday_noofrooms);
		
		/* /====== Week Day Occupancy ====== */
		
		/* ====== Week End Occupancy ====== */
		$weekend_noofrooms = DB::select(DB::raw("select sum(`no_of_room`) as aggregate from `room_inventory` where `hotel_id` = $request->log_hotel_id and `date` between '$from_date' and '$to_date' and `booking_status` != 'Canceled' and `source` = 'ONLINE' and DAYOFWEEK(date) IN (1,7);"));
		$weekend_noofrooms = $weekend_noofrooms[0]->aggregate;
		$noofdays_weekend = $this->getNoOfDays($from_date, $to_date, 2);
		$inventory_rooms_weekend = $inventory_rooms*$noofdays_weekend;
		if(!$weekend_noofrooms){
			$weekend_noofrooms = 0;
			$weekend_acc = 0;
		}else{
			$weekend_acc = $weekend_noofrooms/$inventory_rooms_weekend*100;
		}
		
		// Dashboard Occupancy Tab Details
		$das_week_end_occ_data = array('weekend_acc' => number_format($weekend_acc,2), 'weekend_acc_total_rooms' => $inventory_rooms_weekend, 'weekend_acc_booked_rooms' => $weekend_noofrooms);
		
		/* /====== Week End Occupancy ====== */
		
		
		
		/* ====== Today Pax ====== */
		
		// Adult
		$today_noofadult = RoomBookedDetails::where('hotel', $request->log_hotel_id)->whereBetween('check_in', array(date('Y-m-d'), date('Y-m-d')))->where('booking_status','!=','Canceled')->where('source', 'ONLINE')->sum('adults');
		
		// Chield
		$today_noofkidswd = RoomBookedDetails::where('hotel', $request->log_hotel_id)->whereBetween('check_in', array(date('Y-m-d'), date('Y-m-d')))->where('booking_status','!=','Canceled')->where('source', 'ONLINE')->sum('kidswd');
		
		$today_noofkidswod = RoomBookedDetails::where('hotel', $request->log_hotel_id)->whereBetween('check_in', array(date('Y-m-d'), date('Y-m-d')))->where('booking_status','!=','Canceled')->where('source', 'ONLINE')->sum('kidswod');
		
		$today_noofchield = $today_noofkidswd+$today_noofkidswod;
		
		// Infant
		$today_noofinfant = RoomBookedDetails::where('hotel', $request->log_hotel_id)->whereBetween('check_in', array(date('Y-m-d'), date('Y-m-d')))->where('booking_status','!=','Canceled')->where('source', 'ONLINE')->sum('infant');
		
		$today_total_pax = $today_noofadult+$today_noofchield+$today_noofinfant;
		// Dashboard Today Pax Tab Details
		$das_todaypax_data = array('today_total_pax' => $today_total_pax, 'today_noofadult' => $today_noofadult, 'today_noofchield' => $today_noofchield, 'today_noofinfant' => $today_noofinfant);
		
		/* /====== Today Pax ====== */
		
		
		// Total Adults
		$total_adult = RoomBookedDetails::where('hotel', $request->log_hotel_id)->whereBetween('check_in', array($request->from_date, $request->to_date))->where('booking_status','!=','Canceled')->where('source', 'ONLINE')->sum('adults');
		
		// Total Chields
		$total_kidswd = RoomBookedDetails::where('hotel', $request->log_hotel_id)->whereBetween('check_in', array($request->from_date, $request->to_date))->where('booking_status','!=','Canceled')->where('source', 'ONLINE')->sum('kidswd');
		
		$total_kidswod = RoomBookedDetails::where('hotel', $request->log_hotel_id)->whereBetween('check_in', array($request->from_date, $request->to_date))->where('booking_status','!=','Canceled')->where('source', 'ONLINE')->sum('kidswod');
		
		$total_chield = $total_kidswd+$total_kidswod;
		
		
		// Total Infants
		$total_infant = RoomBookedDetails::where('hotel', $request->log_hotel_id)->whereBetween('check_in', array($request->from_date, $request->to_date))->where('booking_status','!=','Canceled')->where('source', 'ONLINE')->sum('infant');
		
		//dd($this->numberOfWorkingDays($request->from_date, $request->to_date));
		echo json_encode(array('status'=>true,'reqeust'=> $request->all(), 'total_bill' => $total_bill, 'extra_bill' => $extra_bill, 'advance_amount' => $advance_amount, 'das_total_billing' => $das_total_billing, 'das_total_billing_data' => $das_total_billing_data, 'das_arr_data' => $das_arr_data, 'das_aparr_data' => $das_aparr_data, 'das_maparr_data' => $das_maparr_data, 'das_cparr_data' => $das_cparr_data, 'das_eparr_data' => $das_eparr_data, 'das_todayocc_data' => $das_todayocc_data, 'das_occ_data' => $das_occ_data, 'das_week_day_occ_data' => $das_week_day_occ_data, 'das_week_end_occ_data' => $das_week_end_occ_data, 'das_todaypax_data' => $das_todaypax_data, 'total_adult' => $total_adult, 'total_chield' => $total_chield, 'total_infant' => $total_infant, 'source_wise_payment' => $source_wise_payment));
    }
	
	/**
     * Get room inventory dashboard data for offline booking only
     *
     * @param  Request
     * @return JSON
     */
    public function roomInventoryDashboardDataOffline(Request $request){
		/* ====== Total Billing ====== */
		// Total Billing
		$total_bill = RoomBookedDetails::select('total_bill')->where('hotel', $request->log_hotel_id)->whereBetween('check_in', array($request->from_date, $request->to_date))->where('booking_status','!=','Canceled')->where('source','!=', 'ONLINE')->groupBy('send_quotation_no')->get()->sum('total_bill');
		
		// Extra Billing
		$extra_bill = RoomBookedDetails::where('hotel', $request->log_hotel_id)->whereBetween('check_in', array($request->from_date, $request->to_date))->where('booking_status','!=','Canceled')->where('source','!=', 'OFFLINE')->distinct('parent_booking_no')->sum('extra_bill');
		
		// Cancel Advance Billing
		$advance_amount = RoomBookedDetails::where('hotel', $request->log_hotel_id)->whereBetween('check_in', array($request->from_date, $request->to_date))->where('booking_status','Canceled')->where('cancel_refund','N')->where('source','!=', 'OFFLINE')->distinct('parent_booking_no')->sum('advance_amount');
		
		$PaymentSources = PaymentSource::where('hotel_id', $request->log_hotel_id)->get();
		$payment = [];
		foreach($PaymentSources as $PaymentSource){
			DB::enableQueryLog();
			$advance_payment_new = RoomBookedDetails::select('advance_amount')->where('booking_from', '!=', 'ONLINE')->whereBetween('check_in',[$request->from_date,$request->to_date])->where('hotel',$request->log_hotel_id)->where('payment_source', $PaymentSource->source)->groupBy('send_quotation_no')->orderBy('check_in','ASC')->get();
			$advance_payment = 0;
			foreach($advance_payment_new as $advance_payment_n){
				$advance_payment += $advance_payment_n->advance_amount;
			}
			//$advance_payment = RoomBookedDetails::where('hotel', $request->log_hotel_id)->whereBetween('check_in', array($request->from_date, $request->to_date))->where('booking_status','!=','Canceled')->where('booking_from','!=', 'OFFLINE')->where('payment_source','DayAway')->distinct('send_quotation_no')->sum('advance_amount');
			//dd(DB::getQueryLog());
			//DD($advance_payment);
			$cancel_payment = RoomBookedDetails::where('hotel', $request->log_hotel_id)->whereBetween('check_in', array($request->from_date, $request->to_date))->where('booking_status','Canceled')->where('cancel_refund','N')->where('source','!=', 'OFFLINE')->distinct('send_quotation_no')->where('payment_source',$PaymentSource->source)->sum('advance_amount');
			$payment[$PaymentSource->source] = $advance_payment+$cancel_payment;
		}
		
		$source_wise_payment = '<table>';
			$total_payment = [];
			foreach($payment as $sourse => $payment){
				$total_payment[] = $payment;
				$source_wise_payment .= '<tr>
					<td>'.$sourse.'</td>
					<td>Rs. '.number_format($payment,2).'</td>
				</tr>';
			}
			$source_wise_payment .= '<tr style="font-weight: bold; color: green;">
				<td>Total</td>
				<td>Rs. '.number_format(array_sum($total_payment),2).'</td>
			</tr>
		</table>';
		
		// Dashboard Total Billing
		$das_total_billing = $total_bill+$extra_bill+$advance_amount;
		
		// Total Room Inventory
		$inventory_rooms = RoomCategory::where('hotel_id', $request->log_hotel_id)->sum('room_count');
		
		$noofdays = $this->getNoOfDays($request->from_date, $request->to_date);
		
		if($noofdays == 0){
			$total_rooms = $inventory_rooms;
		}else{
			$total_rooms = $inventory_rooms*$noofdays;
		}
		
		// Set session for select hotel
		$operator_id = session()->get('operator.id');
		$operator = Operator::where('id', $operator_id)->first();
		
		if($operator->room_inventory != 'Y'){
			$request->session()->forget('operator.hotel'); 
			$request->session()->push('operator.hotel', $request->log_hotel_id); 
		}
		
		// Booked Rooms
		//DB::enableQueryLog();
		//$noofrooms = RoomBookedDetails::where('hotel', $request->log_hotel_id)->whereBetween('check_in', array($request->from_date, $request->to_date))->where('booking_status','!=','Canceled')->sum('noofrooms');
		$noofrooms = RoomInventory::where('hotel_id', $request->log_hotel_id)->whereBetween('date', array($request->from_date, $request->to_date))->where('booking_status','!=','Canceled')->where('source', '!=', 'ONLINE')->sum('no_of_room');
		//dd(DB::getQueryLog());
		// Dashboard Total Billing Tab Details
		$das_total_billing_data = array('total_billing' => round($das_total_billing), 'total_rooms' => $total_rooms, 'booked_rooms' => $noofrooms);
		
		/* /====== Total Billing ====== */
		
		/* ====== ARR ====== */
		
		if($noofrooms > 0){
			$arr = $das_total_billing/$noofrooms;
		}else{
			$arr = 0;
		}
		
		// Dashboard ARR Tab Details
		$das_arr_data = array('arr' => round($arr), 'total_bill' => round($das_total_billing), 'total_rooms' => $total_rooms, 'booked_rooms' => $noofrooms);
		
		/* /====== ARR ====== */
		
		/* ====== AP ARR ====== */
		// AP Total Billing
		
		$ap_total_bill = RoomBookedDetails::where('hotel', $request->log_hotel_id)->whereBetween('check_in', array($request->from_date, $request->to_date))->where('booking_status','!=','Canceled')->where('plan', 'ap_price')->where('source','!=', 'ONLINE')->distinct('parent_booking_no')->sum('total_bill');
		
		// AP Extra Billing
		$ap_extra_bill = RoomBookedDetails::where('hotel', $request->log_hotel_id)->whereBetween('check_in', array($request->from_date, $request->to_date))->where('booking_status','!=','Canceled')->where('plan', 'ap_price')->where('source','!=', 'ONLINE')->distinct('parent_booking_no')->sum('extra_bill');
		
		// AP Cancel Advance Billing
		$ap_advance_amount = RoomBookedDetails::where('hotel', $request->log_hotel_id)->whereBetween('check_in', array($request->from_date, $request->to_date))->where('booking_status','Canceled')->where('cancel_refund','N')->where('plan', 'ap_price')->where('source','!=', 'ONLINE')->distinct('parent_booking_no')->sum('advance_amount');
		
		// Dashboard Total Billing
		$ap_das_total_billing = $ap_total_bill+$ap_extra_bill+$ap_advance_amount;
		
		// AP Booked Rooms
		//$ap_noofrooms = RoomBookedDetails::where('hotel', $request->log_hotel_id)->whereBetween('check_in', array($request->from_date, $request->to_date))->where('booking_status','!=','Canceled')->where('plan', 'ap_price')->sum('noofrooms');
		
		$ap_noofrooms = RoomInventory::where('hotel_id', $request->log_hotel_id)->whereBetween('date', array($request->from_date, $request->to_date))->where('booking_status','!=','Canceled')->where('source', '!=', 'ONLINE')->where('plan', 'ap_price')->sum('no_of_room');
		//dd(DB::getQueryLog());
		if($ap_noofrooms > 0){
			$aparr = $ap_das_total_billing/$ap_noofrooms;
		}else{
			$aparr = 0;
		}
		
		// AP Dashboard ARR Tab Details
		$das_aparr_data = array('aparr' => round($aparr), 'ap_das_total_billing' => round($ap_das_total_billing), 'ap_total_rooms' => $total_rooms, 'ap_booked_rooms' => $ap_noofrooms);
		
		/* /====== AP ARR ====== */
		
		/* ====== MAP ARR ====== */
		// MAP Total Billing
		$map_total_bill = RoomBookedDetails::where('hotel', $request->log_hotel_id)->whereBetween('check_in', array($request->from_date, $request->to_date))->where('booking_status','!=','Canceled')->where('plan', 'map_price')->where('source','!=', 'ONLINE')->distinct('parent_booking_no')->sum('total_bill');
		
		// MAP Extra Billing
		$map_extra_bill = RoomBookedDetails::where('hotel', $request->log_hotel_id)->whereBetween('check_in', array($request->from_date, $request->to_date))->where('booking_status','!=','Canceled')->where('plan', 'map_price')->where('source','!=', 'ONLINE')->distinct('parent_booking_no')->sum('extra_bill');
		
		// MAP Cancel Advance Billing
		$map_advance_amount = RoomBookedDetails::where('hotel', $request->log_hotel_id)->whereBetween('check_in', array($request->from_date, $request->to_date))->where('booking_status','Canceled')->where('cancel_refund','N')->where('plan', 'map_price')->where('source','!=', 'ONLINE')->distinct('parent_booking_no')->sum('advance_amount');
		
		// Dashboard Total Billing
		$map_das_total_billing = $map_total_bill+$map_extra_bill+$map_advance_amount;
		//dd($map_das_total_billing);
		// MAP Booked Rooms
		//$map_noofrooms = RoomBookedDetails::where('hotel', $request->log_hotel_id)->whereBetween('check_in', array($request->from_date, $request->to_date))->where('booking_status','!=','Canceled')->where('plan', 'map_price')->sum('noofrooms');
		$map_noofrooms = RoomInventory::where('hotel_id', $request->log_hotel_id)->whereBetween('date', array($request->from_date, $request->to_date))->where('booking_status','!=','Canceled')->where('source', '!=', 'ONLINE')->where('plan', 'map_price')->sum('no_of_room');
		//dd(DB::getQueryLog());
		if($map_noofrooms > 0){
			$maparr = $map_das_total_billing/$map_noofrooms;
		}else{
			$maparr = 0;
		}
		
		// MAP Dashboard ARR Tab Details
		$das_maparr_data = array('maparr' => round($maparr), 'map_das_total_billing' => round($map_das_total_billing), 'map_total_rooms' => $total_rooms, 'map_booked_rooms' => $map_noofrooms);
		
		/* /====== MAP ARR ====== */
		
		/* ====== CP ARR ====== */
		// CP Total Billing
		$cp_total_bill = RoomBookedDetails::where('hotel', $request->log_hotel_id)->whereBetween('check_in', array($request->from_date, $request->to_date))->where('booking_status','!=','Canceled')->where('plan', 'cp_price')->where('source','!=', 'ONLINE')->distinct('parent_booking_no')->sum('total_bill');
		
		// CP Extra Billing
		$cp_extra_bill = RoomBookedDetails::where('hotel', $request->log_hotel_id)->whereBetween('check_in', array($request->from_date, $request->to_date))->where('booking_status','!=','Canceled')->where('plan', 'cp_price')->where('source','!=', 'ONLINE')->distinct('parent_booking_no')->sum('extra_bill');
		
		// CP Cancel Advance Billing
		$cp_advance_amount = RoomBookedDetails::where('hotel', $request->log_hotel_id)->whereBetween('check_in', array($request->from_date, $request->to_date))->where('booking_status','Canceled')->where('cancel_refund','N')->where('plan', 'cp_price')->where('source','!=', 'ONLINE')->distinct('parent_booking_no')->sum('advance_amount');
		
		// Dashboard Total Billing
		$cp_das_total_billing = $cp_total_bill+$cp_extra_bill+$cp_advance_amount;
		
		// CP Booked Rooms
		//$cp_noofrooms = RoomBookedDetails::where('hotel', $request->log_hotel_id)->whereBetween('check_in', array($request->from_date, $request->to_date))->where('booking_status','!=','Canceled')->where('plan', 'cp_price')->sum('noofrooms');
		//DB::enableQueryLog();
		$cp_noofrooms = RoomInventory::where('hotel_id', $request->log_hotel_id)->whereBetween('date', array($request->from_date, $request->to_date))->where('booking_status','!=','Canceled')->where('source', '!=', 'ONLINE')->where('plan', 'cp_price')->sum('no_of_room');
		//dd(DB::getQueryLog());
		if($cp_noofrooms > 0){
			$cparr = $cp_das_total_billing/$cp_noofrooms;
		}else{
			$cparr = 0;
		}
		
		// CP Dashboard ARR Tab Details
		$das_cparr_data = array('cparr' => round($cparr), 'cp_das_total_billing' => round($cp_das_total_billing), 'cp_total_rooms' => $total_rooms, 'cp_booked_rooms' => $cp_noofrooms);
		
		/* /====== CP ARR ====== */
		
		/* ====== EP ARR ====== */
		// EP Total Billing
		$ep_total_bill = RoomBookedDetails::where('hotel', $request->log_hotel_id)->whereBetween('check_in', array($request->from_date, $request->to_date))->where('booking_status','!=','Canceled')->where('plan', 'ep_price')->where('source','!=', 'ONLINE')->distinct('parent_booking_no')->sum('total_bill');
		
		// EP Extra Billing
		$ep_extra_bill = RoomBookedDetails::where('hotel', $request->log_hotel_id)->whereBetween('check_in', array($request->from_date, $request->to_date))->where('booking_status','!=','Canceled')->where('plan', 'ep_price')->where('source','!=', 'ONLINE')->distinct('parent_booking_no')->sum('extra_bill');
		
		// EP Cancel Advance Billing
		$ep_advance_amount = RoomBookedDetails::where('hotel', $request->log_hotel_id)->whereBetween('check_in', array($request->from_date, $request->to_date))->where('booking_status','Canceled')->where('cancel_refund','N')->where('plan', 'ep_price')->where('source','!=', 'ONLINE')->distinct('parent_booking_no')->sum('advance_amount');
		
		// Dashboard Total Billing
		$ep_das_total_billing = $ep_total_bill+$ep_extra_bill+$ep_advance_amount;
		
		// EP Booked Rooms
		//$ep_noofrooms = RoomBookedDetails::where('hotel', $request->log_hotel_id)->whereBetween('check_in', array($request->from_date, $request->to_date))->where('booking_status','!=','Canceled')->where('plan', 'ep_price')->sum('noofrooms');
		$ep_noofrooms = RoomInventory::where('hotel_id', $request->log_hotel_id)->whereBetween('date', array($request->from_date, $request->to_date))->where('booking_status','!=','Canceled')->where('source', '!=', 'ONLINE')->where('plan', 'ep_price')->sum('no_of_room');
		
		if($ep_noofrooms > 0){
			$eparr = $ep_das_total_billing/$ep_noofrooms;
		}else{
			$eparr = 0;
		}
		
		// EP Dashboard ARR Tab Details
		$das_eparr_data = array('eparr' => round($eparr), 'ep_das_total_billing' => round($ep_das_total_billing), 'ep_total_rooms' => $total_rooms, 'ep_booked_rooms' => $ep_noofrooms);
		
		/* /====== EP ARR ====== */
		
		/* ====== Today Occupancy ====== */
		//$today_noofrooms = RoomBookedDetails::where('hotel', $request->log_hotel_id)->whereBetween('check_in', array('2021-04-02', '2021-04-02'))->where('booking_status','!=','Canceled')->sum('noofrooms');
		
		$today_noofrooms = RoomInventory::where('hotel_id', $request->log_hotel_id)->whereBetween('date', array(date('Y-m-d'), date('Y-m-d')))->where('booking_status','!=','Canceled')->where('source', '!=', 'ONLINE')->sum('no_of_room');
		
		$today_acc = $today_noofrooms/$inventory_rooms*100;
		
		// Dashboard Today Occupancy Tab Details
		$das_todayocc_data = array('today_acc' => number_format($today_acc,2), 'today_acc_total_rooms' => $inventory_rooms, 'today_acc_booked_rooms' => $today_noofrooms);
		
		/* /====== Today Occupancy ====== */
		
		/* ====== Occupancy ====== */
		
		if($total_rooms > 0){
			$acc = $noofrooms/$total_rooms*100;
		}else{
			$acc = 0;
		} 
		
		// Dashboard Occupancy Tab Details
		$das_occ_data = array('acc' => number_format($acc,2), 'acc_total_rooms' => $total_rooms, 'acc_booked_rooms' => $noofrooms);
		
		/* /====== Occupancy ====== */
		
		/* ====== Week Day Occupancy ====== */
		$from_date = $request->from_date;
		$to_date = $request->to_date;
		$noofdays = $this->getNoOfDays($from_date, $to_date, 1);
		$weekday_noofrooms = DB::select(DB::raw("select sum(`no_of_room`) as aggregate from `room_inventory` where `hotel_id` = $request->log_hotel_id and `date` between '$from_date' and '$to_date' and `booking_status` != 'Canceled' and `source` != 'ONLINE' and DAYOFWEEK(date) NOT IN (1,7);"));
		$weekday_noofrooms = $weekday_noofrooms[0]->aggregate;
		if(!$weekday_noofrooms){
			$weekday_noofrooms = 0;
		}
		$inventory_rooms_weekday = $inventory_rooms*$noofdays;
		if($weekday_noofrooms != 0){
			$weekday_acc = $weekday_noofrooms/$inventory_rooms_weekday*100;
		}else{
			$weekday_acc = 0;
		} 
		
		// Dashboard Week Day Occupancy Tab Details
		$das_week_day_occ_data = array('weekday_acc' => number_format($weekday_acc,2), 'weekday_acc_total_rooms' => $inventory_rooms_weekday, 'weekday_acc_booked_rooms' => $weekday_noofrooms);
		
		/* /====== Week Day Occupancy ====== */
		
		/* ====== Week End Occupancy ====== */
		$weekend_noofrooms = DB::select(DB::raw("select sum(`no_of_room`) as aggregate from `room_inventory` where `hotel_id` = $request->log_hotel_id and `date` between '$from_date' and '$to_date' and `booking_status` != 'Canceled' and `source` != 'ONLINE' and DAYOFWEEK(date) IN (1,7);"));
		$weekend_noofrooms = $weekend_noofrooms[0]->aggregate;
		$noofdays_weekend = $this->getNoOfDays($from_date, $to_date, 2);
		$inventory_rooms_weekend = $inventory_rooms*$noofdays_weekend;
		if(!$weekend_noofrooms){
			$weekend_noofrooms = 0;
			$weekend_acc = 0;
		}else{
			$weekend_acc = $weekend_noofrooms/$inventory_rooms_weekend*100;
		}
		
		// Dashboard Occupancy Tab Details
		$das_week_end_occ_data = array('weekend_acc' => number_format($weekend_acc,2), 'weekend_acc_total_rooms' => $inventory_rooms_weekend, 'weekend_acc_booked_rooms' => $weekend_noofrooms);
		
		/* /====== Week End Occupancy ====== */
		
		
		
		/* ====== Today Pax ====== */
		
		// Adult
		$today_noofadult = RoomInventory::where('hotel_id', $request->log_hotel_id)->whereBetween('date', array(date('Y-m-d'), date('Y-m-d')))->where('booking_status','!=','Canceled')->where('source','!=', 'ONLINE')->sum('adult');
		
		// Chield
		$today_noofchield = RoomInventory::where('hotel_id', $request->log_hotel_id)->whereBetween('date', array(date('Y-m-d'), date('Y-m-d')))->where('booking_status','!=','Canceled')->where('source','!=', 'ONLINE')->sum('kids');
		
		// Infant
		$today_noofinfant = RoomInventory::where('hotel_id', $request->log_hotel_id)->whereBetween('date', array(date('Y-m-d'), date('Y-m-d')))->where('booking_status','!=','Canceled')->where('source','!=', 'ONLINE')->sum('infant');
		
		$today_total_pax = $today_noofadult+$today_noofchield+$today_noofinfant;
		// Dashboard Today Pax Tab Details
		$das_todaypax_data = array('today_total_pax' => $today_total_pax, 'today_noofadult' => $today_noofadult, 'today_noofchield' => $today_noofchield, 'today_noofinfant' => $today_noofinfant);
		
		/* /====== Today Pax ====== */
		
		
		// Total Adults
		$total_adult = RoomInventory::where('hotel_id', $request->log_hotel_id)->whereBetween('date', array($request->from_date, $request->to_date))->where('booking_status','!=','Canceled')->where('source','!=', 'ONLINE')->sum('adult');
		
		// Total Chields
		$total_chield = RoomInventory::where('hotel_id', $request->log_hotel_id)->whereBetween('date', array($request->from_date, $request->to_date))->where('booking_status','!=','Canceled')->where('source','!=', 'ONLINE')->sum('kids');
		
		
		// Total Infants
		$total_infant = RoomInventory::where('hotel_id', $request->log_hotel_id)->whereBetween('date', array($request->from_date, $request->to_date))->where('booking_status','!=','Canceled')->where('source','!=', 'ONLINE')->sum('infant');
		
		//dd($this->numberOfWorkingDays($request->from_date, $request->to_date));
		echo json_encode(array('status'=>true,'reqeust'=> $request->all(), 'total_bill' => $total_bill, 'extra_bill' => $extra_bill, 'advance_amount' => $advance_amount, 'das_total_billing' => $das_total_billing, 'das_total_billing_data' => $das_total_billing_data, 'das_arr_data' => $das_arr_data, 'das_aparr_data' => $das_aparr_data, 'das_maparr_data' => $das_maparr_data, 'das_cparr_data' => $das_cparr_data, 'das_eparr_data' => $das_eparr_data, 'das_todayocc_data' => $das_todayocc_data, 'das_occ_data' => $das_occ_data, 'das_week_day_occ_data' => $das_week_day_occ_data, 'das_week_end_occ_data' => $das_week_end_occ_data, 'das_todaypax_data' => $das_todaypax_data, 'total_adult' => $total_adult, 'total_chield' => $total_chield, 'total_infant' => $total_infant, 'source_wise_payment' => $source_wise_payment));
    }
	
	/**
	 * This function use for get the all booking
	 *
	 * @return all booking page
	 */
	public function getAllBooking(Request $request){ 
		if (session()->exists('operator')) {
			$user=session()->get('operator');
            $operator_id = session()->get('operator.id');
			$operator = Operator::where('id', $operator_id)->first();
            $hotel_id = session()->get('operator.hotel');
            $hotel = $this->getHotelDetailsByIdWithFullInfo(@$hotel_id[0]);
			$hotels = Hotel::All();
			if($request->hotel_id != '' && ($request->from == '' && $request->to == '')){
				$bookings = RoomBookedDetails::where('hotel', $request->hotel_id)->where('user_id', $user['id'][0])->where('company_id', $user['company_id'][0])->where('property_id', $user['property_id'][0])->orderBy('check_in', 'ASC')->paginate(10);
			}elseif($request->hotel_id == '' && $request->from != '' && $request->to != ''){
				$bookings = RoomBookedDetails::where('user_id', $user['id'][0])->where('company_id', $user['company_id'][0])->where('property_id', $user['property_id'][0])->whereBetween('check_in', array($request->from, $request->to))->orderBy('check_in', 'ASC')->paginate(10);
			}elseif($request->hotel_id != '' && $request->from != '' && $request->to != ''){
				$bookings = RoomBookedDetails::where('user_id', $user['id'][0])->where('company_id', $user['company_id'][0])->where('property_id', $user['property_id'][0])->where('hotel', $request->hotel_id)->whereBetween('check_in', array($request->from, $request->to))->orderBy('check_in', 'ASC')->paginate(10);
			}else{
				if($operator->room_inventory == 'Y'){
					$bookings = RoomBookedDetails::where('user_id', $user['id'][0])->where('company_id', $user['company_id'][0])->where('property_id', $user['property_id'][0])->where('hotel', $hotel_id)->orderBy('check_in', 'ASC')->paginate(10);
				}else{
					$bookings = RoomBookedDetails::where('user_id', $user['id'][0])->where('company_id', $user['company_id'][0])->where('property_id', $user['property_id'][0])->orderBy('check_in', 'ASC')->paginate(10);
				}
			}
			
            return view('operator/allbooking', compact('hotels','hotel','operator','bookings'));
		}else{
			return redirect('/operator'); 
		}
	}
	
	/**
	 * This function use for delete the booking
	 *
	 * @return all booking page
	 */
	public function deleteBooking($id){ 
		if (session()->exists('operator')) {
            $bookings = RoomBookedDetails::where('id', $id)->delete();
			return redirect()->back();
		}else{
			return redirect('/operator'); 
		}
	}
	
	
	/**
	 * This function use for get the all booking
	 *
	 * @return all booking page
	 */
	public function checkSeasonHotelRateAvailable(Request $request){ 
		if (session()->exists('operator')) {
            $operator_id = session()->get('operator.id');
			$operator = Operator::where('id', $operator_id)->first();
			
			$checkin = $request->checkin;
			$hotel = $request->hotel;
			$room_type = $request->room_type;
            
			$hotel_rate = $this->GetSeasonHotelRate($checkin, $hotel, $room_type);
			if($hotel_rate['status'] == true){
				echo json_encode(array('rate_status'=>$hotel_rate['status'],'hotelseasonrate'=> $hotel_rate['hotelseasonrate']));
			}else{
				echo json_encode(array('rate_status'=>$hotel_rate['status'],'hotelseasonrate'=> $hotel_rate['hotelseasonrate']));
			}
		}else{
			echo json_encode(array('status'=>false,'hotelseasonrate'=> ''));
		} 
	}
	
	/**
	 * This function use for voucher download
	 *
	 * @return view
	 */
	public function downloadVoucher($id){
		$voucher = Voucher::findOrFail($id);
		return view('admin.voucher.dwnvoucher', compact('voucher'));
		$pdf = PDF::loadView('admin.voucher.dwnvoucher', compact('voucher'));
		return $pdf->download('pdfview.pdf');
    }
	
	/**
	 * This function use for get the hotel name by id
	 *
	 * @return hotel name
	 */
	public function getHotelNameById(Request $request){
		$hotel_id = $request->hotel_id;
		$hotel = Hotel::select('hotel_name')->where('id', $hotel_id)->first();
		return $hotel->hotel_name;
    }
	
	/**
     * This function use for Send followup report to operator email.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function sendActivityVoucherReport(){
        try{
			$timestamp = strtotime("tomorrow");
            $vouchers = ActivityVoucher::where('date', date("Y-m-d", $timestamp))->with('Vender')->get();
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
			<p>Dear Admin,</p>
			<br>
			<h2>Tomorrow Activity Report</h2>

			<table>
			  <tr style="background-color: #183678; color: #fff;">
				<th class="" >Voucher No</th>                   
				<th class="" >Activity</th>                  
				<th class="" >Name</th>                  
				<th class="" >Mobile</th>                  
				<th class="" >Email</th>                  
				<th class="" >Adults</th>                  
				<th class="" >Chields</th>                  
				<th class="" >Total Visitors</th>                  
				<th class="" >Date</th>   
				<th class="" >Time</th>  
				<th class="" >Slot</th>  
				<th class="" >Actual Cost</th>  
				<th class="" >Total Bill</th>  
				<th class="" >Advance</th>  
				<th class="" >Received By</th>  
				<th class="" >Advance Date</th>  
				<th class="" >Balance</th>  
				<th class="" >Vendor</th> 
				<th class="" >PDF</th>  
			  </tr>';
				foreach($vouchers as $voucher){
					$message .= '<tr>
						<td>'.$voucher->voucher_no.'</td>
						<td>'.$voucher->activity_id.'</td>
						<td>'.$voucher->client_name.'</td>
						<td>'.$voucher->mobile.'</td>
						<td>'.$voucher->email.'</td>
						<td>'.$voucher->adults.'</td>
						<td>'.$voucher->chields.'</td>
						<td>'.$voucher->total_visitors.'</td>
						<td>'.date('d M Y', strtotime($voucher->date)).'</td>
						<td>'.$voucher->time.'</td>
						<td>'.ucwords(str_replace('_',' ', $voucher->slot)).'</td>
						<td>'.$voucher->actual_cost.'</td>
						<td>'.$voucher->total_bill.'</td>
						<td>'.$voucher->advance_received.'</td>
						<td>'.$voucher->payment_received_by.'</td>
						<td>'.date('d M Y', strtotime($voucher->date_of_advance)).'</td>
						<td>'.$voucher->balance.'</td>
						<td>'.$voucher->Vender->name.'</td>
						<td> <a href="/storage/app/quotations/'.$voucher->voucher_no.'.pdf" target="_blank">Voucher</a></td> 					
					</tr>';
				}
				$message .= '</table>

			</body>
			</html>';
			
			if(count($vouchers) > 0){
				$this->sendAdmin($message, 'Tomorrow Activity Report', 'Sales@ensoberhotels.com');
				return 'Successfully!';
			}else{
				return 'Data Not Found!';
			}
        } 

        catch (ModelNotFoundException $e) {
            return back()->with('flash_error', $e);
        }
    }
	
}
