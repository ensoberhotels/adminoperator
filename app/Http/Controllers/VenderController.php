<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use DB;
use Storage;


use App\Admin;
use App\Vender;
use App\Hotel;
use App\Operator;
use App\HotelGallery;
use App\HotelAmenity;
use App\Amenity;
use App\RoomCategory;
use App\HotelSeasonRate;
use App\PaidAmenity;
use App\HotelGroupSeasonRate;
use App\Lead;
use App\Quotation;
use App\Sale;
use App\City;
use App\Transport;
use App\Car;
use App\CarSegment;
use App\CarModel;
use App\CarSeats;
use App\Country;
use App\Region;
use App\ITIRoute;
use App\ITIBasicInfo;
use App\ITITransport;
use App\ITIHotel;
use App\ITIActivity;
use App\ITIPrice;

class VenderController extends Controller
{
	
	/**
	 * This function use for load admin login view
	 *
	 * @return admin login page
	 */
	public function index(){
		return view('vender.login');
	}
	
	/**
	 * This function use for Vender login action
	 *
	 * @return admin login page
	 */
	public function venderLogin(Request $request){
		
		$this->validate($request, [
			'user' => 'required',
			'password' => 'required',
		]);
		
		try{
			$vender = Vender::where('email', $request->user)->first();
			//dd($vender);
			if($vender != "" && Hash::check($request->password, $vender->password)){
				$request->session()->regenerate();
				$request->session()->put('vender', $vender->name);
                $request->session()->push('vender.id', $vender->id);
				$request->session()->push('vender.vender_type', $vender->vender_type);
				return redirect('vender/dashboard');
			}else{
				return redirect('vender');
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
	public function dashboard(){
		if (session()->exists('vender')) {
           return view('vender/dashboard');
		}else{
			return redirect('/vender');
		}
	}

	/**
	 * This function use for logout admin 
	 *
	 * @return vender login page
	 */
	public function logout(){
		session()->flush();
		return redirect('/vender');
	}

	/**
	 * This function use for add hotel
	 *
	 * @return array
	 */
	public function addHotel(){
		return view('vender/addhotel');
	}


	/**
	 * This function use for get all hotels
	 *
	 * @return array
	 */
	public function hotelList(){
		return view('vender/hotellist');
	}
    
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
       return view('vender/hotels/viewhotel', compact('Hotel','hotelamenity','hotelroomcategoires', 'hotelgalleries','hotelseasonrate', 'current_date'));
    }
	
	public function makeItinerary(){
		$cities = City::select('hotels.*','cities.id as city_id','cities.name as name')->join('hotels', 'cities.id', '=', 'hotels.city_id')->groupBy('cities.id')->get();
		return view('vender/makeitinerary', compact('cities'));
	}
	
	public function makeItineraryNew(){
		//$cities = City::select('hotels.*','cities.id as city_id','cities.name as name')->join('hotels', 'cities.id', '=', 'hotels.city_id')->groupBy('cities.id')->get();
		$cities = City::select('id as city_id','name as name')->where('itinerary_city','1')->groupBy('id')->get();
		
		$transports = Transport::orderBy('id' , 'desc')->with('car')->with('venderName')->with('car_segment')->with('car_model')->with('car_seats')->with('countryName')->with('stateName')->with('cityName')->get();
		
		return view('vender/makeitinerarynew', compact('cities','transports'));
	}
	
	// Make itinerary in mobile
	public function makeItineraryNewM(){
		$cities = City::select('id as city_id','name as name')->where('itinerary_city','1')->groupBy('id')->get();
		
		$transports = Transport::orderBy('id' , 'desc')->with('car')->with('venderName')->with('car_segment')->with('car_model')->with('car_seats')->with('countryName')->with('stateName')->with('cityName')->get();
		return view('vender/makeitinerarynewm', compact('cities','transports'));
	}

	
	
	public function printItinerary($id){
		$itinerary = ITIBasicInfo::where('itinerary_no',$id)->get();
		return view('vender/printitinerary', compact('itinerary'));
	}

}
