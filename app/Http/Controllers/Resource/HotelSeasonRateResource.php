<?php

namespace App\Http\Controllers\Resource;
use View;
use App\HotelSeasonRate;
use App\Hotel;
use App\RoomCategory;
use App\City;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Controllers\Controller;
use App\AdminRequest;
use Storage;

class HotelSeasonRateResource extends Controller 
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
        $user=session()->get('admin');
        if ( ($request->has('hotel_id') && $request->input('hotel_id')!= '') ) {
            
			$query = HotelSeasonRate::query();
			if($request->has('hotel_id') && $request->input('hotel_id')!= ''){
			  $query->where('hotel_id',$request->input('hotel_id'));
			}
            $hotel_season_rates = $query->orderBy('id' , 'desc')->with('hotel')->with('RoomType')->with('RoomCategory')->where('company_id',$user['comp_id'][0])->where('property_id',$user['id'][0])->paginate(10);
        }else{ 
            $hotel_season_rates = HotelSeasonRate::orderBy('id' , 'desc')->with('hotel')->with('RoomType')->with('RoomCategory')->where('company_id',$user['comp_id'][0])->where('property_id',$user['id'][0])->paginate(10);
        }
        $hotels = Hotel::where('status', 'ACTIVE')->where('company_id',$user['comp_id'][0])->where('property_id',$user['id'][0])->orderby('hotel_name', 'ASC')->get();
		
        return view('admin.hotelseasonrate.index', compact('hotel_season_rates','hotels'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $user=session()->get('admin');
        $hotels = Hotel::where('status', 'ACTIVE')->where('company_id',$user['comp_id'][0])->where('property_id',$user['id'][0])->orderby('hotel_name', 'ASC')->get();
		$citiesh = City::select('hotels.*','cities.id as city_id','cities.name as name')->join('hotels', 'cities.id', '=', 'hotels.city_id')->groupBy('cities.id')->get();
        //$roomcategories = RoomCategory::All();
        return view('admin.hotelseasonrate.create', compact('hotels','citiesh'));
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
            $user=session()->get('admin');
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
                $seasonrate->room_category_id = $request->room_type_id[$x];
                $seasonrate->start_date = $request->start_date[$x];
                $seasonrate->end_date = $request->end_date[$x];
                $seasonrate->ep_price = $request->ep_price[$x];
                $seasonrate->cp_price = $request->cp_price[$x];
                $seasonrate->map_price = $request->map_price[$x];
                $seasonrate->ap_price = $request->ap_price[$x];
                $seasonrate->status = 'ACTIVE';
                $seasonrate->property_id=$user['id'][0];
                $seasonrate->company_id=$user['comp_id'][0];
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
            return view('admin.hotelseasonrate.show', compact('hotel_season_rate'));

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
            $user=session()->get('admin');
            $hotelseasonrate = HotelSeasonRate::where('id',$id)->where('company_id',$user['comp_id'][0])->where('property_id',$user['id'][0])->first();
            if ($hotelseasonrate) {
                $roomcategories = RoomCategory::where('hotel_id',$hotelseasonrate->hotel_id)->get();
                return view('admin.hotelseasonrate.edit',compact('hotelseasonrate', 'roomcategories'));
            } else {
                return back()->with('flash_error', 'Hotel Season Rate Not Found');
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
            $user=session()->get('admin');
			$post = HotelSeasonRate::where('id',$id)->where('company_id',$user['comp_id'][0])->where('property_id',$user['id'][0])->first();
			
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
                
                $post->save();
                return redirect()->route('hotelseasonrate.index')->with('flash_success', 'Hotel Season Rate Updated Successfully');     
            }  
            else {
                return redirect('/admin/hotelseasonrate')->with('flash_error', 'Hotel Season Rate Not Found');
            }          
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
            $user=session()->get('admin');
            $post = hotelseasonrate::where('id',$id)->where('company_id',$user['comp_id'][0])->where('property_id',$user['id'][0])->first();
            if( $post ) {
                $post->delete();
                return back()->with('flash_success', 'Hotel Season Rate deleted successfully');
            }
            else {
                return back()->with('flash_error', 'Hotel Season Rate Not Found');
            }
        } 
        catch (ModelNotFoundException $e) {
            return back()->with('flash_error', 'Hotel Season Rate Not Found');
        }
    }
}
