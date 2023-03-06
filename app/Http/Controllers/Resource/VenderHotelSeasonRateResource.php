<?php

namespace App\Http\Controllers\Resource;
use View;
use App\HotelSeasonRate;
use App\Hotel;
use App\RoomCategory;
use App\RoomTypes;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Controllers\Controller;
use App\AdminRequest;
use Storage;

class VenderHotelSeasonRateResource extends Controller
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
        //$hotel_season_rates = HotelSeasonRate::orderBy('id' , 'desc')->with('hotel')->with('RoomCategory')->get();
        $vender_id = session()->get('vender.id');            
        
        $hotel_season_rates = HotelSeasonRate::select('hotel_season_rates.*', 'hotels.hotel_name','hotels.vender_approved', 'room_types.room_type')
                                                ->join('hotels','hotels.id','=','hotel_season_rates.hotel_id')
                                                ->join('room_types','room_types.id','=','hotel_season_rates.room_type_id')
                                                ->where('hotels.vender_id',$vender_id[0])
                                                ->orderBy('hotel_season_rates.id' , 'desc')->get();
        return view('vender.hotelseasonrates.index', compact('hotel_season_rates'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   //$hotels = Hotel::All();
        //$roomcategories = RoomCategory::All();
        $vender_id = session()->get('vender.id');            
        $hotels = Hotel::where('vender_id',$vender_id[0])->orderBy('id' , 'desc')->get();
        
        return view('vender.hotelseasonrates.create', compact('hotels'));
    }

    /** 
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         
        /*$this->validate($request, [
            'car_name'          => 'required',
            'seat'   => 'required',
            'car_image'         => 'required|mimes:jpeg,jpg,bmp,png|max:5242880',
        ]);*/

        try{

            /*$post = $request->all();

                        
            $res = HotelSeasonRate::create( $post );
            
            return back()->with('flash_success','Hotel Season Rate Saved Successfully');*/
            if($request->Has('hotel_id')){
            $updatehotel = Hotel::where('id', $request->hotel_id)->first();
            $updatehotel->child_age = $request->child_age;
            $updatehotel->child_extra_cost = $request->child_extra_cost;
            $updatehotel->chable_adult_age = $request->chable_adult_age;
            $updatehotel->adult_extra_cost = $request->adult_extra_cost;
            $updatehotel->one_occupancy_cost = $request->one_occupancy_cost;
            $updatehotel->save();
            
            
            $count = count($request->room_type_id);
            for($x = 0; $x< $count; $x++){
                $seasonrate = new HotelSeasonRate(); 
                $seasonrate->hotel_id = $request->hotel_id;
                $seasonrate->room_type_id = $request->room_type_id[$x];
                $seasonrate->start_date = $request->start_date[$x];
                $seasonrate->end_date = $request->end_date[$x];
                $seasonrate->ep_price = $request->ep_price[$x];
                $seasonrate->cp_price = $request->cp_price[$x];
                $seasonrate->map_price = $request->map_price[$x];
                $seasonrate->ap_price = $request->ap_price[$x];
                $seasonrate->status = 'ACTIVE';
                $seasonrate->save();
            }
            
            return back()->with('flash_success','SUCESS: Hotel Season Rate Saved Successfully');
        }

        } 

        catch (ModelNotFoundException $e) {
            return back()->with('flash_error', 'Hotel Season Rates Not Found');
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
            $hotel_season_rates = HotelSeasonRate::findOrFail($id);
            return view('vender.hotelseasonrates.show', compact('hotel_season_rates'));

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
            $hotel = Hotel::select('hotels.vender_id')
                            ->join('hotel_season_rates','hotels.id','=','hotel_season_rates.hotel_id')
                            ->where('hotel_season_rates.id',$id)
                            ->first();
            $vender_id = session()->get('vender.id');   
             if(!empty($hotel) && $hotel->vender_id == $vender_id[0] ){
            
            $hotelseasonrate = HotelSeasonRate::findOrFail($id);
            $roomcategories = RoomCategory::where('hotel_id',$hotelseasonrate->hotel_id)->get();
            $hotel_approved = Hotel::select('hotels.vender_approved')
                            ->where('hotels.id',$hotelseasonrate->hotel_id)
                            ->first();
            
            
            return view('vender.hotelseasonrates.edit',compact('hotelseasonrate', 'roomcategories','hotel_approved'));
             }else{
                  return redirect()->route('hotelseasonrates.index')->with('flash_success', 'Sorry! you are trying to access other hotel data'); 

             }
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
            'car_name'          => 'required',
            'seat'   => 'required',
        ]);*/
        try{
            $post = HotelSeasonRate::findOrFail($id);
            
            if( $post ) {
                //$post->hotel_id = $request->hotel_id;
                $post->room_type_id = $request->room_type_id;
                $post->start_date = $request->start_date;
                $post->end_date = $request->end_date;
                $post->ep_price = $request->ep_price;
                $post->cp_price = $request->cp_price;
                $post->map_price = $request->map_price;
                $post->ap_price = $request->ap_price;
                $post->status = $request->status;
            }
            
            $post->save();

            return redirect()->route('hotelseasonrates.index')->with('flash_success', 'Hotel Season Rate Updated Successfully'); 
            
        } 

        catch (ModelNotFoundException $e) {
            return back()->with('flash_error', 'Hotel Season Rate Not Found');
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

            $post = hotelseasonrate::findOrFail($id);
            if( $post ) {
                $post->delete();
                return back()->with('flash_success', 'Post deleted successfully');
            }

        } 
        catch (ModelNotFoundException $e) {
            return back()->with('flash_error', 'Post Not Found');
        }
    }
}
